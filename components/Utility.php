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
                    if($model->card->card_type == 1 || $model->card->card_type == 2)//xbox
                    {
                        if($model->price == 1000)
                        {
                            $time = time() - $model->in_time;
                            if($time >= 20 && $time <=25)
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
                    else if($model->card->card_type == 2)//ps4
                    {

                    }
                    else if($model->card->card_type == 3)//biliard
                    {

                    }
                }
            }
            return $result;
            
        }
    }
}
