<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\DepartmentMember;

/**
 * This is the model class for table "responsible_person".
 *
 * @property int $id
 * @property int $department_member
 * @property int $initiative
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property DepartmentMember $departmentMember
 * @property Initiative $initiative0
 * @property User $updatedBy
 */
class ResponsiblePerson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'responsible_person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_member', 'department', 'initiative', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [[ 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [
                ['departmembe_member', 'department', 'initiative'], 'safe'
            ],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['department_member'], 'exist', 'skipOnError' => true, 'targetClass' => DepartmentMember::className(), 'targetAttribute' => ['department_member' => 'id']],
            [['initiative'], 'exist', 'skipOnError' => true, 'targetClass' => Initiative::className(), 'targetAttribute' => ['initiative' => 'id']],
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
            'department_member' => 'Department Member',
            'department' => 'Department',
            'initiative' => 'Initiative',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
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
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[DepartmentMember]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember0()
    {
        return $this->hasOne(Member::className(), ['id' => 'department_member']);
    }

    /**
     * Gets query for [[Initiative0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInitiative0()
    {
        return $this->hasOne(Initiative::className(), ['id' => 'initiative']);
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
