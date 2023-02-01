<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FuneralNotices;
use Yii;

/**
 * FuneralNoticesSearch represents the model behind the search form of `app\models\FuneralNotices`.
 */
class FuneralNoticesSearch extends FuneralNotices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'notified_by', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'address', 'photo', 'position_in_church', 'family_members_and_contacts'], 'safe'],
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
        $query = FuneralNotices::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC]],
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
            'notified_by' => Yii::$app->user->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'position_in_church', $this->position_in_church])
            ->andFilterWhere(['like', 'family_members_and_contacts', $this->family_members_and_contacts]);

        return $dataProvider;
    }
}