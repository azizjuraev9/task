<?php

use yii\db\Migration;

/**
 * Class m181011_125946_user_gifts
 */
class m181011_125946_user_gifts extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_gifts}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'gift_id' => $this->integer(),
            'status' => $this->integer()->notNull(),
            'money' => $this->integer(),
            'time' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ], $tableOptions);

        $this->createIndex(
            'idx-user_gifts-user_id',
            'user_gifts',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_gifts-user_id',
            'user_gifts',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-user_gifts-gift_id',
            'user_gifts',
            'gift_id'
        );

        $this->addForeignKey(
            'fk-user_gifts-gift_id',
            'user_gifts',
            'gift_id',
            'gifts',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%user_gifts}}');
    }
}
