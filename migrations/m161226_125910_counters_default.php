<?php

use yii\db\Migration;
use yii\db\Schema;

class m161226_125910_counters_default extends Migration
{
    public function up()
    {
        $this->addColumn('counter', 'default', Schema::TYPE_INTEGER);
    }

    public function down()
    {
        $this->dropColumn('counter', 'default');
    }

}
