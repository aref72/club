<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card".
 *
 * @property integer $id
 * @property integer $card_number
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $card_type
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_number', 'created_at', 'updated_at', 'status'], 'required'],
            [['card_number', 'status', 'card_type'], 'integer'],
            [['created_at', 'updated_at'], 'string', 'max' => 255],
            [['card_number'], 'unique'],
            ['card_number','string','min'=>6],
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
            'created_at' => 'زمان ایجاد',
            'updated_at' => 'زمان ویرایش',
            'status' => 'وضعیت',
            'card_type' => 'نوع کارت',
        ];
    }
}
