<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $tasks \app\models\Task[] */
/* @var $tasksWithoutDate \app\models\Task[] */
/* @var $tasksOverdue \app\models\Task[] */
/* @var $goals \app\models\Goal[] */
/* @var $goalsWithoutDate \app\models\Goal[] */
/* @var $goalsOverdue \app\models\Goal[] */
/* @var $goalsCount int */
/* @var $tasksCount int */
/* @var $tasksWithoutDateCount int */
/* @var $goalsWithoutDateCount int */
/* @var $tasksOverdueCount int */
/* @var $goalsOverdueCount int */
?>
<h1>Dashboard</h1>

<? if ($tasksWithoutDateCount): ?>
    <h2>Tasks Without Date <span title="Total" class="label label-danger"><?= $tasksWithoutDateCount ?></span></h2>
    <? foreach ($tasksWithoutDate as $task): ?>
        <?= $this->render('/task/list-item', [
            'task' => $task,
            'showGoalTitle' => true
        ]); ?>
    <? endforeach; ?>
<? endif; ?>


<? if ($goalsWithoutDateCount): ?>
    <h2>Goals Without Date <span title="Total" class="label label-danger"><?= $goalsWithoutDateCount ?></span></h2>
    <? foreach ($goalsWithoutDate as $goal): ?>
        <?= $this->render('/goal/list-item', [
            'goal' => $goal,
        ]); ?>
    <? endforeach; ?>
<? endif; ?>


<? if ($tasksOverdueCount): ?>
    <h2>Overdue Tasks <span title="Total" class="label label-danger"><?= $tasksOverdueCount ?></span></h2>
    <? foreach ($tasksOverdue as $task): ?>
        <?= $this->render('/task/list-item', [
            'task' => $task,
            'showGoalTitle' => true
        ]); ?>
    <? endforeach; ?>
<? endif; ?>

<? if ($goalsOverdueCount): ?>
    <h2>Overdue Goals <span title="Total" class="label label-danger"><?= $goalsOverdueCount ?></span></h2>
    <? foreach ($goalsOverdue as $goal): ?>
        <?= $this->render('/goal/list-item', [
            'goal' => $goal,
        ]); ?>
    <? endforeach; ?>
<? endif; ?>


<h2>Nearest Tasks <span title="Total" class="label label-primary"><?= $tasksCount ?></span></h2>

<? foreach ($tasks as $task): ?>
    <?= $this->render('/task/list-item', [
        'task' => $task,
        'showGoalTitle' => true
    ]); ?>
<? endforeach; ?>

<h2>Nearest Goals <?= Html::a($goalsCount, Url::to('/goal/index'), ['class' => 'label label-primary']) ?></h2>

<? foreach ($goals as $goal): ?>
    <?= $this->render('/goal/list-item', [
        'goal' => $goal,
    ]); ?>
<? endforeach; ?>
