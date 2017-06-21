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
                'only' => ['create','list','computing'],
                'rules' => [
                    [
                        'actions' => ['create','list','computing'],
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
        $gameModel->setScenario('create');
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
        $priceItems = ArrayHelper::map(\app\models\PriceTime::find()->where(['status' => 1])->asArray()->all(), 'price', 'price');
        return $this->render('_form', [
            'gameModel' => $gameModel,
            'gameTypeItems' => $gameTypeItems,
            'priceItems' =>$priceItems,
        ]);
    }
    public function actionList() {
        $gamePriceSum = Game::find()->where(['not',['price' =>null]])->andWhere(['!=', 'out_time', ''])->sum('price');
        $gameQuery= Game::find()->joinWith(['gameType', 'card', 'user', 'card.cardType'])->where(['and', ['!=', 'out_time', ''], ['!=', 'price', '']]);
        $dataProvider=new \yii\data\ActiveDataProvider([
            'query'=>$gameQuery,
            'pagination' => [
                'pageSize' => 9
            ]
            
        ]);
        return $this->render('list',[
           'dataProvider'=>$dataProvider,
           'gamePriceSum' => $gamePriceSum,
        ]);
    }
    
    
    public function actionComputing() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $gameModelByPrice = Game::find()->where(['process_type' => 0])->andWhere(['out_time' => ''])->all();
        $res = Yii::$app->utility->checkTimeAndCloseGame($gameModelByPrice, 0);
        return $res;
        
        
    }

}
