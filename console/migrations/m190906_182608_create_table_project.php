<?php

use yii\db\Migration;

/**
 * Class m190906_182608_create_table_project
 */
class m190906_182608_create_table_project extends Migration
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

        $this->createTable('projects', [
            'id' => $this->primaryKey()->defaultExpression('AUTO_INCREMENT'),
            'title' => $this->string(255),
            'description' => $this->string(455)->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->null(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(0)
        ], $tableOptions);

        $this->addForeignKey(
            'project-created_by',
            'projects',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'project-updated_by',
            'projects',
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
        $this->dropTable('projects');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190906_182608_create_table_project cannot be reverted.\n";

        return false;
    }
    */
}
