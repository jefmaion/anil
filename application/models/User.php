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

        $user  = $this->db->select('name, email, is_admin, password')->where('email', $email)->get($this->table)->row();

        $this->session->set_flashdata('auth_email', $email);
        
        if(!$user) {
            return false;
        }

        if(!password_verify($pass, $user->password)) {
            return false;    
        }

        $this->session->set_userdata('user', $user);
        return true;

    }

    public function logout() {
        $data = $this->session->all_userdata();
        foreach ($data as $row => $rows_value) {
            $this->session->unset_userdata($row);
        }
    }

}