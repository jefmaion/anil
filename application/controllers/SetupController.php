<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SetupController extends CI_Controller
{

    protected $file = 'application/config/config.env';

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {

        return $this->load->view('admin/setup_auth');
    }

    public function show() {
        if(!$this->session->userdata('_setup')) {
            return redirect('setup/login');
        }

        return $this->load->view('admin/setup');
    }

    public function auth() {
        

        if(!password_verify($this->input->post('setup_pass'), $this->config->item('setup_pass'))) {
            $this->session->set_flashdata('error','Acesso Negado');
            return redirect('setup');
        }

        $this->session->set_userdata('_setup', 'ok');

        redirect('setup');
    }

    public function store() {
        $this->load->helper('file');


   
        $txt = '<?php '.PHP_EOL.PHP_EOL;

        foreach($this->input->post() as $key => $value) {
            $txt .= '$config["'.$key.'"] =  "'.$value.'"; '.PHP_EOL;
        }

        $txt .= PHP_EOL . '?>';
        write_file('application/config/environment.php', $txt);




        if($this->input->post('run_migration')) {
            $this->load->dbforge();
            $this->dbforge->drop_table('migrations', TRUE);
    
            $this->load->library('migration');
            
            if ($this->migration->current() === FALSE)
            {
                // echo $this->migration->error_string();
            }else{
                // echo "Table Migrated Successfully.";
            }
        }
        

        $this->session->set_flashdata('success','Configurações Salvas Com Sucesso!');
        return redirect('setup');

    }


    public function logout() {
        unset($_SESSION['_setup']);
        redirect('setup');
    }

}