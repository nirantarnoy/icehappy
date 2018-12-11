<?php

use yii\db\Migration;

/**
 * Handles adding is_attach to table `customer`.
 */
class m181211_141547_add_is_attach_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customer','is_attach',$this->integer());
        $this->addColumn('customer','is_file',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('customer','is_attach');
        $this->dropColumn('customer','is_file');
    }
}
