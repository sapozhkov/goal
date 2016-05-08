<?php

use app\models\Task;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $goal app\models\Goal*/
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => $goal->title, 'url' => $goal->url()];
$this->title = Yii::t('app', 'Tasks');
$this->params['breadcrumbs'][] = Yii::t('app', 'Tasks');
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Task'), ['task/create', 'goal_id' => $goal->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'date',
            'closed',
            'percent',
            // 'created_at',
            // 'closed_at',

            [
                'class' => yii\grid\ActionColumn::className(),
                'template' => '{close}',
                'buttons' => [
                    'close' => function ($url, $model, $key) {
                        /** @var Task $model */
                        return $model->closed ? '' : Html::a('Close', ['close-task', 'task_id' => $model->id]);
                    }
                ]
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>

</div>
