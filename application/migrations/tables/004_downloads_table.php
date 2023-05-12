<?php


class Downloads_Table extends CI_Migration {

    protected $tableName = 'downloads';

    public function up() {

        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],

            'created_at DATETIME default NOW()',

            'filename' => [
                'type' => 'VARCHAR',
                'constraint' => '500'
            ],

            'file_id' => [
                'type' => 'INT',
                'null' => true,
            ],

            'action' => [
                'type' => 'VARCHAR',
                'constraint' => '1'
            ],
        ]);
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tableName);
    }

    public function down() {
        $this->dbforge->drop_table($this->tableName, true);
    }

}