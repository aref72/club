<?php

namespace app\modules\account\controllers;

use Yii;
use yii\web\Controller;
use app\modules\account\models\LoginForm;
use app\modules\account\models\UserSearch;
use app\modules\account\models\User;
use app\rbac\models\Role;
use yii\base\Model;

class UserController extends Controller
{ 
    public $layout = '//admin';

    public $defaultAction = 'login';

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create', 'update', 'delete', 'view', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete', 'view', 'index'],
                        'allow' => true,
                        'roles' => ['theCreator', 'admin', 'manageUsers'],
                    ],
                ]
            ]
        ];
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    public function actionLogin()
    {
        $this->layout = '//login';
        if(!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model->setCountLogin();
        if(Yii::$app->request->post()){ 
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->redirect(Yii::$app->user->returnUrl);
            }
        }
	
        return $this->render('login', [
           'model' => $model,
        ]);
    }
    
    public function actionSignup(){ 
        $this->layout = '//login';
       	if(!Yii::$app->user->isGuest)
            return $this->redirect('@adshome');
        $model = new SignupForm();
        if($model->load(Yii::$app->request->post())){
            $user = $model->signup();
                if(!empty($user) and Yii::$app->user->login($user))
                    return $this->redirect('@admin');
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    public function actionIndex() {
        $userSearchModel = new UserSearch();
        $userDataProvider = $userSearchModel->search(Yii::$app->request->queryParams);
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('index', [
                'userDataProvider' => $userDataProvider,
                'userSearchModel' => $userSearchModel,
            ]);
        }
        return $this->render('index', [
            'userDataProvider' => $userDataProvider,
            'userSearchModel' => $userSearchModel,
        ]);
    }
    
    public function actionView($id) {
        $userModel = User::findOne($id);
        
        return $this->renderAjax('view', [
            'userModel' => $userModel
        ]);
    }
    public function actionCreate() {
        $userModel = new User();
        $roleModel = new Role();

        if ($userModel->load(Yii::$app->request->post()) && 
            $roleModel->load(Yii::$app->request->post()) &&
            Model::validateMultiple([$userModel, $roleModel]))
        {
            $userModel->genarateAuthKey();
            $userModel->setPassword($userModel->password_hash);
            
            if ($userModel->save()) 
            {
                $roleModel->user_id = $userModel->getId();
                $roleModel->save(); 
            }  

            return $this->redirect('index');      
        } 
        
        $auth_items = \yii\helpers\ArrayHelper::map(\app\rbac\models\AuthItem::find()
                ->where(['!=', 'name', 'theCreator'])
                ->asArray()
                ->all(), 'name', 'name');
        return $this->renderAjax('create', [
            'userModel' => $userModel,
            'roleModel' => $roleModel,
            'auth_items' => $auth_items
        ]);
    }
    
    
    public function actionUpdate($id) {
        $userModel = User::findOne($id);
        $roleModel = Role::findOne($userModel->roleName);
        
        //جلوگیری از ویرایش کاربر بانقش ایجاد کننده توسط کاربر بانقش ادمین
        //یا کاربر با نقش مدیر کاربرها
        $identity = Yii::$app->user->identity;
        if(($identity->role->item_name=='admin' || $identity->role->item_name=='manageUsers')
                && $userModel->role->item_name == 'theCreator'){
            throw new \yii\web\HttpException(403, 'You are not allowed to perform this action.');
        }
        
        if ($userModel->load(Yii::$app->request->post()) && 
            $roleModel->load(Yii::$app->request->post()) &&
            Model::validateMultiple([$userModel, $roleModel]))
        {
            $userModel->setPassword($userModel->password_hash);
            if ($userModel->save() && $roleModel->save()) 
            {
                return 1;
            }  

                 
        } 
        
        $auth_items = \yii\helpers\ArrayHelper::map(\app\rbac\models\AuthItem::find()
                ->where(['!=', 'name', 'theCreator'])
                ->asArray()
                ->all(), 'name', 'name');
        return $this->renderAjax('update', [
            'userModel' => $userModel,
            'roleModel' => $roleModel, 
            'auth_items' => $auth_items,
        ]);
    }
    
    public function actionDelete($id) {
        $userModel = User::findOne($id);
        $roleModel = Role::find()->where(['user_id' => $id])->one();
        
        //جلوگیری از ویرایش کاربر بانقش ایجاد کننده توسط کاربر بانقش ادمین
        //یا کاربر با نقش مدیر کاربرها
        $identity = Yii::$app->user->identity;
        if(($identity->role->item_name=='admin' || $identity->role->item_name=='manageUsers')
                && $userModel->role->item_name == 'theCreator'){
            throw new \yii\web\HttpException(403, 'You are not allowed to perform this action.');
        }
        
        if(!empty($userModel) && !empty($roleModel)){
            if($userModel->delete() && $roleModel->delete()){
                return 1;
            }
        }
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
