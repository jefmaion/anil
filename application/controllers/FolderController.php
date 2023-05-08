<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Shuchkin\SimpleXLSXGen;

class FolderController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!auth()) {
            redirect('auth');
        }

        $this->load->model('Folder', 'folder');
        $this->load->model('File', 'file');
        $this->load->model('Company', 'company');
    }

	public function index()
	{

        if($this->input->is_ajax_request()) {
            echo $this->datatable();
            return;
        }

        $company = $this->company->list();

        $count = $this->folder->count();
        $files = $this->file->count();
        $downloads = $this->file->countDownloads();

        $size = $this->folder->totalSize();

		$this->load->view('admin/index', compact('count', 'files', 'downloads', 'size', 'company'));
	}

    public function export() {
        $folders = $this->folder->list();
        $data[] = ['Pasta', 'Senha', 'Caminho'];
        foreach($folders as $folder) {
            $data[] = [$folder->name, $folder->pass, base_url('exames/' . $folder->name)];
        }

        return SimpleXLSXGen::fromArray($data)->downloadAs('Diretorios_'.date('Y_m_d_H_i_s').'.xlsx');
    }

    
    public function show($id) {
        
        if(!$folder = $this->folder->find($id)) {
            $this->session->set_flashdata('error','Pasta não encontrada!');
            return redirect('/admin', 'refresh');
        }

        $files = $this->file->list($folder->id);
        return $this->load->view('admin/show', compact('folder', 'files'));
    }

    public function upload($id) {

        $folder = $this->folder->find($id);

        $data = [];
        $countfiles = count($_FILES['files']['name']);

        $this->load->library('upload'); 
   
        // Looping all files
        for($i=0;$i<$countfiles;$i++){
   
          if(!empty($_FILES['files']['name'][$i])){
   
            // Define new $_FILES array - $_FILES['file']
            $_FILES['_file']['name'] = $_FILES['files']['name'][$i];
            $_FILES['_file']['type'] = $_FILES['files']['type'][$i];
            $_FILES['_file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['_file']['error'] = $_FILES['files']['error'][$i];
            $_FILES['_file']['size'] = $_FILES['files']['size'][$i];
  
            // Set preference
            $config['upload_path']          = 'files/' . $folder->name . '/';
            $config['allowed_types']        = '*';
            $config['file_name'] = $_FILES['_file']['name'];
   
            $this->upload->initialize($config);
   
            // File upload
            if($this->upload->do_upload('_file')){
                
              // Get data about the file
              $file = $this->upload->data();

              $this->file->create([
                'fk_folder' => $folder->id,
                'name' => $file['file_name'],
                'size' => $file['file_size'],
                'extension' => $file['file_ext'],
                'filetype' => $file['file_type']
              ]);
  
              // Initialize array
              $data[] = $file;

              $config = [];
            }
          }
   
        }


        return redirect('/admin/folder/'.$folder->id.'/show', 'refresh');
    }

    public function create() {
        for($i=1;$i<=$this->input->post('num_folders');$i++) {

            $newFolder = $this->folder->generateDirName();

            if(!$this->folder->folderExists($newFolder)) {
                $this->folder->create([
                    'name' => $newFolder,
                    'active' => 1
                ]);
            }
        }

        $this->session->set_flashdata('success','Pastas geradas com sucesso!');

        return redirect('/admin', 'refresh');
    }

    public function delete($id) {
        
        if(!$folder = $this->folder->find($id)) {
            $this->session->set_flashdata('error','Pasta não encontrada');
            return redirect('/admin', 'refresh');
        }

        $this->folder->delete($folder);

        $this->session->set_flashdata('success','Pasta removida com sucesso!');
        return redirect('/admin', 'refresh');
    }

    public function reset() {
        $folders = $this->folder->list();

        foreach($folders as $folder) {
            $this->folder->delete($folder);
        }

        return redirect('/admin', 'refresh');
    }

    private function datatable() {

        $data = [];

        $folders = $this->folder->list();


        $button = '<a name="" id="" class="btn btn-%s btn-sm" href="%s" role="button">%s</a> ';

        foreach($folders as $folder) {

            $url = base_url('exames?usr=') . $folder->name;

            $data[] = [
                'folder' => '<b>' . $folder->name . '</b>',
                'pass' => $folder->password,
                'size' => formatBytes($folder->size),
                'files' => $folder->num_files,
                'url' => anchor($url, $url, ['target' => '_blank']),
                'action' => sprintf($button, 'primary', base_url('admin/folder/'.$folder->id.'/show'), '<i class="fa fa-file" aria-hidden="true"></i> Arquivos') 
                            . 
                            deleteButton($folder->id, base_url('admin/folder/'.$folder->id.'/delete'))
            ];
        }

        return json_encode(['data' => $data]);

    }

  
}
