<?php

use yii\db\Migration;

/**
 * Class m191017_112709_drop_footballer_table
 */
class m191017_112709_drop_footballer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * Drop `goal` and `team_footballer` tables foreign keys to `footballer`.
         */
        $this->dropForeignKey('goal_ibfk_3', '{{%goal}}');
        $this->dropForeignKey('team_footballer_ibfk_2', '{{%team_footballer}}');

        /**
         * Drop `footballer` table.
         */
        $this->dropTable('{{%footballer}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%footballer}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
            'age' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('team_footballer_ibfk_2', '{{%team_footballer}}', ['footballer_id'], 'footballer', ['id']);
        $this->addForeignKey('goal_ibfk_3', '{{%goal}}', ['footballer_id'], 'footballer', ['id']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_112709_drop_footballer_table cannot be reverted.\n";

        return false;
    }
    */
}
