<?php

use yii\db\Schema;
use yii\db\Migration;

class m161222_072411_counters extends Migration
{
    public function up()
    {

        $this->createTable('counter', [
            'id' => Schema::TYPE_PK,
            'goal_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'title' => Schema::TYPE_STRING . '(256) NOT NULL',
            'type' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'description' => Schema::TYPE_TEXT. ' NOT NULL',
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey('counter2goal', 'counter', 'goal_id', 'goal', 'id', 'RESTRICT', 'CASCADE');

        $this->createTable('counter_row', [
            'id' => Schema::TYPE_PK,
            'counter_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'time' => Schema::TYPE_DATETIME . ' NOT NULL',
            'value' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'description' => Schema::TYPE_TEXT. ' NOT NULL',
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey('row2counter', 'counter_row', 'counter_id', 'counter', 'id', 'RESTRICT', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('counters');
        $this->dropTable('counter_row');
    }

}
