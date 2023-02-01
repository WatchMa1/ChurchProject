<?php

namespace app\models;

use Yii;
use MP\SelectModel\MPModelSelectAction;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "church_officers".
 *
 * @property int $id
 * @property int $position_id
 * @property int $user_id
 * @property int $year
 * @property int $added_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $addedBy
 * @property ChurchPositions $position
 * @property User $user
 */
class ChurchOfficers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'church_officers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position_id', 'user_id', 'year'], 'required'],
            [['position_id', 'user_id', 'year', 'added_by', 'created_at', 'updated_at'], 'integer'],
            [['added_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['added_by' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChurchPositions::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
    public function actions(): array
    {
        return array_merge(parent::actions(), [
            'model-search' => [
                'class' => MPModelSelectAction::class,
            ],
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position_id' => 'Position',
            'user_id' => 'Member',
            'year' => 'Year',
            'added_by' => 'Added By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[AddedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by']);
    }

    /**
     * Gets query for [[Position]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(ChurchPositions::className(), ['id' => 'position_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}