<?php

use yii\db\Migration;
use yii\db\Schema;

class m160519_075516_t26_task_date extends Migration
{
    public function up()
    {
        $this->alterColumn('task', 'date', Schema::TYPE_DATE);
    }

    public function down()
    {
        $this->alterColumn('task', 'date', Schema::TYPE_DATETIME);
    }
}
