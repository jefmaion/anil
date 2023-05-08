<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Folder extends CI_Model {

    private $table = 'folders';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->load->helper('string');

        $this->load->model('File', 'file');
    }

    public function generateDirName() {
        return strtoupper(random_string('alnum', 8));
    }

    public function find($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function findByName($name) {
        return $this->db->where('name', $name)->get($this->table)->row();
    }

    public function count() {
        return $this->db->from($this->table)->count_all_results();
    }

    public function totalSize() {
        $this->db->select_sum('size');
        return $this->db->get('files')->row()->size; // Produces: SELECT SUM(age) as age FROM members
    }

    public function create($data) {
        if(!mkdir('files/' . $data['name'] , 0777)) {
            return false;
        }

        $folderPass = $this->generateDirName();
        $hash       = password_hash($folderPass, PASSWORD_DEFAULT);

        $data['hash'] = $hash;
        $data['password'] = $folderPass;

        $this->db->insert($this->table, $data);
    }

    public function files($idFolder) {
        return $this->file->list($idFolder);
    }

    public function auth($folder, $pass) {
        return $this->db->where('name', $folder)->where('password', $pass)->get($this->table)->row();
    }

    public function delete($folder) {
        
    
        if($files = $this->files($folder->id)) {
            foreach($files as $file) {
                $this->file->delete($file);
            }
        }

        $this->db->where('name', $folder->name)->delete($this->table);

        rmdir('files/' . $folder->name);
    }

    public function list() {

        return $this->query()->get()->result();

        
    }

    private function query() {
        return $this->db
                ->select('
                    a.id, 
                    a.name, 
                    a.created_at,
                    a.password,
                    a.active, 
                    count(b.id) as num_files,
                    sum(b.size) as size
                ')
                ->from($this->table . ' a')
                ->join('files b', 'a.id = b.fk_folder', 'left')
                ->group_by('a.id, a.name, a.active, a.created_at, a.password');
    }

    public function folderExists($dirname) {
        return is_dir('files/' . $dirname);
    }


}
