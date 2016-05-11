<?php

use yii\db\Schema;
use yii\db\Migration;

class m160511_085252_t14_smart_fields extends Migration
{
    public function up()
    {
        $this->addColumn('goal', 'smart_specific', Schema::TYPE_TEXT. ' NOT NULL');
        $this->addColumn('goal', 'smart_measurable', Schema::TYPE_TEXT. ' NOT NULL');
        $this->addColumn('goal', 'smart_achievable', Schema::TYPE_TEXT. ' NOT NULL');
        $this->addColumn('goal', 'smart_relevant', Schema::TYPE_TEXT. ' NOT NULL');
        $this->addColumn('goal', 'smart_time_bound', Schema::TYPE_TEXT. ' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('goal', 'smart_specific');
        $this->dropColumn('goal', 'smart_measurable');
        $this->dropColumn('goal', 'smart_achievable');
        $this->dropColumn('goal', 'smart_relevant');
        $this->dropColumn('goal', 'smart_time_bound');
    }

}
