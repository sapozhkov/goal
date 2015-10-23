<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property integer $id
 * @property string $title
 * @property integer $weight
 *
 * @property Goal[] $goals
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
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
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'weight' => Yii::t('app', 'Weight'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoals()
    {
        return $this->hasMany(Goal::className(), ['type_id' => 'id']);
    }
}
