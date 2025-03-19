<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dashboardall extends CI_Controller
{

	public $paging_row_perpage 	= 100;

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_dashboard');
		$this->load->helper('url');
		$this->load->library('pagination');

		if ($this->session->userdata('id_jenis_user') <> '1') {
			redirect('login');
		}
	}

	public function index()
	{
		$metergroupid = $this->input->post('metergroupid');
		// if ($metergroupid == "") {
		// 	redirect(site_url('dashboardall/index/0'));
		// }

		$sess_data_metergroupid['sess_metergroupid'] = $metergroupid;
		$this->session->set_userdata($sess_data_metergroupid);

		$d['title'] = 'OVERVIEW ALL METERS';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['com'] = $this->model_dashboard->count_com();
		$d['modbus'] = $this->model_dashboard->count_modbus();
		$com = $this->model_dashboard->count_com();
		$no = 1;

		$d['metergroupid'] = $metergroupid;
		$condition_metergroup['metergroupid'] = $metergroupid;
		// $d['metergrouprow'] = $this->mcrud->search($condition_metergroup, 'metergroups');

		// tkh // 	function searchall($conditions=NULL,$tablename="", $orderbyfield=NULL, $orderbytype=NULL,$limit=0,$offset=0)
		$result = $this->mcrud->search($condition_metergroup, 'metergroups'); // tkh get metergroupname
		$d['metergroupname'] = $result;
		$result = $this->mcrud->searchall_row($condition_metergroup, 'pg_counter_min_metergroups', 'date_time', 'asc', 1, 0);
		$d['metergrouprow'] = $result;
		// var_dump($result);
		// die;
		// $d['metergrouprow'] = $result->row();
		// var_dump($d);
		// die;

		$val_uri3 = $this->uri->segment(3);
		if ($val_uri3 == "" or !is_numeric($val_uri3)) {
			redirect(site_url('dashboardall/index/0'));
		}

		while ($no <= $com) {
			$data_urut = 'data_' . $no;
			$d[$data_urut] = $this->model_dashboard->filter_dashboard('com', $no, 'data_meter')->result();
			$no++;
		}

		$d['meter'] = $this->model_dashboard->tampil()->result();
		$d['page'] = 'admin';

		//=============================

		$config['base_url'] 	= site_url('dashboardall/index'); //site url
		//$config['total_rows'] 	= $this->db->count_all('data_meter'); //total row
		// $config['total_rows'] 	= $this->model_dashboard->count_rows('data_meter', $this->session->userdata('username'), $metergroupid); //total row
		// All tkh
		$config['total_rows'] 	= $this->model_dashboard->count_rows('data_meter', $this->session->userdata('username')); //total row

		$config['per_page'] 	= $this->paging_row_perpage;  //show record per halaman
		$config["uri_segment"] 	= 3;  // uri parameter
		$choice 				= $config["total_rows"] / $config["per_page"];
		$config["num_links"] 	= floor(3);

		// Membuat Style pagination untuk BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="float-right" ><nav><ul class="pagination" style="text-align:right;">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$d['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		//panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
		// $d['data_meter_paging'] = $this->model_dashboard->get_data_meter_paging_list($config["per_page"], $d['page'], $this->session->userdata('username'), $metergroupid)->result();
		// All tkh
		$d['data_meter_paging'] = $this->model_dashboard->get_data_meter_paging_list($config["per_page"], $d['page'], $this->session->userdata('username'))->result();

		$d['pagination'] = $this->pagination->create_links();
		// var_dump($d);
		// die;

		//=============================
		$this->template->display('dashboardall', $d);
	}

	public function datameter($val_page = 0)  //  pg_counter_live
	{
		// var_dump($val_page);		
		// die;
		$metergroupid = $this->session->userdata('sess_metergroupid');
		//$list = $this->model_dashboard->tampil()->result();
		$list = $this->model_dashboard->get_data_meter_paging_list($this->paging_row_perpage, $val_page, $this->session->userdata('username'), $metergroupid)->result();
		$data = array();
		$no = 0;
		foreach ($list as $meter) {
			$no++;
			// $id_meter    = $meter->id_meter;
			$id			= $meter->id;
			$id_counter = $this->model_dashboard->getcounter_id('pg_counter_live', $id);
			// var_dump($id_counter); // die;			
			if ($id_counter != null) {
				$dtcounter = $this->model_dashboard->dt_counter_formatted('pg_counter_live', 'id_counter', $id_counter)->row();
			} else {
				$dtcounter = '';
			}


			// if ($meter->id == 'COM2_3'){
			// 	var_dump($dtcounter);		
			// 	die;
			// }
			// if ($meter->id == 'COM2_1'){
			// var_dump($dtcounter);		
			// //die;
			// }

			$row = array();
			$row['id_meter'] = $meter->id_meter;
			$row['id'] = $meter->id;
			if ($dtcounter == '' or $dtcounter == null) {
				$row['variable0'] 	= null;
				$row['variable1'] 	= null;
				$row['variable2'] 	= null;
				$row['variable3']  	= null;
				$row['variable4']  	= null;
				$row['date_time']  	= null;
			} else { // tkh
				// --$reactive_power 	= sqrt(abs(($dtcounter->va * $dtcounter->va) - ($dtcounter->watt * $dtcounter->watt)));
				// $row['variable0'] 	= $dtcounter->kwh_exp / 1000; 	//col_db kwh_exp	// var val_variable0	= obj.variable0;    // active energy	// tkh 
				// $row['variable1'] 	= $dtcounter->va2 / 1000;		//col_db va2		// var val_variable1 	= obj.variable1;	// maximum demand
				// $row['variable2'] 	= $dtcounter->watt / 1000;		//col_db watt		// var val_variable2 	= obj.variable2;	// average demand
				// $row['variable3'] 	= $dtcounter->va / 1000;		//col_db va			// var val_variable3 	= obj.variable3;	// apparent power
				// $row['variable4']   = $dtcounter->va3  / 1000;		//col_db va3		// var val_variable4 	= obj.variable4; 	// reactive
				// $row['date_time']  	= $dtcounter->date_time;		//  pf -- kvah

				//billing
				//$d['tarif_wbp'] 		= $tarif_wbp;   // col kwh1
				//$d['tarif_lwbp'] 		= $tarif_lwbp;  // col kwh2

				// variable0 => <td width="35%" class="tdnm">TOTAL</td>
				// penyesuaian binding baru full variabel
				if ($dtcounter->kwh == null) {
					if ($dtcounter->kwh_exp == null) {
						$row['variable0'] 		= null;
					} else {
						$row['variable0'] 		= $dtcounter->kwh_exp / 1000;
					}
				} else {
					$row['variable0'] 		= $dtcounter->kwh / 1000;
				}
				// variable1 => <td width="35%" class="tdnm">WBP</td>
				// if($dtcounter->kwh1 == null) {
				// 	$row['variable1'] 		= null;
				// } else {
				// 	$row['variable1'] 		= $dtcounter->kwh1/ 1000;

				// }
				// // variable2 => <td class="tdnm">LWBP</td>
				// if($dtcounter->kwh2 == null) {
				// 	$row['variable2'] 		= null;
				// } else {
				// 	$row['variable2'] 		= $dtcounter->kwh2/ 1000;
				// }

				// format grp
				if ($dtcounter->v2 == null) {
					if ($dtcounter->v1 == null) {
						$row['variable1'] 		= null;
					} else {
						$row['variable1'] 		= $dtcounter->v1 / 1; // bagi 1 biar jadi number
					}
				} else {
					$v_avg = ($dtcounter->v1 + $dtcounter->v2 + $dtcounter->v3) / 3;
					$row['variable1'] 		= $v_avg;
				}

				if ($dtcounter->i2 == null) {
					if ($dtcounter->i1 == null) {
						$row['variable2'] 		= null;
					} else {
						$row['variable2'] 		= $dtcounter->i1 / 1;
					}
				} else {

					$i_avg = ($dtcounter->i1 + $dtcounter->i2 + $dtcounter->i3) / 3;
					$row['variable2'] 		= $i_avg;
				}

				if ($dtcounter->va == null) {
					$row['variable3'] 		= null;
				} else {
					$row['variable3'] 		= $dtcounter->va / 1;
				}

				if ($dtcounter->watt == null) {
					$row['variable4'] 		= null;
				} else {
					$row['variable4'] 		= $dtcounter->watt / 1;
				}

				if ($dtcounter->date_time == null) {
					$row['date_time'] 		= null;
				} else {
					$row['date_time'] 		= $dtcounter->date_time;
				}
			}		// var_dump($row);

			$data[] = $row;
		}

		// $output = array($data); //output to array
		// var_dump($data); // die;
		echo json_encode($data); //output to json format
	}
}
