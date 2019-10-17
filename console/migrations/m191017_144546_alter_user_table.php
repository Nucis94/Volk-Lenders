<?php

use yii\db\Migration;

/**
 * Class m191017_144546_alter_user_table
 */
class m191017_144546_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * Add `role` field to `user` table. Default role will be set to 'USER' represented by '10' value.
         */
        $this->addColumn('{{%user}}', 'role', 'SMALLINT(6) NOT NULL DEFAULT \'10\' AFTER `email`');


        /**
         * Create foreign keys in `team_footballer` and `goal` tables to `role` table.
         */
        $this->addForeignKey('team_footballer_footballer', '{{%team_footballer}}', ['footballer_id'], 'user', ['id']);
        $this->addForeignKey('goal_footballer', '{{%goal}}', ['footballer_id'], 'user', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('goal_footballer', '{{%goal}}');
        $this->dropForeignKey('team_footballer_footballer', '{{%team_footballer}}');

        $this->dropColumn('{{%user}}', '{{%role}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_144546_alter_user_table cannot be reverted.\n";

        return false;
    }
    */
}
