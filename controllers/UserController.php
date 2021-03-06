<?php

namespace app\controllers;
use app\models\User;
use yii\data\ActiveDataProvider;
use Yii;

class UserController extends \yii\web\Controller
{
    
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['list', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['list', 'create', 'update', 'delete'],
                        'allow' => true,
                        'matchCallback' => function(){
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
                        },
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
    
    public function actionList()
    {
        $dataProvider= new ActiveDataProvider([
            'query'=>User::find(),
            'pagination' => [ 'pageSize' => 3 ]
        ]);
        
        
        return $this->render('list',[
            'dataProvider'=>$dataProvider
        ]);
        
    }
    
    
    public function actionDelete($id)
    {
        $userModel= User::findOne($id);
        $userModel->delete();
        $this->redirect(['list']);
    }
    
    
    
    public function actionUpdate($id)
    {
  
        $userModel= User::findOne($id);
        $userModel->updated_at= time();
        $userModel->auth_key= \Yii::$app->security->generateRandomString();
        if ($userModel->load(\Yii::$app->request->post()) && $userModel->validate()){
            $userModel->password_hash= \Yii::$app->security->generatePasswordHash($userModel->password_hash);
            $userModel->save();
           $this->redirect(['list']);
        }
      return  $this->render('update',[
          'userModel'=>$userModel
      ]);

        
    }
    
    
    public function actionCreate()
    {
        $userModel= new User;
        $userModel->created_at= time();
        $userModel->updated_at= time();
        $userModel->auth_key= \Yii::$app->security->generateRandomString();
        if ($userModel->load(\Yii::$app->request->post()) && $userModel->validate()){
            $userModel->password_hash= \Yii::$app->security->generatePasswordHash($userModel->password_hash);
            $userModel->save();
           $this->redirect(['list']);
        }
 
      return $this->render('create',[
            'userModel'=>$userModel
        ]);
 
        
    }
    
    public function actionView($id) {
        $userModel = User::find()->where(['id'=>$id])->one();
         if(!isset($userModel))
        {
            throw new \yii\web\HttpException("user not found", 404);
        }
         return $this->render('view', [
            'userModel' => $userModel
        ]);
        
    }
}
