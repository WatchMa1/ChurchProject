<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "minister".
 *
 * @property int $minister_id
 * @property string $first_name
 * @property string|null $other_name
 * @property string $last_name
 * @property int $address_id
 *
 * @property Baptism[] $baptisms
 * @property Address $address
 */
class Minister extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'minister_new';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'address_id'], 'required'],
            [['address_id'], 'integer'],
            [['first_name', 'other_name', 'last_name'], 'string', 'max' => 255],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'minister_id' => 'Minister ID',
            'first_name' => 'First Name',
            'other_name' => 'Other Name',
            'last_name' => 'Last Name',
            'address_id' => 'Address ID',
        ];
    }

    /**
     * Gets query for [[Baptisms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaptism()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

}
