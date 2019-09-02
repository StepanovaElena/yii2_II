<?php

use yii\db\Migration;

/**
 * Class m190831_174504_insert_into_table_user
 */
class m190831_174504_insert_into_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'id' => 1,
            'username' => 'Администратор',
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'password_hash' => \Yii::$app->security->generatePasswordHash(123456),
            'password_reset_token' => \Yii::$app->security->generateRandomString(),
            'email' => 'admin@mail.ru',
            'status' => 10,
            'created_at' => 'CURRENT_TIMESTAMP',
            'updated_at' => 'CURRENT_TIMESTAMP',
        ]);

        $this->insert('user', [
            'id' => 2,
            'username' => 'Тестовый пользователь',
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'password_hash' => \Yii::$app->security->generatePasswordHash(123456),
            'password_reset_token' => \Yii::$app->security->generateRandomString(),
            'email' => 'user@mail.ru',
            'status' => 10,
            'created_at' => 'CURRENT_TIMESTAMP',
            'updated_at' => 'CURRENT_TIMESTAMP',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->delete('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190831_174504_insert_into_table_user cannot be reverted.\n";

        return false;
    }
    */
}
