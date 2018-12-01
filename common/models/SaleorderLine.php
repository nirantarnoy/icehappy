<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "saleorder_line".
 *
 * @property int $id
 * @property int $sale_id
 * @property int $customer_id
 * @property int $product_id
 * @property int $qty
 * @property int $free_qty
 * @property double $price
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class SaleorderLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'saleorder_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_id', 'customer_id', 'product_id', 'qty', 'free_qty', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['price'], 'number'],
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
            'product_id' => 'Product ID',
            'qty' => 'Qty',
            'free_qty' => 'Free Qty',
            'price' => 'Price',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
