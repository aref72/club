<?php

namespace app\controllers;
use app\models\Card;
use yii\data\ActiveDataProvider;
use Yii;

class CardController extends \yii\web\Controller
{
    public function actionList()
    {
           $dataProvider= new ActiveDataProvider([
            'query'=> Card::find(),
            'pagination' => [ 'pageSize' => 3 ]
        ]);
        
        
        return $this->render('list',[
            'dataProvider'=>$dataProvider
        ]);
        
    }

}
