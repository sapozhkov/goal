<?php

use yii\db\Schema;
use yii\db\Migration;

class m151023_124222_goal_table extends Migration
{
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('goal', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(256) NOT NULL',
            'status_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'priority_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'type_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'description' => Schema::TYPE_TEXT. ' NOT NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'to_be_done_at' => Schema::TYPE_DATETIME,
            'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'done_at' => Schema::TYPE_DATETIME,
        ], $tableOptions);

        $this->createTable('status', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(256) NOT NULL',
            'weight' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'closed' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createTable('priority', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(256) NOT NULL',
            'weight' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createTable('type', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(256) NOT NULL',
            'weight' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->addForeignKey('status2goal', 'goal', 'status_id', 'status', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('priority2goal', 'goal', 'priority_id', 'priority', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('type2goal', 'goal', 'type_id', 'type', 'id', 'RESTRICT', 'CASCADE');

    }

    public function safeDown()
    {
        $this->dropTable('goal');
        $this->dropTable('status');
        $this->dropTable('priority');
        $this->dropTable('type');
    }

}
