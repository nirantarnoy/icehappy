<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sale_zone`.
 */
class m181119_031801_create_sale_zone_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sale_zone', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'description'=>$this->string(),
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
        $this->dropTable('sale_zone');
    }
}
