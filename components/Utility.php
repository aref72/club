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
    
    public function checkTime($models, $process_type) {
        if($process_type == 0)
        {
            $result = [];
            foreach ($models as $model) {
                if($model->card->card_type == 1)//xbox
                {
                    if($model->price == 1000)
                    {
                        $time = time() - $model->in_time;
                        if($time >= 600 && $time <=700)
                        {
                            $result[] =[
                                'card_number' => $model->card_number,
                            ];
                        }
                         
                    }
                }
                else if($model->card_type == 2)//ps4
                {
                    
                }
                else if($model->card_type == 3)//biliard
                {
                    
                }
            }
            return $result;
        }
    }
}
