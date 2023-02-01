<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Baptism;

/**
 * BaptismSearch represents the model behind the search form of `app\models\Baptism`.
 */
class BaptismSearch extends Baptism
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['baptism_id', 'baptising_minister', 'member_id'], 'integer'],
            [['date'], 'safe'],
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
        $query = Baptism::find();

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
            'baptism_id' => $this->baptism_id,
            'baptising_minister' => $this->baptising_minister,
            'member_id' => $this->member_id,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}
