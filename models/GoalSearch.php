<?php

namespace app\models;

use app\modules\settings\models\Status;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * GoalSearch represents the model behind the search form about `app\models\Goal`.
 */
class GoalSearch extends Goal
{

    /** @var string Sort field */
    public $sort = '';

    public function init() {
        parent::init();
        $this->load(\Yii::$app->request->get());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'priority_id', 'type_id'], 'integer'],
            [['sort'], 'string'],
            [['title', 'description', 'created_at', 'to_be_done_at', 'updated_at', 'done_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return parent::attributeLabels()+[
            'sort' => Yii::t('app', 'Sort By'),
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Goal::find();

        $query
            ->with('type')
            ->with('priority')
            ->with('status')
        ;

        if ( !$this->isUsed() ) {
            $query
                ->innerJoinWith('priority')
                ->orderBy([
                    'priority.weight' => SORT_ASC,
                    'to_be_done_at' => SORT_ASC
                ])
                ->innerJoinWith('status')
                ->where('status.closed=0')
            ;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'params' => ['sort' => $this->sort]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        switch ( (int)$this->status_id ) {
            case 0:
                break;
            case Status::OPENED:
                $query
                    ->innerJoinWith('status')
                    ->where('status.closed=0')
                ;
                break;
            case Status::CLOSED:
                $query
                    ->innerJoinWith('status')
                    ->where('status.closed=1')
                ;
                break;
            default:
                $query->andFilterWhere(['status_id' => $this->status_id]);
                break;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'priority_id' => $this->priority_id,
            'type_id' => $this->type_id,
            'created_at' => $this->created_at,
            'to_be_done_at' => $this->to_be_done_at,
            'updated_at' => $this->updated_at,
            'done_at' => $this->done_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

    /**
     * Return true if one of filter fields is used
     * @return bool
     */
    public function isUsed() {
        return $this->title or $this->status_id or $this->priority_id or $this->type_id or $this->sort;
    }
}
