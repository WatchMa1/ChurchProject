<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FundItems;

/**
 * FundItemsSearch represents the model behind the search form of `app\models\FundItems`.
 */
class FundItemsSearch extends FundItems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fund_category', 'created_at', 'updated_at'], 'integer'],
            [['item_name', 'description', 'year'], 'safe'],
            [['budget'], 'number'],
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
    public function search($params,$yearly = null,$category = null)
    {
        $query = FundItems::find();

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

        if ($yearly) {
            $this->year = $yearly;     
        }
        if ($category) {
            if ($category == 'trust') {
                $this->fund_category = 23;     
            }
            if ($category == 'local') {
                $query->andFilterWhere(['<>', 'fund_category', '23']) ;    
            }
            
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fund_category' => $this->fund_category,
            'year' => $this->year,
            'budget' => $this->budget,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}