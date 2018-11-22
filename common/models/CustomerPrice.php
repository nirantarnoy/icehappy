<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_price".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $product_id
 * @property int $price
 * @property int $priceper
 * @property string $price_start
 * @property string $price_end
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class CustomerPrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'product_id', 'price', 'priceper', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['price_start', 'price_end'], 'safe'],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'product_id' => 'Product ID',
            'price' => 'Price',
            'priceper' => 'Priceper',
            'price_start' => 'Price Start',
            'price_end' => 'Price End',
            'note' => 'Note',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
