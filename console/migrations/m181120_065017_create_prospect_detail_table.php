<?php

use yii\db\Migration;

/**
 * Handles the creation of table `prospect_detail`.
 */
class m181120_065017_create_prospect_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('prospect_detail', [
            'id' => $this->primaryKey(),
            'prospect_id'=>$this->integer(),
            'line_type'=>$this->integer(),
            'itemid'=>$this->integer(),
            'qty'=>$this->float(),
            'note'=>$this->string(),
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
        $this->dropTable('prospect_detail');
    }
}
