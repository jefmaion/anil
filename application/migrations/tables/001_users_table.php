<?php


class Users_Table extends CI_Migration {


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

            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],

            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '1000',
                'null' => true
            ],

            'is_admin' => [
                'type' => 'INT',
                'null' => true,
                'default' => 0
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down() {
        $this->dbforge->drop_table('users', true);
    }

    public function seeder() {
        return $this->db->insert_batch('users', [
            [
                'name' => 'Jefferson Maion',
                'email' => 'jefmaion@hotmail.com',
                'password' => password_hash('123123123', PASSWORD_DEFAULT)
            ],
            [
                'name' => 'Jefferson Maglio',
                'email' => 'jefferson@maglio.com.br',
                'password' => password_hash('646369051Brasil', PASSWORD_DEFAULT)
            ]
        ]);
    }

}