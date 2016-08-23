<?php

use app\models\Goal;
use app\models\Task;
use yii\helpers\Html;

/* @var $taskRows Task[] */
/* @var $goal Goal */
/* @var $taskCount int */

?>

<a name="tasks"></a>
<h2>
    <?= Html::a(
        sprintf(
            '%s <span class="label label-primary">%d</span>',
            Yii::t('task', 'Tasks'),
            $taskCount
        ),
        $goal->urlTaskList()); ?>
    <?= Html::a(Yii::t('task', 'Create Task'), ['task/create', 'goal_id' => $goal->id], ['class' => 'btn btn-success']) ?>
</h2>

<? foreach ($taskRows as $task): ?>
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-unchecked"></span>',
            ['close-task', 'task_id' => $task->id],
            ['title' => Yii::t('task', 'Close')])
        ?>
        <strong><?= Yii::$app->formatter->asDatetime($task->date) ?></strong>
        <?= nl2br(Html::encode($task->title)) ?>
    </p>
<? endforeach; ?>
