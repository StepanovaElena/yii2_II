<?php

use yii\db\Migration;

/**
 * Class m190902_165432_create_table_tasks
 */
class m190902_165432_create_table_tasks extends Migration
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

        $this->createTable('tasks', [
            'id' => $this->primaryKey()->defaultExpression('AUTO_INCREMENT'),
            'title' => $this->string(150)->notNull(),
            'description' => $this->string(455)->notNull(),
            'executor_id' => $this->integer()->null(),
            'started_at' => $this->date()->notNull(),
            'completed_at' => $this->date()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->null(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->date()->null()
        ], $tableOptions);

        $this->addForeignKey(
            'task-executor',
            'tasks',
            'executor_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'task-created_by',
            'tasks',
            'created_by',
            'user',
            'id'
        );

        $this->addForeignKey(
            'task-updated_by',
            'tasks',
            'updated_by',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tasks');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190902_165432_create_table_tasks cannot be reverted.\n";

        return false;
    }
    */
}
