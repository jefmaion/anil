<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Model {

    private $table = 'files';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    public function find($id) {
        return $this->query()->where('a.id', $id)->get()->row();
    }

    public function findByHash($hash) {
        return $this->query()->where('a.file_hash', $hash)->get()->row();
    }

    public function count() {
        return $this->db->from($this->table)->count_all_results();
    }

    public function countDownloads() {
        return $this->db->from('downloads a')->join($this->table . ' b', 'b.id = a.file_id', 'inner')->count_all_results();
    }

    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function downloadFile($file, $addLog=true) {
      
        if($addLog) {
            $this->addLogDownload($file, 'D');
        }
        
        $this->load->helper('download');

        return force_download('files/' . $file->fullpath, NULL);
    }

    public function showFile($file, $addLog=true) {
        if($addLog) {
            $this->addLogDownload($file, 'V');
        }

        $this->output
           ->set_content_type($file->filetype)
           ->set_output(file_get_contents('files/' . $file->fullpath));
        
    }

    public function delete($file) {

        $filepath = 'files/' . $file->folder .'/'. $file->name;

        if(file_exists($filepath)) {
            unlink($filepath);
        }

        $this->db->where('id', $file->id)->delete($this->table);
    }

    public function addLogDownload($file, $action='D') {
        $this->db->insert('downloads', [
            'file_id' => $file->id,
            'filename' => $file->name,
            'action' => $action
        ]);
    }

    public function list($idFolder=null) {
        return $this->query()->where('a.fk_folder', $idFolder)->get()->result();
    }

    private function query() {
        return $this->db
                ->select("a.id, a.name, a.created_at, a.fk_folder, a.size, count(c.file_id) as num_downloads, b.name as folder, a.filetype, a.file_hash, b.id as folder_id, CONCAT(b.name, '/', a.name) as fullpath ")
                ->from($this->table . ' a')
                ->join('folders b', 'a.fk_folder = b.id', 'inner')
                ->join('downloads c', 'c.file_id = a.id', 'left')
                ->group_by('a.id', 'a.name', 'a.created_at', 'a.fk_folder', 'a.size', 'b.name', 'b.id', 'a.filetype','a.file_hash', "CONCAT(b.name, '/', a.name)");
    }


}
