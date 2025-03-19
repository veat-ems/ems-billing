<?php

ini_set('memory_limit', '-1');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kwhperjam extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model(array('model_trend', 'model_kwhperjam', 'mcrud'));
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}
	
    public function index() {
		$d['title'] = 'KWh per Jam';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';	

		$d['data_meter'] = $this->model_kwhperjam->getdata('data_meter', $this->session->userdata('username'))->result();
		
		
		// ============ init value =====================
		$checked 			= 0;
		$str_insert			= '';
		$str_ses_username	= $this->session->userdata('username');

		
		//============== post ===========================
		$id 			= $this->input->post('meterid');
		$mode 			= $this->input->post('mode');
		$dateselected	= $this->input->post('dateselected');
		$showpointvalue	= $this->input->post('showpointvalue');
		
		//--exception
		if ($id == '') {
			//$conditions_min['active'] = 1;
			$conditions_min = "(metergroupid in (select metergroupid from usermetergroups where username = '" . $this->session->userdata('username') . "' ))";
			$id = $this->model_trend->searchmin('data_meter', 'id', $conditions_min);
		}
		$id_name		= $this->mcrud->getvalue('data_meter', 'id_name', 'id', $id);
		
		if ($dateselected == '') {
			$dateselected = date('Y-m-d');
		}
		
		if ($mode == '') {
			$mode 			= 'Cummulative';
		}
		
		if ($showpointvalue == '') {
			$showpointvalue = 1;
		}
		
		
		//============= calculation =====================
		
		$hari   				= $dateselected;
		$val_kwh_last 			= 0;
		$val_kwh_diff_last 		= 0;
		$no 					= 0;
		$kwh_graph				= '';
		$jam_graph				= '';
		$satuan					= '';
		
    	while ($no<24) {
    	   $nj = $no;
    	   
		   $list = $this->model_kwhperjam->id_jam($id, $hari, $nj)->result();
		   
		   
		   if($list=='' or $list==null){
		   		
		   }
		   else{
			
				if ($mode == 'Difference') {
					$dt_now  = $this->model_kwhperjam->data_jam($id, $hari, $nj)->row();
					$kwh_now = $dt_now->kwh_exp;
					if ($kwh_now == '') $kwh_now = 0;
					
					if ($no == 0) {
						$hari_before 	= date('Y-m-d', strtotime($hari . " -1 days"));
						$nj_before 		= 23;
					} else {
						$hari_before 	= $hari;
						$nj_before 		= $no - 1;
					}
					
					$dt_before_list = $this->model_kwhperjam->id_jam($id, $hari_before, $nj_before)->result();
					
					if($dt_before_list=='' or $dt_before_list==null){
						$kwh_before = 0;
					} else {
						$dt_before  = $this->model_kwhperjam->data_jam($id, $hari_before, $nj_before)->row();
						$kwh_before = $dt_before->kwh_exp;
						if ($kwh_before == '') $kwh_before = 0;
					}
					
					
					if ($no == 0 and $kwh_before == 0) {
						$diff_kwh = 0;
					} else {
						$diff_kwh = $kwh_now - $kwh_before;
					}
					
					//--- untuk menjaga bila 0 akan mempertahankan nilai sebelumnya, tidak turun ke angka 0
					if ($diff_kwh > 0) {
						$val_kwh_diff_last = $diff_kwh;
					}
					if ($diff_kwh == 0) {
						$diff_kwh = $val_kwh_diff_last;
					}
					
					if ($diff_kwh > 99999999) {
						$satuan 			= 'MWh';
						$devided_diff_kwh	= $diff_kwh / 1000000;
					} else {
						$satuan 			= 'KWh';
						$devided_diff_kwh	= $diff_kwh / 1000;
					}
					
					$kwh_graph .= round($devided_diff_kwh, 2) . ",";
					$jam_graph .= "'" . $nj . "',";
					
				} else {
					
					$dt_now  = $this->model_kwhperjam->data_jam($id, $hari, $nj)->row();
					$kwh_now = $dt_now->kwh_exp;
					if ($kwh_now == '') $kwh_now = 0;
					
					if ($kwh_now > 0) {
						$val_kwh_last = $kwh_now;
					}
					
					if ($kwh_now == 0) {
						$kwh_now = $val_kwh_last;
					}
					
					if ($kwh_now > 99999999) {
						$satuan 		= 'MWh';
						$devided_kwh	= $kwh_now / 1000000;
					} else {
						$satuan 		= 'KWh';
						$devided_kwh	= $kwh_now / 1000;
					}
					
					$kwh_graph .=  round($devided_kwh, 2). ",";
					$jam_graph .= "'" . $nj . "',";
					
				}
				
		   		
		   }
		     
    	   $no++;
    	
    	}
		
		$d['id'] 				= $id;
		$d['id_name'] 			= $id_name;
		$d['mode'] 				= $mode;
		$d['showpointvalue'] 	= $showpointvalue;
		
		$d['kwh_graph'] 		= $kwh_graph;
		$d['jam_graph'] 		= $jam_graph;
		$d['satuan'] 			= $satuan;
		
		$d['dateselected'] 	= $dateselected;
		
        $this->template->display_trend('kwhperjam',$d);
    }
	
	
}