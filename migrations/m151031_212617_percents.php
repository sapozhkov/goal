<?php

use yii\db\Schema;
use yii\db\Migration;

class m151031_212617_percents extends Migration
{
    public function up()
    {
        $this->addColumn('goal', 'done_percent', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0');
    }

    public function down()
    {
        $this->dropColumn('goal', 'done_percent');
    }

}
