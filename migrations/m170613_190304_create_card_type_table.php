<?php

use yii\db\Migration;

/**
 * Handles the creation of table `card_type`.
 */
class m170613_190304_create_card_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('card_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description'=> $this->string()->null(),
        ]);
        $this->batchInsert('card_type', [
            'name'
        ], [
            ['XBOX'],
            ['PS4'],
            ['Billiard']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('card_type');
    }
}
