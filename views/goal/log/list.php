<?php

/* @var $logDataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $logDataProvider,
    'columns' => [
        [
            'attribute' => 'message',
            'format' => 'html',
        ],
        [
            'attribute' => 'created_at',
            'format' => 'date',
            'filter' => ''
        ],
    ],
]);
