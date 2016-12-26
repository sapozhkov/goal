<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var \app\models\Goal $goal  */

$counterModel = new \app\models\CounterRow();

?>

<a name="counters"></a>

<h2><?= Html::a(Yii::t('counter', 'Counters'), $goal->urlCounterList()); ?></h2>

<? foreach ($goal->counters as $counter): ?>
    <div>
        <?php $form = ActiveForm::begin(['action' => ['counter/add']]); ?>

        <?= Html::hiddenInput('CounterRow[counter_id]', $counter->id) ?>

        <h3>
            <?= Html::a(Html::encode($counter->title), ['counter/view', 'id' => $counter->id]) ?>
            <span class="label label-primary"><?= $counter->sum ?></span>
        </h3>

        <div class="row">
            <div class="col-lg-1 col-sm-2">
                <?= $form->field($counterModel, 'value')->label(false)->textInput([]) ?>
            </div>
            <div class="col-lg-1 col-sm-2">
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('counter', 'Add'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<? endforeach; ?>

<? if (!$goal->counters): ?>
    <?= Yii::t('counter', 'No counters') ?>
<? endif; ?>

