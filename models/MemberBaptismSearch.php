<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MemberBaptism;

/**
 * MemberBaptismSearch represents the model behind the search form of `app\models\MemberBaptism`.
 */
class MemberBaptismSearch extends MemberBaptism
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_baptism_id', 'member_id', 'baptism_id'], 'integer'],
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
        $query = MemberBaptism::find();

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
            'member_baptism_id' => $this->member_baptism_id,
            'member_id' => $this->member_id,
            'baptism_id' => $this->baptism_id,
        ]);

        return $dataProvider;
    }
}
