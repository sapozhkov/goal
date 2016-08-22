<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $tasks \app\models\Task[] */
/* @var $goals \app\models\Goal[] */
/* @var $goalCount int */
/* @var $taskCount int */
?>
<h1>Dashboard</h1>

<h2>Nearest Tasks <span title="Total" class="label label-primary"><?= $taskCount ?></span></h2>

<? foreach ($tasks as $task): ?>
    <?= $this->render('/task/list-item', [
        'task' => $task,
        'showGoalTitle' => true
    ]); ?>
<? endforeach; ?>

<h2>Nearest Goals <?= Html::a($goalCount, Url::to('/goal/index'), ['class' => 'label label-primary']) ?></h2>

<? foreach ($goals as $goal): ?>
    <?= $this->render('/goal/list-item', [
        'goal' => $goal,
    ]); ?>
<? endforeach; ?>
