<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CounterRow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="counter-row-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'counter_id')->hiddenInput() ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <? if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'time')->textInput() ?>
    <? endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('counter', 'Create') : Yii::t('counter', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
