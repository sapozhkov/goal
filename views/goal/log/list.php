<?php

/* @var $this yii\web\View */
/* @var $logRows app\models\Log[] */
/* @var $goal app\models\Goal */
/* @var $logModel app\models\Log */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h2><?= Html::a(\Yii::t('log', 'Logs'), $goal->urlLogList()); ?></h2>

<? foreach ($logRows as $log): ?>
<?= $this->render('/log/log_data', [
    'log' => $log
]) ?>
<? endforeach; ?>

<hr>

<div class="message-form">

    <?php $form = ActiveForm::begin(['action' => ['goal/message']]); ?>

    <?= Html::hiddenInput('Log[goal_id]', $logModel->goal_id) ?>

    <?= $form->field($logModel, 'message')->label(\Yii::t('goal', 'Write new message'))->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('goal', 'Write'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
