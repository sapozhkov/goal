<?php

namespace app\modules\settings\models;

use app\models\Goal;
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
            'id' => Yii::t('type', 'ID'),
            'title' => Yii::t('type', 'Title'),
            'weight' => Yii::t('type', 'Weight'),
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
