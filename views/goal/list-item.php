<?php

/**
 * @var \app\models\Goal $goal
 */
use yii\helpers\Html;
use yii\helpers\Url;

?>

<a href="<?= Url::to(['view', 'id' => $goal->id]) ?>">
    <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-music"></span> <?= Html::encode($goal->title) ?></h4>
    <p class="list-group-item-text">List Group Item Text</p>
</a>
