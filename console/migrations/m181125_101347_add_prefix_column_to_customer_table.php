<?php

use yii\db\Migration;

/**
 * Handles adding prefix to table `customer`.
 */
class m181125_101347_add_prefix_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customer', 'prefix', $this->string());
        $this->addColumn('customer','email',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('customer', 'prefix');
        $this->dropColumn('customer', 'email');
    }
}
