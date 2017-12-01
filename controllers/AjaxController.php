<?php
namespace app\controllers;


use Yii;
use app\models\Game;
/**
 * Description of AjaxController
 *
 * @author asus
 */
class AjaxController extends \yii\web\Controller{
    
    
    
    public function actionComputing() {
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $data = '';
            $i = 0;
            while (true){
                $i++;
                usleep(1000000);
                
                $gameModelByPrice = Game::find()->where(['process_type' => 0])->andWhere(['out_time' => ''])->all();
                $res = Yii::$app->utility->checkTimeAndCloseGame($gameModelByPrice, 0);
                $array = [];
                if(!empty($res))
                {
                    $array['result']= true;
                    $array['data'] = $res;
                    return $array;
                }

                if($i== 7)
                {
                    return false;
                }
            }
        }
        
        
    }
}
