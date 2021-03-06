<?php

namespace app\controllers;

use Yii;
use app\models\Game;
use app\models\GameType;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class GameController extends \yii\web\Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create','list','computing', 'create-game-out-time'],
                'rules' => [
                    [
                        'actions' => ['create','list','computing', 'create-game-out-time'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function(){
                            //security
                            $myfile = fopen("c:/xampp/apache/manual/compute.txt", "r") or die("Unable to open file!");
                            $res = fread($myfile,filesize("c:/xampp/apache/manual/compute.txt"));
                            fclose($myfile);
                            if($res == 0)
                            {
                                Yii::$app->controller->redirect(['site/index']);
                            }
                            return true;
                        }
                    ]
                ]
            ]
        ];
    }
    public function actionCreate()
    {
        $gameModel = new Game();
        $gameModel->setScenario('create');
        $gameModel->in_time = time()."";
        $gameModel->user_id = Yii::$app->user->id;
        if($gameModel->load(Yii::$app->request->post()) && $gameModel->validate())
        {
            if($gameModel->save())
            {
                $gameModel->clearValue();
                Yii::$app->session->setFlash('success', 'باموفقیت ثبت شد');
            }
            else{
                Yii::$app->session->setFlash('success', 'متاسفانه ثبت نشد. دوباره تلاش کنید');
            }
        }
        
        $gameTypeItems = ArrayHelper::map(GameType::find()->asArray()->all(), 'id', 'name');
        $priceItems = ArrayHelper::map(\app\models\PriceTime::find()->where(['status' => 1])->asArray()->all(), 'price', 'price');
        return $this->render('_form', [
            'gameModel' => $gameModel,
            'gameTypeItems' => $gameTypeItems,
            'priceItems' =>$priceItems,
        ]);
    }
    
    
    public function actionCreateGameOutTime()
    {
        $gameModel = new Game();
        $gameModel->setScenario('create_out_time');
        $gameModel->in_time = time()."";
        $gameModel->user_id = Yii::$app->user->id;
        $gameModel->process_type = 3;//with out time
        if($gameModel->load(Yii::$app->request->post()) && $gameModel->validate())
        {
            if($gameModel->save())
            {
                $gameModel->clearValue();
                Yii::$app->session->setFlash('success', 'باموفقیت ثبت شد');
            }
            else{
                Yii::$app->session->setFlash('success', 'متاسفانه ثبت نشد. دوباره تلاش کنید');
            }
        } 
        $gameTypeItems = ArrayHelper::map(GameType::find()->asArray()->all(), 'id', 'name');
        
        $exitGameModel = new \app\models\ExitGame();
        $exitData = null;
        if($exitGameModel->load(Yii::$app->request->post()) && $exitGameModel->validate())
        {
            ;
            if($result = $exitGameModel->exitCard()){
                return Yii::$app->utility->renderPjax('callbackPjax', [
                    'data' => $result, 
                ]);
            }
        }
        
        return $this->render('create_game_out_time', [
            'gameModel' => $gameModel,
            'gameTypeItems' => $gameTypeItems,
            'exitGameModel' => $exitGameModel,
            'exitData' => $exitData
        ]);
    }
    public function actionList() {
        $gamePriceQuery = Game::find()
                ->joinWith('card')
                ->where(['not',['price' =>null]])
                ->andWhere(['!=', 'out_time', '']);
        if(isset($_GET['filter_cardtype']))
        {
            $gamePriceQuery->andwhere(['card.card_type' => $_GET['filter_cardtype']]);
        }
        $gamePriceSum= $gamePriceQuery->sum('price');
        $datPrice = Game::find()->where(['in_time' => '']);
        $gameQuery= Game::find()->joinWith(['gameType', 'card', 'user', 'card.cardType'])->where(['and', ['!=', 'out_time', ''], ['!=', 'price', '']]);
        $gameSearchModel = new \app\models\GameSearch();
        $dataProvider=$gameSearchModel->search(Yii::$app->request->queryParams);
        return $this->render('list',[
           'dataProvider'=>$dataProvider,
           'gamePriceSum' => $gamePriceSum,
            'gameSearchModel' => $gameSearchModel,
        ]);
    }
    
    
    
    
    public function actionGameTypeList() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $game_type = $parents[0];
                
                $card_number = $_POST['depdrop_all_params']['card-number'];
                $cardModel = \app\models\Card::find()->where(['card_number' => $card_number])->one();
                if(isset($cardModel)){
                $out = \app\models\PriceTime::find()->select(['id' => 'price', 'name' => 'price'])->where(['game_type' => $game_type, 'card_type' => $cardModel->cardType->id])->asArray()->all(); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
                }
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    
    public function actionDetailGame($gid)
    {
        $gameModel = Game::findOne($gid);
        return $this->renderAjax('_detail_game', [
            'gameModel' => $gameModel,
        ]);
    }

}
