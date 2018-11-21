<?php

use yii\db\Migration;

/**
 * Handles adding delivery_type to table `customer`.
 */
class m181121_143442_add_delivery_type_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customer', 'delivery_type', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('customer', 'delivery_type');
    }
}
