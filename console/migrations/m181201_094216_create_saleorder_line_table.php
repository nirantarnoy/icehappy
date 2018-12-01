<?php

use yii\db\Migration;

/**
 * Handles the creation of table `saleorder_line`.
 */
class m181201_094216_create_saleorder_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('saleorder_line', [
            'id' => $this->primaryKey(),
            'sale_id' => $this->integer(),
            'customer_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty'=> $this->integer(),
            'free_qty' => $this->integer(),
            'price'=> $this->float(),
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
        $this->dropTable('saleorder_line');
    }
}
