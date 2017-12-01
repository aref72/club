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
        $gameModel->out_time= time().'';
        $time = ($gameModel->out_time - $gameModel->in_time) / 60;
        
        $gameModel->price = 1000;
        $gameModel->save();
        
    }
}
