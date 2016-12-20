<?php

/**
 * @var \app\models\Task[] $tasks
 * @var \app\models\Goal[] $goals
 */

if ( $tasks ) {
    echo "\n";
    echo \Yii::t('dashboard', 'Overdue Goals');
    echo "\n\n";
    foreach ($goals as $goal) {
        echo sprintf("[%s] %s (%s)\n", $goal->alias, $goal->title, $goal->to_be_done_at);
    }
    echo "\n";
}

if ( $tasks ) {
    echo "\n";
    echo \Yii::t('dashboard', 'Overdue Tasks');
    echo "\n\n";
    foreach ($tasks as $task) {
        echo sprintf("%s [%s] (%s)\n", $task->title, $task->goal->title, $task->date);
    }
    echo "\n";
}
