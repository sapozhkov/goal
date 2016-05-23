<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GoalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('goal', 'Goals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?= Html::a('<span class="glyphicon glyphicon-plus-sign"></span> '.Yii::t('goal', 'Create Goal'), ['create'], ['class' => 'btn btn-success']) ?>
        <div data-toggle="collapse" data-target="#filter" class="btn  btn-default"><span class="glyphicon glyphicon-filter"></span> <?= \Yii::t('app', 'Filter') ?></div>
    </div>

    <div id="filter" class="collapse <?= $searchModel->isUsed() ? 'in' : '' ?>">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="list-group">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => [
            'tag' => false
        ],
        'itemView' =>
            function ($goal, $key, $index, $widget) {
                return $this->render('list-item', [
                    'goal' => $goal,
                ]);
            },
    ]) ?>
    </div>

</div>
