<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ChurchContacts;

/**
 * ChurchContactsSearch represents the model behind the search form of `app\models\ChurchContacts`.
 */
class ChurchContactsSearch extends ChurchContacts
{
    /**
     * {@inheritdoc}
     */
    public $positionname;

    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['position_id','positionname'], 'safe'],
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
        $query = ChurchContacts::find()->joinWith('position',true,' LEFT JOIN');

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'name', $this->positionname]);

        return $dataProvider;
    }
}