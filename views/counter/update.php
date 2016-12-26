<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Counter */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Counter',
]) . $model->title;
$goal = $model->goal;
$this->params['breadcrumbs'][] = ['label' => $goal->title, 'url' => $goal->url()];
$this->params['breadcrumbs'][] = ['label' => Yii::t('counter', 'Counters'), 'url' => $goal->urlCounterList()];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

?>
<div class="counter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
