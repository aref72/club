<?php
namespace app\modules\account\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $logo
 * @property integer $signuptime
 * @property string $auth_key
 * @property string $created_at 
 * @property string $updated_at 
 * @property Role $role
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
            [['username', 'password_hash', 'email'], 'required','message'=>'فیلد را پر کنید'],
            [['username', 'authKey'], 'string', 'max' => 200],
            [['password_hash', 'email'], 'string', 'max' => 250],
            [['username'], 'unique','message'=>'کاربر قبلا ثبت شده است'],
            [['email'], 'email','message'=>'ایمیل معتبر نیست'],
            [['email'], 'unique','message'=>'این کاربر قبلا ثبت شده است'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'شناسه'),
            'username' => Yii::t('app', 'username'),
            'password_hash' => Yii::t('app', 'password_hash'),
            'email' => Yii::t('app', 'email'),
            'logo' => Yii::t('app', 'logo'),
            'created_at' => Yii::t('app', 'created_at'),
            'updated_at' => Yii::t('app', 'created_at'),
            'status' => Yii::t('app', 'status'),
            'auth_key' => Yii::t('app','auth_key'),
            'roleName' => Yii::t('app', 'roleName'),
        ];
    }
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(\app\rbac\models\Role::className(), ['user_id' => 'id']);
    }

    /**
     * Returns the role name ( item_name )
     *
     * @return string
     */
    public function getRoleName()
    {
        return $this->role->item_name;
    }
    
    
    public function genarateAuthKey()
    {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
    }
    
    /**
     * Generates password hash from password and sets it to the model.
     *
     * @param  string $password
     * 
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    
    public static  function getColumns($sec){
        $secnario = [];
        $secnario['report'] = ['id','username', 'email', 'status', 'created_at', 'updated_at'];
        return $secnario[$sec];
    }
    //-------------------------------validators-----------------------------------------//
    
    
    /**
     * @return boolean if password provided is valid for current user
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    //-------------------------------\yii\web\IdentityInterface-------------------------//
    
     /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    
}
