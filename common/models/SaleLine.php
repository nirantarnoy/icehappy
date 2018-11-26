<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale_line".
 *
 * @property int $id
 * @property int $sale_id
 * @property int $product_id
 * @property int $qty
 * @property double $price
 * @property double $line_disc_per
 * @property double $line_disc_amount
 * @property double $line_total
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class SaleLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_id', 'product_id', 'qty', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['price', 'line_disc_per', 'line_disc_amount', 'line_total'], 'number'],
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
            'product_id' => 'Product ID',
            'qty' => 'Qty',
            'price' => 'Price',
            'line_disc_per' => 'Line Disc Per',
            'line_disc_amount' => 'Line Disc Amount',
            'line_total' => 'Line Total',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
