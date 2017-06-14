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
        
    public function actionCreate()
    {
        $cardModel= new Card;
        $cardModel->created_at= time()."";
        $cardModel->updated_at= time()."";
        if ($cardModel->load(\Yii::$app->request->post()) && $cardModel->validate()){
            $cardModel->save();
           $this->redirect(['list']);
        }
 
      return $this->render('create',[
            'cardModel'=>$cardModel
        ]);
 
        
    }
    
    
    public function actionDetail($cnum) {
        $cardModel = Card::find()->where(['card_number' => $cnum])->one();
        if(!isset($cardModel))
        {
            throw new \yii\web\HttpException("card not found", 404);
        }
        return $this->renderAjax('detail', [
            'cardModel' => $cardModel
        ]);
    }

}
