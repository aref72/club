<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property integer $status
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $account_activation_token
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'status', 'auth_key', 'created_at', 'updated_at', 'level'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'password_hash', 'password_reset_token', 'account_activation_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'username' => 'نام کاربری',
            'email' => 'ایمیل',
            'password_hash' => 'گذرواژه',
            'status' => 'وضعیت',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'account_activation_token' => 'Account Activation Token',
            'created_at' => 'زمان ایجاد',
            'updated_at' => 'زمان ویرایش',
            'level'=>'سطح کاربر',
        ];
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey) {
        return $this->auth_key == $authKey;
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        
    }
    
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
