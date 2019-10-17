<?php

use yii\db\Migration;

/**
 * Class m191017_181601_add_entries_to_user_table
 */
class m191017_181601_add_entries_to_user_table extends Migration
{
    /**
     * Define an array of footballers to create.
     */
    const footballers = [
        1 => 'footballer_1',
        2 => 'footballer_2',
        3 => 'footballer_3',
        4 => 'footballer_4',
        5 => 'footballer_5'
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $query = [];

        /**
         * Fill `query` array by all defined `footballers`.
         */
        foreach (self::footballers as $iter => $footballer) {
            $id = $iter;
            $username = $footballer;
            $auth_key = Yii::$app->security->generateRandomString();
            $password_hash = Yii::$app->security->generatePasswordHash($footballer);
            $email = $footballer . '@foot.ball';
            $role = \frontend\models\Footballer::ROLE_FOOTBALLER;
            $status = \frontend\models\Footballer::STATUS_ACTIVE;
            $created_at = time();
            $updated_at = $created_at + 1;

            $query[] = [$id, $username, $auth_key, $password_hash, $email, $role, $status, $created_at, $updated_at];
        }

        /**
         * Insert all `footballers`.
         */
        $this->batchInsert('{{%user}}', ['id', 'username', 'auth_key', 'password_hash', 'email', 'role', 'status', 'created_at', 'updated_at'], $query);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /**
         * Delete all `footballers` by ID.
         */
        $ids = array_keys(self::footballers);
        $condition = '`id` IN (' . join(', ', $ids) . ')';
        $this->delete('{{%user}}', $condition);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_181601_add_entries_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
