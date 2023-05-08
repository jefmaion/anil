<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!auth()) {
            redirect('auth');
        }

        $this->load->model('Company', 'company');
        
    }

    public function create() {

        $data = $this->input->post();

        $this->company->create($data);

        return redirect('admin');


    }

	public function update($id) {
        $data = $this->input->post();

        $company = $this->company->find($id);

        if(isset($_FILES['photo'])) {

            $photo = 'public/img/' . $company->photo;

            if(file_exists($photo)) {
                unlink($photo);
            }

            

            $config['upload_path']          = 'public/img/';
            $config['allowed_types']        = 'gif|jpg|png';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('photo'))
            {
                $file = $this->upload->data();
                $data['photo'] = $file['file_name'];
            }
        }
        
        $this->company->update($id, $data);
        return redirect('admin');
    }

    
}
