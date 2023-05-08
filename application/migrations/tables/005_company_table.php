<?php


class Company_Table extends CI_Migration {

    protected $tableName = 'company';

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

            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => '1000',
                'null' => true
            ],

        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tableName);
    }

    public function down() {
        $this->dbforge->drop_table($this->tableName, true);
    }

}