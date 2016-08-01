<?php

namespace app\modules\settings\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PrioritySearch represents the model behind the search form about `app\modules\settings\models\Priority`.
 */
class PrioritySearch extends Priority
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'weight'], 'integer'],
            [['title'], 'safe'],
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
        $query = Priority::find();

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
            'weight' => $this->weight,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

    /**
     * Returns sorted array of AR
     * @return Priority[]
     */
    public static function getAll() {
        return self::find()
            ->orderBy('weight')
            ->all();
    }
}
