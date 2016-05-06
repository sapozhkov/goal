<?php

/* @var $logRows app\models\Log[] */
/* @var $goal app\models\Goal */

use yii\helpers\Html;

?>

<p><?= Html::a('Show all log', $goal->urlLogList()); ?></p>

<? foreach ($logRows as $log): ?>
<p>
    <strong><?= $log->created_at ?></strong>
    <?= nl2br($log->message) ?>
</p>
<? endforeach; ?>
