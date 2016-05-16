<?php

use app\models\Task;
use yii\helpers\Html;
use yii\grid\GridView;

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

    <p>
        <?= Html::a(Yii::t('task', 'Create Task'), ['task/create', 'goal_id' => $goal->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'date:date',
            'percent',
            [
                'attribute' => 'closed',
                'format' => 'html',
                'value' => function (Task $model) {
                    return $model->closed ?
                        Html::a(
                            '<span class="glyphicon glyphicon-ok"></span>',
                            ['task/open-task', 'task_id' => $model->id],
                            ['title' => Yii::t('task', 'Close')]
                        )
                        :
                        Html::a(
                            '<span class="glyphicon glyphicon-unchecked"></span>',
                            ['task/close-task', 'task_id' => $model->id],
                            ['title' => Yii::t('task', 'Open')]
                        )
                    ;
                },
                'filter' => [
                    0 => Yii::t('task', 'Opened'),
                    1 => Yii::t('task', 'Closed'),
                ],
            ],

            // 'created_at',
            // 'closed_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>

</div>
