<?php

use yii\db\Migration;

/**
 * Class m191017_184705_add_entries_to_team_table
 */
class m191017_184705_add_entries_to_team_table extends Migration
{
    /**
     * Define an array of teams to create.
     */
    const teams = [
        1 => 'blue',
        2 => 'green',
        3 => 'red',
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
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
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /**
         * Delete all `teams` by ID.
         */
        $ids = array_keys(self::teams);
        $condition = '`id` IN (' . join(', ', $ids) . ')';
        $this->delete('{{%team}}', $condition);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_184705_add_entries_to_team_table cannot be reverted.\n";

        return false;
    }
    */
}
