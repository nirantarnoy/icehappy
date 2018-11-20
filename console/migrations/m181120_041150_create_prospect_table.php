<?php

use yii\db\Migration;

/**
 * Handles the creation of table `prospect`.
 */
class m181120_041150_create_prospect_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('prospect', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'contact_name'=>$this->string(),
            'mobile'=>$this->string(),
            'phone'=>$this->string(),
            'line'=>$this->string(),
            'facebook'=>$this->string(),
            'seeme'=>$this->string(),
            'delivery_type'=>$this->string(),
            'delivery_place'=>$this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('prospect');
    }
}
