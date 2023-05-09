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
            $this->addLogDownload($file);
        }
        
        $this->load->helper('download');

        return force_download('files/' . $file->fullpath, NULL);
    }

    public function delete($file) {

        $filepath = 'files/' . $file->folder .'/'. $file->name;

        if(file_exists($filepath)) {
            unlink($filepath);
        }

        $this->db->where('id', $file->id)->delete($this->table);
    }

    public function addLogDownload($file) {
        $this->db->insert('downloads', [
            'file_id' => $file->id,
            'filename' => $file->name
        ]);
    }

    public function list($idFolder=null) {
        return $this->query()->where('a.fk_folder', $idFolder)->get()->result();
    }

    private function query() {
        return $this->db
                ->select("a.id, a.name, a.created_at, a.fk_folder, a.size, count(c.file_id) as num_downloads, b.name as folder, b.id as folder_id, CONCAT(b.name, '/', a.name) as fullpath ")
                ->from($this->table . ' a')
                ->join('folders b', 'a.fk_folder = b.id', 'inner')
                ->join('downloads c', 'c.file_id = a.id', 'left')
                ->group_by('a.id', 'a.name', 'a.created_at', 'a.fk_folder', 'a.size', 'b.name', 'b.id', "CONCAT(b.name, '/', a.name)");
    }


}
