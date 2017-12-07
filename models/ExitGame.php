<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of ExitGame
 *
 * @author asus
 */
class ExitGame extends \yii\base\Model{
    public $card_number;
    
    
    public function rules() {
        return [
            [['card_number'], 'required'],
            [['card_number'], 'CardNumberValidation']
        ];
    }
    
    public function attributeLabels() {
        return [
            'card_number' => 'شماره کارت'
        ];
    }
    
    
    public function CardNumberValidation($attribute) {
        $res = Card::find()->where(['card_number' => $this->$attribute])->exists();
        if(!$res)
        {
            $this->addError($attribute, "کارت مورد نظر پیدا نشد");
        }
    }
    
    public function exitCard()
    {
        $gameModel = Game::find()->where(['out_time' => null, 'card_number' => $this->card_number])->one();
        if(!isset($gameModel->id))
        {
            $this->addError('card_number', "این کارت وارد نشده است");
        }
        else
        {
        
        
            $gameModel->out_time= time().'';
            $hour = ($gameModel->out_time - $gameModel->in_time) / 60 /60;

            $priceModel = PriceTime::find()->where(['card_type' => $gameModel->card->card_type])->all();
//            foreach ($priceModel as $price) 
//            {
//                if($hour < $price->time)
//                {
//                    $gameModel->price = 10;
//                }
//            }
            if($hour < 0.5)
            {
                $gameModel->price = 10;
            }
            else if($hour == 1 || $hour > 1)
            {
                $gameModel->price = 2000 * $hour;
            }
            
            if($gameModel->save())
            {
                return $gameModel;
            }
            return false;
        }
        
    }
}
