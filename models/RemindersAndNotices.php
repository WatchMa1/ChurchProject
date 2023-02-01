<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "reminders_and_notices".
 *
 * @property int $id
 * @property int $date_of_notice
 * @property string $title
 * @property string $body
 * @property string|null $send_to
 * @property int|null $audience
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int $added_by
 *
 * @property User $addedBy
 */
class RemindersAndNotices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reminders_and_notices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_of_notice'], 'required'],
            [['audience', 'status', 'created_at', 'updated_at', 'added_by'], 'integer'],
            [['title', 'body'], 'string'],
            [['send_to'], 'string', 'max' => 50],
            [['added_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['added_by' => 'id']],
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
            'date_of_notice' => 'Date and Time Of Notice',
            'title' => 'Title',
            'body' => 'Body',
            'send_to' => 'Send To',
            'audience' => 'Audience',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'added_by' => 'Added By',
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
}
