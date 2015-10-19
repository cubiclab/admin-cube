<?php

use yii\db\Schema;
use yii\db\Migration;

class m200809_121516_init_cubes_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        // Modules table
        $this->createTable('{{%cubes}}', [
            'module_id'     => Schema::TYPE_PK,
            'name'          => Schema::TYPE_STRING . '(64) NOT NULL',
            'class'         => Schema::TYPE_STRING . '(128) NOT NULL',
            'title'         => Schema::TYPE_STRING . '(128) NOT NULL',
            'icon'          => Schema::TYPE_STRING . '(32) NOT NULL',
            'settings'      => Schema::TYPE_TEXT . ' NULL DEFAULT NULL',
            'notice'        => Schema::TYPE_INTEGER . " DEFAULT '0'",
            'order'         => Schema::TYPE_INTEGER,
            'status'        => Schema::TYPE_BOOLEAN . " DEFAULT '0'"
        ], $tableOptions);

        // Indexes
        $this->createIndex('name', '{{%cubes}}', 'name', true);
        $this->createIndex('status', '{{%cubes}}', 'status', false);
        $this->createIndex('order', '{{%cubes}}', 'order', true);

    }

    public function safeDown()
    {
        $this->dropTable('{{%cubes}}');
    }

}
