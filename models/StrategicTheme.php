<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "strategic_theme".
 *
 * @property int $id
 * @property string $theme
 * @property string $strategic_plan
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property StrategicObjective[] $strategicObjectives
 */
class StrategicTheme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'strategic_theme';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['theme', 'strategic_plan', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['created_by', 'created_at', 'updated_by', 'strategic_plan', 'updated_at'], 'integer'],
            [['theme'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'theme' => 'Theme',
            'strategic_plan' => 'Strategic Plan',
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
     * Gets query for [[StrategicObjectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrategicObjectives()
    {
        return $this->hasMany(StrategicObjective::className(), ['strategic_theme' => 'id']);
    }
}
