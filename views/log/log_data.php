<?php

use app\models\Goal;
use app\models\Priority;
use app\modules\settings\models\Status;
use app\modules\settings\models\Type;
use \yii\helpers\Html;
/**
 * @var \app\models\Log $log
 */

$goalModel = new Goal();
$notFound = '{not found}';

?>

<strong title="<?= Yii::$app->formatter->asDatetime($log->created_at) ?>"><?= Yii::$app->formatter->asRelativeTime($log->created_at) ?></strong>
<br />

<?php

$data = json_decode($log->data, true);

$rows = [];

if ( $data ) {
    foreach ($data as $fieldName => $fieldData ) {

        if ( $goalModel->hasAttribute($fieldName) ) {

            $fieldLabel = $goalModel->getAttributeLabel($fieldName);

            switch ( $fieldName ) {

                case 'percent':
                case 'title':
                    $rows[] = sprintf(
                        '<strong>%s</strong>: "%s" -> "%s"',
                        $fieldLabel,
                        Html::encode($fieldData[0]),
                        Html::encode($fieldData[1])
                    );
                    break;

                case 'status_id':
                    $oldStatus = Status::findOne($fieldData[0]);
                    $newStatus = Status::findOne($fieldData[1]);
                    $rows[] = sprintf(
                        '<strong>%s</strong>: "%s" -> "%s"',
                        $fieldLabel,
                        $oldStatus ? Html::encode( $oldStatus->title) : $notFound,
                        $newStatus ? Html::encode( $newStatus->title) : $notFound
                    );
                    break;

                case 'priority_id':
                    $oldPriority = Priority::findOne($fieldData[0]);
                    $newPriority = Priority::findOne($fieldData[1]);
                    $rows[] = sprintf(
                        '<strong>%s</strong>: "%s" -> "%s"',
                        $fieldLabel,
                        $oldPriority ? Html::encode( $oldPriority->title) : $notFound,
                        $newPriority ? Html::encode( $newPriority->title) : $notFound
                    );
                    break;

                case 'type_id':
                    $oldType = Type::findOne($fieldData[0]);
                    $newType = Type::findOne($fieldData[1]);
                    $rows[] = sprintf(
                        '<strong>%s</strong>: "%s" -> "%s"',
                        $fieldLabel,
                        $oldType ? Html::encode( $oldType->title) : $notFound,
                        $newType ? Html::encode( $newType->title) : $notFound
                    );
                    break;

                case 'description':
                case 'smart_specific':
                case 'smart_measurable':
                case 'smart_achievable':
                case 'smart_relevant':
                case 'smart_time_bound':
                    $rows[] = sprintf(
                        '%s (%s)',
                        \Yii::t('log', 'Field "{0}" updated', ['<strong>'.$fieldLabel.'</strong>']),
                        Html::a('diff', ['log/diff', 'id' => $log->id, 'field' => $fieldName])
                    );
                    break;

            }

        }

        // если не явлвется атрибутом
        else {

            switch ($fieldName) {

                case 'add_task':
                    $rows[] = \Yii::t('task', 'Add task "{0}"',
                        [Html::a($fieldData['title'], ['task/update', 'id' => $fieldData['id']])]);
                    break;

                case 'close_task':
                    $rows[] = \Yii::t('task', 'Close task "{0}"',
                        [Html::a($fieldData['title'], ['task/update', 'id' => $fieldData['id']])]);
                    break;

            }

        }

    }
}

?>

<? if ( $rows ): ?>
    <ul>
        <? foreach ($rows as $row): ?>
            <li>
                <?= $row ?>
            </li>
        <? endforeach; ?>
    </ul>
<? endif; ?>

<? if ( $log->message ): ?>
    <?= Yii::$app->formatter->asWiki($log->message) ?>
<? endif; ?>


