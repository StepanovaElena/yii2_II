<?php

use yii\db\Migration;

/**
 * Class m190912_075008_create_table_participants
 */
class m190912_075008_create_table_participants extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('participants', [
            'project_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'role' => "ENUM('manager','developer','consultant','tester')"
        ], $tableOptions);

        $this->addForeignKey(
            'user_key',
            'participants',
            'user_id',
            'user',
            'id'
        );
        $this->addForeignKey(
            'project_key',
            'participants',
            'project_id',
            'projects',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('participants');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190912_075008_create_table_participants cannot be reverted.\n";

        return false;
    }
    */
}
