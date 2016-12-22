<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "counter".
 *
 * @property integer $id
 * @property integer $goal_id
 * @property string $title
 * @property integer $type
 * @property string $description
 *
 * @property Goal $goal
 * @property CounterRow[] $counterRows
 */
class Counter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'counter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goal_id', 'type'], 'integer'],
            [['title', 'type'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 256],
            [['goal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goal::className(), 'targetAttribute' => ['goal_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('counnter', 'ID'),
            'goal_id' => Yii::t('counnter', 'Goal ID'),
            'title' => Yii::t('counnter', 'Title'),
            'type' => Yii::t('counnter', 'Type'),
            'description' => Yii::t('counnter', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoal()
    {
        return $this->hasOne(Goal::className(), ['id' => 'goal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounterRows()
    {
        return $this->hasMany(CounterRow::className(), ['counter_id' => 'id']);
    }
}
