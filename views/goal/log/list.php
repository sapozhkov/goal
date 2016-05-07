<?php

/* @var $logRows app\models\Log[] */
/* @var $goal app\models\Goal */
/* @var $logModel app\models\Log */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h2><?= Html::a('Log', $goal->urlLogList()); ?></h2>

<div class="message-form">

    <?php $form = ActiveForm::begin(['action' => ['goal/message']]); ?>

    <?= Html::hiddenInput('Log[goal_id]', $logModel->goal_id) ?>

    <?= $form->field($logModel, 'message')->label(\Yii::t('app', 'Write new message'))->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Write'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<? foreach ($logRows as $log): ?>
<p>
    <strong><?= $log->created_at ?></strong>
    <?= nl2br(Html::encode($log->message)) ?>
</p>
<? endforeach; ?>
