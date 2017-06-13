<?php

use yii\db\Migration;

/**
 * Handles the creation of table `game_type`.
 */
class m170613_191527_create_game_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('game_type', [
            'id' => $this->primaryKey(),
            'name'=> $this->string()->notNull(),
            'description'=> $this->string()->null(),
        ]);
         $this->batchInsert('game_type', [
            'name'
        ], [
            ['single'],
            ['Doubles'],
            ['Three-handed'],
            ['Four']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('game_type');
    }
}
