<?php

use yii\db\Migration;

/**
 * Possible migration with base settings for goals (status and priority list)
 */
class m151023_131415_goal_base_settings extends Migration
{
    public function safeUp()
    {
        $this->addStatus();
        $this->addPriority();
        $this->addTypeList();

    }

    public function safeDown()
    {
        $this->delete('status');
        $this->delete('priority');
        $this->delete('type');
    }

    /**
     * Add base status list
     */
    private function addStatus()
    {
        $aData = [
            [1, 'New'],
            [2, 'Done', 1],
            [3, 'In work'],
            [4, 'Paused'],
            [5, 'Annuled', 1],
        ];

        foreach ($aData as $aRow)
        {
            $this->insert('status', [
                'id' => $aRow[0],
                'title' => $aRow[1],
                'weight' => $aRow[0],
                'closed' => isset($aRow[2]) ? (int)(bool)$aRow[2] : 0
            ]);
        }
    }

    /**
     * Add base priority list
     */
    private function addPriority()
    {
        $aData = [
            [1, 'A'],
            [2, 'B'],
            [3, 'C'],
        ];

        foreach ($aData as $aRow)
        {
            $this->insert('priority', [
                'id' => $aRow[0],
                'title' => $aRow[1],
                'weight' => $aRow[0],
            ]);
        }
    }

    /**
     * Add base type list
     */
    private function addTypeList()
    {
        $aData = [
            [1, 'Long-term'],
            [2, 'Middle-term'],
            [3, 'Short-term'],
        ];

        foreach ($aData as $aRow)
        {
            $this->insert('type', [
                'id' => $aRow[0],
                'title' => $aRow[1],
                'weight' => $aRow[0],
            ]);
        }
    }
}
