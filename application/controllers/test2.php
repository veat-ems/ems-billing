<?php

class test2 extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('model_meterdata');
	}
	
    public function index() {
		$data = $this->model_meterdata->getdata('metergroups')->result();
		echo 'A';
    }
	
}