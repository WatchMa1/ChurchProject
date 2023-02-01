<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "strategic_objective".
 *
 * @property int $id
 * @property string $objective
 * @property int $strategic_theme
 * @property int $department
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Initiative[] $initiatives
 * @property KPI[] $kPIs
 * @property User $createdBy
 * @property Department $department0
 * @property StrategicTheme $strategicTheme
 * @property User $updatedBy
 */
class StrategicObjective extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'strategic_objective';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['objective', 'strategic_theme', 'department', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['strategic_theme', 'department', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['objective'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department' => 'id']],
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
            'objective' => 'Objective',
            'strategic_theme' => 'Strategic Theme',
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
     * Gets query for [[Initiatives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInitiatives()
    {
        return $this->hasMany(Initiative::className(), ['strategic_objectives' => 'id']);
    }

    /**
     * Gets query for [[KPIs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKPIs()
    {
        return $this->hasMany(KPI::className(), ['strategic_objective' => 'id']);
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
