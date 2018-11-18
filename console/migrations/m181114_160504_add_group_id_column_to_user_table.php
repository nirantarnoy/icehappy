<?php

use yii\db\Migration;

/**
 * Handles adding group_id to table `user`.
 */
class m181114_160504_add_group_id_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','group_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','group_id');
    }
}
