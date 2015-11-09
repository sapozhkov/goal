<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Goal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->dropDownList(
        ArrayHelper::map(models\StatusSearch::getAll(), 'id', 'title')
    ) ?>

    <?= $form->field($model, 'priority_id')->dropDownList(
        ArrayHelper::map(models\PrioritySearch::getAll(), 'id', 'title')
    ) ?>

    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(models\TypeSearch::getAll(), 'id', 'title')
    ) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php
        $aPercent = [];
        for ( $i=0; $i<=10; $i++ )
              $aPercent[$i*10] = $i*10;
    ?>
    <?= $form->field($model, 'done_percent')->dropDownList($aPercent) ?>

    <?= $form->field($model, 'created_at')->widget(DatePicker::className(), ['dateFormat'=>'php:Y-m-d']) ?>

    <?= $form->field($model,'to_be_done_at')->widget(DatePicker::className(), ['dateFormat'=>'php:Y-m-d']) ?>

    <?= $form->field($model, 'done_at')->widget(DatePicker::className(), ['dateFormat'=>'php:Y-m-d']) ?>

    <hr />

    <?= $form->field($model, 'log_message')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
