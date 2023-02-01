<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "k_p_i".
 *
 * @property int $id
 * @property string $measure
 * @property string $yearly_target
 * @property string $q1_target
 * @property string $q2_target
 * @property string $q3_target
 * @property string $q4_target
 * @property int $strategic_objective
 * @property int $department
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property Department $department0
 * @property StrategicObjective $strategicObjective
 * @property User $updatedBy
 */
class KPI extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k_p_i';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['measure', 'yearly_target', 'q1_target', 'q2_target', 'q3_target', 'q4_target', 'strategic_objective', 'department', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['strategic_objective', 'department', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['measure', 'yearly_target', 'q1_target', 'q2_target', 'q3_target', 'q4_target'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department' => 'id']],
            [['strategic_objective'], 'exist', 'skipOnError' => true, 'targetClass' => StrategicObjective::className(), 'targetAttribute' => ['strategic_objective' => 'id']],
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
            'measure' => 'Measure',
            'yearly_target' => 'Yearly Target',
            'q1_target' => 'Q1 Target',
            'q2_target' => 'Q2 Target',
            'q3_target' => 'Q3 Target',
            'q4_target' => 'Q4 Target',
            'strategic_objective' => 'Strategic Objective',
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
     * Gets query for [[StrategicObjective]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrategicObjective()
    {
        return $this->hasOne(StrategicObjective::className(), ['id' => 'strategic_objective']);
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
