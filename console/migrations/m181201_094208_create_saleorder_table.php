<?php

use yii\db\Migration;

/**
 * Handles the creation of table `saleorder`.
 */
class m181201_094208_create_saleorder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('saleorder', [
            'id' => $this->primaryKey(),
            'sale_no'=>$this->string(),
            'sale_date'=>$this->date(),
            'sale_zone' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'approve_by' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('saleorder');
    }
}
