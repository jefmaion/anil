<?php


class Folders_Table extends CI_Migration {


    public function up() {

        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],

            'created_at DATETIME default NOW()',

            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '500'
            ],

            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '1000',
                'null' => true
            ],

            'hash' => [
                'type' => 'VARCHAR',
                'constraint' => '1000',
                'null' => true
            ],

            'hash' => [
                'type' => 'VARCHAR',
                'constraint' => '1000',
                'null' => true
            ],

            'active' => [
                'type' => 'INT',
                'null' => true,
                'default' => 0
            ],
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('folders');
    }

    public function down() {
        $this->dbforge->drop_table('folders', true);
    }

}