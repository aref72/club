<?php

namespace app\controllers;

use Yii;
use app\models\Transaction;
use app\models\GameType;
use yii\helpers\ArrayHelper;

class TransactionController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $transactionModel = new Transaction();
        if($transactionModel->load(Yii::$app->request->post()) && $transactionModel->validate())
        {
            
        }
        
        $gameTypeItems = ArrayHelper::map(GameType::find()->asArray()->all(), 'id', 'name');
        return $this->render('_form', [
            'transactionModel' => $transactionModel,
            'gameTypeItems' => $gameTypeItems,
        ]);
    }

}
