<?php
use yii\db\Migration;

class m141022_115823_create_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'account_activation_token' => $this->string(),          
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'level' => $this->integer()->notNull(),
        ], $tableOptions);
        
        $this->insert("{{%user}}", [
            'username' => 'akbar',
            'password_hash' => Yii::$app->security->generatePasswordHash("123456"),
            'email' => 'akbar.joody@gmail.com',
            'status' => 1,
            'auth_key' => Yii::$app->security->generateRandomString(),
            'created_at' => time(),
            'updated_at' => time(),
            'level' => 1,
        ]);
        $this->insert("{{%user}}", [
            'username' => 'aref',
            'password_hash' => Yii::$app->security->generatePasswordHash("123456"),
            'email' => 'rf.mohammadzade.am@gmail.com',
            'status' => 1,
            'auth_key' => Yii::$app->security->generateRandomString(),
            'created_at' => time(),
            'updated_at' => time(),
            'level' => 1,
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}