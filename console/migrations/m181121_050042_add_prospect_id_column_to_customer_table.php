<?php

use yii\db\Migration;

/**
 * Handles adding prospect_id to table `customer`.
 */
class m181121_050042_add_prospect_id_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customer', 'prospect_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('customer', 'prospect_id');
    }
}
