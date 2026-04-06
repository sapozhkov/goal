<?php

use yii\db\Migration;

class m260407_120000_goal_base_settings extends Migration
{
    public function safeUp()
    {
        if (!$this->isTableEmpty('status')) {
            return;
        }

        if (!$this->isTableEmpty('priority')) {
            return;
        }

        if (!$this->isTableEmpty('type')) {
            return;
        }

        $this->insertRows('status', [
            ['id' => 1, 'title' => 'New', 'weight' => 1, 'closed' => 0],
            ['id' => 2, 'title' => 'Done', 'weight' => 2, 'closed' => 1],
            ['id' => 3, 'title' => 'In work', 'weight' => 3, 'closed' => 0],
            ['id' => 4, 'title' => 'Paused', 'weight' => 4, 'closed' => 0],
            ['id' => 5, 'title' => 'Annuled', 'weight' => 5, 'closed' => 1],
        ]);

        $this->insertRows('priority', [
            ['id' => 1, 'title' => 'A', 'weight' => 1],
            ['id' => 2, 'title' => 'B', 'weight' => 2],
            ['id' => 3, 'title' => 'C', 'weight' => 3],
        ]);

        $this->insertRows('type', [
            ['id' => 1, 'title' => 'Long-term', 'weight' => 1],
            ['id' => 2, 'title' => 'Middle-term', 'weight' => 2],
            ['id' => 3, 'title' => 'Short-term', 'weight' => 3],
        ]);
    }

    public function safeDown()
    {
        $this->delete('status', ['id' => [1, 2, 3, 4, 5]]);
        $this->delete('priority', ['id' => [1, 2, 3]]);
        $this->delete('type', ['id' => [1, 2, 3]]);
    }

    private function insertRows($table, array $rows)
    {
        foreach ($rows as $row) {
            $exists = (new \yii\db\Query())
                ->from($table)
                ->where(['id' => $row['id']])
                ->exists($this->db);

            if (!$exists) {
                $this->insert($table, $row);
            }
        }
    }

    private function isTableEmpty($table)
    {
        return !(new \yii\db\Query())
            ->from($table)
            ->exists($this->db);
    }
}
