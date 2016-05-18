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

\app\assets\DiffAsset::register($this);

$a = explode("\n", $old);
$b = explode("\n", $new);

// Options for generating the diff
$options = array(
    'ignoreWhitespace' => true,
    //'ignoreCase' => true,
);
// Initialize the diff class
$diff = new Diff($a, $b, $options);

$renderer = new Diff_Renderer_Html_Inline;
$text =  $diff->render($renderer);

?>

<h1><?= $this->title ?>:</h1>

<?= $text ?>


