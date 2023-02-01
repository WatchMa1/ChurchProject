<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Initiative;

/**
 * InitiativeSearch represents the model behind the search form of `app\models\Initiative`.
 */
class InitiativeSearch extends Initiative
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['budget', 'department_id', 'created_at', 'created_by', 'updated_at', 'updated_by',], 'integer'],
            [['start_date', 'end_date', 'strategic_theme', 'kpi', 'responsible_person'  ], 'safe'],
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
        $query = Initiative::find();

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
            //'start_date' => $this->start_date,
            //'end_date' => $this->end_date,
            'budget' => $this->budget,
            'kpi' => $this->kpi,
            //'strategic_objective' => $this->strategic_objective,
            // 'strategic_theme' => $this->strategic_theme,
            'department_id' => $this->department_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'activity', $this->activity])
            ->andFilterWhere(['like', 'comments', $this->comments])->andFilterWhere(['like', 'start_date', $this->start_date])->andFilterWhere(['like', 'end_date', $this->end_date]);
        
        $query->joinWith('strategicTheme');
        $query->andFilterWhere(['like', 'strategic_theme.theme', $this->strategic_theme]);
        
        $query->joinWith('strategicObjectives');
        $query->andFilterWhere(['like', 'strategic_objective.objective', $this->strategic_objective]);
        
        $query->joinWith('kpi0');
        $query->andFilterWhere(['like', 'kpi.measure', $this->kpi]);
        
        $query->joinWith('responsible');
        $query->andFilterWhere(['like', 'responsible.getFullName', $this->responsible]);

        return $dataProvider;
    }
}
