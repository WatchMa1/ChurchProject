<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "strategic_plan".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $year
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property StrategicTheme[] $strategicThemes
 */
class StrategicPlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'strategic_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'description', 'start_year', 'finish_year', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['id', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['start_year', 'finish_year'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1000],
            [['id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
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
            'name' => 'Name',
            'description' => 'Description',
            'start_year' => 'Start Year',
            'finish_year' => 'Finish Year',
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[StrategicThemes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrategicThemes()
    {
        return $this->hasMany(StrategicTheme::className(), ['strategic_plan' => 'id']);
    }
}
