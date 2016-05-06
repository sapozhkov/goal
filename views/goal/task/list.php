<?php

use app\models\Goal;
use app\models\Task;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $taskDataProvider yii\data\ActiveDataProvider */
/* @var $goal Goal */

?>

<p>
    <?= Html::a(Yii::t('app', 'Create Task'), ['task/create', 'goal_id' => $goal->id], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $taskDataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'title',
            'format' => 'html',
            'value' => function(Task $task){
                return Html::a(Html::encode($task->title), ['task/update', 'id' => $task->id] ) ;
            },
        ],
        'date',
        'percent',

        [
            'class' => yii\grid\ActionColumn::className(),
            'template' => '{close}',
            'buttons' => [
                'close' => function ($url, $model, $key) {
                    /** @var Task $model */
                    return $model->closed ? '' : Html::a('Close', ['goal/close-task', 'task_id' => $model->id]);
                }
            ]
        ],

    ],
]); ?>