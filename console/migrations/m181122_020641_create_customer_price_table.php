<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer_price`.
 */
class m181122_020641_create_customer_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('customer_price', [
            'id' => $this->primaryKey(),
            'customer_id'=>$this->integer(),
            'product_id'=>$this->integer(),
            'price' => $this->integer(),
            'priceper'=> $this->integer(),
            'price_start' =>$this->date(),
            'price_end' => $this->date(),
            'note'=>$this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('customer_price');
    }
}
