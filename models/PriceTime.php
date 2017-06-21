<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price_time".
 *
 * @property integer $id
 * @property integer $price
 * @property integer $time
 * @property integer $status
 */
class PriceTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'time', 'status', 'card_type', 'game_type'], 'required'],
            [['price', 'time', 'status', 'card_type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'price' => 'مبلغ',
            'time' => 'زمان',
            'status' => 'وضعیت',
            'card_type' => 'نوع دستگاه',
            'game_type' => 'نوع بازی',
        ];
    }
      public function getCardType() {
        return $this->hasOne(CardType::className(), ['id'=> 'card_type']);
    }
      public function getGameType() {
         return $this->hasOne(GameType::className(), ['id'=> 'game_type']);
    }

}
