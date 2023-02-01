<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Family;

/**
 * FamilySearch represents the model behind the search form of `app\models\Family`.
 */
class FamilySearch extends Family
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'head_of_family', 'spouse', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['family_name', 'family_photo', 'prayer_band'], 'safe'],
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
        $query = Family::find();

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
            'head_of_family' => $this->head_of_family,
            'spouse' => $this->spouse,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'family_name', $this->family_name])
            ->andFilterWhere(['like', 'family_photo', $this->family_photo])
            ->andFilterWhere(['like', 'prayer_band', $this->prayer_band]);

        return $dataProvider;
    }
}
