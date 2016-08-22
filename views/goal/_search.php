<?php

use app\modules\settings\models\Priority;
use app\modules\settings\models\Status;
use app\modules\settings\models\Type;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GoalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goal-search">

    <? $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]) ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'title') ?>
        </div>

        <div class="col-sm-4">
        <?
            $statusList = ArrayHelper::map(
                Status::find()->orderBy('weight')->asArray()->all(),
                'id',
                'title'
            );
            echo $form->field($model, 'status_id')->dropDownList([''=>''] + $statusList+[
                    Status::OPENED => \Yii::t('Type', '<< Opened >>'),
                    Status::CLOSED => \Yii::t('Type', '<< Closed >>'),
                ]);
        ?>
        </div>

        <div class="col-sm-4">
        <?
            $priorityList = ArrayHelper::map(
                Priority::find()->orderBy('weight')->asArray()->all(),
                'id',
                'title'
            );
            echo $form->field($model, 'priority_id')->dropDownList([''=>''] + $priorityList);
        ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
        <?
            $typeList = ArrayHelper::map(
                Type::find()->orderBy('weight')->asArray()->all(),
                'id',
                'title'
            );
            echo $form->field($model, 'type_id')->dropDownList([''=>''] + $typeList);
        ?>
        </div>

        <div class="col-sm-4">
        <?= $form->field($model, 'sort')->dropDownList([
                '' => 'default',
                'id' => 'id',
                '-id' => '-id',
            ])
        ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
