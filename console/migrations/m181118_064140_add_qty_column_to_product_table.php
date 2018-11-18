<?php

use yii\db\Migration;

/**
 * Handles adding qty to table `product`.
 */
class m181118_064140_add_qty_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'qty', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product', 'qty');
    }
}
