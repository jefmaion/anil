<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('id')) {
             redirect('admin');
        }

        $this->load->model('User', 'user');

    }

    public function index() {
        $users = $this->user->list();
        return $this->load->view('users/index', compact('users'));
    }

    public function store() {
        $data = $this->input->post();

        if($this->user->findByEmail($data['email']) > 0) {
            return responseRedirect('/admin/users', 'Email já cadastrado', 'error');
        }

        if($this->user->store($data)) {
            return responseRedirect('/admin/users',  'Usuário criado com sucesso');
        }

        return responseRedirect('/admin/users', 'Não foi possível criar o usuário', 'error');
    }

    public function delete($id) {

        if($this->user->delete($id)) {
            return responseRedirect('/admin/users',  'Usuário removido com sucesso');
        }

        return responseRedirect('/admin/users', 'Não foi possível remover o usuário', 'error');
    }

}