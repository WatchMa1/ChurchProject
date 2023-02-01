<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ChildDedication;

/**
 * ChildDedicationSearch represents the model behind the search form of `app\models\ChildDedication`.
 */
class ChildDedicationSearch extends ChildDedication
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['child_name', 'child_gender', 'meaning_name', 'father_name', 'mother_name', 'father_phone', 'mother_phone', 'father_email', 'mother_email', 'father_religious_affiliation', 'father_adventist_membership', 'mother_religious_affiliation', 'mother_adventist_membership', 'photo'], 'safe'],
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
        $query = ChildDedication::find();
        //$user_id = $params['user_id'];
        // add conditions that should always apply here
        //$query->where(['user_id' => $user_id]);

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
            'user_id' => Yii::$app->user->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'child_name', $this->child_name])
            ->andFilterWhere(['like', 'child_gender', $this->child_gender])
            ->andFilterWhere(['like', 'meaning_name', $this->meaning_name])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'father_phone', $this->father_phone])
            ->andFilterWhere(['like', 'mother_phone', $this->mother_phone])
            ->andFilterWhere(['like', 'father_email', $this->father_email])
            ->andFilterWhere(['like', 'mother_email', $this->mother_email])
            ->andFilterWhere(['like', 'father_religious_affiliation', $this->father_religious_affiliation])
            ->andFilterWhere(['like', 'father_adventist_membership', $this->father_adventist_membership])
            ->andFilterWhere(['like', 'mother_religious_affiliation', $this->mother_religious_affiliation])
            ->andFilterWhere(['like', 'mother_adventist_membership', $this->mother_adventist_membership])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }
}