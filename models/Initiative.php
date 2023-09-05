<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "initiative".
 *
 * @property int $id
 * @property string $activity
 * @property string $start_date
 * @property string $end_date
 * @property int $budget_per_activity
 * @property string $comments
 * @property int $kpi
 * @property int $strategic_objectives
 * @property int $department
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property Department $department0
 * @property KPI $kpi0
 * @property StrategicObjective $strategicObjectives
 * @property User $updatedBy
 * @property ResourcePerson[] $resourcePeople
 * @property ResponsiblePerson[] $responsiblePeople
 */
class Initiative extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'initiative';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity', 'strategic_theme', 'start_date', 'end_date', 'budget', 'comments', 'kpi', 'strategic_objective', 'department_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['start_date', 'end_date', 'responsible_person', 'strategic_theme', 'kpi',], 'safe'],
            [['budget', 'department_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['activity'], 'string', 'max' => 255],
            [['comments'], 'string', 'max' => 500],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['kpi'], 'exist', 'skipOnError' => true, 'targetClass' => KPI::className(), 'targetAttribute' => ['kpi' => 'id']],
            [['strategic_objective'], 'exist', 'skipOnError' => true, 'targetClass' => StrategicObjective::className(), 'targetAttribute' => ['strategic_objective' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['strategic_theme'], 'exist', 'skipOnError' => true, 'targetClass' => StrategicTheme::className(), 'targetAttribute' => ['strategic_theme' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity' => 'Activity',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'budget' => 'Budget',
            'comments' => 'Comments',
            'kpi' => 'KPI',
            'strategic_objective' => 'Strategic Objective',
            'responisble_Person' => 'Resonsible Person',
            'department' => 'Department',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'strategic_theme' => 'Strategic Theme',
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
     * Gets query for [[Department0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment0()
    {
        return $this->hasOne(Department::className(), ['id' => 'department']);
    }

    /**
     * Gets query for [[Kpi0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKpi0()
    {
        return $this->hasOne(KPI::className(), ['id' => 'kpi']);
    }




    /**
     * Gets query for [[StrategicObjectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrategicObjectives()
    {
        return $this->hasOne(StrategicObjective::className(), ['id' => 'strategic_objective']);
    }


    public function getStrategicTheme()
    {
        return $this->hasOne(StrategicTheme::className(), ['id' => 'strategic_theme']);
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
     * Gets query for [[ResponsiblePeople]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponsible()
    {
        return $this->hasOne(Member::className(), ['id' => 'responsible_person']);
    }
}