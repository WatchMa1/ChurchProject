<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "accomplished_activity".
 *
 * @property int $id
 * @property int $achieved_score
 * @property string $reason_for_disparity
 * @property int $initiative
 * @property int $kpi
 * @property int $strategic_objective
 * @property int $strategic_theme
 * @property int $department
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property Department $department0
 * @property Initiative $initiative0
 * @property KPI $kpi0
 * @property StrategicObjective $strategicObjective
 * @property StrategicTheme $strategicTheme
 * @property User $updatedBy
 */
class AccomplishedActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accomplished_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['initiative', 'kpi', 'strategic_objective', 'strategic_theme', 'department', 'created_by', 'created_at', 'updated_by', 'updated_at', 'quarter'], 'required'],
            [['achieved_score', 'initiative', 'kpi', 'strategic_objective', 'strategic_theme', 'department', 'created_by', 'created_at', 'updated_by', 'updated_at', 'quarter'], 'integer'],
            [['reason_for_disparity'], 'string', 'max' => 1000],
            [['color'], 'string', 'max' => 10],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department' => 'id']],
            [['initiative'], 'exist', 'skipOnError' => true, 'targetClass' => Initiative::className(), 'targetAttribute' => ['initiative' => 'id']],
            [['kpi'], 'exist', 'skipOnError' => true, 'targetClass' => KPI::className(), 'targetAttribute' => ['kpi' => 'id']],
            [['strategic_objective'], 'exist', 'skipOnError' => true, 'targetClass' => StrategicObjective::className(), 'targetAttribute' => ['strategic_objective' => 'id']],
            [['strategic_theme'], 'exist', 'skipOnError' => true, 'targetClass' => StrategicTheme::className(), 'targetAttribute' => ['strategic_theme' => 'id']],
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
            'achieved_score' => 'Achieved Score',
            'color' => 'Color Code',
            'reason_for_disparity' => 'Comment',
            'initiative' => 'Initiative',
            'kpi' => 'Kpi',
            'strategic_objective' => 'Strategic Objective',
            'strategic_theme' => 'Strategic Theme',
            'quarter' => 'Quarter',
            'department' => 'Department',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
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
     * Gets query for [[Initiative0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInitiative0()
    {
        return $this->hasOne(Initiative::className(), ['id' => 'initiative']);
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
     * Gets query for [[StrategicObjective]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrategicObjective()
    {
        return $this->hasOne(StrategicObjective::className(), ['id' => 'strategic_objective']);
    }

    /**
     * Gets query for [[StrategicTheme]].
     *
     * @return \yii\db\ActiveQuery
     */
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
}