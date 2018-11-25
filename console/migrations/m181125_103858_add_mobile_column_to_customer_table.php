<?php

use yii\db\Migration;

/**
 * Handles adding mobile to table `customer`.
 */
class m181125_103858_add_mobile_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customer', 'mobile', $this->string());
        $this->addColumn('customer', 'line', $this->string());
        $this->addColumn('customer', 'facebook', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('customer', 'mobile');
        $this->dropColumn('customer', 'line');
        $this->dropColumn('customer', 'facebook');
    }
}
