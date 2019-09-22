<?php

use yii\db\Migration;

/**
 * Class m190917_102631_add_column_into_participants
 */
class m190917_102631_add_column_into_participants extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('participants', 'id', $this->primaryKey()->defaultExpression('AUTO_INCREMENT'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('participants', 'id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190917_102631_add_column_into_participants cannot be reverted.\n";

        return false;
    }
    */
}
