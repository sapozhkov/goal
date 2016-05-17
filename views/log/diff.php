<?php

/**
 * @var \app\models\Log $log
 * @var string $field
 * @var string $old
 * @var string $new
 */

$this->title = $log->goal->getAttributeLabel($field) . ' ' . \Yii::t('log', 'updated');
$this->params['breadcrumbs'][] = ['label' => $log->goal->title, 'url' => $log->goal->url()];
$this->params['breadcrumbs'][] = ['label' => Yii::t('log', 'Logs'), 'url' => $log->goal->urlLogList()];
$this->params['breadcrumbs'][] = ['label' => $log->id, 'url' => ['log/update', 'id' => $log->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Diff');

?>

<h1><?= $log->goal->getAttributeLabel($field) ?> <?= \Yii::t('log', 'updated') ?>:</h1>

<h2>Old:</h2>
<?= \Yii::$app->formatter->asWiki($old) ?>

<h2>New:</h2>
<?= \Yii::$app->formatter->asWiki($new) ?>


