<?php

use yii\db\Migration;

/**
 * Handles adding line_price to table `customer_detail`.
 */
class m181125_071010_add_line_price_column_to_customer_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customer_detail', 'line_price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('customer_detail', 'line_price');
    }
}
