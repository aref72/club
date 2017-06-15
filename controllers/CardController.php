<?php

namespace app\controllers;
use app\models\Card;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\CardType;

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
        $CardTypeItem = ArrayHelper::map(CardType::find()->asArray()->all(), 'id', 'name');
 
      return $this->render('create',[
            'cardModel'=>$cardModel,
          'CardTypeItem'=>$CardTypeItem
        ]);
 
        
    }
    
     public function actionDelete($id)
    {
        $cardModel= Card::findOne($id);
        $cardModel->delete();
        $this->redirect(['list']);
    }
    
        public function actionUpdate($id)
    {
  
        $cardModel= Card::findOne($id);
        $cardModel->updated_at= time()."";
        if ($cardModel->load(\Yii::$app->request->post()) && $cardModel->validate()){
            $cardModel->save();
           $this->redirect(['list']);
        }
      return  $this->render('update',[
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
