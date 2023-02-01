<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "church_contacts".
 *
 * @property int $id
 * @property int $position_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ChurchPositions $position
 */
class ChurchContacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'church_contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position_id'], 'required'],
            [['position_id'], 'unique', 'message'=>'This position already Exists on church contacts'],
            [['position_id', 'created_at', 'updated_at'], 'integer'],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChurchPositions::className(), 'targetAttribute' => ['position_id' => 'id']],
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position_id' => 'Position ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
}