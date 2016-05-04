<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models;

/* @var $this yii\web\View */
/* @var $logModel app\models\Log */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(['action' => ['goal/message']]); ?>

    <?= Html::hiddenInput('Log[goal_id]', $logModel->goal_id) ?>

    <?= $form->field($logModel, 'message')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
