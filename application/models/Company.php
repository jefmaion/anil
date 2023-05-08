<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Model {

    private $table = 'company';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    public function find($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function list() {
        return $this->db->limit(1)->get($this->table)->row();
    }

    public function create($data) {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->set($data)->where('id', $id)->update($this->table);
    }
}