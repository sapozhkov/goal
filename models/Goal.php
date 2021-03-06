<?php

namespace app\models;

use app\modules\settings\models\Priority;
use app\modules\settings\models\Status;
use app\modules\settings\models\Type;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "goal".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $icon
 * @property integer $status_id
 * @property integer $priority_id
 * @property integer $type_id
 * @property string $description
 * @property string $created_at
 * @property string $to_be_done_at
 * @property string $updated_at
 * @property string $done_at
 * @property integer $percent
 * @property string $smart_specific
 * @property string $smart_measurable
 * @property string $smart_achievable
 * @property string $smart_relevant
 * @property string $smart_time_bound
 *
 * @property Type $type
 * @property Priority $priority
 * @property Status $status
 * @property Log[] $logs
 * @property Counter[] $counters
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
            [['title', 'alias'], 'required'],
            [['alias'], 'match', 'pattern' => '/^[\w-_]+$/'],
            [['status_id', 'priority_id', 'type_id', 'percent'], 'integer'],
            [['description','smart_specific', 'smart_measurable', 'smart_achievable', 'smart_relevant', 'smart_time_bound', 'icon'], 'string'],
            [['title', 'alias', 'created_at', 'to_be_done_at', 'done_at', 'icon'], 'safe'],
            [['title'], 'string', 'max' => 256],
            [['alias'], 'string', 'max' => 32]
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    self::EVENT_BEFORE_UPDATE => 'updated_at',
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
            'id' => Yii::t('goal', 'ID'),
            'title' => Yii::t('goal', 'Title'),
            'alias' => Yii::t('goal', 'Alias'),
            'status_id' => Yii::t('goal', 'Status'),
            'priority_id' => Yii::t('goal', 'Priority'),
            'type_id' => Yii::t('goal', 'Type'),
            'description' => Yii::t('goal', 'Description'),
            'created_at' => Yii::t('goal', 'Created At'),
            'to_be_done_at' => Yii::t('goal', 'To Be Done At'),
            'updated_at' => Yii::t('goal', 'Updated At'),
            'done_at' => Yii::t('goal', 'Done At'),
            'percent' => Yii::t('goal', 'Percent'),
            'smart_specific'   => Yii::t('goal', 'Smart Specific'),
            'smart_measurable' => Yii::t('goal', 'Smart Measurable'),
            'smart_achievable' => Yii::t('goal', 'Smart Achievable'),
            'smart_relevant'   => Yii::t('goal', 'Smart Relevant'),
            'smart_time_bound' => Yii::t('goal', 'Smart Time Bound'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['goal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounters()
    {
        return $this->hasMany(Counter::className(), ['goal_id' => 'id']);
    }

    /*
     * URL
     */

    /**
     * Url to goal/view
     * @param array $params add params
     * @return string
     */
    public function url($params = []) {
        return Url::to(['goal/view', 'alias' => $this->alias]+$params);
    }

    /**
     * Url to log list for goal
     * @return string
     */
    public function urlLogList() {
        return Url::to(['log/index', 'sort'=> '-created_at', 'goal_id' => $this->id]);
    }

    /**
     * Url to task list for goal
     * @return string
     */
    public function urlTaskList() {
        return Url::to(['task/index', 'sort'=> 'date', 'TaskSearch[goal_id]' => $this->id, 'TaskSearch[closed]' => 0]);
    }

    /**
     * Url to counters list for goal
     * @return string
     */
    public function urlCounterList() {
        return Url::to(['counter/index', 'sort'=> 'title', 'CounterSearch[goal_id]' => $this->id]);
    }

}
