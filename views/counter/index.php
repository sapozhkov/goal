<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Counter;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CounterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => $goal->title, 'url' => $goal->url()];
$this->title = Yii::t('counter', 'Counters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('counter', 'Create Counter'), ['create', 'goal_id' => $goal->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'title',
                'format'=>'html',
                'value'=>function(Counter $counter){
                    return Html::a($counter->title, $counter->urlToLog());
                },
                //'filter' => '',
            ],
            'sum',
            'default',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
