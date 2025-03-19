<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alarm extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('model_alarm');
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
	}
	
    public function index() {
		$d['title'] = 'ALARM';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';		
		$d['data_log'] = $this->model_alarm->getdata('tabel_log')->result();		
		$d['data_teg'] = $this->model_alarm->getdata('data_meter')->result();
        $this->template->display('alarm',$d);
    }


}