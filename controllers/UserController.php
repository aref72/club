<?php

namespace app\controllers;
use app\models\User;
use yii\data\ActiveDataProvider;


class UserController extends \yii\web\Controller
{
    
    
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
            $userModel->save();
           $this->redirect(['list']);
        }
 
      return $this->render('create',[
            'userModel'=>$userModel
        ]);
 
        
    }

}
