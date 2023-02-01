<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_baptism".
 *
 * @property int $member_baptism_id
 * @property int $member_id
 * @property int $baptism_id
 *
 * @property Baptism $baptism
 * @property Member $member
 */
class MemberBaptism extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member_baptism';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_id', 'baptism_id'], 'required'],
            [['member_id', 'baptism_id'], 'integer'],
            [['baptism_id'], 'exist', 'skipOnError' => true, 'targetClass' => Baptism::className(), 'targetAttribute' => ['baptism_id' => 'baptism_id']],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'member_baptism_id' => 'Member Baptism ID',
            'member_id' => 'Member ID',
            'baptism_id' => 'Baptism ID',
        ];
    }

    /**
     * Gets query for [[Baptism]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaptism()
    {
        return $this->hasOne(Baptism::className(), ['baptism_id' => 'baptism_id']);
    }

    /**
     * Gets query for [[Member]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }
}
