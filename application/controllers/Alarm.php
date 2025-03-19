<?php

use Aws\Result;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alarm extends CI_Controller {

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
		$d['title'] = 'ALARM TODAY';
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
        $this->template->display_table('alarm',$d);
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
		// $d['data_log'] = $this->model_alarm->getdata('tabel_log')->result();
		// $d['data_teg'] = $this->model_alarm->getdata('data_meter')->result();
		// var_dump($d);
		// 	die;
        $this->template->display_table('alarmhistory',$d);
	}


	public function alarm_list_today(){ //index today

		$data=$this->model_alarm->get_today('pg_alarm')->result();
		// var_dump($data);
		// die; 
		echo json_encode($data);
	}

	public function alarm_list_all(){ // alarmhistory 10000

			$data=$this->model_alarm->get_all('pg_alarm')->result();
			// var_dump($data);
			// die; 
			echo json_encode($data);
		}	

	






	public function alarmhistory_ori() {
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
	function data_list_alarmhistory_ori(){
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
	

	
	public function pushdataalarm()
	{

		$var_date_from	= date('Y-m-1');
		$var_date_thru	= date('Y-m-t');
		$var_shownumber = 10;
		$var_active 	= 1;
		
		$list = $this->model_alarm->tampil($var_date_from, $var_date_thru, $var_shownumber, $var_active, $this->session->userdata('username'))->result();
		$data = array();
		
		$no 				= 0;
		$alarm_description 	= '';
		
		foreach ($list as $alarm) {
			$no++;

			/*
			$alarm_description .= '<form name="formalarmtoggleitem" id="formalarmtoggleitem" method="post" action="alarm/toggleitemsave">';
			$alarm_description .= '<div class="row" id="alarm_' . $alarm->id_alarm . '">';
			$alarm_description .= '<div class="col-md-12"><b>' . $alarm->id_name . '</b></div>';
			$alarm_description .= '<div class="col-md-12"><b>' . $alarm->date_time . '</b></div>';
			$alarm_description .= '<div class="col-md-12">' . $alarm->alarmlog . '</div>';
			$alarm_description .= '<div class="col-md-12" style="text-align:right;"><button type="submit" class="btn btn-xs btn-warning" onClick="javascript:alert(""test"");">Close X</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
			$alarm_description .= '</div>';
			$alarm_description .= '</form>';
			*/
			
			//$alarm_description .= '<form method="post" >';
			$alarm_description .= '<div class="row" id="alarm_' . $alarm->id_alarm . '" style="border-top:solid 1px #CECECE;">';
			$alarm_description .= '<div class="col-md-12"><b>' . $alarm->id_name . '</b></div>';
			$alarm_description .= '<div class="col-md-12"><b>' . $alarm->date_time . '</b></div>';
			$alarm_description .= '<div class="col-md-12">' . $alarm->alarmlog . '</div>';
			//$alarm_description .= '<div class="col-md-12" style="text-align:right;"><input type="checkbox" value="' . $alarm->id_alarm . '" name="toggleitemalarm" class="toggleitemalarm" id="toggleitemalarm" data-toggle="toggle" data-on="Show" data-off="Close" data-size="mini" data-style="ios" data-onstyle="info" data-offstyle="danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="xyz">xyz</button><button type="button" id="btnalarm" class="btnalarm">alarm</button></div>';
			$alarm_description .= '</div>';
			//$alarm_description .= '</form>';
			//$alarm_description .= '<br>';
		}
		
		if ($no > 0) {
			
			$alarm_link = "<a href='" . base_url() . "alarm'>Show All Alarm</a>";
			
		} else {
			$alarm_link = "";
			$alarm_description = 'No alarm.';
		}

		$data = array();
		$row = array();
		$alarm_notif = $no;
		
		$row['alarm_description']  	= $alarm_description;
		$row['alarm_link']  		= $alarm_link;
		$row['alarm_notif']  		= $alarm_notif;
		
		$data[] = $row;
		
		$output = array($data
				);
		//output to json format
		echo json_encode($data);
	}

	public function togglesave() {
		$username	= $this->session->userdata('username');
		$alarmonoff = $this->input->post('alarmonoff');
		
		$condition_delete['settingid'] 	= 'ALARM_ONOFF';
		$condition_delete['username'] 	= $username;
		$this->mcrud->delete($condition_delete, 'settings');
		
		$val_alarmonoff['settingid'] 	= 'ALARM_ONOFF';
		$val_alarmonoff['username'] 	= $username;
		$val_alarmonoff['value_num'] 	= $alarmonoff;
		$this->mcrud->insert($val_alarmonoff, 'settings');
		
	}
	
	public function toggleitemsave() {
		$username	= $this->session->userdata('username');
		$id_alarm 	= $this->input->post('id_alarm');
		
		$val_alarmonoff['id_alarm'] 	= $id_alarm;
		$val_alarmonoff['username'] 	= $username;
		$val_alarmonoff['onoff'] 		= 0;
		$this->mcrud->insert($val_alarmonoff, 'alarmsettings');
		
	}
}