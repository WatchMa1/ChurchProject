<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use MP\SelectModel\MPModelSelectAction;

/**
 * This is the model class for table "payment_request".
 *
 * @property int $id
 * @property int $requested_by
 * @property int $department
 * @property int $amount
 * @property string|null $strategic_area
 * @property int $date_required
 * @property string $payment_to_be_made_to
 * @property string $purpose
 * @property int $requested_at
 *
 * @property Department $department0
 * @property User $requestedBy
 */
class PaymentRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['requested_by', 'department', 'amount', 'date_required', 'payment_to_be_made_to', 'purpose'], 'required'],
            [['requested_by', 'department', 'amount', 'requested_at','updated_at','status','processed_amount'], 'integer'],
            [['strategic_area', 'payment_to_be_made_to', 'purpose','processed_comment'], 'string'],
            [['department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department' => 'id']],
            [['requested_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['requested_by' => 'id']],
        ];
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['requested_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
    public function actions(): array
    {
        return array_merge(parent::actions(), [
            'model-search' => [
                'class' => MPModelSelectAction::class,
            ],
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'requested_by' => 'Requested By',
            'department' => 'Department',
            'amount' => 'Amount',
            'strategic_area' => 'Strategic Area',
            'date_required' => 'Date Required',
            'payment_to_be_made_to' => 'Payment To Be Made To',
            'purpose' => 'Purpose',
            'requested_at' => 'Requested At',
            'updated_at' => 'Updated At',
            'status' => 'status',
            'processed_at' => 'Processed At',
            'processed_by' => 'Processed By',
            'processed_amount' => 'Processed Amount',
            'processed_comment' => 'Processed Comment',
        ];
    }

    /**
     * Gets query for [[Department0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment0()
    {
        return $this->hasOne(Department::className(), ['id' => 'department']);
    }

    /**
     * Gets query for [[RequestedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'requested_by']);
    }
}