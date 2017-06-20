<?php

namespace app\controllers;

use Yii;
use app\models\Game;
use app\models\GameType;
use yii\helpers\ArrayHelper;

class GameController extends \yii\web\Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }
    public function actionCreate()
    {
        $gameModel = new Game();
        $gameModel->in_time = time()."";
        $gameModel->user_id = Yii::$app->user->id;
        if($gameModel->load(Yii::$app->request->post()) && $gameModel->validate())
        {
            if($gameModel->save())
            {
                $gameModel->clearValue();
                Yii::$app->session->setFlash('success', 'باموفقیت ثبت شد');
            }
            else{
                Yii::$app->session->setFlash('success', 'متاسفانه ثبت نشد. دوباره تلاش کنید');
            }
        }
        
        $gameTypeItems = ArrayHelper::map(GameType::find()->asArray()->all(), 'id', 'name');
        return $this->render('_form', [
            'gameModel' => $gameModel,
            'gameTypeItems' => $gameTypeItems,
        ]);
    }
    public function actionList() {
        $transactionQuery= Game::find()->joinWith(['gameType', 'card', 'user', 'card.cardType'])->where(['and', ['!=', 'out_time', ''], ['!=', 'price', '']]);
        $dataProvider=new \yii\data\ActiveDataProvider([
            'query'=>$transactionQuery,
            'pagination' => [
                'pageSize' => 9
            ]
            
        ]);
        return $this->render('list',[
           'dataProvider'=>$dataProvider,
        ]);
    }
    
    
    public function actionComputing() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $gameModelByPrice = Game::find()->where(['process_type' => 0])->andWhere(['out_time' => ''])->all();
        $res = Yii::$app->utility->checkTimeAndCloseGame($gameModelByPrice, 0);
        return $res;
        
        
    }

}
