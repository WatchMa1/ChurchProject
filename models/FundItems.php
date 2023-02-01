<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Department;

/**
 * This is the model class for table "fund_items".
 *
 * @property int $id
 * @property string $item_name
 * @property string $description
 * @property int $fund_category
 * @property string $year
 * @property float $budget
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property OfferingAndTithe[] $offeringAndTithes
 */
class FundItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fund_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'fund_category', 'year', 'budget'], 'required'],
            [['description'], 'string'],
            [['fund_category', 'created_at', 'dept', 'updated_at'], 'integer'],
            [['year'], 'safe'],
            [['budget'], 'number'],
            [['item_name'], 'string', 'max' => 200],
            [['item_name'], 'unique'],
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
            'item_name' => 'Item Name',
            'description' => 'Description',
            'fund_category' => 'Fund Category',
            'dept' => 'Department',
            'year' => 'Year',
            'budget' => 'Budget',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[OfferingAndTithes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfferingAndTithes()
    {
        return $this->hasMany(OfferingAndTithe::className(), ['fund_item_id' => 'id']);
    }
    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment0()
    {
        return $this->hasMany(Department::className(), ['id' => 'dept']);
    }
}