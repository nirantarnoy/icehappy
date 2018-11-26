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
            [['name'],'required'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by','zone_id'], 'integer'],
            [['lat','long','prefix','first_name','last_name'],'string'],
            [['email'],'email'],
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
            'name' => 'ชื่อร้าน/บริษัท',
            'first_name'=>'ชื่อ',
            'last_name'=>'นามสกุล',
            'contact_name' => 'ชื่อผู้ติดต่อ',
            'mobile' => 'มือถือ',
            'phone' => 'โทรศัพท์',
            'line' => 'Line',
            'facebook' => 'Facebook',
            'lat'=>'lat',
            'prefix'=>'คำนำหน้า',
            'email'=>'E-mail',
            'long'=>'long',
            'zone_id'=>'เขต/เส้นทาง',
            'seeme' => 'รู้จักเราทาง',
            'delivery_type' => 'วิธีส่ง',
            'delivery_place' => 'ที่อยู่ในการส่ง',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
