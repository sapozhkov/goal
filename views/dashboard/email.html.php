<?php

/**
 * @var \app\models\Task[] $tasks
 * @var \app\models\Goal[] $goals
 * @var int $tasksCount
 * @var int $goalsCount
 */

?>

<? if ($tasks): ?>
    <h2><?= \Yii::t('dashboard', 'Overdue Tasks') ?> <span title="<?= \Yii::t('dashboard', 'Total') ?>" class="label label-danger">[<?= $tasksCount ?>]</span></h2>
    <? foreach ($tasks as $task): ?>
        <?= $this->render('/task/list-item', [
            'task' => $task,
            'showGoalTitle' => true
        ]); ?>
    <? endforeach; ?>
<? endif; ?>

<? if ($goals): ?>
    <h2><?= \Yii::t('dashboard', 'Overdue Goals') ?> <span title="<?= \Yii::t('dashboard', 'Total') ?>" class="label label-danger">[<?= $goalsCount ?>]</span></h2>
    <? foreach ($goals as $goal): ?>
        <?= $this->render('/goal/list-item', [
            'goal' => $goal,
        ]); ?>
    <? endforeach; ?>
<? endif; ?>
