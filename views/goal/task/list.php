<?php

use app\models\Goal;
use app\models\Task;
use yii\helpers\Html;

/* @var $taskRows Task[] */
/* @var $goal Goal */

?>

<h2><?= Html::a(Yii::t('task', 'Tasks'), $goal->urlTaskList()); ?></h2>
<p>
    <?= Html::a(Yii::t('task', 'Create Task'), ['task/create', 'goal_id' => $goal->id], ['class' => 'btn btn-success']) ?>
</p>

<? foreach ($taskRows as $task): ?>
    <p>
        <?= Html::a('Close', ['task/close-task', 'task_id' => $task->id]) ?>
        <strong><?= Yii::$app->formatter->asDatetime($task->date) ?></strong>
        <?= nl2br(Html::encode($task->title)) ?>
    </p>
<? endforeach; ?>
