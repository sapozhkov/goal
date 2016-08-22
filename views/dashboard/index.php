<?php
/* @var $this yii\web\View */
/* @var $tasks \app\models\Task[] */
?>
<h1>Dashboard</h1>

<h2>Nearest Tasks</h2>

<? if ($tasks): ?>
    <? foreach ($tasks as $task): ?>
        <?= $this->render('/task/list-item', [
            'task' => $task,
        ]); ?>
    <? endforeach; ?>
<? endif; ?>
