<?php

use yii\db\Migration;

/**
 * Handles adding first_name to table `prospect`.
 */
class m181125_101922_add_first_name_column_to_prospect_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('prospect', 'first_name', $this->string()->after('name'));
        $this->addColumn('prospect', 'last_name', $this->string()->after('first_name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('prospect', 'first_name');
        $this->dropColumn('prospect', 'last_name');
    }
}
