<?php

use yii\db\Schema;
use yii\db\Migration;

class m160802_121241_t13_goal_alias extends Migration
{
    public function up()
    {
        $this->addColumn('goal', 'alias', Schema::TYPE_STRING . '(32) NOT NULL');
        $this->execute('UPDATE `goal` SET `alias`=`id`');
        $this->createIndex('alias', 'goal', 'alias', true);
    }

    public function down()
    {
        $this->dropColumn('goal', 'alias');
    }

}
