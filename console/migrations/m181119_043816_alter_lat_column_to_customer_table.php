<?php

use yii\db\Migration;

/**
 * Class m181119_043816_alter_lat_column_to_customer_table
 */
class m181119_043816_alter_lat_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('customer','lat',$this->string());
        $this->alterColumn('customer','long',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('customer','lat',$this->decimal());
        $this->alterColumn('customer','long',$this->decimal());

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181119_043816_alter_lat_column_to_customer_table cannot be reverted.\n";

        return false;
    }
    */
}
