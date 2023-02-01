<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ChurchOfficers;

/**
 * ChurchOfficersSearch represents the model behind the search form of `app\models\ChurchOfficers`.
 */
class ChurchOfficersSearch extends ChurchOfficers
{
    /**
     * {@inheritdoc}
     */
    public $positionname;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'year', 'created_at', 'updated_at'], 'integer'],
            [['position_id','positionname', 'user_id','added_by'], 'safe'],
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
        $query = ChurchOfficers::find()->joinWith('position',true,' LEFT JOIN');

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
            'position_id' => $this->position_id,
            'user_id' => $this->user_id,
            'year' => $this->year,
            'added_by' => $this->added_by, 
        ]);
        $query->andFilterWhere(['like', 'name', $this->positionname]);
        return $dataProvider;
    }
}