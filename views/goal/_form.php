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

    <div class="row">
        <div class="col-xs-6 col-lg-6">

            <div>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>

            <div>
                <?= $form->field($model, 'status_id')->dropDownList(
                    ArrayHelper::map(models\StatusSearch::getAll(), 'id', 'title')
                ) ?>
            </div>

            <div>
                <?= $form->field($model, 'priority_id')->dropDownList(
                    ArrayHelper::map(models\PrioritySearch::getAll(), 'id', 'title')
                ) ?>
            </div>

            <div>
                <?= $form->field($model, 'type_id')->dropDownList(
                    ArrayHelper::map(models\TypeSearch::getAll(), 'id', 'title')
                ) ?>
            </div>

        </div>

        <div class="col-xs-6 col-lg-6">
            <div>
                <?php
                $aPercent = [];
                for ( $i=0; $i<=10; $i++ )
                    $aPercent[$i*10] = $i*10;
                ?>
                <?= $form->field($model, 'done_percent')->dropDownList($aPercent) ?>
            </div>

            <div>
                <?= $form->field($model, 'created_at')->widget(DatePicker::className(), ['dateFormat'=>'php:Y-m-d']) ?>
            </div>

            <div>
                <?= $form->field($model,'to_be_done_at')->widget(DatePicker::className(), ['dateFormat'=>'php:Y-m-d']) ?>
            </div>

            <div>
                <?= $form->field($model, 'done_at')->widget(DatePicker::className(), ['dateFormat'=>'php:Y-m-d']) ?>
            </div>

            <div>

            </div>

        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'smart_specific')
        ->hint(nl2br(Html::encode(\Yii::t('smart', 'specific_hint'))))
        ->label('[SMART] '. \Yii::t('smart', 'specific'))
        ->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'smart_measurable')
        ->hint(nl2br(Html::encode(\Yii::t('smart', 'measurable_hint'))))
        ->label('[SMART] '. \Yii::t('smart', 'measurable'))
        ->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'smart_achievable')
        ->hint(nl2br(Html::encode(\Yii::t('smart', 'achievable_hint'))))
        ->label('[SMART] '. \Yii::t('smart', 'achievable'))
        ->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'smart_relevant')
        ->hint(nl2br(Html::encode(\Yii::t('smart', 'relevant_hint'))))
        ->label('[SMART] '. \Yii::t('smart', 'relevant'))
        ->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'smart_time_bound')
        ->hint(nl2br(Html::encode(\Yii::t('smart', 'time_bound_hint'))))
        ->label('[SMART] '. \Yii::t('smart', 'time_bound'))
        ->textarea(['rows' => 3]) ?>

    <? if ( !$model->isNewRecord ): ?>
    <?= $form->field($model, 'log_message')->textarea(['rows' => 6]) ?>
    <? endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
