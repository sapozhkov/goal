<?php

use app\models\Priority;
use app\models\Status;
use app\models\Type;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GoalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goal-search">

    <?php

    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);

    // title
    echo $form->field($model, 'title');

    // status
    $statusList = ArrayHelper::map(
        Status::find()->orderBy('weight')->asArray()->all(),
        'id',
        'title'
    );
    echo $form->field($model, 'status_id')->dropDownList([''=>''] + $statusList);

    // Priority
    $priorityList = ArrayHelper::map(
        Priority::find()->orderBy('weight')->asArray()->all(),
        'id',
        'title'
    );
    echo $form->field($model, 'priority_id')->dropDownList([''=>''] + $priorityList);

    // Type
    $typeList = ArrayHelper::map(
        Type::find()->orderBy('weight')->asArray()->all(),
        'id',
        'title'
    );
    echo $form->field($model, 'type_id')->dropDownList([''=>''] + $typeList);

    // Sorting
    echo $form->field($model, 'sort')->dropDownList([
        '-title' => '-title',
        'id' => 'id',
        '-id' => '-id',
    ]);

    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
