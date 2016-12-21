<?php

namespace app\commands;

use app\helper\Dashboard;
use yii\console\Controller;

/**
 * Cron tasks
 */
class CronController extends Controller
{
    /**
     * Start searching for overdue tasks/goals/...
     * Email will send if found
     */
    public function actionIndex()
    {

        $goals = Dashboard::getGoalsOverdue($goalsCount);
        $tasks = Dashboard::getTasksOverdue($tasksCount);

        if ( $goals or $tasks ) {

            $email = \Yii::$app->params['adminEmail'];
            $domain = \Yii::$app->params['domain'];

            $text = \Yii::$app->view->render('/dashboard/email.txt.php', [
                'tasks' => $tasks,
                'goals' => $goals
            ]);

            $html = \Yii::$app->view->render('/dashboard/email.html.php', [
                'tasks' => $tasks,
                'goals' => $goals,
                'goalsCount' => $goalsCount,
                'tasksCount' => $tasksCount,
            ]);

            \Yii::$app->mailer->compose()
                ->setFrom('noreplay@'.$domain)
                ->setTo($email)
                ->setSubject(\Yii::t('dashboard', 'Overdue for {0} at {1}', [$domain, date('Y.m.d')]))
                ->setTextBody($text)
                ->setHtmlBody($html)
                ->send();

        }

    }
}
