<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WeddingNotices;

/**
 * WeddingNoticesSearch represents the model behind the search form of `app\models\WeddingNotices`.
 */
class WeddingNoticesSearch extends WeddingNotices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'wedding_date', 'phone_number', 'family', 'added_by', 'status', 'created_at', 'updated_at'], 'integer'],
            [['groom_first_name', 'groom_last_name', 'bride_first_name', 'bride_last_name', 'address', 'more_info', 'groom_church', 'bride_church', 'is_bride_baptised', 'is_groom_baptised', 'officiating_minister_name'], 'safe'],
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
        $query = WeddingNotices::find();
        $user = Yii::$app->user->id;
        if (!User::userIsAllowedTo('Manage Users')) {
            $query = $query->where(['added_by'=>$user]);
        }
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
            'wedding_date' => $this->wedding_date,
            'phone_number' => $this->phone_number,
            'family' => $this->family,
            'added_by' => $this->added_by,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'groom_first_name', $this->groom_first_name])
            ->andFilterWhere(['like', 'groom_last_name', $this->groom_last_name])
            ->andFilterWhere(['like', 'bride_first_name', $this->bride_first_name])
            ->andFilterWhere(['like', 'bride_last_name', $this->bride_last_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'more_info', $this->more_info])
            ->andFilterWhere(['like', 'groom_church', $this->groom_church])
            ->andFilterWhere(['like', 'bride_church', $this->bride_church])
            ->andFilterWhere(['like', 'is_bride_baptised', $this->is_bride_baptised])
            ->andFilterWhere(['like', 'is_groom_baptised', $this->is_groom_baptised])
            ->andFilterWhere(['like', 'officiating_minister_name', $this->officiating_minister_name]);

        return $dataProvider;
    }
}