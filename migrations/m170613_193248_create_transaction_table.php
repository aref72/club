<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transaction`.
 */
class m170613_193248_create_transaction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('transaction', [
            'id' => $this->primaryKey(),
            'card_number'=> $this->integer()->notNull(),
            'game_type'=> $this->string()->notNull(),
            'price'=> $this->integer()->null(),
            'time' => $this->integer()->null(),
            'process_type' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('transaction');
    }
}
