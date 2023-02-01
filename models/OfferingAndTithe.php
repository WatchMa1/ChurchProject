<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "offering_and_tithe".
 *
 * @property int $id
 * @property int $user
 * @property string $receipt_id
 * @property int|null $updated_by
 * @property int $added_by
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $addedBy
 * @property User $updatedBy
 * @property OfferingAndTitheReceipts $receipt
 */
class OfferingAndTithe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offering_and_tithe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user', 'receipt_id', 'added_by','date_of_receipt'], 'required'],
            [['user', 'updated_by', 'added_by', 'created_at', 'updated_at'], 'integer'],
            [['receipt_id'], 'string', 'max' => 50],
            [['receipt_id'], 'unique'],
            [['added_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['added_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'user' => 'Member',
            'receipt_id' => 'Receipt ID',
            'updated_by' => 'Updated By',
            'added_by' => 'Added By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
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
     * Gets query for [[Receipts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(OfferingAndTitheReceipts::className(), ['receipt_id' => 'receipt_id']);
    }

    public function getReceiptsTotal()
    {
        $receipts = OfferingAndTitheReceipts::find()->where(['receipt_id' => $this->receipt_id])->asArray()->all(); 
        $total_amount = 0;

        foreach ($receipts as $index => $receipt) {
            $amount = $receipt['amount'];
            $total_amount = $total_amount + $amount;
        }  
  
        return $total_amount;
    }
    public function getTrustFundsTotal()
    {
        $total_amount = 0;
        $receipts = FundItems::find()->asArray()->all(); 
        foreach ($receipts as $index => $receipt) {
            $fund_item = $receipt['id'];
            $fund_category = $receipt['fund_category'];
            if ($fund_category == 23) {
                $receipts = OfferingAndTitheReceipts::find()->where(['receipt_id' => $this->receipt_id, 'fund_item' => $fund_item])->asArray()->all(); 
                foreach ($receipts as $index => $receipt) {
                    $amount = $receipt['amount'];
                    $total_amount = $total_amount + $amount;
                }            
            }

        }  
            
        return $total_amount;
    }
    public function getLocalFundsTotal()
    {
        $total_amount = 0;
        $receipts = FundItems::find()->asArray()->all(); 
        foreach ($receipts as $index => $receipt) {
            $fund_item = $receipt['id'];
            $fund_category = $receipt['fund_category'];
            if ($fund_category != 23) {
                $receipts = OfferingAndTitheReceipts::find()->where(['receipt_id' => $this->receipt_id, 'fund_item' => $fund_item])->asArray()->all(); 
                foreach ($receipts as $index => $receipt) {
                    $amount = $receipt['amount'];
                    $total_amount = $total_amount + $amount;
                }            
            }

        }  
            
        return $total_amount;
    }
}