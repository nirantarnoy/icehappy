<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_detail".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $line_type
 * @property int $itemid
 * @property double $qty
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class CustomerDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'line_type', 'itemid', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['qty','line_price'], 'number'],
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
            'line_type' => 'Line Type',
            'itemid' => 'Itemid',
            'qty' => 'Qty',
            'note' => 'Note',
            'line_price' => 'Line price',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
