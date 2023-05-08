<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!auth()) {
            redirect('auth');
        }
        $this->load->model('File', 'file');
        
    }

	public function index()
	{
      
	}

    public function download($id) {
        $file = $this->file->find($id);
        $this->load->helper('download');
        return force_download('files/' . $file->fullpath, NULL);
    }

    public function delete($id) {

        $file = $this->file->find($id);

        $this->file->delete($file);

        return redirect('/admin/folder/'.$file->folder_id.'/show', 'refresh');
    }

}
