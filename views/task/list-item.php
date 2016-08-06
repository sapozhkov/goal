<?php

/**
 * @var \app\models\Task $task
 */
use yii\helpers\Html;

?>

<div class="list-group-item">

    <div class="row">
        <div class="col-xs-1">
            <?
            echo $task->closed ?
                Html::a(
                    '<span class="glyphicon glyphicon-ok"></span>',
                    ['task/open-task', 'task_id' => $task->id],
                    ['title' => Yii::t('task', 'Close')]
                )
                :
                Html::a(
                    '<span class="glyphicon glyphicon-unchecked"></span>',
                    ['task/close-task', 'task_id' => $task->id],
                    ['title' => Yii::t('task', 'Open')]
                )
            ?>
        </div>

        <div class="col-xs-10">

            <h4 class="list-group-item-heading goal-list-item-heading"><?= Html::a(Html::encode($task->title), ['update', 'id' => $task->id]) ?></h4>
            <div class="list-group-item-text">

            <nobr>

                <span title="<?= strip_tags(\Yii::$app->formatter->asDate($task->date)) ?>">
                    <span class="glyphicon glyphicon-calendar"></span>
                    <?= \Yii::$app->formatter->asRelativeTime($task->date) ?>
                </span>
                <? if ($task->percent): ?>
                <span title="<?= Yii::t('task', 'Percent') ?>">
                    <span class="glyphicon glyphicon-tasks"></span>
                    <?= $task->percent ?>%
                </span>
                <? endif; ?>
            </nobr>

        </div>
    </div>

    </div>
</div>
