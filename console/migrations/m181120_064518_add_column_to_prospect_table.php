<?php

use yii\db\Migration;

/**
 * Class m181120_064518_add_column_to_prospect_table
 */
class m181120_064518_add_column_to_prospect_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('prospect','lat',$this->string());
        $this->addColumn('prospect','long',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('prospect','lat');
        $this->dropColumn('prospect','long');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181120_064518_add_column_to_prospect_table cannot be reverted.\n";

        return false;
    }
    */
}
