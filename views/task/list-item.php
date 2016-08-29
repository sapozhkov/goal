<?php

/**
 * @var \app\models\Task $task
 * @var bool $showGoalTitle
 * @var bool $showDeleteBtn
 */
use yii\helpers\Html;

if ( !isset($showGoalTitle) )
    $showGoalTitle = false;

if ( !isset($showDeleteBtn) )
    $showDeleteBtn = false;

?>

<div class="list-group-item">

    <div class="row">
        <div class="task-list-icon">
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

        <? if ($showDeleteBtn): ?>
            <div class="task-list-delete-container">

                <?
                    $options = [
                        'title' => Yii::t('yii', 'Delete'),
                        'aria-label' => Yii::t('yii', 'Delete'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'data-method' => 'post',
                        'data-pjax' => '0',
                    ];
                    echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['task/delete', 'id'=>$task->id], $options);
                ?>
            </div>
        <? endif; ?>

        <div class="task-list-content-shift <? if ($showDeleteBtn): ?>task-list-content-shift-right<? endif; ?>">

            <h4 class="list-group-item-heading goal-list-item-heading">
                <?= Html::a(Html::encode($task->title), ['task/update', 'id' => $task->id]) ?>
                <? if ( $showGoalTitle ): ?>
                    <small><a href="<?= $task->goal->url() ?>">[<?= $task->goal->title ?>]</a></small>
                <? endif; ?>
            </h4>
            <div class="list-group-item-text">

                <nobr>
                    <span title="<?= strip_tags(\Yii::$app->formatter->asDate($task->date)) ?>">
                        <span class="glyphicon glyphicon-calendar"></span>
                        <?= \Yii::$app->formatter->asRelativeTimeHighlight($task->date) ?>
                    </span>
                </nobr>
                <nobr>
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
