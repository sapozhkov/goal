<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property integer $id
 * @property integer $goal_id
 * @property string $created_at
 * @property string $data
 * @property string $message
 *
 * @property Goal $goal
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'goal_id'], 'integer'],
            [['goal_id', 'created_at'], 'required'],
            [['created_at', 'data', 'message'], 'safe'],
            [['data', 'message'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'goal_id' => Yii::t('app', 'Goal ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'data' => Yii::t('app', 'Data'),
            'message' => Yii::t('app', 'Message'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoal()
    {
        return $this->hasOne(Goal::className(), ['id' => 'goal_id']);
    }
}
