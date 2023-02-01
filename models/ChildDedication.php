<?php

namespace app\models;

use Yii;
use MP\SelectModel\MPModelSelectAction;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "child_dedication".
 *
 * @property int $id
 * @property int $user_id
 * @property string $child_name
 * @property string $child_gender
 * @property string|null $meaning_name
 * @property string $father_name
 * @property string $mother_name
 * @property string|null $father_phone
 * @property string|null $mother_phone
 * @property string|null $father_email
 * @property string|null $mother_email
 * @property string $father_religious_affiliation
 * @property string $father_adventist_membership
 * @property string $mother_religious_affiliation
 * @property string $mother_adventist_membership
 * @property string $photo
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $user
 */
class ChildDedication extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'child_dedication';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'child_name', 'child_gender', 'father_name', 'mother_name'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['child_name', 'child_gender', 'meaning_name', 'father_religious_affiliation', 'father_adventist_membership', 'mother_religious_affiliation', 'mother_adventist_membership', 'photo'], 'string'],
            [['father_name', 'mother_name'], 'string', 'max' => 100],
            [['father_phone', 'mother_phone'], 'string', 'max' => 15],
            [['father_email', 'mother_email'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'child_name' => 'Child Name',
            'child_gender' => 'Child Gender',
            'meaning_name' => 'Meaning Name',
            'father_name' => 'Father Name',
            'mother_name' => 'Mother Name',
            'father_phone' => 'Father Phone',
            'mother_phone' => 'Mother Phone',
            'father_email' => 'Father Email',
            'mother_email' => 'Mother Email',
            'father_religious_affiliation' => 'Father Religious Affiliation',
            'father_adventist_membership' => 'Father Adventist Membership',
            'mother_religious_affiliation' => 'Mother Religious Affiliation',
            'mother_adventist_membership' => 'Mother Adventist Membership',
            'photo' => 'Photo',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}