<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leadership_history".
 *
 * @property int $id
 * @property int $member
 * @property string $capacity
 * @property string $year
 * @property string|null $congregation
 * @property string|null $district
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property Member $member0
 * @property User $member1
 */
class LeadershipHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'leadership_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'capacity', 'year', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['member', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['capacity', 'congregation', 'district'], 'string'],
            [['year'], 'safe'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member' => 'id']],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['member' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member' => 'Member',
            'capacity' => 'Capacity',
            'year' => 'Year',
            'congregation' => 'Congregation',
            'district' => 'District',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
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
     * Gets query for [[Member1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember1()
    {
        return $this->hasOne(User::className(), ['id' => 'member']);
    }
}
