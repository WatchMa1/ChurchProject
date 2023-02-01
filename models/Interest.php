<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "interest".
 *
 * @property int $id
 * @property string $first_name
 * @property string $other_name
 * @property string $last_name
 * @property string $gender
 * @property string $email
 * @property string $residence
 * @property string $denomination
 * @property string $date
 * @property string $need
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Interest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'interest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'first_name', 'other_name', 'last_name', 'gender', 'email', 'residence', 'denomination', 'date', 'need', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['id', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['date'], 'safe'],
            [['first_name', 'other_name', 'last_name', 'email', 'residence', 'denomination', 'need'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 10],
            [['id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'other_name' => 'Other Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'email' => 'Email',
            'residence' => 'Residence',
            'denomination' => 'Denomination',
            'date' => 'Date',
            'need' => 'Need',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
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
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
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
