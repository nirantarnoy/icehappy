<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale_free".
 *
 * @property int $id
 * @property int $sale_id
 * @property int $customer_id
 * @property int $qty_big
 * @property int $qty_small
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class SaleFree extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale_free';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_id', 'customer_id', 'qty_big', 'qty_small', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_id' => 'Sale ID',
            'customer_id' => 'Customer ID',
            'qty_big' => 'Qty Big',
            'qty_small' => 'Qty Small',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
