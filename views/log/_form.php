<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Log */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::hiddenInput('referrer', \Yii::$app->request->referrer) ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'goal_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <h3><?= \Yii::t('log', 'Preview') ?>:</h3>
    <?= $this->render('/log/log_data', [
        'log' => $model
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
