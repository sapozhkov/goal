<?php

use yii\db\Schema;
use yii\db\Migration;

class m151107_223818_log extends Migration
{
    public function up()
    {
        $this->createTable('log', [
            'id' => Schema::TYPE_PK,
            'goal_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'data' => Schema::TYPE_TEXT . ' NOT NULL',
            'message' => Schema::TYPE_TEXT . ' NOT NULL',
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey('log2goal', 'log', 'goal_id', 'goal', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('log');
    }

}
