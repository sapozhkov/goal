<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CounterRowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $counter \app\models\Counter */

$goal = $counter->goal;

$this->title = Yii::t('counter', 'Counter Rows');
$this->params['breadcrumbs'][] = ['label' => $goal->title, 'url' => $goal->url()];
$this->params['breadcrumbs'][] = ['label' => Yii::t('counter', 'Counters'), 'url' => $goal->urlCounterList()];
$this->params['breadcrumbs'][] = ['label' => $counter->title, 'url' => $counter->url()];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-row-index">

    <h1><?= $this->title ?>: <?= Html::encode($counter->title) ?> [<?= $counter->sum ?>]</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('counter', 'Settings'), $counter->url(), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('counter', 'Create Counter Row'), ['create', 'counter_id' => $counter->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'time',
            'value',
            'description:wiki',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
