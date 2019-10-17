<?php

use yii\db\Migration;

/**
 * Class m191017_185723_add_entries_to_team_footballer_table
 */
class m191017_185723_add_entries_to_team_footballer_table extends Migration
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
     * Define an array of teams to create.
     */
    const teams = [
        1 => 'blue',
        2 => 'green',
        3 => 'red',
    ];


    /**
     * Adding some random footballers.
     */
    private function footballerSafeUp()
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
     * Delete footballer entries generated.
     */
    private function footballerSafeDown()
    {
        /**
         * Delete all `footballers` by ID.
         */
        $ids = array_keys(self::footballers);
        $condition = '`id` IN (' . join(', ', $ids) . ')';
        $this->delete('{{%user}}', $condition);
    }


    /**
     * Adding some random teams.
     */
    public function teamSafeUp()
    {
        $query = [];

        /**
         * Fill `query` array by all defined `teams`.
         */
        foreach (self::teams as $iter => $color) {
            $id = $iter;
            $name = 'team_' . $color;
            $city = $color;

            $query[] = [$id, $name, $city];
        }

        /**
         * Insert all `teams`.
         */
        $this->batchInsert('{{%team}}', ['id', 'name', 'city'], $query);
    }

    /**
     * Delete team entries generated.
     */
    public function teamSafeDown()
    {
        /**
         * Delete all `teams` by ID.
         */
        $ids = array_keys(self::teams);
        $condition = '`id` IN (' . join(', ', $ids) . ')';
        $this->delete('{{%team}}', $condition);
    }


    /**
     * Adding some random relations between teams and footballers.
     */
    public function teamFootballerSafeUp()
    {
        $query = [];

        /**
         * Fill `query` array by all defined `footballers`.
         */
        foreach (self::footballers as $iter => $footballer) {
            $id = $iter;
            $team_id = (($iter - 1) % (count(self::teams))) + 1;
            $footballer_id = $iter;
            $date = time();

            $query[] = [$id, $team_id, $footballer_id, $date];
        }

        /**
         * Insert all relations between `footballers` and `teams`.
         */
        $this->batchInsert('{{%team_footballer}}', ['id', 'team_id', 'footballer_id', 'date'], $query);
    }

    /**
     * Delete team_footballer entries generated.
     */
    public function teamFootballerSafeDown()
    {
        /**
         * Delete all `team_footballers` by ID.
         */
        $ids = array_keys(self::footballers);
        $condition = '`id` IN (' . join(', ', $ids) . ')';
        $this->delete('{{%team_footballer}}', $condition);
    }


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        self::footballerSafeUp();
        self::teamSafeUp();
        self::teamFootballerSafeUp();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        self::teamFootballerSafeDown();
        self::teamSafeDown();
        self::footballerSafeDown();
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
