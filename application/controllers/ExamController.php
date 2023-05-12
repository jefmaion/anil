<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Folder', 'folder');
        $this->load->model('Company', 'company');
        
    }

    public function index($folder) {

        if(!$folder = $this->folder->findByName($folder)) {
            
        }

        $company = $this->company->list();

        return $this->load->view('exams/auth', compact('folder', 'company'));
    }

    public function auth() {
        $data = $this->input->post();


        if(!$folder = $this->folder->auth($data['folder'], $data['password'])) {
            $this->session->set_flashdata('error','Pasta ou senha inválidos');
            return redirect('/exames/' . $data['folder'], 'refresh');
        }

        $this->session->set_userdata('user_folder', $folder);

        redirect('/exames/'.$data['folder'].'/show');
    }

	public function show($folder)
	{
        if(!$this->session->userdata('user_folder')) {
            return redirect('/exames/auth', 'refresh');
        }

        $company = $this->company->list();

        if(!$folder = $this->folder->findByName($folder)) {
            return responseRedirect('/exames/wrong', 'Pasta ou senha inválidos', 'error');
        }

        $files = $this->folder->files($folder->id);

        return $this->load->view('exams/index', compact('files', 'company'));
	}

    public function download($folder, $hash) {

        if(!$this->session->userdata('user_folder')) {
            return redirect('/exames/' . $folder, 'refresh');
        }

        if(!$file = $this->file->findByHash($hash)) {
            return responseRedirect('/exames/' . $folder . '/show', 'Arquivo não encontrado', 'error');
        }

        return $this->file->downloadFile($file);
    }

    public function view($folder, $hash) {


        if(!$this->session->userdata('user_folder')) {
            return redirect('/exames/' . $folder, 'refresh');
        }

        if(!$file = $this->file->findByHash($hash)) {
            return responseRedirect('/exames/' . $folder . '/show', 'Arquivo não encontrado', 'error');
        }

        return $this->file->showFile($file);
    }

   

}
