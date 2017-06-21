<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use yii\base\Component;
/**
 * Description of Utility
 *
 * @author asus
 */
class Utility extends Component{
    
    public function checkTimeAndCloseGame($models, $process_type) {
        if($process_type == 0)
        {
            $result = [];
            if(!empty($models)){
                foreach ($models as $model) {
                    
                    $time_process= null;
                    $priceTime = \app\models\PriceTime::find()
                            ->where([
                                'card_type' => $model->card->card_type,
                                'game_type' => $model->type,
                                'status' => 1,
                            ])->all();
                    foreach ($priceTime as $pt)
                    {
                        if($model->price == $pt->price)
                        {
                            $time_process = $pt->time*60;
                        }
                    }
                    if(!empty($time_process))
                    {
                        $time = time() - $model->in_time;
                        if($time >= $time_process && ($time_process) <=$time)
                        {
                            $model->out_time = time() + (time() - $model->in_time)."";
                            $resSave = $model->save();
                            $result[] =[
                                'result' => $resSave,
                                'card_number' => $model->card_number,
                            ];
                        }
                    } 
                }
            }
            return $result;
            
        }
    }
}
