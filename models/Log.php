<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
            [['goal_id'], 'required'],
            [['created_at', 'data', 'message'], 'safe'],
            [['data', 'message'], 'string']
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'created_at',
                ],
                'value' => function () {
                    return date('c', time() - date('Z'));
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('log', 'ID'),
            'goal_id' => Yii::t('log', 'Goal ID'),
            'created_at' => Yii::t('log', 'Created At'),
            'data' => Yii::t('log', 'Data'),
            'message' => Yii::t('log', 'Message'),
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
