<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price_time`.
 */
class m170619_173542_create_price_time_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('price_time', [
            'id' => $this->primaryKey(),
            'price' => $this->integer(),
            'time' => $this->integer(),
            'status' => $this->boolean(),
            'card_type' => $this->integer(),
            'game_type' => $this->integer(),
        ]);
        $this->db->createCommand()->insert('price_time', [
            'price' => 1000,
            'time' => 1,
            'status' => 1,
            'card_type' => 1,
            'game_type' => 1
        ])->execute();
        
         $this->db->createCommand()->insert('price_time', [
            'price' => 1000,
            'time' => 1,
            'status' => 1,
            'card_type' => 2,
            'game_type' => 1
        ])->execute();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('price_time');
    }
}
