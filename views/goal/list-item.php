<?php

/**
 * @var \app\models\Goal $goal
 */
use app\helper\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<a href="<?= Url::to(['view', 'id' => $goal->id])?>" class="list-group-item">

    <? if($goal->icon): ?>
        <?= Icon::getIconHtml($goal->icon, ['class' => 'goal-list-icon list-inline']) ?>
    <? endif; ?>

    <h4 class="list-group-item-heading goal-list-item-heading <?= $goal->icon ? 'goal-list-content-shift' : '' ?>"><?= Html::encode($goal->title) ?></h4>
    <div class="list-group-item-text goal-list-item-text <?= $goal->icon ? 'goal-list-content-shift' : '' ?>">

        <nobr>
            <span title="<?= \Yii::t('goal', 'Priority') ?>">
                <span class="glyphicon glyphicon-star"></span>
                <?= $goal->priority->title ?>
            </span>
            <span title="<?= \Yii::t('goal', 'Type' ) ?>">
                <span class="glyphicon glyphicon-time"></span>
                <?= $goal->type->title ?>
            </span>
        </nobr>

        <nobr>
            <span title="<?= \Yii::t('goal', 'Status') ?>">
                <span class="glyphicon glyphicon-tag"></span>
                <?= $goal->status->title ?>
            </span>
            <span title="<?= \Yii::t('goal', 'To Be Done At' ) ?> <?= strip_tags(\Yii::$app->formatter->asDate($goal->to_be_done_at)) ?>">
                <span class="glyphicon glyphicon-calendar"></span>
                <?= \Yii::$app->formatter->asRelativeTime($goal->to_be_done_at) ?>
            </span>
        </nobr>

    </div>
</a>
