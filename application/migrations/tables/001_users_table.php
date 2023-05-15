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

    // public function seeder() {


    //     $usersAdmin = [

    //         [
    //             'name' => 'Jefferson',
    //             'email' => 'email@email.com',
    //             'password' => 'password'
    //         ],

    //         [
    //             'name' => 'Jefferson',
    //             'email' => 'email@email.com',
    //             'password' => 'password'
    //         ],

    //         // [
    //         //     'name' => 'Outro Usuário',
    //         //     'email' => 'email@email.com',
    //         //     'password' => 'password'
    //         // ],

    //     ];

    //     foreach($usersAdmin as $user) {
    //         $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
    //         $this->db->insert('users', $user);
    //     }
    // }

}