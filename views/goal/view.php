<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Goal */
/* @var $logDataProvider yii\data\ActiveDataProvider */
/* @var $taskDataProvider yii\data\ActiveDataProvider */
/* @var $logModel app\models\Log */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Goals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'status_id',
                'value'=>$model->status->title
            ],
            [
                'attribute' => 'priority_id',
                'value'=>$model->priority->title
            ],
            [
                'attribute' => 'type_id',
                'value'=>$model->type->title
            ],
            'description:ntext',
            'done_percent',
            'created_at:date',
            'to_be_done_at:date',
            'done_at:date',
            'updated_at:datetime',
        ],
    ]) ?>

    <?= $this->render('task/list', [
        'taskDataProvider' => $taskDataProvider,
        'goal' => $model
    ]) ?>

    <?= $this->render('log/_form', [
        'logModel' => $logModel,
    ]) ?>

    <?= $this->render('log/list', [
        'logDataProvider' => $logDataProvider,
    ]) ?>


</div>
