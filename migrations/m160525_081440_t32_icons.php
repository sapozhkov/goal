<?php

use yii\db\Migration;
use yii\db\Schema;

class m160525_081440_t32_icons extends Migration
{
    public function up()
    {
        $this->addColumn('goal', 'icon', Schema::TYPE_STRING. ' NOT NULL' );
    }

    public function down()
    {
        $this->dropColumn('goal', 'icon');
    }

}
