<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goal".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status_id
 * @property integer $priority_id
 * @property integer $type_id
 * @property string $description
 * @property string $created_at
 * @property string $to_be_done_at
 * @property string $updated_at
 * @property string $done_at
 *
 * @property Type $type
 * @property Priority $priority
 * @property Status $status
 */
class Goal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'created_at', 'updated_at'], 'required'],
            [['status_id', 'priority_id', 'type_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'to_be_done_at', 'updated_at', 'done_at'], 'safe'],
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
            'status_id' => Yii::t('app', 'Status ID'),
            'priority_id' => Yii::t('app', 'Priority ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'to_be_done_at' => Yii::t('app', 'To Be Done At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'done_at' => Yii::t('app', 'Done At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::className(), ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
}
