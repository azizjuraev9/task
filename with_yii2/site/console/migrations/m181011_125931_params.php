<?php

use yii\db\Migration;

/**
 * Class m181011_125931_params
 */
class m181011_125931_params extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%params}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string()->notNull()->unique(),
            'value' => $this->string()->notNull(),
            'desc' => $this->string()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%params}}');
    }
}
