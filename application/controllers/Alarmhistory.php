<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alarmhistory extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model(array('model_alarm', 'mcrud'));
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
        $this->template->display_table('alarmhistory',$d);
    }


	//=================
	function data_list(){
		$var_date_from	= date('Y-m-1');
		$var_date_thru	= date('Y-m-t');
		//$var_shownumber = 'ALL';
		$var_shownumber = 100;
		$var_active 	= 'ALL';
		
		//$list = $this->model_alarm->tampil($var_date_from, $var_date_thru, $var_shownumber, $var_active)->result();
		
		$data=$this->model_alarm->data_list($var_date_from, $var_date_thru, $var_shownumber, $var_active);
		echo json_encode($data);
	}

	public function ajax_list()
	{
		//$list = $this->person->get_datatables();
		
		$var_date_from	= date('Y-m-1');
		$var_date_thru	= date('Y-m-t');
		//$var_shownumber = 'ALL';
		$var_shownumber = 1000;
		//$var_active 	= 1; munculkan semua alrm active=0 history
		$var_active 	= 'ALL'; 
		$list = $this->model_alarm->tampil($var_date_from, $var_date_thru, $var_shownumber, $var_active)->result();
		$data = array();
		$no = 0;
		foreach ($list as $alarm) {
			$no++;
			$row = array();
			$row[] = $alarm->id_alarm;
			$row[] = $alarm->id_name;
			$row[] = $alarm->id_meter;
			$row[] = $alarm->date_time;
			$row[] = $alarm->alarmlog;
			$row[] = '';
			$row[] = '';
			

			//add html for action
			$row[] = '';
		
			$data[] = $row;
		}

		$output = array($data
				);
		//output to json format
		echo json_encode($data);
	}
	
	public function ajax_list_history()
	{
		//$list = $this->person->get_datatables();
		
		$var_date_from	= date('Y-m-1');
		$var_date_thru	= date('Y-m-t');
		//$var_shownumber = 'ALL';
		$var_shownumber = 100;
		$var_active 	= 'ALL';
		
		$list = $this->model_alarm->tampil($var_date_from, $var_date_thru, $var_shownumber, $var_active)->result();
		$data = array();
		$no = 0;
		foreach ($list as $alarm) {
			$no++;
			$row = array();
			$row[] = $alarm->id_alarm;
			$row[] = $alarm->id_name;
			$row[] = $alarm->id_meter;
			$row[] = $alarm->date_time;
			$row[] = $alarm->alarmlog;
			$row[] = '';
			$row[] = '';
			

			//add html for action
			$row[] = '';
		
			$data[] = $row;
		}

		$output = array($data
				);
		//output to json format
		echo json_encode($data);
	}	
	
	public function pushdataalarm()
	{

		$var_date_from	= date('Y-m-1');
		$var_date_thru	= date('Y-m-t');
		$var_shownumber = 50;
		$var_active 	= 1;
		
		$list = $this->model_alarm->tampil($var_date_from, $var_date_thru, $var_shownumber, $var_active)->result();
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
			$alarm_description .= '<br>';
		}
		
		if ($no > 0) {
			
			$alarm_link = "<a href='" . base_url() . "alarm'>Show All Alarm</a>";
		} else {
			$alarm_link = "";
			$alarm_description = 'No alarm.';
		}

		$data = array();
		$row = array();
		
		$row['alarm_description']  	= $alarm_description;
		$row['alarm_link']  		= $alarm_link;
		
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