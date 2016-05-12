<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Task',
]) . ' ' . $model->title;

$goal = $model->goal;
$this->params['breadcrumbs'][] = ['label' => $goal->title, 'url' => $goal->url()];
$this->params['breadcrumbs'][] = ['label' => Yii::t('task', 'Tasks'), 'url' => $goal->urlTaskList()];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

?>
<div class="task-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
