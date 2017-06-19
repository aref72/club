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
            [['price', 'time', 'status', 'card_type'], 'required'],
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
        ];
    }
}
