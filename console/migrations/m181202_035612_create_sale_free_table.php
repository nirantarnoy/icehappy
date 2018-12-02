<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sale_free`.
 */
class m181202_035612_create_sale_free_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sale_free', [
            'id' => $this->primaryKey(),
            'sale_id'=> $this->integer(),
            'customer_id'=>$this->integer(),
            'qty_big' => $this->integer(),
            'qty_small' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sale_free');
    }
}
