<?php

/* @var $logDataProvider yii\data\ActiveDataProvider */

use app\models\Log;
use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $logDataProvider,
    'columns' => [
        [
            'attribute' => 'message',
            'format' => 'html',
            'value' => function($log) {
                /** @var Log $log */
                return nl2br($log->message);
            }
        ],
        [
            'attribute' => 'created_at',
            'format' => 'datetime',
            'filter' => ''
        ],
    ],
]);
