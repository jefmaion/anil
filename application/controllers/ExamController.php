<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Folder', 'folder');
        
    }

    public function index($folder) {

        if(!$folder = $this->folder->findByName($folder)) {
            
        }

        return $this->load->view('exams/auth', compact('folder'));
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
            return redirect('/exames/' . $folder, 'refresh');
        }


        $barTitle = 'Exames';
        $files = [];

        if(!$folder = $this->folder->findByName($folder)) {
            return $this->load->view('exams/index', compact('files', 'barTitle'));
        }

        
        $files    =  $this->folder->files($folder->id);

        return $this->load->view('exams/index', compact('files', 'barTitle'));



	}

    public function download($id) {
        $file = $this->file->find($id);

        $this->file->addLogDownload($file);

        $this->load->helper('download');
        return force_download('files/' . $file->fullpath, NULL);
    }

   

}
