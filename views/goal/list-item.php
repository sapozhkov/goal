<?php

/**
 * @var \app\models\Goal $goal
 */
use yii\helpers\Html;
use yii\helpers\Url;

?>

<a href="<?= Url::to(['view', 'id' => $goal->id])?>" class="list-group-item">
    <h4 class="list-group-item-heading"><?= Html::encode($goal->title) ?></h4>
    <div class="list-group-item-text">

        <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= $goal->percent ?>%;">
                <?= $goal->percent ?>%
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3 col-xs-4" title="<?= \Yii::t('goal', 'Priority') ?>">
                <span class="glyphicon glyphicon-star"></span>
                <?= $goal->priority->title ?>
            </div>

            <div class="col-sm-3 col-xs-8" title="<?= \Yii::t('goal', 'Type' ) ?>">
                <span class="glyphicon glyphicon-time"></span>
                <?= $goal->type->title ?>
            </div>

            <div class="col-sm-3 col-xs-12" title="<?= \Yii::t('goal', 'To Be Done At' ) ?> <?= strip_tags(\Yii::$app->formatter->asDate($goal->to_be_done_at)) ?>">
                <span class="glyphicon glyphicon-calendar"></span>
                <?= \Yii::$app->formatter->asRelativeTime($goal->to_be_done_at) ?>
            </div>

            <div class="col-sm-3 col-xs-12" title="<?= \Yii::t('goal', 'Status') ?>">
                <span class="glyphicon glyphicon-tag"></span>
                <?= $goal->status->title ?>
            </div>
        </div>

    </div>
</a>
