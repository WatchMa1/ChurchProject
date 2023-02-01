<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WeeklySchedule;

/**
 * WeeklyScheduleSearch represents the model behind the search form of `app\models\WeeklySchedule`.
 */
class WeeklyScheduleSearch extends WeeklySchedule
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'elder_one', 'elder_two', 'clerk_one', 'clerk_two', 'deacon_one', 'deacon_two'], 'integer'],
            [['theme', 'cares_concern', 'announcements', 'sabbath_school', 'main_service', 'afternoon_service', 'personal_ministries', 'health_message', 'other'], 'safe'],
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
        $query = WeeklySchedule::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['day' => SORT_DESC]],
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
            'day' => $this->day,
            'elder_one' => $this->elder_one,
            'elder_two' => $this->elder_two,
            'clerk_one' => $this->clerk_one,
            'clerk_two' => $this->clerk_two,
            'deacon_one' => $this->deacon_one,
            'deacon_two' => $this->deacon_two,
        ]);

        $query->andFilterWhere(['like', 'theme', $this->theme])
            ->andFilterWhere(['like', 'cares_concern', $this->cares_concern])
            ->andFilterWhere(['like', 'announcements', $this->announcements])
            ->andFilterWhere(['like', 'sabbath_school', $this->sabbath_school])
            ->andFilterWhere(['like', 'main_service', $this->main_service])
            ->andFilterWhere(['like', 'afternoon_service', $this->afternoon_service])
            ->andFilterWhere(['like', 'personal_ministries', $this->personal_ministries])
            ->andFilterWhere(['like', 'health_message', $this->health_message])
            ->andFilterWhere(['like', 'other', $this->other]);

        return $dataProvider;
    }
}
