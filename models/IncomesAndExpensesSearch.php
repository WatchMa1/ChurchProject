<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\IncomesAndExpenses;
use app\models\User;
use app\models\FundItems;


/**
 * IncomesAndExpensesSearch represents the model behind the search form of `app\models\IncomesAndExpenses`.
 */
class IncomesAndExpensesSearch extends IncomesAndExpenses
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fund_item', 'added_by', 'created_at', 'updated_at', 'updated_by'], 'integer'],
            [['trans_type'], 'safe'],
            [['amount'], 'number'],
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

    public function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
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
        $query = IncomesAndExpenses::find();

        $date_of_trans_to = Yii::$app->getRequest()->getQueryParam('date_of_trans_to');
        $date_of_trans_from = Yii::$app->getRequest()->getQueryParam('date_of_trans_from');
        if (User::userIsAllowedTo('Manage Department')) {
            $dept = Yii::$app->session['department'];
        }

        if (User::userIsAllowedTo('Manage Users')) {
            $dept = Yii::$app->getRequest()->getQueryParam('dept');
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
                ],
            'sort'=> ['defaultOrder' => ['date_of_trans' => SORT_DESC]],
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
            'fund_item' => $this->fund_item,
            'amount' => $this->amount,
            'added_by' => $this->added_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'trans_type', $this->trans_type]);

        $fund_id_arr = array();
        if (isset($dept) && strlen($dept) > 0) {
            $arr  = FundItems::find()->where(['dept' => $dept])->asArray()->all();
            foreach ($arr as $item) {
                $curr_item_id = $item['id'];
                array_push($fund_id_arr, $curr_item_id);
            }
            $query->andFilterWhere(['IN','fund_item', $fund_id_arr]);

        }
        if ($this->validateDate($date_of_trans_to)) {
            $query->andFilterWhere(['<=','date_of_trans', strtotime($date_of_trans_to)]);
        }
        if ($this->validateDate($date_of_trans_from)) {
            $query->andFilterWhere(['>=','date_of_trans', strtotime($date_of_trans_from)]);
        }
        return $dataProvider;
    }
}