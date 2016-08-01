<?php

use yii\db\Migration;
use yii\db\Schema;

class m160801_081755_task_text extends Migration
{
    public function up()
    {
        $this->addColumn('task', 'description', Schema::TYPE_TEXT. ' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('task', 'description');
    }

}
