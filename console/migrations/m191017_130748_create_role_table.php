<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role}}`.
 */
class m191017_130748_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * Create a roles table to store all available roles.
         */
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%role}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->unique(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);


        /**
         * Insert 'USER', 'ADMIN' and 'FOOTBALLER' roles to `role` table.
         */
        $this->insert('{{%role}}', [
            'id' => 10,
            'title' => 'USER',
            'created_at' => 'NOW()',
            'updated_at' => 'NOW()',
        ]);
        $this->insert('{{%role}}', [
            'id' => 20,
            'title' => 'ADMIN',
            'created_at' => 'NOW()',
            'updated_at' => 'NOW()',
        ]);
        $this->insert('{{%role}}', [
            'id' => 30,
            'title' => 'FOOTBALLER',
            'created_at' => 'NOW()',
            'updated_at' => 'NOW()',
        ]);


        /**
         * Add `role` field to `user` table.
         */
        $this->addColumn('{{%user}}', 'role', 'INT(11) AFTER `email`');
        $this->addForeignKey('user_role', '{{%user}}', ['role'], '{{%role}}', ['id']);


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

        $this->dropForeignKey('user_role', '{{%user}}');
        $this->dropColumn('{{%user}}', '{{%role}}');

        $this->dropTable('{{%role}}');
    }
}
