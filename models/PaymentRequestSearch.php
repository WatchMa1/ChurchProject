<?php

namespace app\models;

use Yii;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaymentRequest;

/**
 * PaymentRequestSearch represents the model behind the search form of `app\models\PaymentRequest`.
 */
class PaymentRequestSearch extends PaymentRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'integer'],
            [['strategic_area', 'payment_to_be_made_to', 'department', 'purpose', 'requested_by'], 'safe'],
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
        $query = PaymentRequest::find();
        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $myDepartment = $session['department'];
            $query = $query->where(['department'=>$myDepartment]);
        }

        $query = $query->joinWith('department0',true,'LEFT JOIN');
        $query = $query->joinWith('requestedBy',true,'LEFT JOIN');

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
            //'requested_by' => $this->requested_by,
            //'department' => $this->department,
            'amount' => $this->amount,
            'date_required' => $this->date_required,
            'requested_at' => $this->requested_at,
        ]);

        $query->andFilterWhere(['like', 'strategic_area', $this->strategic_area])
            ->andFilterWhere(['like', 'payment_to_be_made_to', $this->payment_to_be_made_to])
            ->andFilterWhere(['like', 'purpose', $this->purpose]);
        $query->andFilterWhere(['like', 'name', $this->department]);
        $query->andFilterWhere(['like', 'first_name', $this->requested_by])
                ->orFilterWhere(['like', 'last_name', $this->requested_by]);

        return $dataProvider;
    }
}