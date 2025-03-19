<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $paging_row_perpage 	= 100;
	
	function __construct(){
		parent::__construct();	
		$this->load->model(array('model_dashboard', 'mcrud'));
		$this->load->helper('url');
       $this->load->library('pagination');
		
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
	}
	
    public function index() {
		$metergroupid = $this->input->post('metergroupid');
		if ($metergroupid == "") {
			redirect(site_url('dashboardgroup/index/0')); 
		}
		
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
		
		$d['metergroupid'] = $metergroupid;
		$condition_metergroup['metergroupid'] = $metergroupid;
		$d['metergrouprow'] = $this->mcrud->search($condition_metergroup, 'metergroups');
		
		$val_uri3 = $this->uri->segment(3);
		if ($val_uri3 == "" or !is_numeric($val_uri3)) {
			redirect(site_url('dashboard/index/0/')); 
		} 
		
		while($no<=$com){
			$data_urut = 'data_'.$no;
			$d[$data_urut] = $this->model_dashboard->filter_dashboard('com',$no,'data_meter')->result();
			$no++;
		
		}
		
		$d['meter'] = $this->model_dashboard->tampil($metergroupid)->result();
		$d['page'] = 'admin';
		
		//=============================
		
		$config['base_url'] 	= site_url('dashboard/index'); //site url
		//$config['total_rows'] 	= $this->db->count_all('data_meter'); //total row
		$config['total_rows'] 	= $this->model_dashboard->count_rows('data_meter', $this->session->userdata('username'), $metergroupid); //total row
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
        $d['data_meter_paging'] = $this->model_dashboard->get_data_meter_paging_list($config["per_page"], $d['page'], $this->session->userdata('username'), $metergroupid)->result();        

        $d['pagination'] = $this->pagination->create_links();
		
		//=============================
		
		
        $this->template->display('dashboard',$d);
    }
	
	public function datameter($val_page=0)
	{

		//$list = $this->model_dashboard->tampil()->result();
		$list = $this->model_dashboard->get_data_meter_paging_list($this->paging_row_perpage, $val_page, $this->session->userdata('username'))->result();
		$data = array();
		$no = 0;
		foreach ($list as $meter) {
			$no++;
			$row = array();
			
			$id_meter    = $meter->id_meter;
			$id    		 = $meter->id;
					
			//$id_counter = $this->model_dashboard->getcounter_id('counter_transit',$id);
			$id_counter = $this->model_dashboard->getcounter_id('counter_live',$id);				
			//$dtcounter = $this->model_dashboard->dt_counter_formatted('counter_transit', $id_counter)->row();
			$dtcounter = $this->model_dashboard->dt_counter_formatted('counter_live', $id_counter)->row();
			
			$row['id_meter'] = $meter->id_meter;
			$row['id'] = $meter->id;
			if($dtcounter=='' or $dtcounter==null){
				$row['kwh1'] = 0;
				$row['kwh2'] = 0;
				$row['kwh']  = 0;
				$row['date_time']  = '';
			}
			else{
				$row['kwh1'] = $dtcounter->kwh1;
				$row['kwh2'] = $dtcounter->kwh2;
				$row['kwh']  = $dtcounter->kwh_exp; // FIELD SOURCE ADA DI SINI
				$row['date_time']  = $dtcounter->date_time;
			}
			
			$data[] = $row;
		}

		$output = array($data
				);
		//output to json format
		echo json_encode($data);
	}




}