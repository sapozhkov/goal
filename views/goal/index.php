<?php

use app\models\Goal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GoalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Goals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Goal'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
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
            // 'created_at',
            // 'to_be_done_at',
            'updated_at:date',
            // 'done_at',

        ],
    ]); ?>

</div>
