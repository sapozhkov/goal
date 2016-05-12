<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Log */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Log',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => $model->goal->title, 'url' => $model->goal->url()];
$this->params['breadcrumbs'][] = ['label' => Yii::t('log', 'Logs'), 'url' => $model->goal->urlLogList()];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
