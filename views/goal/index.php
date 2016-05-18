<?php

use app\models\Goal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GoalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('goal', 'Goals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('goal', 'Create Goal'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['width' => 60]
            ],
            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function(Goal $goal){
                    return Html::a(Html::encode($goal->title), ['goal/view', 'id' => $goal->id] ) ;
                },
            ],
            [
                'attribute' => 'status_id',
                'value' => function(Goal $goal){
                    return $goal->status->title;
                },
                'filter' => \yii\helpers\ArrayHelper::map(
                    \app\models\Status::find()->orderBy('weight')->asArray()->all(),
                    'id',
                    'title'
                ),
            ],
            [
                'attribute'=>'priority_id',
                'value'=>function(Goal $goal){
                    return $goal->priority->title;
                },
                'filter' => \yii\helpers\ArrayHelper::map(
                    \app\models\Priority::find()->orderBy('weight')->asArray()->all(),
                    'id',
                    'title'
                ),
            ],
            [
                'attribute'=>'done_percent',
                'format'=>'html',
                'value'=>function(Goal $goal){
                    return
                        '<div class="progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.$goal->done_percent.'%;">
                            '.$goal->done_percent.'%
                          </div>
                        </div>';
                },
                'filter' => '',
            ],
            [
                'attribute'=>'type_id',
                'value'=>function(Goal $goal){
                    return $goal->type->title;
                },
                'filter' => \yii\helpers\ArrayHelper::map(
                    \app\models\Type::find()->orderBy('weight')->asArray()->all(),
                    'id',
                    'title'
                ),
            ],
            // 'description:ntext',
            [
                'attribute' => 'created_at',
                'format' => 'date',
                'filter' => ''
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'date',
                'filter' => ''
            ],
            [
                'attribute' => 'to_be_done_at',
                'format' => 'date',
                'filter' => ''
            ],
//            'done_at',

        ],
    ]); ?>

</div>
