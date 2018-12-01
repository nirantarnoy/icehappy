<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "saleorder".
 *
 * @property int $id
 * @property string $sale_no
 * @property string $sale_date
 * @property int $sale_zone
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $approve_by
 */
class Saleorder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'saleorder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_date'], 'safe'],
            [['sale_zone', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'approve_by'], 'integer'],
            [['sale_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_no' => 'Sale No',
            'sale_date' => 'Sale Date',
            'sale_zone' => 'Sale Zone',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'approve_by' => 'Approve By',
        ];
    }
}
