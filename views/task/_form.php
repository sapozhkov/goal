<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), ['dateFormat'=>'php:Y-m-d']) ?>

    <?= Html::hiddenInput('Task[goal_id]', $model->goal_id) ?>

    <?= $form->field($model, 'closed')->checkbox() ?>

    <?php
    $aPercent = [];
    for ( $i=0; $i<=10; $i++ )
        $aPercent[$i*10] = $i*10;
    ?>
    <?= $form->field($model, 'percent')->dropDownList($aPercent) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
