<?php

use yii\db\Migration;

/**
 * Handles the creation of table `card`.
 */
class m170613_183854_create_card_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('card', [
            'id' => $this->primaryKey(),
            'card_number' => $this->integer()->unique()->notNull(),
            'created_at' => $this->string()->notNull(),
            'updated_at' => $this->string()->notNull(),
            'status' => $this->boolean()->notNull(),
            'card_type' => $this->integer()->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('card');
    }
}
