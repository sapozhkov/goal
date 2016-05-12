<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "priority".
 *
 * @property integer $id
 * @property string $title
 * @property integer $weight
 *
 * @property Goal[] $goals
 */
class Priority extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'priority';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['weight'], 'integer'],
            [['title'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('priority', 'ID'),
            'title' => Yii::t('priority', 'Title'),
            'weight' => Yii::t('priority', 'Weight'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoals()
    {
        return $this->hasMany(Goal::className(), ['priority_id' => 'id']);
    }
}
