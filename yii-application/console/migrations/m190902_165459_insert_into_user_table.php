<?php

use Ramsey\Uuid\Uuid;
use yii\db\Migration;

/**
 * Class m190902_165459_insert_into_user_table
 */
class m190902_165459_insert_into_user_table extends Migration
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
            'created_at' => '',
            'updated_at' => ''
        ]);

        $this->insert('user', [
            'id' => 2,
            'username' => 'Тестовый пользователь',
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'password_hash' => \Yii::$app->security->generatePasswordHash(123456),
            'password_reset_token' => \Yii::$app->security->generateRandomString(),
            'email' => 'user@mail.ru',
            'status' => 10,
            'created_at' => '',
            'updated_at' => ''
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
        echo "m190902_165459_insert_into_user_table cannot be reverted.\n";

        return false;
    }
    */
}
