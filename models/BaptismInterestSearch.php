<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BaptismInterest;

/**
 * BaptismInterestSearch represents the model behind the search form of `app\models\BaptismInterest`.
 */
class BaptismInterestSearch extends BaptismInterest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user', 'recieved_by', 'created_at', 'updated_at'], 'integer'],
            [['state'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = BaptismInterest::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user' => $this->user,
            'recieved_by' => $this->recieved_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'state', $this->state]);

        return $dataProvider;
    }
}
