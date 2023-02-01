<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_type".
 *
 * @property int $id
 * @property string $name
 * @property int $group
 */
class MemberType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group'], 'required'],
            [['group'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'group' => 'Group',
        ];
    }
}
