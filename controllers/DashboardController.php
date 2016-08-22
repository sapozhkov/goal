<?php

namespace app\controllers;

use app\models\Task;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $aTasks = Task::find()
            ->where(['closed' => 0])
            ->andWhere('date')
            ->orderBy('date')
            ->limit(10)
            ->all()
        ;

        return $this->render('index', [
            'tasks' => $aTasks,
        ]);
    }

}
