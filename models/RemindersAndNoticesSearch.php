<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RemindersAndNotices;
use Yii;

/**
 * RemindersAndNoticesSearch represents the model behind the search form of `app\models\RemindersAndNotices`.
 */
class RemindersAndNoticesSearch extends RemindersAndNotices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'date_of_notice', 'audience', 'status', 'created_at', 'updated_at', 'added_by'], 'integer'],
            [['title', 'body', 'send_to'], 'safe'],
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
    public function search($params,$limit = null)
    {
        if ($limit) {
            $query = RemindersAndNotices::find()->limit($limit);
        } else {
            $query = RemindersAndNotices::find();
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['date_of_notice' => SORT_DESC]],
        ]);

        $dept = Yii::$app->session['department'];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_of_notice' => $this->date_of_notice,
            'audience' => $this->audience,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'added_by' => $this->added_by,
        ]);
        if (User::userIsAllowedTo('Manage Users')) {
            
        } else {
            $allowed_arr = array('all',$dept);
            $query->andFilterWhere(['IN','audience', $allowed_arr])
                ->andFilterWhere(['status' => 1]);
        }
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'send_to', $this->send_to]);

        return $dataProvider;
    }
}
