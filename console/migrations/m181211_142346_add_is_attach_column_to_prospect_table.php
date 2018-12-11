<?php

use yii\db\Migration;

/**
 * Handles adding is_attach to table `prospect`.
 */
class m181211_142346_add_is_attach_column_to_prospect_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('prospect','is_attach',$this->integer());
        $this->addColumn('prospect','is_file',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('prospect','is_attach');
        $this->dropColumn('prospect','is_file');
    }
}
