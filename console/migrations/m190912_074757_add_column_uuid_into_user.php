<?php

use yii\db\Migration;

/**
 * Class m190912_074757_add_column_uuid_into_user
 */
class m190912_074757_add_column_uuid_into_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'uuid', $this->string(125)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'uuid');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190912_074757_add_column_uuid_into_user cannot be reverted.\n";

        return false;
    }
    */
}
