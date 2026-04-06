<?php

use app\helper\Icon;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use app\models;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Goal */
/* @var $form yii\widgets\ActiveForm */

$iconInputId = Html::getInputId($model, 'icon');
$iconPickerId = $iconInputId . '-picker';
$iconPreviewId = $iconInputId . '-preview';
$iconToggleId = $iconInputId . '-toggle';
$iconCollapseId = $iconInputId . '-collapse';
$selectedIcon = (string)$model->icon;
$iconOptions = Icon::getList();

$this->registerJs("
    (function () {
        var picker = document.getElementById(" . Json::htmlEncode($iconPickerId) . ");
        var input = document.getElementById(" . Json::htmlEncode($iconInputId) . ");
        var preview = document.getElementById(" . Json::htmlEncode($iconPreviewId) . ");
        var toggle = document.getElementById(" . Json::htmlEncode($iconToggleId) . ");

        if (!picker || !input || !preview || !toggle) {
            return;
        }

        function renderPreview(value) {
            if (value) {
                preview.innerHTML = '<span class=\"glyphicon glyphicon-' + value + '\"></span><span class=\"goal-icon-preview-label\">' + value + '</span>';
            } else {
                preview.innerHTML = '<span class=\"goal-icon-preview-empty\">" . Json::htmlEncode(Yii::t('app', 'Not set')) . "</span>';
            }
        }

        picker.addEventListener('click', function (event) {
            var option = event.target.closest('[data-icon-value]');
            var options;

            if (!option) {
                return;
            }

            input.value = option.getAttribute('data-icon-value');
            options = picker.querySelectorAll('[data-icon-value]');

            Array.prototype.forEach.call(options, function (item) {
                item.classList.toggle('active', item === option);
            });

            renderPreview(input.value);
        });

        renderPreview(input.value);
    })();
");
?>

<div class="goal-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">

            <div>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>

            <div>
                <?= $form->field($model, 'status_id')->dropDownList(
                    ArrayHelper::map(\app\modules\settings\models\StatusSearch::getAll(), 'id', 'title')
                ) ?>
            </div>

            <div>
                <?= $form->field($model, 'priority_id')->dropDownList(
                    ArrayHelper::map(\app\modules\settings\models\PrioritySearch::getAll(), 'id', 'title')
                ) ?>
            </div>

            <div>
                <?= $form->field($model, 'type_id')->dropDownList(
                    ArrayHelper::map(\app\modules\settings\models\TypeSearch::getAll(), 'id', 'title')
                ) ?>
            </div>

        </div>

        <div class="col-sm-6">

            <div>
                <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
            </div>

            <div>
                <?php
                $aPercent = [];
                for ( $i=0; $i<=10; $i++ )
                    $aPercent[$i*10] = $i*10;
                ?>
                <?= $form->field($model, 'percent')->dropDownList($aPercent) ?>
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
                <?= $form->field($model, 'icon')->hiddenInput()->label(Yii::t('goal', 'Icon')) ?>
                <div class="goal-icon-panel">
                    <div id="<?= Html::encode($iconPreviewId) ?>" class="goal-icon-preview"></div>
                    <button type="button"
                            id="<?= Html::encode($iconToggleId) ?>"
                            class="btn btn-default btn-sm"
                            data-toggle="collapse"
                            data-target="#<?= Html::encode($iconCollapseId) ?>"
                            aria-expanded="false"
                            aria-controls="<?= Html::encode($iconCollapseId) ?>">
                        <?= Yii::t('app', 'Update') ?> <?= Yii::t('goal', 'Icon') ?>
                    </button>
                </div>
                <div id="<?= Html::encode($iconCollapseId) ?>" class="collapse">
                    <div id="<?= Html::encode($iconPickerId) ?>" class="goal-icon-picker">
                        <button type="button"
                                class="goal-icon-picker-item <?= $selectedIcon === '' ? 'active' : '' ?>"
                                data-icon-value=""
                                title="<?= Html::encode(Yii::t('app', 'Not set')) ?>">
                            <span class="goal-icon-picker-empty">&times;</span>
                        </button>
                        <? foreach ($iconOptions as $iconName): ?>
                        <button type="button"
                                class="goal-icon-picker-item <?= $selectedIcon === $iconName ? 'active' : '' ?>"
                                data-icon-value="<?= Html::encode($iconName) ?>"
                                title="<?= Html::encode($iconName) ?>">
                            <?= Icon::getIconHtml($iconName) ?>
                        </button>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'smart_specific')
        ->hint(nl2br(Html::encode(\Yii::t('smart', 'specific_hint'))))
        ->label('[SMART] '. \Yii::t('goal', 'Smart Specific'))
        ->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'smart_measurable')
        ->hint(nl2br(Html::encode(\Yii::t('smart', 'measurable_hint'))))
        ->label('[SMART] '. \Yii::t('goal', 'Smart Measurable'))
        ->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'smart_achievable')
        ->hint(nl2br(Html::encode(\Yii::t('smart', 'achievable_hint'))))
        ->label('[SMART] '. \Yii::t('goal', 'Smart Achievable'))
        ->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'smart_relevant')
        ->hint(nl2br(Html::encode(\Yii::t('smart', 'relevant_hint'))))
        ->label('[SMART] '. \Yii::t('goal', 'Smart Relevant'))
        ->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'smart_time_bound')
        ->hint(nl2br(Html::encode(\Yii::t('smart', 'time_bound_hint'))))
        ->label('[SMART] '. \Yii::t('goal', 'Smart Time Bound'))
        ->textarea(['rows' => 3]) ?>

    <? if ( !$model->isNewRecord ): ?>
    <?= $form->field($model, 'log_message')
            ->label(Yii::t('goal', 'Write new message'))
            ->textarea(['rows' => 6])
    ?>
    <? endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
