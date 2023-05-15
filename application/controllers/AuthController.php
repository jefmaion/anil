<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('id')) {
             redirect('admin');
        }

        $this->load->model('User', 'user');
        $this->load->library('encryption');

        $this->load->database();

        $this->migrate();
    }

    public function add() {
        $data = $this->input->post();

        if($this->user->store($data)) {
            return $this->auth();
        }
    }

    public function index()
    {

        if($this->db->table_exists('users') && $this->db->count_all_results('users') > 0) {
            return $this->load->view('auth/login');
        }

        return $this->load->view('auth/new');
        
    }

    public function auth()
    {

        

        $data = $this->input->post();

        if (!$this->user->auth($data['email'], $data['password'])) {
            return responseRedirect('auth', 'Usuário ou senha Inválidos', 'warning');
        }

        redirect('admin');
    }

    function logout()
    {
        $this->user->logout();
        redirect('auth');
    }


    private function migrate() {

        if($this->db->table_exists('folders')) {
            return;
        }

        $this->load->dbforge();
        $this->dbforge->drop_table('migrations', TRUE);

        $this->load->library('migration');
        
        if ($this->migration->current() === FALSE)
        {
            echo $this->migration->error_string();
        }else{
            return true;
        }
    }
}
