<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer_pic`.
 */
class m181119_040020_create_customer_pic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('customer_pic', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'filename'=>$this->string(),
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
        $this->dropTable('customer_pic');
    }
}
