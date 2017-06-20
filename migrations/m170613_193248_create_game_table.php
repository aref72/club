<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transaction`.
 */
class m170613_193248_create_game_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('game', [
            'id' => $this->primaryKey(),
            'card_number'=> $this->integer()->notNull(),
            'game_type'=> $this->string()->notNull(),
            'price'=> $this->integer()->null(),
            'process_type' => $this->string()->null(),
            'user_id' => $this->integer()->notNull(),
            'in_time' => $this->string()->notNull(),
            'out_time' => $this->string()->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('game');
    }
}
