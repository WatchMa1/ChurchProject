<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "family_other".
 *
 * @property int $id
 * @property int $family
 * @property int $other
 * @property int $created_at
 * @property int|null $created_by
 * @property int $updated_at
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property Family $family0
 * @property Member $other0
 * @property User $updatedBy
 */
class FamilyOther extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'family_other';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['family', 'other'], 'required'],
            [['family', 'other', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['family'], 'exist', 'skipOnError' => true, 'targetClass' => Family::className(), 'targetAttribute' => ['family' => 'id']],
            [['other'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['other' => 'id']],
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
            'family' => 'Family',
            'other' => 'Other',
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
     * Gets query for [[Family0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamily0()
    {
        return $this->hasOne(Family::className(), ['id' => 'family']);
    }

    /**
     * Gets query for [[Other0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOther0()
    {
        return $this->hasOne(Member::className(), ['id' => 'other']);
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
