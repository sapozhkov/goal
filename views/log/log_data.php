<?php

use app\models\Goal;
use app\models\Priority;
use app\models\Status;
use app\models\Type;
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

$data = json_decode($log->data);

$rows = [];

if ( $data ) {
    foreach ($data as $fieldName => $fieldData ) {

        if ( $goalModel->hasAttribute($fieldName) ) {

            $fieldLabel = $goalModel->getAttributeLabel($fieldName);

            switch ( $fieldName ) {

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
                        '<strong>%s</strong> %s (%s)',
                        $fieldLabel,
                        \Yii::t('log', 'updated'),
                        Html::a('diff', ['log/diff', 'id' => $log->id, 'field' => $fieldName])
                    );
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


