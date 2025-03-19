<?php

ini_set('memory_limit', '-1');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trenddetailmultiple extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model(array('model_trend', 'mcrud'));
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}
	
    public function index() {
		$d['title'] = 'TREND';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';	
		$d['data_meter'] = $this->model_trend->getdata('data_meter')->result();
		$d['parameter'] = $this->model_trend->getdata('parameter')->result();
		
		// ============ init value =====================
		$checked 			= 0;
		$str_insert			= '';
		$str_ses_username	= $this->session->userdata('username');
		$str_categories		= '';
		
		$param_watt1		= '';
		$param_watt2		= '';
		$param_watt3		= '';
		$param_watt			= '';

		$param_kwh_exp		= '';
		$param_kwh_imp		= '';

		$param_kvarh_exp	= '';
		$param_kvarh_imp	= '';

		$param_kvah			= '';

		$param_thd_v1		= '';
		$param_thd_v2		= '';
		$param_thd_v3		= '';

		$param_thd_i1		= '';
		$param_thd_i2		= '';
		$param_thd_i3		= '';

		$param_kwh1			= '';
		$param_kwh2			= '';
		$param_kwh			= '';

		$param_freq 		= '';

		$param_v1 			= '';
		$param_v2 			= '';
		$param_v3 			= '';

		$param_v12 			= '';
		$param_v23 			= '';
		$param_v31 			= '';

		$param_i1 			= '';
		$param_i2 			= '';
		$param_i3 			= '';
		$param_inet 		= '';

		$param_va1 			= '';
		$param_va2 			= '';
		$param_va3 			= '';
		$param_va 			= '';

		$param_pf1 			= '';
		$param_pf2 			= '';
		$param_pf3 			= '';
		
		//============== post ===========================
		//$datasource 	= $this->input->post('datasource');
		$datasource 	= 'Detail';
		$id 			= $this->input->post('id');
		$tempo 			= $this->input->post('tempo');
		$dari 			= $this->input->post('dari');
		$dari_time 		= $this->input->post('dari_time');
		$sampai 		= $this->input->post('sampai');
		$sampai_time 	= $this->input->post('sampai_time');
		
		//--exception
		if ($id == '') {
			//$conditions_min['active'] = 1;
			$conditions_min = '';
			$id = $this->model_trend->searchmin('data_meter', 'id', $conditions_min);
		}
		
		$id_name		= $this->mcrud->getvalue('data_meter', 'id_name', 'id', $id);
		
		if ($tempo == '') {
			$tempo = 'Monthly';
		}
		
		if ($datasource == '') {
			$datasource = 'Hourly';
		}
		
		if ($dari == '') {
			$dari = date('Y-m-d');
		}
		
		if ($sampai == '') {
			$sampai = date('Y-m-d');
		}
		
		if ($tempo == 'Monthly') {
			$dari 	= date('Y-m-01', strtotime($dari));
			$sampai = date('Y-m-t', strtotime($dari));
		} else if ($tempo == 'Daily') {
			$dari 	= date('Y-m-d', strtotime($dari));
			$sampai = date('Y-m-d', strtotime($dari));
		}
		
		if ($dari_time == '') {
			$dari_time = '00:00:00';
		}
		
		if ($sampai_time == '') {
			$sampai_time = '23:59:59';
		}
		
		
		//-- graph title
		
		if ($datasource == 'Hourly') {
			$datasource_title = 'Hourly Data ';
		} else if ($datasource == 'Detail') {
			$datasource_title = 'Detail Data ';
		}
		
		if ($tempo == 'Monthly') {
			$graph_title 	= $id_name . ' ' . $datasource_title . 'Monthly Graph' . ' for period ' . date('F Y', strtotime($dari));
			//$graph_subtitle = $id_name . ' for period ' . date('F Y', strtotime($dari));
			$graph_subtitle = '';
		} else if ($tempo == 'Daily') {
			$graph_title 	= $id_name . ' ' . $datasource_title . 'Daily Graph'. ' for period ' . date('d F Y', strtotime($dari));
			//$graph_subtitle = $id_name . ' for period ' . date('d F Y', strtotime($dari));
			$graph_subtitle = '';
		} else {
			$graph_title 	= $id_name . ' ' . $datasource_title . 'Date Range Graph'. ' for period ' . date('d F Y', strtotime($dari)) . ' - ' . date('d F Y', strtotime($sampai));
			//$graph_subtitle = $id_name . ' for period ' . date('d F Y', strtotime($dari)) . ' - ' . date('d F Y', strtotime($sampai));
			$graph_subtitle = '';
		}
		
		
		//-- setting value
		$chk_showpointvalue = $this->input->post('chk_showpointvalue');
		
		//-- param value
		$chk_watt1		= $this->input->post('chk_watt1');
		$chk_watt2		= $this->input->post('chk_watt2');
		$chk_watt3		= $this->input->post('chk_watt3');
		$chk_watt		= $this->input->post('chk_watt');
		
		$chk_kwh_exp	= $this->input->post('chk_kwh_exp');
		$chk_kwh_imp	= $this->input->post('chk_kwh_imp');
		
		$chk_kvarh_exp	= $this->input->post('chk_kvarh_exp');
		$chk_kvarh_imp	= $this->input->post('chk_kvarh_imp');
		
		//$chk_kvah		= $this->input->post('chk_kvah');
		$chk_kvah		= 0;
		
		$chk_thd_v1		= $this->input->post('chk_thd_v1');
		$chk_thd_v2		= $this->input->post('chk_thd_v2');
		$chk_thd_v3		= $this->input->post('chk_thd_v3');
		
		$chk_thd_i1		= $this->input->post('chk_thd_i1');
		$chk_thd_i2		= $this->input->post('chk_thd_i2');
		$chk_thd_i3		= $this->input->post('chk_thd_i3');
		
		/*
		$chk_kwh1		= $this->input->post('chk_kwh1');
		$chk_kwh2		= $this->input->post('chk_kwh2');
		$chk_kwh		= $this->input->post('chk_kwh');
		*/
		
		$chk_kwh1		= 0;
		$chk_kwh2		= 0;
		$chk_kwh		= 0;
		
		$chk_freq 		= $this->input->post('chk_freq');
		
		$chk_v1 		= $this->input->post('chk_v1');
		$chk_v2 		= $this->input->post('chk_v2');
		$chk_v3 		= $this->input->post('chk_v3');
		
		$chk_v12 		= $this->input->post('chk_v12');
		$chk_v23 		= $this->input->post('chk_v23');
		$chk_v31 		= $this->input->post('chk_v31');
		
		$chk_i1 		= $this->input->post('chk_i1');
		$chk_i2 		= $this->input->post('chk_i2');
		$chk_i3 		= $this->input->post('chk_i3');
		$chk_inet 		= $this->input->post('chk_inet');
		
		$chk_va1 		= $this->input->post('chk_va1');
		$chk_va2 		= $this->input->post('chk_va2');
		$chk_va3 		= $this->input->post('chk_va3');
		$chk_va 		= $this->input->post('chk_va');
		
		$chk_pf1 		= $this->input->post('chk_pf1');
		$chk_pf2 		= $this->input->post('chk_pf2');
		$chk_pf3 		= $this->input->post('chk_pf3');
		//============== end post ===========================


		
		
		//============== selection chk =======================
		
		if ($chk_watt1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'watt1', 1), ";
		}
		
		if ($chk_watt2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'watt2', 1), ";
		}
		
		if ($chk_watt3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'watt3', 1), ";
		}
		
		if ($chk_watt == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'watt', 1), ";
		}
		
		if ($chk_kwh_exp == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kwh_exp', 1), ";
		}
		
		if ($chk_kwh_imp == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kwh_imp', 1), ";
		}
		
		if ($chk_kvarh_exp == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kvarh_exp', 1), ";
		}
		
		if ($chk_kvarh_imp == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kvarh_imp', 1), ";
		}
		
		if ($chk_kvah == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kvah', 1), ";
		}
		
		if ($chk_thd_v1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'thd_v1', 1), ";
		}
		
		if ($chk_thd_v2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'thd_v2', 1), ";
		}
		
		if ($chk_thd_v3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'thd_v3', 1), ";
		}
		
		if ($chk_thd_i1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'thd_i1', 1), ";
		}
		
		if ($chk_thd_i2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'thd_i2', 1), ";
		}
		
		if ($chk_thd_i3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'thd_i3', 1), ";
		}
		
		if ($chk_kwh1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kwh1', 1), ";
		}
		
		if ($chk_kwh2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kwh2', 1), ";
		}
		
		if ($chk_kwh == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kwh', 1), ";
		}
		
		if ($chk_freq == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'freq', 1), ";
		}
		
		if ($chk_v1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'v1', 1), ";
		}
		
		if ($chk_v2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'v2', 1), ";
		}
		
		if ($chk_v3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'v3', 1), ";
		}
		
		if ($chk_v12 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'v12', 1), ";
		}
		
		if ($chk_v23 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'v23', 1), ";
		}
		
		if ($chk_v31 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'v31', 1), ";
		}
		
		if ($chk_i1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'i1', 1), ";
		}
		
		if ($chk_i2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'i2', 1), ";
		}
		
		if ($chk_i3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'i3', 1), ";
		}
		
		if ($chk_inet == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'inet', 1), ";
		}
		
		if ($chk_va1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'va1', 1), ";
		}
		
		if ($chk_va2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'va2', 1), ";
		}
		
		if ($chk_va3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'va3', 1), ";
		}
		
		if ($chk_va == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'va', 1), ";
		}
	
		if ($chk_pf1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'pf1', 1), ";
		}
		
		if ($chk_pf2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'pf2', 1), ";
		}
		
		if ($chk_pf3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'pf3', 1), ";
		}
		
		//============== end selection chk ===================
		
		//============== action ==============================
		
		// -- update stored param
		if ($checked == 1) {
			$str_insert = substr(trim($str_insert), 0, -1);
			$this->model_trend->update_parameter($str_ses_username, 'trend', $str_insert);
			
		}
		
		
		// -- read value
		if ($datasource == 'Hourly' or $datasource == '') {
			$tablename = 'counter_jam';
			
			if ($tempo == 'Monthly') {
				$trends = $this->model_trend->get_trend_monthly($tablename, $id, $dari, $sampai);
			} else if ($tempo == 'Daily') {
				$trends = $this->model_trend->get_trend_daily($tablename, $id, $dari, $sampai);
			} else {
				$condition_trend['id'] 				= $id;
				$condition_trend['date_time >= '] 	= $dari . ' ' . $dari_time;
				$condition_trend['date_time <= '] 	= $sampai . ' ' . $sampai_time;
				$trends = $this->mcrud->searchall($condition_trend, $tablename, 'date_time', 'asc');
			}
			
		} else {
			$tablename = 'counter_transit';
			
			if ($tempo == 'Monthly') {
				$condition_trend['id'] 				= $id;
				$condition_trend['date_time >= '] 	= $dari . ' ' . $dari_time;
				$condition_trend['date_time <= '] 	= $sampai . ' ' . $sampai_time;
				$trends = $this->mcrud->searchall($condition_trend, $tablename, 'date_time', 'asc');
				
			} else if ($tempo == 'Daily') {
				$condition_trend['id'] 				= $id;
				$condition_trend['date_time >= '] 	= $dari . ' ' . $dari_time;
				$condition_trend['date_time <= '] 	= $sampai . ' ' . $sampai_time;
				$trends = $this->mcrud->searchall($condition_trend, $tablename, 'date_time', 'asc');
				
			} else {
				$condition_trend['id'] 				= $id;
				$condition_trend['date_time >= '] 	= $dari . ' ' . $dari_time;
				$condition_trend['date_time <= '] 	= $sampai . ' ' . $sampai_time;
				$trends = $this->mcrud->searchall($condition_trend, $tablename, 'date_time', 'asc');
			}
		}
		
		
		
		
		
		
		$loop_trend = 0;
		foreach($trends as $trend){
			$loop_trend += 1;
			
			// set categories (Xaxis text)
			if ($datasource == 'Hourly' or $datasource == '') {
				if ($tempo == 'Monthly') {
					$str_categories .= "'" . date('Y-m-d H:i:s', strtotime($trend->date_time)) . "',";
				} else if ($tempo == 'Daily') {
					$str_categories .= "'" . date('Y-m-d H:i:s', strtotime($trend->date_time)) . "',";
				} else {
					$str_categories .= "'" . date('Y-m-d H:i:s', strtotime($trend->date_time)) . "',";
				}
			} else {
				if ($tempo == 'Monthly') {
					$str_categories .= "'" . date('Y-m-d H:i:s', strtotime($trend->date_time)) . "',";
				} else if ($tempo == 'Daily') {
					$str_categories .= "'" . date('Y-m-d H:i:s', strtotime($trend->date_time)) . "',";
				} else {
					$str_categories .= "'" . date('Y-m-d H:i:s', strtotime($trend->date_time)) . "',";
				}
			}
			
			$param_watt1		.= round($trend->watt1, 2) .',';
			$param_watt2		.= round($trend->watt2, 2) .',';
			$param_watt3		.= round($trend->watt3, 2) .',';
			$param_watt			.= round($trend->watt, 2) .',';

			$param_kwh_exp		.= round(($trend->kwh_exp / 1000), 2) .',';
			$param_kwh_imp		.= round(($trend->kwh_imp / 1000), 2) .',';

			$param_kvarh_exp	.= round(($trend->kvarh_exp / 1000), 2) .',';
			$param_kvarh_imp	.= round(($trend->kvarh_imp / 1000), 2) .',';

			$param_kvah			.= round(($trend->kvah / 1000), 2) .',';

			$param_thd_v1		.= round($trend->thd_v1, 2) .',';
			$param_thd_v2		.= round($trend->thd_v2, 2) .',';
			$param_thd_v3		.= round($trend->thd_v3, 2) .',';

			$param_thd_i1		.= round($trend->thd_i1, 2) .',';
			$param_thd_i2		.= round($trend->thd_i2, 2) .',';
			$param_thd_i3		.= round($trend->thd_i3, 2) .',';

			$param_kwh1			.= round(($trend->kwh1 / 1000), 2) .',';
			$param_kwh2			.= round(($trend->kwh2 / 1000), 2) .',';
			$param_kwh			.= round(($trend->kwh / 1000), 2) .',';

			$param_freq 		.= round($trend->freq, 2) .',';

			$param_v1 			.= round($trend->v1, 2) .',';
			$param_v2 			.= round($trend->v2, 2) .',';
			$param_v3 			.= round($trend->v3, 2) .',';

			$param_v12 			.= round($trend->v12, 2) .',';
			$param_v23 			.= round($trend->v23, 2) .',';
			$param_v31 			.= round($trend->v31, 2) .',';

			$param_i1 			.= round($trend->i1, 2) .',';
			$param_i2 			.= round($trend->i2, 2) .',';
			$param_i3 			.= round($trend->i3, 2) .',';
			$param_inet 		.= round($trend->inet, 2) .',';

			$param_va1 			.= round($trend->va1, 2) .',';
			$param_va2 			.= round($trend->va2, 2) .',';
			$param_va3 			.= round($trend->va3, 2) .',';
			$param_va 			.= round($trend->va, 2) .',';

			$param_pf1 			.= round($trend->pf1, 2) .',';
			$param_pf2 			.= round($trend->pf2, 2) .',';
			$param_pf3 			.= round($trend->pf3, 2) .',';
			
		}
		
		if ($loop_trend > 0) {
			$param_watt1		= substr(trim($param_watt1), 0, -1);
			$param_watt2		= substr(trim($param_watt2), 0, -1);
			$param_watt3		= substr(trim($param_watt3), 0, -1);
			$param_watt			= substr(trim($param_watt), 0, -1);

			$param_kwh_exp		= substr(trim($param_kwh_exp), 0, -1);
			$param_kwh_imp		= substr(trim($param_kwh_imp), 0, -1);

			$param_kvarh_exp	= substr(trim($param_kvarh_exp), 0, -1);
			$param_kvarh_imp	= substr(trim($param_kvarh_imp), 0, -1);

			$param_kvah			= substr(trim($param_kvah), 0, -1);

			$param_thd_v1		= substr(trim($param_thd_v1), 0, -1);
			$param_thd_v2		= substr(trim($param_thd_v2), 0, -1);
			$param_thd_v3		= substr(trim($param_thd_v3), 0, -1);

			$param_thd_i1		= substr(trim($param_thd_i1), 0, -1);
			$param_thd_i2		= substr(trim($param_thd_i2), 0, -1);
			$param_thd_i3		= substr(trim($param_thd_i3), 0, -1);

			$param_kwh1			= substr(trim($param_kwh1), 0, -1);
			$param_kwh2			= substr(trim($param_kwh2), 0, -1);
			$param_kwh			= substr(trim($param_kwh), 0, -1);

			$param_freq 		= substr(trim($param_freq), 0, -1);

			$param_v1 			= substr(trim($param_v1), 0, -1);
			$param_v2 			= substr(trim($param_v2), 0, -1);
			$param_v3 			= substr(trim($param_v3), 0, -1);

			$param_v12 			= substr(trim($param_v12), 0, -1);
			$param_v23 			= substr(trim($param_v23), 0, -1);
			$param_v31 			= substr(trim($param_v31), 0, -1);

			$param_i1 			= substr(trim($param_i1), 0, -1);
			$param_i2 			= substr(trim($param_i2), 0, -1);
			$param_i3 			= substr(trim($param_i3), 0, -1);
			$param_inet 		= substr(trim($param_inet), 0, -1);

			$param_va1 			= substr(trim($param_va1), 0, -1);
			$param_va2 			= substr(trim($param_va2), 0, -1);
			$param_va3 			= substr(trim($param_va3), 0, -1);
			$param_va 			= substr(trim($param_va), 0, -1);

			$param_pf1 			= substr(trim($param_pf1), 0, -1);
			$param_pf2 			= substr(trim($param_pf2), 0, -1);
			$param_pf3 			= substr(trim($param_pf3), 0, -1);
		}

		
		
		//============== end action ==========================
		
		
		$condition_parameters['username'] 	= $this->session->userdata('username');
		$condition_parameters['module'] 	= 'trend';
		$condition_parameters['setvalue'] 	= 1;
		$fieldparameters 		= $this->mcrud->searchall($condition_parameters, 'fieldparameters', 'fieldname', 'asc');
		$fieldparameters_count 	= $this->mcrud->searchcount($condition_parameters, 'fieldparameters');
		
		$d['fieldparameters']	= $fieldparameters;
		
		if ($str_categories != '') {
			$str_categories = substr(trim($str_categories), 0, -1);
		}
		$d['str_categories']	= $str_categories;
		
		$d['graph_title']		= $graph_title;
		$d['graph_subtitle']	= $graph_subtitle;
		
		$d['datasource'] 		= $datasource;
		$d['id'] 				= $id;
		$d['tempo'] 			= $tempo;
		$d['dari'] 				= $dari;
		$d['sampai'] 			= $sampai;
		
		$d['param_watt1']		= $param_watt1;
		$d['param_watt2']		= $param_watt2;
		$d['param_watt3']		= $param_watt3;
		$d['param_watt']		= $param_watt;

		$d['param_kwh_exp']		= $param_kwh_exp;
		$d['param_kwh_imp']		= $param_kwh_imp;

		$d['param_kvarh_exp']	= $param_kvarh_exp;
		$d['param_kvarh_imp']	= $param_kvarh_imp;

		$d['param_kvah']		= $param_kvah;

		$d['param_thd_v1']		= $param_thd_v1;
		$d['param_thd_v2']		= $param_thd_v2;
		$d['param_thd_v3']		= $param_thd_v3;

		$d['param_thd_i1']		= $param_thd_i1;
		$d['param_thd_i2']		= $param_thd_i2;
		$d['param_thd_i3']		= $param_thd_i3;

		$d['param_kwh1']		= $param_kwh1;
		$d['param_kwh2']		= $param_kwh2;
		$d['param_kwh']			= $param_kwh;

		$d['param_freq'] 		= $param_freq;

		$d['param_v1'] 			= $param_v1;
		$d['param_v2'] 			= $param_v2;
		$d['param_v3'] 			= $param_v3;

		$d['param_v12'] 		= $param_v12;
		$d['param_v23'] 		= $param_v23;
		$d['param_v31'] 		= $param_v31;

		$d['param_i1'] 			= $param_i1;
		$d['param_i2'] 			= $param_i2;
		$d['param_i3'] 			= $param_i3;
		$d['param_inet'] 		= $param_inet;

		$d['param_va1'] 		= $param_va1;
		$d['param_va2'] 		= $param_va2;
		$d['param_va3'] 		= $param_va3;
		$d['param_va'] 			= $param_va;

		$d['param_pf1'] 		= $param_pf1;
		$d['param_pf2'] 		= $param_pf2;
		$d['param_pf3'] 		= $param_pf3;
		
		$d['dari_time'] 		= $dari_time;
		$d['sampai_time'] 		= $sampai_time;
		
		$d['showpointvalue'] 	= $chk_showpointvalue;
		
		$d['count_variable'] 	= $fieldparameters_count;
		
		if (($fieldparameters_count % 2) == 1) {
			$even_parameter_count = $fieldparameters_count + 1;
		} else {
			$even_parameter_count = $fieldparameters_count;
		}
		$d['count_variable_middle'] = $even_parameter_count / 2;
		
        $this->template->display_trend('trenddetailmultiple',$d);
    }
	
}