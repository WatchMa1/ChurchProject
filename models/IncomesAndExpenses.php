<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "incomes_and_expenses".
 *
 * @property int $id
 * @property int $fund_item
 * @property string $trans_type
 * @property float $amount
 * @property int $added_by
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property User $addedBy
 * @property FundItems $fundItem
 */
class IncomesAndExpenses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incomes_and_expenses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fund_item', 'trans_type', 'amount', 'added_by','date_of_trans'], 'required'],
            [['fund_item', 'added_by', 'created_at', 'updated_at', 'updated_by'], 'integer'],
            [['amount'], 'number'],
            [['trans_type'], 'string', 'max' => 50],
            [['added_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['added_by' => 'id']],
            [['fund_item'], 'exist', 'skipOnError' => true, 'targetClass' => FundItems::className(), 'targetAttribute' => ['fund_item' => 'id']],
        ];
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fund_item' => 'Fund Item',
            'trans_type' => 'Transaction Type',
            'date_of_trans' => 'Transaction Date',
            'amount' => 'Amount',
            'added_by' => 'Added By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[AddedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[FundItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFundItem()
    {
        return $this->hasOne(FundItems::className(), ['id' => 'fund_item']);
    }
}