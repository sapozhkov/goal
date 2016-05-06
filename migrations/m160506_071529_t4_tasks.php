<?php

use yii\db\Schema;
use yii\db\Migration;

class m160506_071529_t4_tasks extends Migration
{
    public function up()
    {

        $this->createTable('task', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(256) NOT NULL',
            'date' => Schema::TYPE_DATETIME,
            'goal_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'closed' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0',
            'percent' => Schema::TYPE_INTEGER . ' DEFAULT 0',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'closed_at' => Schema::TYPE_DATETIME,
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey('task2goal', 'task', 'goal_id', 'goal', 'id', 'RESTRICT', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('task');
    }

}
