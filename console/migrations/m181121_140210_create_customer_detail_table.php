<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer_detail`.
 */
class m181121_140210_create_customer_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('customer_detail', [
            'id' => $this->primaryKey(),
            'customer_id'=>$this->integer(),
            'line_type'=>$this->integer(),
            'itemid'=>$this->integer(),
            'qty'=>$this->float(),
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
        $this->dropTable('customer_detail');
    }
}
