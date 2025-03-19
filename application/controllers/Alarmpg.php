<?php

use Aws\Result;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alarmpg extends CI_Controller {

	function __construct(){
		parent::__construct();		
		// $this->load->model(array('model_alarm', 'mcrud'));
		$this->load->model('model_alarm');
		$this->load->model('mcrud');
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
	}
	
    public function index() {
		$d['title'] = 'ALARM PG';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';		
		// $d['data_log'] = $this->model_alarm->getdata('tabel_log')->result();
		// $d['data_teg'] = $this->model_alarm->getdata('data_meter')->result();
		// var_dump($d);
		// 	die;
        $this->template->display_table('alarmpg',$d);
    }


	public function alarm_list_all(){

			$data=$this->model_alarm->getdata('pg_alarm')->result();
			// var_dump($data);
			// die;
			echo json_encode($data);
		}

	public function alarmhistory() {
		$d['title'] = 'ALARM HISTORY';
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
        $this->template->display_table('alarmhistory',$d);
    }

	//=================
	function data_list_alarmhistory(){
		$var_date_from	= date('Y-m-1');
		$var_date_thru	= date('Y-m-t');
		//$var_shownumber = 'ALL';
		$var_shownumber = 1000;
		//$var_active 	= 1; munculkan semua alrm active=0 history
		$var_active 	= 'ALL';
		
		//$list = $this->model_alarm->tampil($var_date_from, $var_date_thru, $var_shownumber, $var_active)->result();
		
		$data=$this->model_alarm->data_list($var_date_from, $var_date_thru, $var_shownumber, $var_active);
		echo json_encode($data);
	}
	
}