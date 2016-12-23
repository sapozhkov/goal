<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CounterRow */

$counter = $model->counter;
$goal = $counter->goal;

$this->title = Yii::t('counter', 'Create Counter Row');
$this->params['breadcrumbs'][] = ['label' => $goal->title, 'url' => $goal->url()];
$this->params['breadcrumbs'][] = ['label' => Yii::t('counter', 'Counters'), 'url' => $goal->urlCounterList()];
$this->params['breadcrumbs'][] = ['label' => $counter->title, 'url' => $counter->url()];
$this->params['breadcrumbs'][] = ['label' => Yii::t('counter', 'Counter Rows'), 'url' => $counter->urlToLog()];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-row-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
