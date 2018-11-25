<?php

use yii\db\Migration;

/**
 * Handles adding prefix to table `prospect`.
 */
class m181125_101405_add_prefix_column_to_prospect_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('prospect', 'prefix', $this->string());
        $this->addColumn('prospect','email',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('prospect', 'prefix');
        $this->dropColumn('prospect', 'email');
    }
}
