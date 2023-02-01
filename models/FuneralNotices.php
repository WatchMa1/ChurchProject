<?php

namespace app\models;

use Yii;
use MP\SelectModel\MPModelSelectAction;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "funeral_notices".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $address
 * @property string|null $photo
 * @property string|null $position_in_church
 * @property string|null $family_members_and_contacts
 * @property int $notified_by
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class FuneralNotices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'funeral_notices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'gender','notified_by','date_of_birth','date_of_death'], 'required'],
            [['notified_by', 'created_at', 'updated_at'], 'integer'],
            [['address', 'photo', 'position_in_church', 'photo', 'gender', 'family_members_and_contacts'], 'string'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            [['id'], 'unique'],
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date of birth',
            'date_of_death' => 'Date of death',
            'address' => 'Address',
            'photo' => 'Photo',
            'position_in_church' => 'Position In Church',
            'family_members_and_contacts' => 'Family Members And Contacts',
            'notified_by' => 'Notified By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    /**
     * Gets query for [[NotifiedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifiedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'notified_by']);
    }
}