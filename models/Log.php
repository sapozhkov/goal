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
            [['goal_id'], 'required'],
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ( !$this->created_at )
                $this->created_at = date('Y-m-d H:i:s');
            return true;
        } else {
            return false;
        }
    }

}
