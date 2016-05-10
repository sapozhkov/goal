<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $title
 * @property string $date
 * @property integer $goal_id
 * @property integer $closed
 * @property integer $percent
 * @property string $created_at
 * @property string $closed_at
 *
 * @property Goal $goal
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'created_at'], 'required'],
            [['date', 'created_at', 'closed_at'], 'safe'],
            [['goal_id', 'closed', 'percent'], 'integer'],
            [['title'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'date' => Yii::t('app', 'Date'),
            'goal_id' => Yii::t('app', 'Goal ID'),
            'closed' => Yii::t('app', 'Closed'),
            'percent' => Yii::t('app', 'Percent'),
            'created_at' => Yii::t('app', 'Created At'),
            'closed_at' => Yii::t('app', 'Closed At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // change close date
            if ( $this->isAttributeChanged('closed', false) and $this->closed )
                $this->closed_at = date('Y-m-d H:i:s');
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        // add log record on task creation
        if ( $insert ) {
            $log = new Log([
                'message' => \Yii::t('app', 'Add task "{0}"', [$this->title]),
                'goal_id' => $this->goal_id
            ]);
            $log->save();
        }

        // on task close
        elseif ( isset($changedAttributes['closed']) and !$changedAttributes['closed'] and $this->closed ) {

            // add log record
            $log = new Log([
                'message' => \Yii::t('app', 'Close task "{0}"', [$this->title]),
                'goal_id' => $this->goal_id
            ]);
            $log->save();

            // upd percent if needed
            if ( $this->percent and $this->percent > $this->goal->done_percent ) {
                $this->goal->done_percent = $this->percent;
                $this->goal->save();
            }

        }

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoal()
    {
        return $this->hasOne(Goal::className(), ['id' => 'goal_id']);
    }
}
