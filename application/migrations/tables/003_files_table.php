<?php


class Files_Table extends CI_Migration {

    protected $tableName = 'files';

    public function up() {

        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],

            'created_at DATETIME default NOW()',

            'fk_folder' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => true
            ],

            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '500'
            ],

            'size' => [
                'type' => 'FLOAT',
                'constraint' => '2',
                'null' => true
            ],

            'filetype' => [
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => true,
            ],


            'extension' => [
                'type' => 'VARCHAR',
                'null' => true,
                'constraint' => '500'
            ],

            'active' => [
                'type' => 'INT',
                'null' => true,
                'default' => 1
            ],
        ]);
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tableName);
    }

    public function down() {
        $this->dbforge->drop_table($this->tableName, true);
    }

}