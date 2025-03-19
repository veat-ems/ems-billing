<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Model_log extends CI_Model {
 
    public function save_log($data)
    {
        $this->db->insert('tabel_log',$data);
    }
}