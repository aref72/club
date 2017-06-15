<?php

namespace app\controllers;

use Yii;
use app\models\Transaction;
use app\models\GameType;
use yii\helpers\ArrayHelper;

class TransactionController extends \yii\web\Controller
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
        $transactionModel = new Transaction();
        $transactionModel->in_time = time()."";
        $transactionModel->user_id = Yii::$app->user->id;
        if($transactionModel->load(Yii::$app->request->post()) && $transactionModel->validate())
        {
            if($transactionModel->save())
            {
                $transactionModel->clearValue();
                Yii::$app->session->setFlash('success', 'باموفقیت ثبت شد');
            }
            else{
                Yii::$app->session->setFlash('success', 'متاسفانه ثبت نشد. دوباره تلاش کنید');
            }
        }
        
        $gameTypeItems = ArrayHelper::map(GameType::find()->asArray()->all(), 'id', 'name');
        return $this->render('_form', [
            'transactionModel' => $transactionModel,
            'gameTypeItems' => $gameTypeItems,
        ]);
    }
    public function actionList() {
        $transactionQuery= Transaction::find();
        $dataProvider=new \yii\data\ActiveDataProvider([
            'query'=>$transactionQuery,
            
        ]);
        return $this->render('list',[
           'dataProvider'=>$dataProvider,
        ]);
    }

}
