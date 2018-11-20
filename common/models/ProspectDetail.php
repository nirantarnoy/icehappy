<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prospect_detail".
 *
 * @property int $id
 * @property int $prospect_id
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
class ProspectDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prospect_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prospect_id', 'line_type', 'itemid', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['qty'], 'number'],
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
            'prospect_id' => 'Prospect ID',
            'line_type' => 'Line Type',
            'itemid' => 'Itemid',
            'qty' => 'Qty',
            'note' => 'Note',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
