<?php

use yii\db\Migration;

class m161222_072411_counters extends Migration
{
    public function up()
    {

        $this->createTable('counter', [
            'id' => $this->primaryKey(),
            'goal_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'type' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey('counter2goal', 'counter', 'goal_id', 'goal', 'id', 'RESTRICT', 'CASCADE');

        $this->createTable('counter_row', [
            'id' => $this->primaryKey(),
            'counter_id' => $this->integer()->notNull(),
            'time' => $this->dateTime()->notNull(),
            'value' => $this->float()->notNull(),
            'description' => $this->text()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey('row2counter', 'counter_row', 'counter_id', 'counter', 'id', 'RESTRICT', 'CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('row2counter', 'counter_row');
        $this->dropTable('counter_row');
        $this->dropForeignKey('counter2goal', 'counter');
        $this->dropTable('counter');
    }

}
