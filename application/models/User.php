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

    public function list() {
        return $this->db->where('is_admin', 0)->get($this->table)->result();
    }

    public function findByEmail($email) {
        return $this->db->where('email', $email)->count_all_results($this->table);
    }

    public function store($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return $this->db->insert($this->table, $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
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