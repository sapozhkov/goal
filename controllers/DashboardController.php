<?php

namespace app\controllers;

use app\helper\Dashboard;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // nearest tasks
        $tasks = Dashboard::getTasksNearest($tasksCount);

        // tasks without date
        $tasksWithoutDate = Dashboard::getTasksWithoutDate($tasksWithoutDateCount);

        // overdue tasks
        $tasksOverdue = Dashboard::getTasksOverdue($tasksOverdueCount);

        /********************************************************************/

        // nearest goals
        $goals = Dashboard::getGoalsNearest($goalsCount);

        // goals without date
        $goalsWithoutDate = Dashboard::getGoalsWithoutDate($goalsWithoutDateCount);

        // overdue goals
        $goalsOverdue = Dashboard::getGoalsOverdue($goalsOverdueCount);

        return $this->render('index', [
            'tasks' => $tasks,
            'tasksCount' => $tasksCount,
            'tasksWithoutDate' => $tasksWithoutDate,
            'tasksWithoutDateCount' => $tasksWithoutDateCount,
            'tasksOverdue' => $tasksOverdue,
            'tasksOverdueCount' => $tasksOverdueCount,
            'goals' => $goals,
            'goalsCount' => $goalsCount,
            'goalsWithoutDate' => $goalsWithoutDate,
            'goalsWithoutDateCount' => $goalsWithoutDateCount,
            'goalsOverdue' => $goalsOverdue,
            'goalsOverdueCount' => $goalsOverdueCount,
        ]);
    }

}
