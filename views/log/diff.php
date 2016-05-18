<?php

/**
 * @var \app\models\Log $log
 * @var string $field
 * @var string $old
 * @var string $new
 */

$this->title = \Yii::t('log', 'Field "{0}" updated', [$log->goal->getAttributeLabel($field)]);
$this->params['breadcrumbs'][] = ['label' => $log->goal->title, 'url' => $log->goal->url()];
$this->params['breadcrumbs'][] = ['label' => Yii::t('log', 'Logs'), 'url' => $log->goal->urlLogList()];
$this->params['breadcrumbs'][] = ['label' => $log->id, 'url' => ['log/update', 'id' => $log->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Diff');

?>

<h1><?= $this->title ?>:</h1>

<h2><?= \Yii::t('log', 'Old value') ?>:</h2>
<?= \Yii::$app->formatter->asWiki($old) ?>

<h2><?= \Yii::t('log', 'New value') ?>:</h2>
<?= \Yii::$app->formatter->asWiki($new) ?>


