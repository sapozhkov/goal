<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "counter".
 *
 * @property integer $id
 * @property integer $goal_id
 * @property string $title
 * @property string $description
 * @property int sum total sum of all CounterRow.values
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
            [['goal_id'], 'integer'],
            [['title'], 'required'],
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
            'id' => Yii::t('counter', 'ID'),
            'goal_id' => Yii::t('counter', 'Goal ID'),
            'title' => Yii::t('counter', 'Title'),
            'description' => Yii::t('counter', 'Description'),
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

    /**
     * Returns total sum of all CounterRow.values
     * @return int
     */
    public function getSum() {
        $r = CounterRow::find()
            ->select(['sum' => 'SUM(value)'])
            ->where(['counter_id' => $this->id])
            ->asArray()
            ->one()
        ;
        return $r ? (int)$r['sum'] : 0;

    }
}
