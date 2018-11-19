<?php

use yii\db\Migration;

/**
 * Handles adding zone_id to table `customer`.
 */
class m181119_034706_add_zone_id_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customer', 'zone_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('customer', 'zone_id');
    }
}
