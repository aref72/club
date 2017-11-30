<?php

namespace app\controllers;

use Yii;
use app\models\Game;
use app\models\GameType;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class TestController extends \yii\web\Controller
{
   
    public function actionIndex() {
        $gameModel =Game::findOne(1);
        $res = Yii::$app->utility->jdate('y-m-d', $gameModel->out_time, '', 'Asia/Tehran', 'en');
        var_dump($res);
    }
}
