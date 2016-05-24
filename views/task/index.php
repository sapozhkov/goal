<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $goal app\models\Goal*/
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => $goal->title, 'url' => $goal->url()];
$this->title = Yii::t('task', 'Tasks');
$this->params['breadcrumbs'][] = Yii::t('task', 'Tasks');
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?= Html::a(Yii::t('task', 'Create Task'), ['task/create', 'goal_id' => $goal->id], ['class' => 'btn btn-success']) ?>
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
                function ($task, $key, $index, $widget) {
                    return $this->render('list-item', [
                        'task' => $task,
                    ]);
                },
        ]) ?>
    </div>

</div>
