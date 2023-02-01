<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "club".
 *
 * @property int $id
 * @property string $club_name
 * @property string $description
 * @property string $age_group
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 */
class Club extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'club';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['club_name', 'description', 'age_group', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['club_name', 'age_group'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'club_name' => 'Club Name',
            'description' => 'Description',
            'age_group' => 'Age Group',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
}
