<?php

namespace app\controllers;
use app\models\User;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        return $this->render('index');
        $userModel= User::find()->all();
      
        var_dump($userModel);
    }
    
    
    public function actionDelete()
    {
        $userModel= User::findOne(5);
        $userModel->delete();
    }
    
    
    
    public function actionUpdate()
    {
        $userModel= User::findOne(5);
        $userModel->username="aaaaaaasss";
        $userModel->email="gkgkgkgkgkgk";
        $userModel->password_hash="lklkm";
        $userModel->status=0;
        $userModel->auth_key="vfdv";
        $userModel->created_at="123321";
        $userModel->updated_at="3212332";
        $userModel->save();
        var_dump($userModel);
        
    }
    
    
    public function actionCreate()
    {
        $userModel= new \app\models\User;
        $userModel->username="aref";
        $userModel->email="kjvc;kjenv;js";
        $userModel->password_hash="aaaaaa";
         $userModel->status=1;
        $userModel->auth_key="dv";
        $userModel->created_at="123321";
        $userModel->updated_at="3212332";
        $userModel->save();
        var_dump($userModel);
        
        
    }

}
