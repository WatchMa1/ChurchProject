<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "departmental_expense_items".
 *
 * @property int $id
 * @property int $fund_item
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property FundItems $fundItem
 */
class DepartmentalExpenseItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departmental_expense_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fund_item'], 'required'],
            [['fund_item', 'created_at', 'updated_at'], 'integer'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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