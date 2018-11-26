<?php

use yii\db\Migration;

/**
 * Handles adding zone_id to table `prospect`.
 */
class m181126_153245_add_zone_id_column_to_prospect_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('prospect', 'zone_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('prospect', 'zone_id');
    }
}
