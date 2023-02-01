<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "weekly_schedule".
 *
 * @property int $id
 * @property string $day
 * @property string $theme
 * @property int $elder_one
 * @property int|null $elder_two
 * @property int|null $clerk_one
 * @property int|null $clerk_two
 * @property int|null $deacon_one
 * @property int|null $deacon_two
 * @property string|null $cares_concern
 * @property string|null $announcements
 * @property string|null $sabbath_school
 * @property string|null $main_service
 * @property string|null $afternoon_service
 * @property string|null $personal_ministries
 * @property string|null $health_message
 * @property string|null $other
 *
 * @property User $clerkOne
 * @property User $clerkTwo
 * @property User $deaconOne
 * @property User $deaconTwo
 * @property User $elderOne
 * @property User $elderTwo
 */
class WeeklySchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weekly_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day', 'theme', 'elder_one'], 'required'],
            [['elder_one', 'elder_two', 'clerk_one', 'clerk_two', 'deacon_one', 'deacon_two'], 'integer'],
            [['day'], 'safe'],
            [['theme', 'cares_concern', 'announcements', 'sabbath_school', 'main_service', 'afternoon_service', 'personal_ministries', 'health_message', 'other'], 'string'],
            [['clerk_one'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['clerk_one' => 'id']],
            [['clerk_two'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['clerk_two' => 'id']],
            [['deacon_one'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['deacon_one' => 'id']],
            [['deacon_two'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['deacon_two' => 'id']],
            [['elder_one'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['elder_one' => 'id']],
            [['elder_two'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['elder_two' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day' => 'Date',
            'theme' => 'Theme',
            'elder_one' => 'Elder On Duty - 1',
            'elder_two' => 'Elder On Duty - 2',
            'clerk_one' => 'Clerk On Duty - 1',
            'clerk_two' => 'Clerk On Duty - 2',
            'deacon_one' => 'Deacon On Duty - 1',
            'deacon_two' => 'Deacon On Duty - 2',
            'cares_concern' => 'Cares Concern',
            'announcements' => 'Announcements',
            'sabbath_school' => 'Sabbath School',
            'main_service' => 'Main Service',
            'afternoon_service' => 'Afternoon Service',
            'personal_ministries' => 'Personal Ministries',
            'pastor_coner' => 'Pastor Corner',
            'health_message' => 'Health Message',
            'other' => 'Other',
        ];
    }

    /**
     * Gets query for [[ClerkOne]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClerkOne()
    {
        return $this->hasOne(User::className(), ['id' => 'clerk_one']);
    }

    /**
     * Gets query for [[ClerkTwo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClerkTwo()
    {
        return $this->hasOne(User::className(), ['id' => 'clerk_two']);
    }

    /**
     * Gets query for [[DeaconOne]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeaconOne()
    {
        return $this->hasOne(User::className(), ['id' => 'deacon_one']);
    }

    /**
     * Gets query for [[DeaconTwo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeaconTwo()
    {
        return $this->hasOne(User::className(), ['id' => 'deacon_two']);
    }

    /**
     * Gets query for [[ElderOne]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElderOne()
    {
        return $this->hasOne(User::className(), ['id' => 'elder_one']);
    }

    /**
     * Gets query for [[ElderTwo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElderTwo()
    {
        return $this->hasOne(User::className(), ['id' => 'elder_two']);
    }
}