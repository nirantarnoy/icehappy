<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prospect".
 *
 * @property int $id
 * @property string $name
 * @property string $contact_name
 * @property string $mobile
 * @property string $phone
 * @property string $line
 * @property string $facebook
 * @property string $seeme
 * @property string $delivery_type
 * @property string $delivery_place
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Prospect extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prospect';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'contact_name', 'mobile', 'phone', 'line', 'facebook', 'seeme', 'delivery_type', 'delivery_place'], 'string', 'max' => 255],
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
            'contact_name' => 'Contact Name',
            'mobile' => 'Mobile',
            'phone' => 'Phone',
            'line' => 'Line',
            'facebook' => 'Facebook',
            'seeme' => 'Seeme',
            'delivery_type' => 'Delivery Type',
            'delivery_place' => 'Delivery Place',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
