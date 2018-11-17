<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale".
 *
 * @property int $id
 * @property string $sale_no
 * @property int $trans_date
 * @property int $customer_id
 * @property int $sale_type_id
 * @property int $payment_type_id
 * @property double $discount_per
 * @property double $discount_amount
 * @property double $sale_total
 * @property string $sale_total_text
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Sale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date', 'customer_id', 'sale_type_id', 'payment_type_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['discount_per', 'discount_amount', 'sale_total'], 'number'],
            [['sale_no', 'sale_total_text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sale_no' => Yii::t('app', 'Sale No'),
            'trans_date' => Yii::t('app', 'Trans Date'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'sale_type_id' => Yii::t('app', 'Sale Type ID'),
            'payment_type_id' => Yii::t('app', 'Payment Type ID'),
            'discount_per' => Yii::t('app', 'Discount Per'),
            'discount_amount' => Yii::t('app', 'Discount Amount'),
            'sale_total' => Yii::t('app', 'Sale Total'),
            'sale_total_text' => Yii::t('app', 'Sale Total Text'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
