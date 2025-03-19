<?php

ini_set('memory_limit', '-1');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trend extends CI_Controller {

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
		$datasource 	= 'Hourly';
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
			$datasource_title = ' ';
		} else if ($datasource == 'Detail') {
			$datasource_title = ' ';
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
				$trends = $this->model_trend->get_trend_monthly_max($tablename, $id, $dari, $sampai);
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
			
			$param_watt1		.= $trend->watt1 .',';
			$param_watt2		.= $trend->watt2 .',';
			$param_watt3		.= $trend->watt3 .',';
			$param_watt			.= $trend->watt .',';

			$param_kwh_exp		.= ($trend->kwh_exp / 1000) .',';
			$param_kwh_imp		.= ($trend->kwh_imp / 1000) .',';

			$param_kvarh_exp	.= ($trend->kvarh_exp / 1000) .',';
			$param_kvarh_imp	.= ($trend->kvarh_imp / 1000) .',';

			$param_kvah			.= ($trend->kvah / 1000) .',';

			$param_thd_v1		.= $trend->thd_v1 .',';
			$param_thd_v2		.= $trend->thd_v2 .',';
			$param_thd_v3		.= $trend->thd_v3 .',';

			$param_thd_i1		.= $trend->thd_i1 .',';
			$param_thd_i2		.= $trend->thd_i2 .',';
			$param_thd_i3		.= $trend->thd_i3 .',';

			$param_kwh1			.= ($trend->kwh1 / 1000) .',';
			$param_kwh2			.= ($trend->kwh2 / 1000) .',';
			$param_kwh			.= ($trend->kwh / 1000) .',';

			$param_freq 		.= $trend->freq .',';

			$param_v1 			.= $trend->v1 .',';
			$param_v2 			.= $trend->v2 .',';
			$param_v3 			.= $trend->v3 .',';

			$param_v12 			.= $trend->v12 .',';
			$param_v23 			.= $trend->v23 .',';
			$param_v31 			.= $trend->v31 .',';

			$param_i1 			.= $trend->i1 .',';
			$param_i2 			.= $trend->i2 .',';
			$param_i3 			.= $trend->i3 .',';
			$param_inet 		.= $trend->inet .',';

			$param_va1 			.= $trend->va1 .',';
			$param_va2 			.= $trend->va2 .',';
			$param_va3 			.= $trend->va3 .',';
			$param_va 			.= $trend->va .',';

			$param_pf1 			.= $trend->pf1 .',';
			$param_pf2 			.= $trend->pf2 .',';
			$param_pf3 			.= $trend->pf3 .',';
			
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
		$fieldparameters = $this->mcrud->searchall($condition_parameters, 'fieldparameters', 'fieldname', 'asc');
		
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
		
        $this->template->display_trend('trend',$d);
    }
	
	
	
	
	public function datagrafik_OLD()
	{
        $id = $this->input->post('id');
		$parameter = $this->input->post('parameter');
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');
		
		$satuan = $this->input->post('satuan');
		$tempo = $this->input->post('tempo');
		//$datasource = $this->input->post('datasource');
		
		// $id = '01. LINE 1';
		
		// $parameter = 'Power';
		// $dari = '2017-08-25';
		// $sampai = '2017-08-29';
		// $satuan = 'W';
		// $tempo = 'Date Between';
		
		// $baru = $id.''.$parameter.''.$dari.''.$sampai;
		// $level = $this->input->post('level');
		// $aktif = $this->input->post('aktif');
		
		if($tempo=='Date Between'){ 
			$dari1   = $dari;
			$sampai1 = $sampai;
		
		}
		elseif($tempo=='Daily'){
			$dari1   = date('Y-m-d');
			$sampai1 = date('Y-m-d');		
		}
		elseif($tempo=='Monthly'){
			
			$hari_ini = date("Y-m-d");
			$dari1 = date('Y-m-01', strtotime($hari_ini));
			$sampai1 = date('Y-m-t', strtotime($hari_ini));
		}
 
		$where = array(
			   'id' => $id
		);
		
		//$list = $this->model_report->getdata_orderby('counter','id_counter')->result();
		$list = $this->model_trend->getdatasort_orderby('counter_jam',$where,'id_counter',$dari1,$sampai1)->result();
		
		if($list=='' or $list==null){
			
			$data[]['datagrf'] = $id;
			$data[]['datagrf'] = $parameter;
			$data[]['datagrf'] = $satuan;
			$data[]['datagrf'][] = '0000-00-00 00:00:00';
			$data[]['datagrf'][] = 0;
			$data[]['datagrf'][] = 0;
			$data[]['datagrf'][] = 0;
			$data[]['datagrf'][] = 0;
			
			
		}
		else{ 
		
		$data = array();
		$output = array();
		$no = 0;
		
		foreach ($list as $counter) {
			$no++;
			$row 			= array();
			$dataAxis 		= array();
			$dataLegend 	= array();
			
			$dataget1 	  = array();
			$dataget2 	  = array();
			$dataget3 	  = array();
			$dataget4 	  = array();
			$dataget5 	  = array();
			
			$dataget6 	  = array();
			$dataget7 	  = array();
			$dataget8 	  = array();
			$dataget9 	  = array();
			$dataget10 	  = array();
			
			$dataget11 	  = array();
			$dataget12 	  = array();
			$dataget13 	  = array();
			$dataget14 	  = array();
			$dataget15 	  = array();
			
			$dataget16 	  = array();
			$dataget17 	  = array();
			$dataget18 	  = array();
			$dataget19 	  = array();
			$dataget20 	  = array();
			
			$dataget21 	  = array();
			$dataget22 	  = array();
			$dataget23 	  = array();
			$dataget24 	  = array();
			$dataget25 	  = array();
			
			$dataget26 	  = array();
			$dataget27 	  = array();
			$dataget28 	  = array();
			$dataget29 	  = array();
			$dataget30 	  = array();
			
			$dataget31 	  = array();
			$dataget32 	  = array();
			$dataget33 	  = array();
			$dataget34 	  = array();
			$dataget35 	  = array();
			
			$dataget36 	  = array();
			
			$dataAxis = $counter->date_time;
			
			
			/*
			if($parameter=='Power'){
				$dataget1 = $counter->watt1;
				$dataget2 = $counter->watt2;
				$dataget3 = $counter->watt3;
				$dataget4 = $counter->watt;
			}
			elseif($parameter=='Current'){
				$dataget1 = $counter->i1;
				$dataget2 = $counter->i2;
				$dataget3 = $counter->i3;
				$dataget4 = $counter->inet;
			}
			elseif($parameter=='Voltage Phase To Netral'){
				$dataget1 = $counter->v1;
				$dataget2 = $counter->v2;
				$dataget3 = $counter->v3;
				$dataget4 = 0;
			}
			elseif($parameter=='Voltage Phase to Phase'){
				$dataget1 = $counter->v12;
				$dataget2 = $counter->v23;
				$dataget3 = $counter->v31;
				$dataget4 = 0;
			}
			elseif($parameter=='Power Factor'){
				$dataget1 = $counter->pf1;
				$dataget2 = $counter->pf2;
				$dataget3 = $counter->pf3;
				$dataget4 = 0;
			}
			elseif($parameter=='Frequency'){
				$dataget1 = $counter->freq;
				$dataget2 = 0;
				$dataget3 = 0;
				$dataget4 = 0;
			}
			elseif($parameter=='Export kWh'){
				$dataget1 = $counter->kwh_exp;
				$dataget2 = 0;
				$dataget3 = 0;
				$dataget4 = 0;
			}
			elseif($parameter=='Import kWh'){
				$dataget1 = $counter->kwh_imp;
				$dataget2 = 0;
				$dataget3 = 0;
				$dataget4 = 0;
			}
			elseif($parameter=='Export kVARh'){
				$dataget1 = $counter->kvarh_exp;
				$dataget2 = 0;
				$dataget3 = 0;
				$dataget4 = 0;
			}
			elseif($parameter=='Import kVARh'){
				$dataget1 = $counter->kvarh_imp;
				$dataget2 = 0;
				$dataget3 = 0;
				$dataget4 = 0;
			}
			elseif($parameter=='THD V'){
				$dataget1 = $counter->thd_v1;
				$dataget2 = $counter->thd_v2;
				$dataget3 = $counter->thd_v3;
				$dataget4 = 0;
			}
			elseif($parameter=='THD I'){
				$dataget1 = $counter->thd_i1;
				$dataget2 = $counter->thd_i2;
				$dataget3 = $counter->thd_i3;
				$dataget4 = 0;
			}
			else{
				$dataget1 = $counter->watt1;
				$dataget2 = $counter->watt2;
				$dataget3 = $counter->watt3;
				$dataget4 = $counter->watt;
			}
			
			*/
			
			// ===== initial value ===
			$dataget1 = 1;
			$dataget2 = 1;
			$dataget3 = 1;
			$dataget4 = 1;
			$dataget5 = 1;

			$dataget6 = 1;
			$dataget7 = 1;
			$dataget8 = 1;
			$dataget9 = 1;
			$dataget10 = 1;

			$dataget11 = 1;
			$dataget12 = 1;
			$dataget13 = 1;
			$dataget14 = 1;
			$dataget15 = 1;

			$dataget16 = 1;
			$dataget17 = 1;
			$dataget18 = 1;
			$dataget19 = 1;
			$dataget20 = 1;

			$dataget21 = 1;
			$dataget22 = 1;
			$dataget23 = 1;
			$dataget24 = 1;
			$dataget25 = 1;

			$dataget26 = 1;
			$dataget27 = 1;
			$dataget28 = 1;
			$dataget29 = 1;
			$dataget30 = 1;

			$dataget31 = 1;
			$dataget32 = 1;
			$dataget33 = 1;
			$dataget34 = 1;
			$dataget35 = 1;
			$dataget36 = 1;
			
			// == set value ==
			
			if ($this->input->post('chk_watt1') == 1) {
				$dataget1 = $counter->watt1;
				$dataLegend[] = 'watt1';
			}
			if ($this->input->post('chk_watt2') == 1) {
				$dataget2 = $counter->watt2;
				$dataLegend[] = 'watt2';
			}
			if ($this->input->post('chk_watt3') == 1) {
				$dataget3 = $counter->watt3;
				$dataLegend[] = 'watt3';
			}
			if ($this->input->post('chk_watt') == 1) {
				$dataget4 = $counter->watt;
				$dataLegend[] = 'watt';
			}
			
			if ($this->input->post('chk_kwh_exp') == 1) {
				$dataget5 = $counter->kwh_exp;
				$dataLegend[] = 'kwh_exp';
			}
			if ($this->input->post('chk_kwh_imp') == 1) {
				$dataget6 = $counter->kwh_imp;
				$dataLegend[] = 'kwh_imp';
			}
			
			if ($this->input->post('chk_kvarh_exp') == 1) {
				$dataget7 = $counter->kvarh_exp;
				$dataLegend[] = 'kvarh_exp';
			}
			if ($this->input->post('chk_kvarh_imp') == 1) {
				$dataget8 = $counter->kvarh_imp;
				$dataLegend[] = 'kvarh_imp';
			}
			
			if ($this->input->post('chk_kvah') == 1) {
				$dataget9 = $counter->kvah;
				$dataLegend[] = 'kvah';
			}
			
			if ($this->input->post('chk_thd_v1') == 1) {
				$dataget10 = $counter->thd_v1;
				$dataLegend[] = 'thd_v1';
			}
			if ($this->input->post('chk_thd_v2') == 1) {
				$dataget11 = $counter->thd_v2;
				$dataLegend[] = 'thd_v2';
			}
			if ($this->input->post('chk_thd_v3') == 1) {
				$dataget12 = $counter->thd_v3;
				$dataLegend[] = 'thd_v3';
			}
			
			if ($this->input->post('chk_thd_i1') == 1) {
				$dataget13 = $counter->thd_i1;
				$dataLegend[] = 'thd_i1';
			}
			if ($this->input->post('chk_thd_i2') == 1) {
				$dataget14 = $counter->thd_i2;
				$dataLegend[] = 'thd_i2';
			}
			if ($this->input->post('chk_thd_i3') == 1) {
				$dataget15 = $counter->thd_i3;
				$dataLegend[] = 'thd_i3';
			}
			
			if ($this->input->post('chk_kwh1') == 1) {
				$dataget16 = $counter->kwh1;
				$dataLegend[] = 'kwh1';
			}
			if ($this->input->post('chk_kwh2') == 1) {
				$dataget17 = $counter->kwh2;
				$dataLegend[] = 'kwh2';
			}
			if ($this->input->post('chk_kwh') == 1) {
				$dataget18 = $counter->kwh;
				$dataLegend[] = 'kwh';
			}
			
			$dt4[]  	 = $dataAxis;
			
			$dt5[]		 = $dataget1;
			$dt6[]		 = $dataget2;
			$dt7[]		 = $dataget3;
			$dt8[]		 = $dataget4;
			$dt9[]		 = $dataget5;
			
			$dt10[]		 = $dataget6;
			$dt11[]		 = $dataget7;
			$dt12[]		 = $dataget8;
			$dt13[]		 = $dataget9;
			$dt14[]		 = $dataget10;
			
			$dt15[]		 = $dataget11;
			$dt16[]		 = $dataget12;
			$dt17[]		 = $dataget13;
			$dt18[]		 = $dataget14;
			$dt19[]		 = $dataget15;
			
			$dt20[]		 = $dataget16;
			$dt21[]		 = $dataget17;
			$dt22[]		 = $dataget18;
			$dt23[]		 = $dataget19;
			$dt24[]		 = $dataget20;
			
			$dt25[]		 = $dataget21;
			$dt26[]		 = $dataget22;
			$dt27[]		 = $dataget23;
			$dt28[]		 = $dataget24;
			$dt29[]		 = $dataget25;
			
			$dt30[]		 = $dataget26;
			$dt31[]		 = $dataget27;
			$dt32[]		 = $dataget28;
			$dt33[]		 = $dataget29;
			$dt34[]		 = $dataget30;

			$dt35[]		 = $dataget31;
			$dt36[]		 = $dataget32;
			$dt37[]		 = $dataget33;
			$dt38[]		 = $dataget34;
			$dt39[]		 = $dataget35;
			
			$dt40[]		 = $dataget36;
		}
		
		$dataLegend[] = 'a';
		$dataLegend[] = 'b';
		$dataLegend[] = 'c';
		$dataLegend[] = 'd';
		
		$dataSeries = "";
		
		$data[]['datagrf'] = $id; 			// datagrf[0]
		$data[]['datagrf'] = $parameter;	// datagrf[1]
		$data[]['datagrf'] = $satuan;		// datagrf[2]
		$data[]['datagrf'] = $dt4; 			// datagrf[3] -> XAxis
		$data[]['datagrf'] = $dataLegend; 	// datagrf[4] -> Legend
		$data[]['datagrf'] = $dataSeries; 	// datagrf[5] -> Series
		
		$data[]['datagrf'] = $dt5; 			// datagrf[6] -> start field value
		
		$data[]['datagrf'] = $dt6;
		$data[]['datagrf'] = $dt7;
		$data[]['datagrf'] = $dt8;
		$data[]['datagrf'] = $dt9;
		$data[]['datagrf'] = $dt10;
		
		$data[]['datagrf'] = $dt11;
		$data[]['datagrf'] = $dt12;
		$data[]['datagrf'] = $dt13;
		$data[]['datagrf'] = $dt14;
		$data[]['datagrf'] = $dt15;
		
		$data[]['datagrf'] = $dt16;
		$data[]['datagrf'] = $dt17;
		$data[]['datagrf'] = $dt18;
		$data[]['datagrf'] = $dt19;
		$data[]['datagrf'] = $dt20;
		
		$data[]['datagrf'] = $dt21;
		$data[]['datagrf'] = $dt22;
		$data[]['datagrf'] = $dt23;
		$data[]['datagrf'] = $dt24;
		$data[]['datagrf'] = $dt25;
		
		$data[]['datagrf'] = $dt26;
		$data[]['datagrf'] = $dt27;
		$data[]['datagrf'] = $dt28;
		$data[]['datagrf'] = $dt29;
		$data[]['datagrf'] = $dt30;
		
		$data[]['datagrf'] = $dt31;
		$data[]['datagrf'] = $dt32;
		$data[]['datagrf'] = $dt33;
		$data[]['datagrf'] = $dt34;
		$data[]['datagrf'] = $dt35;
		
		$data[]['datagrf'] = $dt36;
		
		}
		
		
		//$column = '[0,3,4,7,8,9,10]';
		//$output[]['dataku'] = $data;
		//$output[]['dataku'] = $column;
		//output to json format
		echo json_encode($data);
		       
	}


}