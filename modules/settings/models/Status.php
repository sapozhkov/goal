<?php

namespace app\modules\settings\models;

use app\models\Goal;
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
            'id' => Yii::t('status', 'ID'),
            'title' => Yii::t('status', 'Title'),
            'weight' => Yii::t('status', 'Weight'),
            'closed' => Yii::t('status', 'Closed'),
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
