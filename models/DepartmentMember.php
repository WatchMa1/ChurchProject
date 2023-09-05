<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Member;

/**
 * This is the model class for table "department_member".
 *
 * @property int $id
 * @property int $member
 * @property int $department
 * @property string $role
 * @property string $year
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Department $department0
 * @property Member $member0
 */
class DepartmentMember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'department', 'role', 'year', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['member', 'department', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['year'], 'safe'],
            [['role'], 'string', 'max' => 255],
            [['department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department' => 'id']],
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
            'member' => 'Member',
            'department' => 'Department',
            'role' => 'Role',
            'year' => 'Year',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
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
     * Gets query for [[Department0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment0()
    {
        return $this->hasOne(Department::className(), ['id' => 'department']);
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

    public function getName0()
    {
        return Member::findOne(['id' => $this->member0])->getFullName();
    }
    public function getFullName()
    {
        return Member::findOne($this->member)->fullName;
    }
}