<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "offering_and_tithe_receipts".
 *
 * @property int $id
 * @property string $receipt_id
 * @property int $fund_item
 * @property float $amount
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int $added_by
 *
 * @property OfferingAndTithe $offeringAndTithe
 * @property FundItems $fundItem
 * @property User $addedBy
 * 
 */
class OfferingAndTitheReceipts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offering_and_tithe_receipts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receipt_id', 'fund_item', 'amount', 'added_by'], 'required'],
            [['fund_item', 'created_at', 'updated_at', 'added_by'], 'integer'],
            [['amount'], 'number'],
            [['receipt_id'], 'string', 'max' => 50],
            [['fund_item'], 'exist', 'skipOnError' => true, 'targetClass' => FundItems::className(), 'targetAttribute' => ['fund_item' => 'id']],
            [['added_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['added_by' => 'id']],
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
            'receipt_id' => 'Receipt ID',
            'fund_item' => 'Fund Item',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'added_by' => 'Added By',
        ];
    }

    /**
     * Gets query for [[OfferingAndTithe]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfferingAndTithe()
    {
        return $this->hasOne(OfferingAndTithe::className(), ['receipt_id' => 'receipt_id']);
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
}