<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OfferingAndTithe;

/**
 * OfferingAndTitheSearch represents the model behind the search form of `app\models\OfferingAndTithe`.
 */
class OfferingAndTitheSearch extends OfferingAndTithe
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user', 'updated_by', 'added_by', 'created_at', 'updated_at'], 'integer'],
            [['receipt_id','date_of_receipt_from','date_of_receipt_to'], 'safe'],
   
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
    public function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public function search($params, $distinct = null)
    {
        $query = OfferingAndTithe::find();
        if ($distinct) {
            $query = $query->select($distinct)->distinct();
        }

        $year = Yii::$app->getRequest()->getQueryParam('year');
        $year = ($this->validateDate($year,'Y')) ? $year : date('Y');
        $date_of_receipt_to = Yii::$app->getRequest()->getQueryParam('date_of_receipt_to');
        $date_of_receipt_from = Yii::$app->getRequest()->getQueryParam('date_of_receipt_from');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort'=> ['defaultOrder' => ['date_of_receipt' => SORT_DESC]],


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
            'user' => $this->user,
            'receipt_id' => $this->receipt_id,
            'updated_by' => $this->updated_by,
            'added_by' => $this->added_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
    
        if (strlen($year) == 4) {
            $next_year = strval($year) + 1;
            $year = $year.'-01-01';
            $next_year = $next_year.'-01-01';
            $query->andFilterWhere(['>=','date_of_receipt', strtotime($year)]);
            $query->andFilterWhere(['<','date_of_receipt', strtotime($next_year)]);
        }
        if ($this->validateDate($date_of_receipt_to)) {
            $query->andFilterWhere(['<=','date_of_receipt', strtotime($date_of_receipt_to)]);
        }
        if ($this->validateDate($date_of_receipt_from)) {
            $query->andFilterWhere(['>=','date_of_receipt', strtotime($date_of_receipt_from)]);
        }
        return $dataProvider;
    }
}