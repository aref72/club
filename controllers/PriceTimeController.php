<?php

namespace app\controllers;
use app\models\PriceTime;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\ArrayHelper;

class PriceTimeController extends \yii\web\Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create','list','update','delete'],
                'rules' => [
                    [
                        'actions' => ['create','list','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function()
                        {
                            if(Yii::$app->user->identity->level != 1)
                            {
                                return false;
                            }
                            return true;
                        }
                    ]
                ]
            ]
        ];
    }
    public function actionList()
    {
           $dataProvider= new ActiveDataProvider([
            'query'=> PriceTime::find(),
            'pagination' => [ 'pageSize' => 13 ]
        ]);
        
        
        return $this->render('list',[
            'dataProvider'=>$dataProvider
        ]);
        
    }
        
    public function actionCreate()
    {
        $priceTimeModel= new PriceTime();
        if ($priceTimeModel->load(\Yii::$app->request->post()) && $priceTimeModel->validate()){
            $priceTimeModel->save();
           $this->redirect(['list']);
        }
        $cardTypeItems = ArrayHelper::map(\app\models\CardType::find()->asArray()->all(), 'id', 'name');
        $gameTypeItems = ArrayHelper::map(\app\models\GameType::find()->asArray()->all(), 'id', 'name');
        return $this->render('create',[
            'priceTimeModel'=>$priceTimeModel,
            'cardTypeItems' => $cardTypeItems,
            'gameTypeItems' => $gameTypeItems,
        ]);
 
        
    }
    
     public function actionDelete($id)
    {
        $priceTimeModel= PriceTime::findOne($id);
        $priceTimeModel->delete();
        $this->redirect(['list']);
    }
    
        public function actionUpdate($id)
    {
  
        $priceTimeModel= PriceTime::findOne($id);
        $priceTimeModel->updated_at= time()."";
        if ($priceTimeModel->load(\Yii::$app->request->post()) && $priceTimeModel->validate()){
            $priceTimeModel->save();
           $this->redirect(['list']);
        }
      return  $this->render('update',[
          'cardModel'=>$priceTimeModel
      ]);

        
    }
    
    
    
 

}
