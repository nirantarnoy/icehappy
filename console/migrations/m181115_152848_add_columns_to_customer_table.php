<?php

use yii\db\Migration;

/**
 * Class m181115_152848_add_columns_to_customer_table
 */
class m181115_152848_add_columns_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customer','lat',$this->decimal());
        $this->addColumn('customer','long',$this->decimal());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('customer','lat');
        $this->dropColumn('customer','long');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181115_152848_add_columns_to_customer_table cannot be reverted.\n";

        return false;
    }
    */
}
