<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Shuchkin\SimpleXLSXGen;

class FolderController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!auth()) {
            redirect('auth');
        }

        $this->load->model('Folder', 'folder');
        $this->load->model('File', 'file');
        $this->load->model('Company', 'company');
    }

    public function index()
    {

        if ($this->input->is_ajax_request()) {
            echo $this->datatable();
            return;
        }

        $company   = $this->company->list();
        $count     = $this->folder->count();
        $files     = $this->file->count();
        $downloads = $this->file->countDownloads();
        $size      = $this->folder->totalSize();

        $this->load->view('admin/index', compact('count', 'files', 'downloads', 'size', 'company'));
    }

    public function export()
    {
        $folders = $this->folder->list();
        $data[] = ['Pasta', 'Senha', 'Caminho'];
        foreach ($folders as $folder) {
            $data[] = [$folder->name, $folder->password, base_url('exames/' . $folder->name)];
        }

        return SimpleXLSXGen::fromArray($data)->downloadAs('Diretorios_' . date('Y_m_d_H_i_s') . '.xlsx');
    }


    public function show($id)
    {

        if (!$folder = $this->folder->find($id)) {
            return responseRedirect('/admin', 'Pasta não encontrada!', 'error');
        }

        $files = $this->file->list($folder->id);
        return $this->load->view('admin/show', compact('folder', 'files'));
    }



    public function create()
    {

        $folders = $this->input->post('num_folders');

        for ($i = 1; $i <= $folders; $i++) {

            $newFolder = $this->folder->generateDirName();

            $this->folder->create([
                'name'   => $newFolder,
                'active' => 1
            ]);
        }

        return responseRedirect('/admin', $folders .  ' pasta(s) criada(s) com sucesso!');
    }

    public function delete($id)
    {

        if (!$folder = $this->folder->find($id)) {
            return responseRedirect('/admin', 'Pasta não encontrada!', 'error');
        }

        $this->folder->delete($folder);

        return responseRedirect('/admin', 'Pasta removida com sucesso!');

    }

    public function reset()
    {
        $folders = $this->folder->list();

        foreach ($folders as $folder) {
            $this->folder->delete($folder);
        }

        return responseRedirect('/admin', 'Redefinição realizada!');
    }

    public function upload($id)
    {

        $folder = $this->folder->find($id);

        $data = [];
        $countfiles = count($_FILES['files']['name']);

        $this->load->library('upload');

        // Looping all files
        for ($i = 0; $i < $countfiles; $i++) {

            if (!empty($_FILES['files']['name'][$i])) {

                // Define new $_FILES array - $_FILES['file']
                $_FILES['_file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['_file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['_file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['_file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['_file']['size']     = $_FILES['files']['size'][$i];

                // Set preference
                $config['allowed_types'] = '*';
                $config['upload_path']   = 'files/' . $folder->name . '/';
                $config['file_name']     = $_FILES['_file']['name'];

                $this->upload->initialize($config);

                if ($this->upload->do_upload('_file')) {

                    $file = $this->upload->data();

                    $this->file->create([
                        'fk_folder' => $folder->id,
                        'name'      => $file['file_name'],
                        'size'      => $file['file_size'],
                        'extension' => $file['file_ext'],
                        'filetype'  => $file['file_type']
                    ]);

                    $data[] = $file;

                    $config = [];
                }
            }
        }

        return responseRedirect('/admin/folder/' . $folder->id . '/show', 'Upload realizado com sucesso!');
    }

    private function datatable()
    {

        $data = [];

        $folders = $this->folder->list();

        $button = '<a name="" id="" class="btn btn-%s btn-sm" href="%s" role="button">%s</a> ';

        foreach ($folders as $folder) {

            $url = base_url('exames/') . $folder->name;

            $data[] = [
                'folder' => '<b>' . $folder->name . '</b>',
                'pass'   => $folder->password,
                'size'   => formatBytes($folder->size),
                'files'  => $folder->num_files,
                'url'    => anchor($url, $url, ['target' => '_blank']),
                'action' => 
                    sprintf($button, 'primary', base_url('admin/folder/' . $folder->id . '/show'), '<i class="fa fa-file" aria-hidden="true"></i> Arquivos') .
                    deleteButton($folder->id, base_url('admin/folder/' . $folder->id . '/delete'))
            ];
        }

        return json_encode(['data' => $data]);
    }
}
