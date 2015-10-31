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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'status_id',
            'priority_id',
//            'type_id',
//            'type.title',
            [
                'attribute'=>'type_id',
                'value'=>function(Goal $goal){
                    return $goal->type->title;
                }
            ],
            // 'description:ntext',
            // 'created_at',
            // 'to_be_done_at',
            'updated_at:date',
            // 'done_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
