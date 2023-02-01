<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "wedding_notices".
 *
 * @property int $id
 * @property string $groom_first_name
 * @property string $groom_last_name
 * @property string $bride_first_name
 * @property string $bride_last_name
 * @property string|null $address
 * @property string $more_info
 * @property int $wedding_date
 * @property int $phone_number
 * @property int|null $family
 * @property string|null $groom_church
 * @property string|null $bride_church
 * @property string $is_bride_baptised
 * @property string $is_groom_baptised
 * @property string|null $officiating_minister_name
 * @property int $added_by
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $addedBy
 */
class WeddingNotices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wedding_notices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['groom_first_name', 'groom_last_name', 'bride_first_name', 'bride_last_name', 'wedding_date',  'wedding_date',  'is_bride_baptised', 'is_groom_baptised'], 'required'],
            [['address', 'phone_number','more_info'], 'string'],
            [['phone_number', 'family', 'added_by', 'status', 'created_at', 'updated_at'], 'integer'],
            [['groom_first_name', 'groom_last_name', 'bride_first_name', 'bride_last_name', 'groom_church', 'bride_church', 'officiating_minister_name'], 'string', 'max' => 255],
            [['is_bride_baptised', 'is_groom_baptised'], 'string', 'max' => 10],
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
            'groom_first_name' => 'Groom First Name',
            'groom_last_name' => 'Groom Last Name',
            'bride_first_name' => 'Bride First Name',
            'bride_last_name' => 'Bride Last Name',
            'address' => 'Address',
            'more_info' => 'More Info',
            'wedding_date' => 'Wedding Date',
            'phone_number' => 'Phone Number',
            'family' => 'Family',
            'groom_church' => 'Groom Church',
            'bride_church' => 'Bride Church',
            'is_bride_baptised' => 'Is Bride Baptised',
            'is_groom_baptised' => 'Is Groom Baptised',
            'officiating_minister_name' => 'Officiating Minister Name',
            'status' => 'Status',
            'added_by' => 'Added By',
            'processed_by' => 'Processed By',
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
    public function getProcessedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'processed_by']);
    }
}