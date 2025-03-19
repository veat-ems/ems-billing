<?php

ini_set('memory_limit', '-1');

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Trendperiodicmultiple extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_trend', 'mcrud'));
		if ($this->session->userdata('id_jenis_user') <> '1') {
			redirect('login');
		}
		//$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		//$this->output->set_header('Pragma: no-cache');
		//$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

	public function index()
	{
		$d['title'] = 'TREND';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';
		$d['data_meter'] = $this->model_trend->getdata('data_meter', $this->session->userdata('username'))->result();
		$d['parameter'] = $this->model_trend->getdata_all('parameter')->result();

		// ============ init value =====================
		$checked 			= 0;
		$str_insert			= '';
		$str_ses_username	= $this->session->userdata('username');
		$str_categories		= '';

		$param_watt1		= '';
		$param_watt2		= '';
		$param_watt3		= '';
		$param_watt			= '';

		$param_kwh_inc1		= '';
		$param_kwh_inc2		= '';
		$param_kwh_inc3		= '';

		$param_kwh1			= '';
		$param_kwh2			= '';

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
			$conditions_min = "(metergroupid in (select metergroupid from usermetergroups where username = '" . $this->session->userdata('username') . "' ))";
			$id = $this->model_trend->searchmin('data_meter', 'id', $conditions_min);
		}

		$id_serial 	= $this->mcrud->getvalue('data_meter', 'id_serial', 'id', $id);
		$lokasi		= $this->mcrud->getvalue('data_meter', 'lokasi', 'id', $id);
		$id_name 	= $this->mcrud->getvalue('data_meter', 'id_name', 'id', $id); // ori
		$groupid 	= $this->mcrud->getvalue('data_meter', 'metergroupid', 'id', $id);
		$groupname 	= $this->mcrud->getvalue('metergroups', 'metergroupname', 'metergroupid', $groupid); 
		$id_name	= $id . '|' . $id_name . '|' . $groupname . '|' . $lokasi;

		// $id_name		= $this->mcrud->getvalue('data_meter', 'id_name', 'id', $id);  // ori

		if ($tempo == '') {
			$tempo = 'Hourly';
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

		if ($dari_time == '') {
			$dari_time = '00:00:00';
		}

		if ($sampai_time == '') {
			$sampai_time = '23:59:59';
		}
				
		if ($tempo == 'Daily') {
			// $dari 			= date('Y-m-01', strtotime($dari));
			// $sampai 		= date('Y-m-t', strtotime($dari));
			// tkh
			$dari 	= date('Y-m-d', strtotime($dari));
			$sampai = date('Y-m-d', strtotime($sampai));
			$dari_time 		= '00:00:00';
			$sampai_time 	= '23:59:59';

			$daily_dari		= $dari . ' ' . $dari_time;
			$daily_sampai	= $sampai . ' ' . $sampai_time;
			// tkh 
			// 			$graph_title 	= $id_name . ' Daily Graph' . ' for period ' . date('F Y', strtotime($dari));
			$graph_title 	= $id_name . ' Daily Graph, ' . ' Period ' . date('d-M-Y', strtotime($dari)) . ' ' . date('H:i', strtotime($dari_time)) . ' ~ ' . date('d-M-Y', strtotime($sampai)) . ' ' . date('H:i', strtotime($sampai_time));
			$graph_subtitle = '';
		} else if ($tempo == 'Hourly') {
			$dari 	= date('Y-m-d', strtotime($dari));
			$sampai = date('Y-m-d', strtotime($sampai));

			$hourly_dari	= $dari . ' ' . $dari_time;
			$hourly_sampai	= $sampai . ' ' . $sampai_time;
			// tkh	
			// 	$graph_title 	= $id_name . ' Hourly Graph' . ' for period ' . date('d-M-Y', strtotime($dari)) . ' ' . date('H:i', strtotime($dari_time)) . ' until ' . date('d-M-Y', strtotime($sampai)) . ' ' . date('H:i', strtotime($sampai_time));
			$graph_title 	= $id_name . ' Hourly Graph, ' . ' Period ' . date('d-M-Y', strtotime($dari)) . ' ' . date('H:i', strtotime($dari_time)) . ' ~ ' . date('d-M-Y', strtotime($sampai)) . ' ' . date('H:i', strtotime($sampai_time));
			$graph_subtitle = '';
		} else { // Detail
			$dari 	= date('Y-m-d', strtotime($dari));
			$sampai = date('Y-m-d', strtotime($sampai));

			$detail_dari	= $dari . ' ' . $dari_time;
			$detail_sampai	= $sampai . ' ' . $sampai_time;

			$graph_title 	= $id_name . ' Detail Graph, ' . ' Period ' . date('d-M-Y', strtotime($dari)) . ' ' . date('H:i', strtotime($dari_time)) . ' ~ ' . date('d-M-Y', strtotime($sampai)) . ' ' . date('H:i', strtotime($sampai_time));
			$graph_subtitle = '';
		}



		//-- setting value
		$chk_showpointvalue = $this->input->post('chk_showpointvalue');

		//-- param value
		$chk_watt1		= $this->input->post('chk_watt1');
		$chk_watt2		= $this->input->post('chk_watt2');
		$chk_watt3		= $this->input->post('chk_watt3');
		$chk_watt		= $this->input->post('chk_watt');


		$chk_kwh_inc1	= $this->input->post('chk_kwh_inc1');
		$chk_kwh_inc2	= $this->input->post('chk_kwh_inc2');
		$chk_kwh_inc3	= $this->input->post('chk_kwh_inc3');

		$chk_kwh1		= $this->input->post('chk_kwh1');
		$chk_kwh2		= $this->input->post('chk_kwh2');

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

		// $chk_kwh		= $this->input->post('chk_kwh');
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
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'P1', 1), ";
		}

		if ($chk_watt2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'P2', 1), ";
		}

		if ($chk_watt3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'P3', 1), ";
		}

		if ($chk_watt == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'P', 1), ";
		}

		if ($chk_kwh_inc1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kWh_Inc1', 1), ";
		}
		if ($chk_kwh_inc2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kWh_Inc2', 1), ";
		}
		if ($chk_kwh_inc3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kWh_Inc3', 1), ";
		}

		if ($chk_kwh1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kWh1', 1), ";
		}

		if ($chk_kwh2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kWh2', 1), ";
		}


		if ($chk_kwh_exp == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kWh_Exp', 1), ";
		}

		if ($chk_kwh_imp == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kWh_Imp', 1), ";
		}

		if ($chk_kvarh_exp == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kVArh_Exp', 1), ";
		}

		if ($chk_kvarh_imp == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kVArh_Imp', 1), ";
		}

		if ($chk_kvah == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kVAh', 1), ";
		}

		if ($chk_thd_v1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'THD_V1', 1), ";
		}

		if ($chk_thd_v2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'THD_V2', 1), ";
		}

		if ($chk_thd_v3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'THD_V3', 1), ";
		}

		if ($chk_thd_i1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'THD_I1', 1), ";
		}

		if ($chk_thd_i2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'THD_I2', 1), ";
		}

		if ($chk_thd_i3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'THD_I3', 1), ";
		}

		if ($chk_kwh == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'kWh', 1), ";
		}

		if ($chk_freq == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'Freq', 1), ";
		}

		if ($chk_v1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'V1', 1), ";
		}

		if ($chk_v2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'V2', 1), ";
		}

		if ($chk_v3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'V3', 1), ";
		}

		if ($chk_v12 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'V12', 1), ";
		}

		if ($chk_v23 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'V23', 1), ";
		}

		if ($chk_v31 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'V31', 1), ";
		}

		if ($chk_i1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'I1', 1), ";
		}

		if ($chk_i2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'I2', 1), ";
		}

		if ($chk_i3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'I3', 1), ";
		}

		if ($chk_inet == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'INet', 1), ";
		}

		if ($chk_va1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'S1', 1), ";
		}

		if ($chk_va2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'S2', 1), ";
		}

		if ($chk_va3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'S3', 1), ";
		}

		if ($chk_va == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'S', 1), ";
		}

		if ($chk_pf1 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'PF1', 1), ";
		}

		if ($chk_pf2 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'PF2', 1), ";
		}

		if ($chk_pf3 == 1) {
			$checked 	 = 1;
			$str_insert	.= "('" . $str_ses_username . "', 'trend', 'PF3', 1), ";
		}

		//============== end selection chk ===================

		//============== action ==============================

		// -- update stored param
		if ($checked == 1) {
			$str_insert = substr(trim($str_insert), 0, -1);
			$this->model_trend->update_parameter($str_ses_username, 'trend', $str_insert);
		}


		// -- read value
		// if ($tempo == 'Daily') {
		// 	$tablename = 'counter_transit';
		// 	$trends = $this->model_trend->get_trend_daily_max_6($tablename, $id, $daily_dari, $daily_sampai);
		// } else if ($tempo == 'Hourly') {
		// 	$tablename = 'counter_jam';
		// 	$trends = $this->model_trend->get_trend_hourly_6($tablename, $id, $hourly_dari, $hourly_sampai);
		// } else {
		// 	$tablename = 'counter_transit';
		// 	$condition_trend['id'] 				= $id;
		// 	$condition_trend['date_time >= '] 	= $dari . ' ' . $dari_time;
		// 	$condition_trend['date_time <= '] 	= $sampai . ' ' . $sampai_time;
		// 	$trends = $this->mcrud->searchall($condition_trend, $tablename, 'date_time', 'asc');
		// }

		// tkh		
		if ($tempo == 'Daily') {
			$tablename = 'pg_counter_day'; // tkh
			$condition_trend['id'] 				= $id;
			$condition_trend['date_time >= '] 	= $dari . ' ' . $dari_time;
			$condition_trend['date_time <= '] 	= $sampai . ' ' . $sampai_time;
			$trends = $this->mcrud->searchall($condition_trend, $tablename, 'date_time', 'asc');
		} else if ($tempo == 'Hourly') {
			$tablename = 'pg_counter_hour'; // tkh
			$condition_trend['id'] 				= $id;
			$condition_trend['date_time >= '] 	= $dari . ' ' . $dari_time;
			$condition_trend['date_time <= '] 	= $sampai . ' ' . $sampai_time;
			$trends = $this->mcrud->searchall($condition_trend, $tablename, 'date_time', 'asc');
		} else { // Detail
			$tablename = 'pg_counter_min'; // tkh
			$condition_trend['id'] 				= $id;
			$condition_trend['date_time >= '] 	= $dari . ' ' . $dari_time;
			$condition_trend['date_time <= '] 	= $sampai . ' ' . $sampai_time;
			$trends = $this->mcrud->searchall($condition_trend, $tablename, 'date_time', 'asc');
		
			// var_dump($condition_trend);
			// var_dump($tablename);
			// var_dump($trends);
			// die;
			//echo $conditions;
			// $this->db->where($condition_trend);
			// $this->db->order_by('date_time', 'asc');
			// $result = $this->db->get($tablename);
			// $trends = $result->result();



			// $sql  = "SELECT id, date_trunc('hour', date_time) as date_time, "; 
			// $sql .= "max(v1) as v1, max(v2) as v2, max(v3) as v3, max(v12) as v12, max(v23) as v23, max(v31) as v31, "; 
			// $sql .= "max(i1) as i1, max(i2) as i2, max(i3) as i3, max(inet) as inet, "; 
			// $sql .= "max(watt1) as watt1, max(watt2) as watt2, max(watt3) as watt3, max(watt) as watt, "; 
			// $sql .= "max(va1) as va1, max(va2) as va2, max(va3) as va3, max(va) as va, "; 
			// $sql .= "max(freq) as freq, max(pf1) as pf1, max(pf2) as pf2, max(pf3) as pf3, "; 
			// $sql .= "max(kwh_exp) as kwh_exp, max(kwh_imp) as kwh_imp, max(kvarh_exp) as kvarh_exp, max(kvarh_imp) as kvarh_imp, "; 
			// $sql .= "max(kvah) as kvah, "; 
			// $sql .= "max(thd_v1) as thd_v1, max(thd_v2) as thd_v2, max(thd_v3) as thd_v3, "; 
			// $sql .= "max(thd_i1) as thd_i1, max(thd_i2) as thd_i2, max(thd_i3) as thd_i3, "; 
			// $sql .= "max(kwh1) as kwh1, max(kwh2) as kwh2, max(kwh) as kwh "; 
			// $sql .= "FROM " . $tablename . " "; 
			// $sql .= "where id = '" . $id . "' and date_time BETWEEN '" . $dari . ' ' . $dari_time. "' and '" . $sampai . ' ' . $sampai_time. "'  "; 
			// $sql .= "group by id, date_trunc('hour', date_time) ";
						
			// $result	= $this->db->query($sql);
			// $trends = $result->result();

		}



		$loop_trend = 0;
		foreach ($trends as $trend) {
			$loop_trend += 1;

			// set categories (Xaxis text)
			if ($tempo == 'Daily') {
				// $str_categories .= "'" . date('d', strtotime($trend->date_time)) . "',";
				// tkh
				$str_categories .= "'" . date('Y-m-d H:i', strtotime($trend->date_time)) . "',";
			} else if ($tempo == 'Hourly') {
				$str_categories .= "'" . date('Y-m-d H:i', strtotime($trend->date_time)) . "',";
			} else {
				$str_categories .= "'" . date('Y-m-d H:i', strtotime($trend->date_time)) . "',";
				// tkh
				// $str_categories .= "'" . date('Y-m-d H:i:s', strtotime($trend->date_time)) . "',";
			}

			$param_watt1		.= round($trend->watt1, 0) . ',';
			$param_watt2		.= round($trend->watt2, 0) . ',';
			$param_watt3		.= round($trend->watt3, 0) . ',';
			$param_watt			.= round($trend->watt, 0) . ',';

			$param_kwh_inc1		.= round($trend->kwh_inc1 / 1000, 1) . ',';
			$param_kwh_inc2		.= round($trend->kwh_inc2 / 1000, 1) . ',';
			$param_kwh_inc3		.= round($trend->kwh_inc3 / 1000, 1) . ',';

			$param_kwh1			.= round($trend->kwh1 / 1000, 1) . ',';
			$param_kwh2			.= round($trend->kwh2 / 1000, 1) . ',';

			$param_kwh_exp		.= round($trend->kwh_exp / 1000, 1) . ',';
			$param_kwh_imp		.= round(($trend->kwh_imp / 1000), 1) . ',';

			$param_kvarh_exp	.= round(($trend->kvarh_exp / 1000), 1) . ',';
			$param_kvarh_imp	.= round(($trend->kvarh_imp / 1000), 1) . ',';

			$param_kvah			.= round(($trend->kvah / 1000), 1) . ',';

			$param_thd_v1		.= round($trend->thd_v1, 1) . ',';
			$param_thd_v2		.= round($trend->thd_v2, 1) . ',';
			$param_thd_v3		.= round($trend->thd_v3, 1) . ',';

			$param_thd_i1		.= round($trend->thd_i1, 1) . ',';
			$param_thd_i2		.= round($trend->thd_i2, 1) . ',';
			$param_thd_i3		.= round($trend->thd_i3, 1) . ',';

			$param_kwh			.= round(($trend->kwh / 1000), 1) . ',';

			$param_freq 		.= round($trend->freq, 2) . ',';

			$param_v1 			.= round($trend->v1, 1) . ',';
			$param_v2 			.= round($trend->v2, 1) . ',';
			$param_v3 			.= round($trend->v3, 1) . ',';

			$param_v12 			.= round($trend->v12, 1) . ',';
			$param_v23 			.= round($trend->v23, 1) . ',';
			$param_v31 			.= round($trend->v31, 1) . ',';

			$param_i1 			.= round($trend->i1, 1) . ',';
			$param_i2 			.= round($trend->i2, 1) . ',';
			$param_i3 			.= round($trend->i3, 1) . ',';
			$param_inet 		.= round($trend->inet, 1) . ',';

			$param_va1 			.= round($trend->va1, 0) . ',';
			$param_va2 			.= round($trend->va2, 0) . ',';
			$param_va3 			.= round($trend->va3, 0) . ',';
			$param_va 			.= round($trend->va, 0) . ',';

			$param_pf1 			.= round($trend->pf1, 2) . ',';
			$param_pf2 			.= round($trend->pf2, 2) . ',';
			$param_pf3 			.= round($trend->pf3, 2) . ',';
		}

		if ($loop_trend > 0) {
			$param_watt1		= substr(trim($param_watt1), 0, -1);
			$param_watt2		= substr(trim($param_watt2), 0, -1);
			$param_watt3		= substr(trim($param_watt3), 0, -1);
			$param_watt			= substr(trim($param_watt), 0, -1);

			$param_kwh_inc1		= substr(trim($param_kwh_inc1), 0, -1);
			$param_kwh_inc2		= substr(trim($param_kwh_inc2), 0, -1);
			$param_kwh_inc3		= substr(trim($param_kwh_inc3), 0, -1);

			$param_kwh1			= substr(trim($param_kwh1), 0, -1);
			$param_kwh2			= substr(trim($param_kwh2), 0, -1);

			$param_kwh_exp		= substr(trim($param_kwh_exp), 0, -1);
			$param_kwh_imp		= substr(trim($param_kwh_imp), 0, -1);

			$param_kvarh_exp	= substr(trim($param_kvarh_exp), 0, -1);
			$param_kvarh_imp	= substr(trim($param_kvarh_imp), 0, -1);

			$param_kvah			= substr(trim($param_kvah), 0, -1);
			$param_kwh			= substr(trim($param_kwh), 0, -1);

			$param_thd_v1		= substr(trim($param_thd_v1), 0, -1);
			$param_thd_v2		= substr(trim($param_thd_v2), 0, -1);
			$param_thd_v3		= substr(trim($param_thd_v3), 0, -1);

			$param_thd_i1		= substr(trim($param_thd_i1), 0, -1);
			$param_thd_i2		= substr(trim($param_thd_i2), 0, -1);
			$param_thd_i3		= substr(trim($param_thd_i3), 0, -1);

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

		// var_dump($fieldparameters);
		// die;

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

		$d['param_P1']			= $param_watt1;
		$d['param_P2']			= $param_watt2;
		$d['param_P3']			= $param_watt3;
		$d['param_P']			= $param_watt;

		$d['param_kWh_Inc1']	= $param_kwh_inc1;
		$d['param_kWh_Inc2']	= $param_kwh_inc2;
		$d['param_kWh_Inc3']	= $param_kwh_inc3;

		$d['param_kWh_Exp']		= $param_kwh_exp;
		$d['param_kWh_Imp']		= $param_kwh_imp;

		$d['param_kVArh_Exp']	= $param_kvarh_exp;
		$d['param_kVArh_Imp']	= $param_kvarh_imp;

		$d['param_kVAh']		= $param_kvah; 

		$d['param_THD_V1']		= $param_thd_v1;
		$d['param_THD_V2']		= $param_thd_v2;
		$d['param_THD_V3']		= $param_thd_v3;

		$d['param_THD_I1']		= $param_thd_i1;
		$d['param_THD_I2']		= $param_thd_i2;
		$d['param_THD_I3']		= $param_thd_i3;

		$d['param_kWh1']		= $param_kwh1;
		$d['param_kWh2']		= $param_kwh2;
		$d['param_kWh']			= $param_kwh;

		$d['param_Freq'] 		= $param_freq;

		$d['param_V1'] 			= $param_v1;
		$d['param_V2'] 			= $param_v2;
		$d['param_V3'] 			= $param_v3;

		$d['param_V12'] 		= $param_v12;
		$d['param_V23'] 		= $param_v23;
		$d['param_V31'] 		= $param_v31;

		$d['param_I1'] 			= $param_i1;
		$d['param_I2'] 			= $param_i2;
		$d['param_I3'] 			= $param_i3;
		$d['param_INet'] 		= $param_inet;

		$d['param_S1'] 			= $param_va1;
		$d['param_S2'] 			= $param_va2;
		$d['param_S3'] 			= $param_va3;
		$d['param_S'] 			= $param_va;

		$d['param_PF1'] 		= $param_pf1;
		$d['param_PF2'] 		= $param_pf2;
		$d['param_PF3'] 		= $param_pf3;

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


		$this->template->display_trend('trendperiodicmultiple', $d);
	}
}
