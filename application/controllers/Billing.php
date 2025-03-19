<?php


ini_set('memory_limit', '-1');

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Billing extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_billing', 'model_meterdata', 'mcrud'));
		if ($this->session->userdata('id_jenis_user') <> '1') {
			redirect('login');
		}

		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

	public function index()
	{
		$d['title'] = 'BILLING';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';

		// init value --
		$tarif_wbp = $this->mcrud->getsetting('USAGE_TARIFF1', $this->session->userdata('username'), 'value_dec');
		$tarif_lwbp = $this->mcrud->getsetting('USAGE_TARIFF2', $this->session->userdata('username'), 'value_dec');
		

		$tarif = $this->mcrud->getsetting('USAGE_TARIFF', $this->session->userdata('username'), 'value_dec');
		$kurs = $this->mcrud->getsetting('USAGE_RATE', $this->session->userdata('username'), 'value_dec');

		$dari = date('Y-m-d');
		$dari 	= date('Y-m-01', strtotime($dari));

		$sampai = date('Y-m-d');
		$sampai = date('Y-m-t', strtotime($dari));

		$dari_time = '00:00:00';
		$sampai_time = '23:59:59';

		$d['id'] 				= '';

		$d['tarif_wbp'] 		= $tarif_wbp;
		$d['tarif_lwbp'] 		= $tarif_lwbp;
		

		$d['tarif'] 			= $tarif;
		$d['kurs'] 				= $kurs;

		$d['dari'] 				= $dari;
		$d['sampai'] 			= $sampai;

		$d['dari_time'] 		= $dari_time;
		$d['sampai_time'] 		= $sampai_time;

		// var_dump($d);
		// die();
		$meterdatas = $this->model_meterdata->getdata('data_meter', $this->session->userdata('username'))->result();
		$d['meterdatas'] = $meterdatas;

		$this->template->display_trend('billing_form', $d);
	}

	public function calculation()
	{
		$d['title'] = 'BILLING';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';


		//============== post ===========================


		$id 			= $this->input->post('id');

		$is_post 		= $this->input->post('is_post');

		$tarif_wbp 		= $this->input->post('tarif_wbp');
		$tarif_lwbp 	= $this->input->post('tarif_lwbp');
		

		$tarif 			= $this->input->post('tarif');
		$kurs 			= $this->input->post('kurs');
		$dari 			= $this->input->post('dari');
		$dari_time 		= $this->input->post('dari_time');
		$sampai 		= $this->input->post('sampai');
		$sampai_time 	= $this->input->post('sampai_time');

		$str_meter = '';
		foreach ($_POST['my-select'] as $met) {
			$str_meter .= "'" . $met . "',";
		}
		if ($str_meter != '') {
			$str_meter = substr($str_meter, 0, -1);
		}

		if ($tarif_wbp == '') {
			//$tarif = 0.23;
			$tarif = $this->mcrud->getsetting('USAGE_TARIFF1', $this->session->userdata('username'), 'value_dec');
		}

		if ($tarif_lwbp == '') {
			//$tarif = 0.23;
			$tarif = $this->mcrud->getsetting('USAGE_TARIFF2', $this->session->userdata('username'), 'value_dec');
		}

		if ($tarif == '') {
			//$tarif = 0.23;
			$tarif = $this->mcrud->getsetting('USAGE_TARIFF', $this->session->userdata('username'), 'value_dec');
		}

		if ($kurs == '') {
			//$kurs = 14000;
			$kurs = $this->mcrud->getsetting('USAGE_RATE', $this->session->userdata('username'), 'value_dec');
		}

		if ($dari == '') {
			$dari = date('Y-m-d');
			$dari 	= date('Y-m-01', strtotime($dari));
		}

		if ($sampai == '') {
			$sampai = date('Y-m-d');
			$sampai = date('Y-m-t', strtotime($dari));
		}

		if ($dari_time == '') {
			$dari_time = '00:00:00';
		}

		if ($sampai_time == '') {
			$sampai_time = '23:59:59';
		}

		//============== end post ===========================


		$d['id'] 				= $id;

		$d['tarif_wbp'] 		= $tarif_wbp;   // col kwh1
		$d['tarif_lwbp'] 		= $tarif_lwbp;  // col kwh2
		
		$d['tarif'] 			= $tarif;
		$d['kurs'] 				= $kurs;

		$d['dari'] 				= $dari;
		$d['sampai'] 			= $sampai;

		$d['dari_time'] 		= $dari_time;
		$d['sampai_time'] 		= $sampai_time;

		$d['str_meters'] 		= $str_meter;

		if ($is_post == 1) {
			$condition_tariff['settingid'] 	= 'USAGE_TARIFF';
			$condition_tariff['username'] 	= $this->session->userdata('username');
			$this->mcrud->delete($condition_tariff, 'settings');

			$condition_tariff1['settingid'] 	= 'USAGE_TARIFF1';
			$condition_tariff1['username'] 	= $this->session->userdata('username');
			$this->mcrud->delete($condition_tariff1, 'settings');

			$condition_tariff2['settingid'] 	= 'USAGE_TARIFF2';
			$condition_tariff2['username'] 	= $this->session->userdata('username');
			$this->mcrud->delete($condition_tariff2, 'settings');

			$condition_rate['settingid'] 	= 'USAGE_RATE';
			$condition_rate['username'] 	= $this->session->userdata('username');
			$this->mcrud->delete($condition_rate, 'settings');

			$val_tariff['settingid'] 	= 'USAGE_TARIFF';
			$val_tariff['username'] 	= $this->session->userdata('username');
			$val_tariff['value_dec'] 	= $tarif;
			$this->mcrud->insert($val_tariff, 'settings');

			$val_tariff1['settingid'] 	= 'USAGE_TARIFF1';
			$val_tariff1['username'] 	= $this->session->userdata('username');
			$val_tariff1['value_dec'] 	= $tarif_wbp;
			$this->mcrud->insert($val_tariff1, 'settings');


			$val_tariff2['settingid'] 	= 'USAGE_TARIFF2';
			$val_tariff2['username'] 	= $this->session->userdata('username');
			$val_tariff2['value_dec'] 	= $tarif_lwbp;
			$this->mcrud->insert($val_tariff2, 'settings');

			$val_rate['settingid'] 	= 'USAGE_RATE';
			$val_rate['username'] 	= $this->session->userdata('username');
			$val_rate['value_dec'] 	= $kurs;
			$this->mcrud->insert($val_rate, 'settings');
		}


		$var_date_from	= $dari . ' ' . $dari_time;
		$var_date_thru	= $sampai . ' ' . $sampai_time;


		//echo $str_meter;
		$tablename = 'pg_counter_min'; // tkh
		$rows 		= $this->model_billing->usagereport($var_date_from, $var_date_thru, $str_meter, $tablename)->result();
		$d['rows'] 	= $rows;
		// var_dump($d);
		// die;


		$this->template->display_table('billing', $d);

// array(20) { ["title"]=> string(7) "BILLING" ["judul"]=> string(15) "EMS Application" ["username"]=> string(10) "superadmin" ["level"]=> string(3) "ADM" ["nama"]=> string(10) "superadmin" ["email"]=> string(20) "superadmin@gmail.com" ["avatar"]=> NULL ["background"]=> NULL ["page"]=> string(5) "admin" ["id"]=> NULL ["tarif_wbp"]=> string(4) "2000" ["tarif_lwbp"]=> string(4) "1000" ["tarif"]=> string(4) "0.24" ["kurs"]=> string(5) "14001" ["dari"]=> string(10) "2021-12-11" ["sampai"]=> string(10) "2021-12-20" ["dari_time"]=> string(7) "0:00:00" ["sampai_time"]=> string(8) "23:59:59" ["str_meters"]=> string(57) "'06846532','00790608','LT_5_1','LT_5_2','LT_5_3','LT_5_4'" ["rows"]=> array(6) { [0]=> object(stdClass)#25 (13) { ["id"]=> string(8) "06846532" ["id_name"]=> string(9) "BBT 1 BP2" ["date_time_start"]=> NULL ["date_time_stop"]=> NULL ["kwh_exp_start"]=> string(1) "0" ["kwh_exp_stop"]=> string(1) "0" ["kwh_exp_usage"]=> string(1) "0" ["kwh1_start"]=> string(1) "0" ["kwh1_stop"]=> string(1) "0" ["kwh1_usage"]=> string(1) "0" ["kwh2_start"]=> string(1) "0" ["kwh2_stop"]=> string(1) "0" ["kwh2_usage"]=> string(1) "0" } [1]=> object(stdClass)#26 (13) { ["id"]=> string(8) "00790608" ["id_name"]=> string(9) "BBT 2 BP2" ["date_time_start"]=> NULL ["date_time_stop"]=> NULL ["kwh_exp_start"]=> string(1) "0" ["kwh_exp_stop"]=> string(1) "0" ["kwh_exp_usage"]=> string(1) "0" ["kwh1_start"]=> string(1) "0" ["kwh1_stop"]=> string(1) "0" ["kwh1_usage"]=> string(1) "0" ["kwh2_start"]=> string(1) "0" ["kwh2_stop"]=> string(1) "0" ["kwh2_usage"]=> string(1) "0" } [2]=> object(stdClass)#27 (13) { ["id"]=> string(6) "LT_5_1" ["id_name"]=> string(10) "NM SN LT_1" ["date_time_start"]=> NULL ["date_time_stop"]=> NULL ["kwh_exp_start"]=> string(18) "2105.9999465942383" ["kwh_exp_stop"]=> string(18) "2407.9999923706055" ["kwh_exp_usage"]=> string(17) "302.0000457763672" ["kwh1_start"]=> string(18) "2105.9999465942383" ["kwh1_stop"]=> string(18) "2407.9999923706055" ["kwh1_usage"]=> string(17) "302.0000457763672" ["kwh2_start"]=> string(1) "0" ["kwh2_stop"]=> string(1) "0" ["kwh2_usage"]=> string(1) "0" } [3]=> object(stdClass)#28 (13) { ["id"]=> string(6) "LT_5_2" ["id_name"]=> string(10) "NM SN LT_2" ["date_time_start"]=> NULL ["date_time_stop"]=> NULL ["kwh_exp_start"]=> string(17) "1917300.048828125" ["kwh_exp_stop"]=> string(17) "2203800.048828125" ["kwh_exp_usage"]=> string(16) "286500.000000000" ["kwh1_start"]=> string(17) "1915300.048828125" ["kwh1_stop"]=> string(17) "2201550.048828125" ["kwh1_usage"]=> string(16) "286250.000000000" ["kwh2_start"]=> string(4) "2000" ["kwh2_stop"]=> string(4) "2250" ["kwh2_usage"]=> string(3) "250" } [4]=> object(stdClass)#29 (13) { ["id"]=> string(6) "LT_5_3" ["id_name"]=> string(10) "NM SN LT_3" ["date_time_start"]=> NULL ["date_time_stop"]=> NULL ["kwh_exp_start"]=> string(18) "5774.0001678466797" ["kwh_exp_stop"]=> string(17) "6560.999870300293" ["kwh_exp_usage"]=> string(17) "786.9997024536133" ["kwh1_start"]=> string(18) "3902.9998779296875" ["kwh1_stop"]=> string(18) "4574.9998092651367" ["kwh1_usage"]=> string(17) "671.9999313354492" ["kwh2_start"]=> string(18) "1871.0000514984131" ["kwh2_stop"]=> string(18) "1986.0000610351563" ["kwh2_usage"]=> string(17) "115.0000095367432" } [5]=> object(stdClass)#30 (13) { ["id"]=> string(6) "LT_5_4" ["id_name"]=> string(10) "NM SN LT_4" ["date_time_start"]=> NULL ["date_time_stop"]=> NULL ["kwh_exp_start"]=> string(1) "0" ["kwh_exp_stop"]=> string(1) "0" ["kwh_exp_usage"]=> string(1) "0" ["kwh1_start"]=> string(1) "0" ["kwh1_stop"]=> string(1) "0" ["kwh1_usage"]=> string(1) "0" ["kwh2_start"]=> string(1) "0" ["kwh2_stop"]=> string(1) "0" ["kwh2_usage"]=> string(1) "0" } } }

	}


	public function xls()
	{
		$tarif_wbp 	 	= $this->input->post('tarif_wbp');
		$tarif_lwbp 	= $this->input->post('tarif_lwbp');
		$tarif 	 		= $this->input->post('tarif');
		$kurs 	 		= $this->input->post('kurs');
		$dari 	 		= $this->input->post('dari');
		$dari_time 	 	= $this->input->post('dari_time');
		$sampai 	 	= $this->input->post('sampai');
		$sampai_time	= $this->input->post('sampai_time');
		$str_meters		= $this->input->post('str_meters');

		//$var_date_from	= date('Y-m-1');
		//$var_date_thru	= date('Y-m-t');

		$var_date_from	= $dari . ' ' . $dari_time;
		$var_date_thru	= $sampai . ' ' . $sampai_time;

		$list = $this->model_billing->usagereport($var_date_from, $var_date_thru, $str_meters)->result();
		$data = array();

		$tot_usage_kwh 		= 0;
		$tot_usage_amount 	= 0;
		$no 				= 0;

		foreach ($list as $billing) {
			$no++;
			$row = array();
			$row['no'] = $no;
			$row['id'] = $billing->id;
			$row['id_name'] = $billing->id_name;
			$row['date_start'] = $billing->date_time_start;
			$row['date_stop'] = $billing->date_time_stop;

			$row['kwh_exp_start'] 	= number_format($billing->kwh_exp_start / 1000, 1);
			$row['kwh_exp_stop'] 	= number_format($billing->kwh_exp_stop / 1000, 1);
			$row['kwh_usage'] 		= number_format($billing->kwh_exp_usage / 1000, 2);
			$row['kwh_total'] 		= number_format((($billing->kwh_exp_usage / 1000) * $kurs * $tarif), 0);

			$row['kwh1_start'] 		= number_format($billing->kwh1_start / 1000, 1);
			$row['kwh1_stop'] 		= number_format($billing->kwh1_stop / 1000, 1);
			$row['kwh1_usage'] 		= number_format($billing->kwh1_usage / 1000, 2);
			$kwh1_tot				= ($billing->kwh1_usage / 1000) * $tarif_wbp;
			$row['kwh1_total'] 		= number_format($kwh1_tot, 0);

			$row['kwh2_start'] 		= number_format($billing->kwh2_start / 1000, 1);
			$row['kwh2_stop']		= number_format($billing->kwh2_stop / 1000, 1);
			$row['kwh2_usage'] 		= number_format($billing->kwh2_usage / 1000, 2);
			$kwh2_tot				= ($billing->kwh2_usage / 1000) * $tarif_lwbp;
			$row['kwh2_total'] 		= number_format($kwh2_tot, 0);

			$kwh12_totalrp	    	= $kwh1_tot + $kwh2_tot;
			$row['kwh12_totalrpF'] 	= number_format($kwh12_totalrp, 0);
			$kwh12_ppnrp			= $kwh12_totalrp * 0.1;
			$row['kwh12_ppnrpF'] 	= number_format($kwh12_ppnrp, 0);
			$kwh12_incppnrp			= $kwh12_totalrp + $kwh12_ppnrp;
			$row['kwh12_incppnrpF']	= number_format($kwh12_incppnrp, 0);



			$tot_usage_kwh 		+= $billing->kwh_exp_usage / 1000;
			$tot_usage_amount 	+= $kwh12_totalrp;

			//add html for action
			$row['action'] = '';

			$data[] = $row;
		}

		$d['data'] = json_encode($data);
		//echo json_encode($data);

		$d['title'] = 'Electricity Usage Report';
		$d['judul'] = 'EMS Application';

		$d['tot_usage_kwh'] 	= number_format($tot_usage_kwh, 2);
		$d['tot_usage_amount'] 	= number_format($tot_usage_amount, 0);
		$d['tarif']				= $tarif;
		$d['kurs']				= $kurs;

		$d['tarif_lwbp']		= $tarif_lwbp;
		$d['tarif_wbp']			= $tarif_wbp;

		$d['dari']				= $dari;
		$d['dari_time']			= $dari_time;
		$d['sampai']			= $sampai;
		$d['sampai_time']		= $sampai_time;

		// var_dump($d);
		// die();
		$this->load->view('billing_excel', $d);
	}
}
