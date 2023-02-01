<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KPI;

/**
 * KPISearch represents the model behind the search form of `app\models\KPI`.
 */
class KPISearch extends KPI
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'strategic_objective', 'department', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['measure', 'yearly_target', 'q1_target', 'q2_target', 'q3_target', 'q4_target'], 'safe'],
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
        $query = KPI::find();

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
            'strategic_objective' => $this->strategic_objective,
            'department' => $this->department,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'measure', $this->measure])
            ->andFilterWhere(['like', 'yearly_target', $this->yearly_target])
            ->andFilterWhere(['like', 'q1_target', $this->q1_target])
            ->andFilterWhere(['like', 'q2_target', $this->q2_target])
            ->andFilterWhere(['like', 'q3_target', $this->q3_target])
            ->andFilterWhere(['like', 'q4_target', $this->q4_target]);

        return $dataProvider;
    }
}
