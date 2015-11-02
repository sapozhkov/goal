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

    <?= $form->field($model, 'done_percent')->dropDownList([0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]) ?>

    <?= $form->field($model, 'created_at')->widget(DatePicker::className()) ?>

    <?= $form->field($model,'to_be_done_at')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'updated_at')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'done_at')->widget(DatePicker::className()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
