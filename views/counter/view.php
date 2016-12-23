<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Counter */

$goal = $model->goal;
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $goal->title, 'url' => $goal->url()];
$this->params['breadcrumbs'][] = ['label' => Yii::t('counter', 'Counters'), 'url' => $goal->urlCounterList()];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="counter-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('counter', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('counter', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('counter', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'goal_id',
            'title',
            'description:ntext',
        ],
    ]) ?>

</div>
