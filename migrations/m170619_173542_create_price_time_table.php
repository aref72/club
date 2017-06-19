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
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('price_time');
    }
}
