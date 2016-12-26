<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Counter;

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
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
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
            [
                'attribute'=>'sum',
                'format'=>'html',
                'value'=>function(Counter $counter){
                    return Html::a($counter->sum, $counter->urlToLog());
                },
            ],
            'description:ntext',
        ],
    ]) ?>

</div>
