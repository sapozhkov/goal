<?php

use yii\db\Migration;

class m160518_074508_t28_percent_rename extends Migration
{
    public function up()
    {
        $this->renameColumn('goal', 'done_percent', 'percent' );
    }

    public function down()
    {
        $this->renameColumn('goal', 'percent', 'done_percent' );
    }

}
