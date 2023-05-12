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
                'name'     => env('ADM_NAME')    ?: 'Admin',
                'email'    => env('ADM_EMAIL')   ?: 'admin@admin.com',
                'password' => (env('ADM_PASS'))  ? password_hash(env('ADM_PASS'), PASSWORD_DEFAULT) : password_hash('3edc4rfv', PASSWORD_DEFAULT)
            ]
        ]);
    }

}