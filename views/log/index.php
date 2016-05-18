<?php

use app\models\Log;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $goal app\models\Goal */
/* @var $searchModel app\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => $goal->title, 'url' => $goal->url()];
$this->title = Yii::t('log', 'Logs');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'created_at:datetime',
            [
                'attribute'=>'message',
                'format'=>'html',
                'value'=>function(Log $log){
                    return $this->render('/log/log_data', ['log' => $log]);
                },
                //'filter' => '',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>

</div>
