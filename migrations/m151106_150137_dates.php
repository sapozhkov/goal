<?php

use yii\db\Schema;
use yii\db\Migration;

class m151106_150137_dates extends Migration
{
    public function up()
    {
        $this->alterColumn('goal', 'created_at', Schema::TYPE_DATE . ' NOT NULL');
        $this->alterColumn('goal', 'to_be_done_at', Schema::TYPE_DATE);
        $this->alterColumn('goal', 'done_at', Schema::TYPE_DATE);
    }

    public function down()
    {
        $this->alterColumn('goal', 'created_at', Schema::TYPE_DATETIME . ' NOT NULL');
        $this->alterColumn('goal', 'to_be_done_at', Schema::TYPE_DATETIME);
        $this->alterColumn('goal', 'done_at', Schema::TYPE_DATETIME);
    }

}
