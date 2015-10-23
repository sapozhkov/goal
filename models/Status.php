<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property string $title
 * @property integer $weight
 * @property integer $closed
 *
 * @property Goal[] $goals
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['weight', 'closed'], 'integer'],
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
            'closed' => Yii::t('app', 'Closed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoals()
    {
        return $this->hasMany(Goal::className(), ['status_id' => 'id']);
    }
}
