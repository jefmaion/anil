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
    }

    public function index()
    {
       
        return $this->load->view('auth/login');
    }

    public function auth()
    {
        $data = $this->input->post();

        if (!$user = $this->user->auth($data['email'], $data['password'])) {
            $this->session->set_flashdata('error', 'Usuário ou Senha Inválidos');
            return redirect('auth');
        }

        $this->session->set_userdata('user', $user);

        redirect('admin');
    }

    function logout()
    {
        $data = $this->session->all_userdata();
        foreach ($data as $row => $rows_value) {
            $this->session->unset_userdata($row);
        }
        redirect('auth');
    }
}
