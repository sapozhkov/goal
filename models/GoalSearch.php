<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Goal;

/**
 * GoalSearch represents the model behind the search form about `app\models\Goal`.
 */
class GoalSearch extends Goal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'priority_id', 'type_id'], 'integer'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Goal::find();

        $query->with('type');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status_id' => $this->status_id,
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
}
