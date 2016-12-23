<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var \app\models\Goal $goal  */

$counterModel = new \app\models\CounterRow();

?>

<a name="counters"></a>

<h2><?= Html::a(Yii::t('counter', 'Counters'), $goal->urlCounterList()); ?></h2>

<ul>
<? foreach ($goal->counters as $counter): ?>
    <li>
        <?php $form = ActiveForm::begin(['action' => ['counter/add']]); ?>

        <?= Html::a(Html::encode($counter->title), ['counter/view', 'id' => $counter->id]) ?>

        <?= Html::hiddenInput('CounterRow[counter_id]', $counter->id) ?>

        <?= $form->field($counterModel, 'value')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('counter', 'Add'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </li>
<? endforeach; ?>
</ul>

