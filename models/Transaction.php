<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $card_number
 * @property string $game_type
 * @property integer $price
 * @property string $process_type
 * @property integer $user_id
 * @property string $in_time
 * @property string $out_time
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_number', 'game_type', 'user_id', 'in_time'], 'required'],
            [['card_number', 'price', 'user_id'], 'integer'],
            [['game_type', 'process_type', 'in_time', 'out_time'], 'string', 'max' => 255],
            [['card_number'], 'CardNumberValidation'],
            [['price'], 'priceValidation', 'skipOnEmpty' => false,]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'card_number' => 'شماره کارت',
            'game_type' => 'نوع بازی',
            'price' => 'مبلغ',
            'process_type' => 'براساس زمان',
            'user_id' => 'شناسه کاربر',
            'in_time' => 'زمان ورود',
            'out_time' => 'مدت زمان',
        ];
    }
    
    
    public function CardNumberValidation($attribute) {
        $res = Card::find()->where(['card_number' => $this->$attribute])->exists();
        if(!$res)
        {
            $this->addError($attribute, "کارت مورد نظر پیدا نشد");
        }
    }
    
    public function clearValue() {
        $this->card_number= null;
        $this->game_type =null;
        $this->price=null;
        $this->process_type=null;
        $this->out_time=null;
    }
    
    public function priceValidation($attribute) {
        if(empty($this->$attribute) && empty($this->out_time))
        {
            $this->addError($attribute, 'مبلغ نمی تواند خالی باشد');
        }
    }
    
    public function getGameType() {
        return $this->hasOne(GameType::className(), ['id' => 'game_type']);
    }
    
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function getCard() {
        return $this->hasOne(Card::className(), ['card_number' => 'card_number']);
    }
}
