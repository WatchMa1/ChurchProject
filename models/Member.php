<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $title
 * @property string $first_name
 * @property string|null $other_name
 * @property string $last_name
 * @property string|null $maiden_name
 * @property string $date_of_birth
 * @property string $gender
 * @property string $marital_status
 * @property int $membership_status
 * @property int $created_at
 * @property int|null $created_by
 * @property int $updated_at
 * @property int|null $updated_by
 *
 * @property Address[] $addresses
 * @property Family[] $families
 * @property Family[] $families0
 * @property FamilyChildren[] $familyChildrens
 * @property FamilyOther[] $familyOthers
 * @property User $createdBy
 * @property MembershipStatus $membershipStatus
 * @property User $updatedBy
 * @property WorkPlace[] $workPlaces
 */
class Member extends \yii\db\ActiveRecord
{
    public $member_type;
    public $member_status;
    public $congregation;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['membership_status', 'title', 'first_name', 'last_name', 'date_of_birth', 'gender', 'marital_status'], 'required'],
            [['membership_status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['first_name', 'other_name', 'last_name', 'maiden_name', 'date_of_birth', 'gender', 'marital_status'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['membership_status'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipStatus::className(), 'targetAttribute' => ['membership_status' => 'id']],
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
            'title' => 'Title',
            'first_name' => 'First name',
            'other_name' => 'Other name(s)',
            'last_name' => 'Last name',
            'maiden_name' => 'Maiden name',
            'date_of_birth' => 'Date of Birth',
            'gender' => 'Gender',
            'marital_status' => 'Marital Status',
            'membership_status' => 'Membership Type',
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
     * Gets query for [[Addresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['member' => 'id']);
    }

    /**
     * Gets query for [[Families]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilies()
    {
        return $this->hasMany(Family::className(), ['head_of_family' => 'id']);
    }

    /**
     * Gets query for [[Families0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilies0()
    {
        return $this->hasMany(Family::className(), ['spouse' => 'id']);
    }

    /**
     * Gets query for [[FamilyChildrens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyChildrens()
    {
        return $this->hasMany(FamilyChildren::className(), ['child' => 'id']);
    }

    /**
     * Gets query for [[FamilyOthers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyOthers()
    {
        return $this->hasMany(FamilyOther::className(), ['other' => 'id']);
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
     * Gets query for [[MembershipStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipStatus()
    {
        return $this->hasOne(MembershipStatus::className(), ['id' => 'membership_status']);
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
     * Gets query for [[WorkPlaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkPlaces()
    {
        return $this->hasMany(WorkPlace::className(), ['member' => 'id']);
    }

    public function getFullName()
    {
        return $this->title.' '.ucwords($this->first_name)." ".ucwords($this->other_name)." ".ucwords($this->last_name);
    }
}
