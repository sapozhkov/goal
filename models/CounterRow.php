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
 * @property float $value
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
            [['counter_id'], 'integer'],
            [['value'], 'integer'],
            [['counter_id'], 'required'],
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
            'id' => Yii::t('counnter', 'ID'),
            'counter_id' => Yii::t('counnter', 'Counter ID'),
            'time' => Yii::t('counnter', 'Time'),
            'value' => Yii::t('counnter', 'Value'),
            'description' => Yii::t('counnter', 'Description'),
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
