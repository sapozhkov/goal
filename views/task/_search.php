<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-search">

    <?php $form = ActiveForm::begin([
        'action' => [''],
        'method' => 'get',
    ]); ?>

    <? if ($model->goal_id): ?>
        <?= Html::hiddenInput('TaskSearch[goal_id]', $model->goal_id) ?>
    <? endif; ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'closed')->dropDownList([
        '' => Yii::t('app', 'All'),
        0 => Yii::t('task', 'Opened'),
        1 => Yii::t('task', 'Closed'),
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
