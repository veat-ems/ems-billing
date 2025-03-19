<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboardgroup extends CI_Controller {

	public $paging_row_perpage 	= 500;
	
	function __construct(){
		parent::__construct();	
		$this->load->model('model_dashboard');
		$this->load->helper('url');
       $this->load->library('pagination');
		
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
	}
	
    public function index() {
		
		$d['title'] = 'OVERVIEW BY GROUP';
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
		
		$val_uri3 = $this->uri->segment(3);
		if ($val_uri3 == "" or !is_numeric($val_uri3)) {
			redirect(site_url('dashboardgroup/index/0')); 
		} 
		
		while($no<=$com){
			$data_urut = 'data_'.$no;
			$d[$data_urut] = $this->model_dashboard->filter_dashboard('com',$no,'data_meter')->result();
			$no++;
		
		}
		
		$d['meter'] = $this->model_dashboard->tampil()->result();
		$d['page'] = 'admin';
		
		//=============================
		
		$config['base_url'] 	= site_url('dashboardgroup/index'); //site url
		//$config['total_rows'] 	= $this->db->count_all('data_meter'); //total row
		$config['total_rows'] 	= $this->model_dashboard->count_rows('metergroups', $this->session->userdata('username')); //total row
        $config['per_page'] 	= 500; //$this->paging_row_perpage;  //show record per halaman
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
        $d['data_meter_paging'] = $this->model_dashboard->get_data_metergroup_paging_list($config["per_page"], $d['page'], $this->session->userdata('username'))->result();        

        $d['pagination'] = $this->pagination->create_links();
		
		//=============================
		
		
        $this->template->display('dashboardgroup',$d);
    }
	
    public function meter() {
		$d['title'] = 'DASHBOARD';
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
		
		$val_uri3 = $this->uri->segment(3);
		if ($val_uri3 == "" or !is_numeric($val_uri3)) {
			redirect(site_url('dashboardgroup/meter/0')); 
		} 
		
		while($no<=$com){
			$data_urut = 'data_'.$no;
			$d[$data_urut] = $this->model_dashboard->filter_dashboard('com',$no,'data_meter')->result();
			$no++;
		
		}
		
		$d['meter'] = $this->model_dashboard->tampil()->result();
		$d['page'] = 'admin';
		
		//=============================
		
		$config['base_url'] 	= site_url('dashboardgroup/meter'); //site url
		//$config['total_rows'] 	= $this->db->count_all('data_meter'); //total row
		$config['total_rows'] 	= $this->model_dashboard->count_rows('data_meter', $this->session->userdata('username')); //total row
        $config['per_page'] 	= 500;//$this->paging_row_perpage;  //show record per halaman
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
        $d['data_meter_paging'] = $this->model_dashboard->get_data_meter_paging_list($config["per_page"], $d['page'], $this->session->userdata('username'))->result();        

        $d['pagination'] = $this->pagination->create_links();
		
		//=============================
		
		
        $this->template->display('dashboardgroupmeter',$d);
    }
	

	public function datameter($val_page=0)
	{
		$list = $this->model_dashboard->get_data_metergroup_paging_list($this->paging_row_perpage, $val_page, $this->session->userdata('username'))->result();
		$data = array();
		$no = 0;

		foreach ($list as $metergroup) {
			$no++;
			$row = array();
			
			$metergroupid    = $metergroup->metergroupid;
					
			// $dtcounter = $this->model_dashboard->dt_counter_group_formatted('metergroups', $metergroupid)->row();
			$dtcounter = $this->model_dashboard->dt_counter_formatted('pg_counter_min_metergroups', 'metergroupid', $metergroupid)->row();// tkh

			$row['metergroupid'] = $metergroup->metergroupid;
			
			if($dtcounter=='' or $dtcounter==null){
				// $row['active_energy'] 		= '';
				// $row['maximum_demand'] 		= '';
				// $row['average_demand']  	= '';
				// $row['apparent_power']  	= '';
				// $row['reactive_power']  	= '';
				// $row['date_time']  			= '';
				$row['active_energy'] 		= null;
				$row['maximum_demand'] 		= null;
				$row['average_demand']  	= null;
				$row['apparent_power']  	= null;
				$row['reactive_power']  	= null;
				$row['date_time']  			= null;
			}
			else{
				// $row['active_energy'] 		= $dtcounter->active_energy / 1000;
				// $row['maximum_demand'] 		= $dtcounter->maximum_demand / 1000;
				// $row['average_demand']  	= $dtcounter->average_demand / 1000;
				// $row['apparent_power']  	= $dtcounter->apparent_power / 1000;
				// $row['reactive_power']  	= $dtcounter->reactive_power / 1000;
				// $row['date_time']  			= $dtcounter->date_time;

				
				if($dtcounter->active_energy == null) {
					$row['active_energy'] 		= null;
				} else {
					$row['active_energy'] 		= $dtcounter->active_energy/ 1000;
				}

				if($dtcounter->maximum_demand == null) {
					$row['maximum_demand'] 		= null;
				} else {
					$row['maximum_demand'] 		= $dtcounter->maximum_demand/ 1000;
				}

				if($dtcounter->average_demand == null) {
					$row['average_demand'] 		= null;
				} else {
					$row['average_demand'] 		= $dtcounter->average_demand/ 1000;
				}

				if($dtcounter->apparent_power == null) {
					$row['apparent_power'] 		= null;
				} else {
					$row['apparent_power'] 		= $dtcounter->apparent_power/ 1000;
				}

				if($dtcounter->reactive_power == null) {
					$row['reactive_power'] 		= null;
				} else {
					$row['reactive_power'] 		= $dtcounter->reactive_power/ 1000;
				}

				if($dtcounter->date_time == null) {
					$row['date_time'] 		= null;
				} else {
					$row['date_time'] 		= $dtcounter->date_time;
				}
			}

			$data[] = $row;
		}

		$output = array($data);
		//output to json format
		// var_dump($data);
		// die;
		echo json_encode($data);

	}




}