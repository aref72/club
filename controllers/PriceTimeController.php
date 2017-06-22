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
                            //security
                            $myfile = fopen("c:/xampp/apache/manual/compute.txt", "r") or die("Unable to open file!");
                            $res = fread($myfile,filesize("c:/xampp/apache/manual/compute.txt"));
                            fclose($myfile);
                            if($res == 0)
                            {
                                Yii::$app->controller->redirect(['site/index']);
                            }
                            
                            
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
//        $priceTimeModel->updated_at= time()."";
        if ($priceTimeModel->load(\Yii::$app->request->post()) && $priceTimeModel->validate()){
            $priceTimeModel->save();
           $this->redirect(['list']);
        }
        $cardTypeItems = ArrayHelper::map(\app\models\CardType::find()->asArray()->all(), 'id', 'name');
        $gameTypeItems = ArrayHelper::map(\app\models\GameType::find()->asArray()->all(), 'id', 'name');
      return  $this->render('update',[
          'priceTimeModel'=>$priceTimeModel,
          'cardTypeItems' => $cardTypeItems,
          'gameTypeItems' => $gameTypeItems,
      ]);  
    }
    
        public function actionView($id) {
        $priceTimeModel = PriceTime::find()->where(['id' => $id])->one();
        if(!isset($priceTimeModel))
        {
            throw new \yii\web\HttpException("card not found", 404);
        }
        return $this->render('view', [
            'priceTimeModel' => $priceTimeModel
        ]);
    }
    
 

}
