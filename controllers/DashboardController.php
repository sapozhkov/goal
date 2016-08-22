<?php

namespace app\controllers;

use app\models\Goal;
use app\models\Task;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // nearest tasks
        $taskQuery = Task::find()
            ->where(['closed' => 0])
            ->orderBy('date')
            ->limit(10)
        ;
        $taskCount = $taskQuery->count();
        $tasks = $taskQuery->andWhere('date')->all();

        // nearest goals
        $goalQuery = Goal::find()
            ->innerJoinWith('status')
            ->where('status.closed=0')
            ->andWhere('to_be_done_at')
            ->orderBy('to_be_done_at')
            ->limit(3)
        ;

        return $this->render('index', [
            'tasks' => $tasks,
            'taskCount' => $taskCount,
            'goals' => $goalQuery->all(),
            'goalCount' => $goalQuery->count('*')
        ]);
    }

}
