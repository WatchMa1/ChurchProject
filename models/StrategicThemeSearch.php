<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StrategicTheme;

/**
 * StrategicThemeSearch represents the model behind the search form of `app\models\StrategicTheme`.
 */
class StrategicThemeSearch extends StrategicTheme
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'strategic_plan', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['theme'], 'safe'],
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
        $query = StrategicTheme::find();

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
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'theme', $this->theme])
            ->andFilterWhere(['like', 'strategic_plan', $this->strategic_plan]);

        return $dataProvider;
    }
}
