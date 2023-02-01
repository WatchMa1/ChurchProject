<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "baptism_interest".
 *
 * @property int $id
 * @property int $user
 * @property string $state
 * @property int|null $recieved_by
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $user0
 * @property User $recievedBy
 */
class BaptismInterest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'baptism_interest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user'], 'integer'],
            [['state'], 'string', 'max' => 100],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user' => 'id']],
            [['recieved_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recieved_by' => 'id']],
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
            'user' => 'Member',
            'state' => 'State',
            'recieved_by' => 'Recieved By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    /**
     * Gets query for [[RecievedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecievedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'recieved_by']);
    }
}