<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Variablegraphical extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_variablegraphical');
		if ($this->session->userdata('id_jenis_user') <> '1') {
			redirect('login');
		}
	}

	public function index()
	{
		$d['title'] = 'VARIABLE GRAPHICAL';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';
		$d['data_meter'] = $this->model_variablegraphical->getdata('data_meter', $this->session->userdata('username'))->result();
		$d['jml_meter'] = $this->model_variablegraphical->count_data('data_meter', $this->session->userdata('username'));
		$this->template->display_graphical('variablegraphical', $d);
		// Panggil Appllcation/libraries/Template.php
	}

	public function view($id)
	{
		$d['title'] = 'VARIABLE GRAPHICAL';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';
		$d['data_meter'] = $this->model_variablegraphical->getdata('data_meter', $this->session->userdata('username'))->result();
		$d['jml_meter'] = $this->model_variablegraphical->count_data('data_meter', $this->session->userdata('username'));
		$this->template->display_graphical('variablegraphical', $d);
		// $this->template->display('variablegraphicalview', $d);
		// Panggil Appllcation/libraries/Template.php
	}

	public function datameter()
	{

		$id = $this->input->post('id');

		// $id = "17. LINE 7";
		$data = array();
		$row = array();
		$dtmeter 		= $this->model_variablegraphical->dt_meter($id)->row();
		// $dtcounter 		= $this->model_variablegraphical->dt_counter2($id)->row();
		// function dt_counter_1($table, $coloum, $id_counter)
		$dtcounter 		= $this->model_variablegraphical->dt_counter_1('pg_counter_live', 'id', $id)->row();

		if ($dtcounter == '' or $dtcounter == null or !$dtcounter) {
			$row['id_counter'] = '0';
			$row['date_time']  = '..data not available...!!!';
			$row['id'] 		   = $id;
			$row['type'] 	   = $dtmeter->type;
			$row['com'] 	   = $dtmeter->com;
			$row['modbus'] 	   = $dtmeter->modbus;
			$row['status'] 	   = 'SIMULATION..';
			$row['v1'] 		   = 0;
			$row['v2'] 		   = 0;
			$row['v3'] 		   = 0;
			$row['v12'] 	   = 0;
			$row['v23'] 	   = 0;
			$row['v31'] 	   = 0;
			$row['i1'] 		   = 0;
			$row['i2'] 		   = 0;
			$row['i3'] 		   = 0;
			$row['inet'] 	   = 0;
			$row['watt1']	   = 0;
			$row['watt2'] 	   = 0;
			$row['watt3'] 	   = 0;
			$row['watt'] 	   = 0;
			$row['va1'] 	   = 0;
			$row['va2'] 	   = 0;
			$row['va3'] 	   = 0;
			$row['va'] 		   = 0;
			$row['freq'] 	   = 0;
			$row['pf1'] 	   = 0;
			$row['pf2'] 	   = 0;
			$row['pf3'] 	   = 0;
			$row['kwh_exp']    = 0;
			$row['kwh_imp']    = 0;
			$row['kvarh_exp']  = 0;
			$row['kvarh_imp']  = 0;
			$row['kvah'] 	   = 0;
			$row['thd_v1'] 	   = 0;
			$row['thd_v2'] 	   = 0;
			$row['thd_v3'] 	   = 0;
			$row['thd_i1'] 	   = 0;
			$row['thd_i2'] 	   = 0;
			$row['thd_i3'] 	   = 0;
			$row['kwh1'] 	   = 0;
			$row['kwh2'] 	   = 0;
			$row['kwh'] 	   = 0;

			$row['power'] 	   = $dtmeter->power;
			$row['v_nominal']  = $dtmeter->v_nominal;
			$row['i_nominal']  = $dtmeter->i_nominal;
		
			$data[] = $row;

		} else {
	
			$row['id_counter'] = $dtcounter->id_counter;
			$row['date_time']  = $dtcounter->date_time;
			$row['id'] 		   = $id;
			$row['type'] 	   = $dtcounter->type;
			$row['com'] 	   = $dtcounter->com;
			$row['modbus'] 	   = $dtcounter->modbus;
			$row['status'] 	   = $dtcounter->status;
			$row['v1'] 		   = $dtcounter->v1;
			$row['v2'] 		   = $dtcounter->v2;
			$row['v3'] 		   = $dtcounter->v3;
			$row['v12'] 	   = $dtcounter->v12;
			$row['v23'] 	   = $dtcounter->v23;
			$row['v31'] 	   = $dtcounter->v31;
			$row['i1'] 		   = $dtcounter->i1;
			$row['i2'] 		   = $dtcounter->i2;
			$row['i3'] 		   = $dtcounter->i3;
			$row['inet'] 	   = $dtcounter->inet;
			$row['watt1']	   = $dtcounter->watt1;
			$row['watt2'] 	   = $dtcounter->watt2;
			$row['watt3'] 	   = $dtcounter->watt3;
			$row['watt'] 	   = $dtcounter->watt / 1000;
			$row['va1'] 	   = $dtcounter->va1;
			$row['va2'] 	   = $dtcounter->va2;
			$row['va3'] 	   = $dtcounter->va3;
			$row['va'] 		   = $dtcounter->va / 1000;
			$row['freq'] 	   = $dtcounter->freq;
			$row['pf1'] 	   = $dtcounter->pf1;
			$row['pf2'] 	   = $dtcounter->pf2;
			$row['pf3'] 	   = $dtcounter->pf3;

			$var_kwh_exp		= $dtcounter->kwh_exp / 1000;
			if ($var_kwh_exp > 9999999999999) {
				$var_kwh_exp = $var_kwh_exp / 1000;
				$val_satuan_kwh_exp  = '<b>EXPORT MWh</b>';
			} else {
				$val_satuan_kwh_exp  = '<b>EXPORT kWh</b>';
			}
			$row['kwh_exp']    		= number_format($var_kwh_exp, 1);
			$row['kwh_exp_satuan']	= $val_satuan_kwh_exp;

			$var_kwh_imp		= $dtcounter->kwh_imp / 1000;
			if ($var_kwh_imp > 9999999999999) {
				$var_kwh_imp = $var_kwh_imp / 1000;
				$val_satuan_kwh_imp  = '<b>IMPORT MWh</b>';
			} else {
				$val_satuan_kwh_imp  = '<b>IMPORT kWh</b>';
			}
			$row['kwh_imp']    		= number_format($var_kwh_imp, 1);
			$row['kwh_imp_satuan']	= $val_satuan_kwh_imp;

			$var_kvarh_exp		= $dtcounter->kvarh_exp / 1000;
			if ($var_kvarh_exp > 9999999999999) {
				$var_kvarh_exp = $var_kvarh_exp / 1000;
				$val_satuan_kvarh_exp  = '<b>EXPORT MVARh</b>';
			} else {
				$val_satuan_kvarh_exp  = '<b>EXPORT kVARh</b>';
			}
			$row['kvarh_exp']    		= number_format($var_kvarh_exp, 1);
			$row['kvarh_exp_satuan']    = $val_satuan_kvarh_exp;

			$var_kvarh_imp		= $dtcounter->kvarh_imp / 1000;
			if ($var_kvarh_imp > 9999999999999) {
				$var_kvarh_imp = $var_kvarh_imp / 1000;
				$val_satuan_kvarh_imp  = '<b>IMPORT MVARh</b>';
			} else {
				$val_satuan_kvarh_imp  = '<b>IMPORT kVARh</b>';
			}
			$row['kvarh_imp']    		= number_format($var_kvarh_imp, 1);
			$row['kvarh_imp_satuan']    = $val_satuan_kvarh_imp;


			if ($dtcounter->kwh_exp == null) {
				$row['kwh_exp'] = '*';
			}
			if ($dtcounter->kwh_imp == null) {
				$row['kwh_imp'] = '*';
			}
			if ($dtcounter->kvarh_exp == null) {
				$row['kvarh_exp'] = '*';
			}
			if ($dtcounter->kvarh_imp == null) {
				$row['kvarh_imp'] = '*';
			}
			$row['kvah'] 	   = $dtcounter->kvah;
			$row['thd_v1'] 	   = $dtcounter->thd_v1;
			$row['thd_v2'] 	   = $dtcounter->thd_v2;
			$row['thd_v3'] 	   = $dtcounter->thd_v3;
			$row['thd_i1'] 	   = $dtcounter->thd_i1;
			$row['thd_i2'] 	   = $dtcounter->thd_i2;
			$row['thd_i3'] 	   = $dtcounter->thd_i3;
			$row['kwh1'] 	   = $dtcounter->kwh1;
			$row['kwh2'] 	   = $dtcounter->kwh2;
			$row['kwh'] 	   = $dtcounter->kwh;

			$row['power'] 	   = $dtmeter->p_nominal;
			$row['v_nominal']  = $dtmeter->v_nominal;
			$row['i_nominal']  = $dtmeter->i_nominal;


			$row['v1_formatted'] 		= number_format($dtcounter->v1, 1);
			$row['v2_formatted'] 		= number_format($dtcounter->v2, 1);
			$row['v3_formatted'] 		= number_format($dtcounter->v3, 1);
			$row['v12_formatted'] 	   	= number_format($dtcounter->v12, 1);
			$row['v23_formatted'] 	   	= number_format($dtcounter->v23, 1);
			$row['v31_formatted'] 	   	= number_format($dtcounter->v31, 1);
			$row['i1_formatted'] 		= number_format($dtcounter->i1, 1);
			$row['i2_formatted'] 		= number_format($dtcounter->i2, 1);
			$row['i3_formatted'] 		= number_format($dtcounter->i3, 1);

			if ($dtcounter->v1 == null) {
				$row['v1_formatted'] = '*';
				$row['v1'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->v2 == null) {
				$row['v2_formatted'] = '*';
				$row['v2'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->v3 == null) {
				$row['v3_formatted'] = '*';
				$row['v3'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->v12 == null) {
				$row['v12_formatted'] = '*';
				$row['v12'] = '0';
			}
			if ($dtcounter->v23 == null) {
				$row['v23_formatted'] = '*';
				$row['v23'] = '0';
			}
			if ($dtcounter->v31 == null) {
				$row['v31_formatted'] = '*';
				$row['v31'] = '0';
			}

			if ($dtcounter->i1 == null) {
				$row['i1_formatted'] = '*';
				$row['i1'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->i2 == null) {
				$row['i2_formatted'] = '*';
				$row['i2'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->i3 == null) {
				$row['i3_formatted'] = '*';
				$row['i3'] = '0';		// jika '*' jarum akan max
			}

			$row['inet_formatted'] 	   	= number_format($dtcounter->inet, 1);
			$row['watt1_formatted']	   	= number_format($dtcounter->watt1, 1);
			$row['watt2_formatted'] 	= number_format($dtcounter->watt2, 1);
			$row['watt3_formatted'] 	= number_format($dtcounter->watt3, 1);
			$row['watt_formatted'] 	   	= number_format($dtcounter->watt / 1000, 1);
			if ($dtcounter->watt == null) {
				$row['watt_formatted'] = '*';
				$row['watt'] = '0';		// jika '*' jarum akan max
			}
			$row['va1_formatted'] 	   	= number_format($dtcounter->va1, 1);
			$row['va2_formatted'] 	   	= number_format($dtcounter->va2, 1);
			$row['va3_formatted'] 	   	= number_format($dtcounter->va3, 1);
			$row['va_formatted'] 		= number_format($dtcounter->va / 1000, 1);
			if ($dtcounter->va == null) {
				$row['va_formatted'] = '*';
				$row['va'] = '0';		// jika '*' jarum akan max
			}
			$row['freq_formatted'] 	   	= number_format($dtcounter->freq, 1);
			$row['pf1_formatted'] 	   	= number_format($dtcounter->pf1, 2);
			$row['pf2_formatted'] 	   	= number_format($dtcounter->pf2, 2);
			$row['pf3_formatted'] 	  	= number_format($dtcounter->pf3, 2);
			if ($dtcounter->freq == null) {
				$row['freq_formatted'] = '*';
				$row['freq'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->pf1 == null) {
				$row['pf1_formatted'] = '*';
				$row['pf1'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->pf2 == null) {
				$row['pf2_formatted'] = '*';
				$row['pf2'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->pf3 == null) {
				$row['pf3_formatted'] = '*';
				$row['pf3'] = '0';		// jika '*' jarum akan max
			}
			$row['kwh_exp_formatted']   = number_format($dtcounter->kwh_exp / 1000, 1);
			$row['kwh_imp_formatted']   = number_format($dtcounter->kwh_imp / 1000, 1);
			$row['kvarh_exp_formatted'] = number_format($dtcounter->kvarh_exp / 1000, 1);
			$row['kvarh_imp_formatted'] = number_format($dtcounter->kvarh_imp / 1000, 1);
			$row['kvah_formatted'] 	   	= number_format($dtcounter->kvah, 1);
			$row['thd_v1_formatted'] 	= number_format($dtcounter->thd_v1, 1);
			$row['thd_v2_formatted'] 	= number_format($dtcounter->thd_v2, 1);
			$row['thd_v3_formatted'] 	= number_format($dtcounter->thd_v3, 1);
			$row['thd_i1_formatted'] 	= number_format($dtcounter->thd_i1, 1);
			$row['thd_i2_formatted'] 	= number_format($dtcounter->thd_i2, 1);
			$row['thd_i3_formatted'] 	= number_format($dtcounter->thd_i3, 1);
			if ($dtcounter->thd_v1 == null) {
				$row['thd_v1_formatted'] = '*';
				$row['thd_v1'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->thd_v2 == null) {
				$row['thd_v2_formatted'] = '*';
				$row['thd_v2'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->thd_v3 == null) {
				$row['thd_v3_formatted'] = '*';
				$row['thd_v3'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->thd_i1 == null) {
				$row['thd_i1_formatted'] = '*';
				$row['thd_i1'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->thd_i2 == null) {
				$row['thd_i2_formatted'] = '*';
				$row['thd_i2'] = '0';		// jika '*' jarum akan max
			}
			if ($dtcounter->thd_i3 == null) {
				$row['thd_i3_formatted'] = '*';
				$row['thd_i3'] = '0';		// jika '*' jarum akan max
			}
			$row['kwh1_formatted'] 	   	= number_format($dtcounter->kwh1, 1);
			$row['kwh2_formatted'] 	   	= number_format($dtcounter->kwh2, 1);
			$row['kwh_formatted'] 	   	= number_format($dtcounter->kwh, 1);

			// var_dump($row);
			// die;
	
			//$data[] = $dtcounter;
			$data[] = $row;
		}


		$output = array(
			$data
		);
		//output to json format
		echo json_encode($data);
	}
}
