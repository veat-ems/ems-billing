<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_alarm extends CI_Model{
	
	function getdata($table){		
		return $this->db->get($table);
	}
	
}