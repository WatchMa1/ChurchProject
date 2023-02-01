<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "address".
 *
 * @property int $id
 * @property string $home_address
 * @property string|null $mobile_number
 * @property string|null $whatsapp_number
 * @property string|null $facebook_id
 * @property string|null $twitter_id
 * @property string|null $instagram_id
 * @property string|null $primary_email
 * @property string|null $secondary_email
 * @property string $gps_home_location
 * @property int $created_at
 * @property int|null $created_by
 * @property int $updated_at
 * @property int|null $updated_by
 * @property int $member
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Member $member0
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['primary_email', 'home_address', 'mobile_number'], 'required'],
            [['primary_email', 'secondary_email'], 'email'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'member'], 'integer'],
            [['home_address', 'mobile_number', 'whatsapp_number', 'facebook_id', 'twitter_id', 'instagram_id', 'primary_email', 'secondary_email', 'gps_home_location'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'home_address' => 'Home Address',
            'mobile_number' => 'Mobile Number',
            'whatsapp_number' => 'WhatsApp Number',
            'facebook_id' => 'Facebook Username',
            'twitter_id' => 'Twitter Handle',
            'instagram_id' => 'Instagram Username',
            'primary_email' => 'Primary Email',
            'secondary_email' => 'Secondary Email',
            'gps_home_location' => 'GPS coordinates of Home Location',
            'member' => 'Member',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     */
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
     * Gets query for [[Member0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember0()
    {
        return $this->hasOne(Member::className(), ['id' => 'member']);
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
