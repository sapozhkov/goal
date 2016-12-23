<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "counter_row".
 *
 * @property integer $id
 * @property integer $counter_id
 * @property string $time
 * @property int $value
 * @property string $description
 *
 * @property Counter $counter
 */
class CounterRow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'counter_row';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['counter_id', 'value'], 'integer'],
            [['counter_id', 'value'], 'required'],
            [['time'], 'safe'],
            [['description'], 'string'],
            [['counter_id'], 'exist', 'skipOnError' => false, 'targetClass' => Counter::className(), 'targetAttribute' => ['counter_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'time',
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
            'id' => Yii::t('counter', 'ID'),
            'counter_id' => Yii::t('counter', 'Counter ID'),
            'time' => Yii::t('counter', 'Time'),
            'value' => Yii::t('counter', 'Value'),
            'description' => Yii::t('counter', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounter()
    {
        return $this->hasOne(Counter::className(), ['id' => 'counter_id']);
    }
}
