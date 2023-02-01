<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "family".
 *
 * @property int $id
 * @property string $family_name
 * @property int|null $head_of_family
 * @property int|null $spouse
 * @property string $family_photo
 * @property string $prayer_band
 * @property int $created_at
 * @property int|null $created_by
 * @property int $updated_at
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property Member $headOfFamily
 * @property Member $spouse0
 * @property User $updatedBy
 * @property FamilyChildren[] $familyChildrens
 * @property FamilyOther[] $familyOthers
 */
class Family extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'family';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['family_name', 'prayer_band'], 'required'],
            [['family_photo'], 'required', 'on'=>'create'],
            [['head_of_family', 'spouse', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['family_name', 'family_photo', 'prayer_band'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['head_of_family'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['head_of_family' => 'id']],
            [['spouse'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['spouse' => 'id']],
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
            'family_name' => 'Family Name',
            'head_of_family' => 'Head of Family',
            'spouse' => 'Spouse',
            'family_photo' => 'Family Photo',
            'prayer_band' => 'Prayer Band',
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
     * Gets query for [[HeadOfFamily]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHeadOfFamily()
    {
        return $this->hasOne(Member::className(), ['id' => 'head_of_family']);
    }

    /**
     * Gets query for [[Spouse0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpouse0()
    {
        return $this->hasOne(Member::className(), ['id' => 'spouse']);
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
     * Gets query for [[FamilyChildrens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyChildrens()
    {
        return $this->hasMany(FamilyChildren::className(), ['family' => 'id']);
    }

    /**
     * Gets query for [[FamilyOthers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyOthers()
    {
        return $this->hasMany(FamilyOther::className(), ['family' => 'id']);
    }
}
