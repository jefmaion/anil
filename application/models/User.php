<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    private $table = 'users';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('encryption');

    }

    public function auth($email, $pass) {

        // $pass = $this->encryption->encrypt($pass);

        $user  = $this->db->select('name, email, is_admin, pass')->where('email', $email)->get($this->table)->row();
        

        if(!$user) {
            return false;
        }


        if(password_verify($pass, $user->pass)) {
            return $user;
        }

        

        return false;

    }

}