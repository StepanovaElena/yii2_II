<?php

use yii\db\Migration;

/**
 * Class m190906_183429_add_column_into
 */
class m190906_183429_add_column_into extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       // $this->addColumn('tasks', 'project_id', $this->integer()->notNull()->after('description'));
        //$this->addForeignKey(
        //    'project_id_key',
        //    'tasks',
        //    'project_id',
        //    'projects',
        //    'id'
        //);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->dropColumn('tasks', 'project_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190906_183429_add_column_into cannot be reverted.\n";

        return false;
    }
    */
}
