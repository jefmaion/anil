<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DownloadController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('File', 'file');
        
    }

    public function download($id) {
        $file = $this->file->find($id);
        $this->load->helper('download');
        return force_download('files/' . $file->fullpath, NULL);
    }

   

}
