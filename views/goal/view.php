<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $goal app\models\Goal */
/* @var $logRows app\models\Log[] */
/* @var $taskRows app\models\Task[] */
/* @var $logModel app\models\Log */

$this->title = $goal->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $goal->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="row">
        <div class="col-xs-6 col-lg-6">

            <div>
                <label><?= Yii::t('app', 'Percent') ?></label>
                <?= (int)$goal->done_percent ?> %
            </div>

            <div>
                <label><?= Yii::t('app', 'Status') ?></label>
                <?= Html::encode($goal->status->title) ?>
            </div>

            <div>
                <label><?= Yii::t('app', 'Priority') ?></label>
                <?= Html::encode($goal->priority->title) ?>
            </div>

            <div>
                <label><?= Yii::t('app', 'Type') ?></label>
                <?= Html::encode($goal->type->title) ?>
            </div>

        </div>
        <div class="col-xs-6 col-lg-6">

            <div>
                <label><?= Yii::t('app', 'Created At') ?></label>
                <?= $goal->created_at ?>
            </div>

            <div>
                <label><?= Yii::t('app', 'Updated At') ?></label>
                <?= $goal->updated_at ?>
            </div>

            <div>
                <label><?= Yii::t('app', 'To Be Done At') ?></label>
                <?= $goal->to_be_done_at ?: '-' ?>
            </div>

            <div>
                <label><?= Yii::t('app', 'Done At') ?></label>
                <?= $goal->done_at ?: '-' ?>
            </div>

        </div>
    </div>

    <table class="table table-striped table-bordered">
        <tbody>
        <tr>
            <th>S</th>
            <th><?= Yii::t('app', 'Specific') ?></th>
            <td><?= nl2br(Html::encode($goal->smart_specific)) ?></td>
        </tr>
        <tr>
            <th>M</th>
            <th><?= Yii::t('app', 'Measurable') ?></th>
            <td><?= nl2br(Html::encode($goal->smart_measurable)) ?></td>
        </tr>
        <tr>
            <th>A</th>
            <th><?= Yii::t('app', 'Achievable') ?></th>
            <td><?= nl2br(Html::encode($goal->smart_achievable)) ?></td>
        </tr>
        <tr>
            <th>R</th>
            <th><?= Yii::t('app', 'Relevant') ?></th>
            <td><?= nl2br(Html::encode($goal->smart_relevant)) ?></td>
        </tr>
        <tr>
            <th>T</th>
            <th><?= Yii::t('app', 'Time Bound') ?></th>
            <td><?= nl2br(Html::encode($goal->smart_time_bound)) ?></td>
        </tr>
        </tbody>
    </table>

    <div>
        <label><?= Yii::t('app', 'Description') ?></label>
        <div><?= Html::encode($goal->description) ?></div>
    </div>

    <?= $this->render('task/list', [
        'taskRows' => $taskRows,
        'goal' => $goal
    ]) ?>

    <?= $this->render('log/list', [
        'logRows' => $logRows,
        'logModel' => $logModel,
        'goal' => $goal
    ]) ?>


</div>
