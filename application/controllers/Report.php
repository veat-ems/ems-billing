<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct(){
		parent::__construct();	
		$this->load->model('model_report');
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
	}
	
    public function index() {
		$d['title'] = 'REPORT';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';
		$d['data_meter'] = $this->model_report->getdata('data_meter')->result();
		$d['parameter'] = $this->model_report->getdata('parameter')->result();
        $this->template->display('report',$d);
    }
	
	public function tampil()
	{
       
 	   	$id = $this->input->post('id');
		$parameter = $this->input->post('parameter');
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');
		$tempo = $this->input->post('tempo');
		
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
		
		//$dari = '2017-08-01';
		//$sampai = '2017-08-29';
		if($id=='All'){
			$list = $this->model_report->getdata_orderby('counter','id_counter',$dari1,$sampai1)->result();
		}
		else{
			$list = $this->model_report->getdatasort_orderby('counter',$id,'id_counter',$dari1,$sampai1)->result();
		}
		$data = array();
		$output = array();
		$no = 0;
		
		foreach ($list as $counter) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $counter->id;
			$row[] = $counter->date_time;
			$row[] = $counter->com;
			$row[] = $counter->modbus;
			$row[] = $counter->type;
			$row[] = $counter->status;
			$row[] = $counter->v1;
			$row[] = $counter->v2;
			$row[] = $counter->v3;
			$row[] = $counter->v12;
			$row[] = $counter->v23;
			$row[] = $counter->v31;
			$row[] = $counter->i1;
			$row[] = $counter->i2;
			$row[] = $counter->i3;
			$row[] = $counter->inet;
			$row[] = $counter->watt1;
			$row[] = $counter->watt2;
			$row[] = $counter->watt3;
			$row[] = $counter->watt;
			$row[] = $counter->va1;
			$row[] = $counter->va2;
			$row[] = $counter->va3;
			$row[] = $counter->va;
			$row[] = $counter->freq;
			$row[] = $counter->pf1;
			$row[] = $counter->pf2;
			$row[] = $counter->pf3;
			$row[] = $counter->kwh_imp;
			$row[] = $counter->kwh_exp;
			$row[] = $counter->kvarh_imp;
			$row[] = $counter->kvarh_exp;
			$row[] = $counter->kvah;
			$row[] = $counter->thd_v1;
			$row[] = $counter->thd_v2;
			$row[] = $counter->thd_v3;
			$row[] = $counter->thd_i1;
			$row[] = $counter->thd_i2;
			$row[] = $counter->thd_i3;			
			
			$data[] = $row;
		}
		
		//$column = '[0,3,4,7,8,9,10]';
		//$output[]['dataku'] = $data;
		//$output[]['dataku'] = $column;
		//output to json format
		echo json_encode($data);
		       
	}
	
	
	public function tampilsort()
	{
        
		$id = $this->input->post('id');
		$parameter = $this->input->post('parameter');
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');
		$tempo = $this->input->post('tempo');
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
			$dari1   = '2017-08-01';
			$sampai1 = '2018-08-30';		
		}
		
		//$list = $this->model_report->getdata_orderby('counter','id_counter')->result();
		
		if($id=='All'){
			$list = $this->model_report->getdata_orderby('counter','id_counter',$dari1,$sampai1)->result();
		}
		else{
			$list = $this->model_report->getdatasort_orderby('counter',$id,'id_counter',$dari1,$sampai1)->result();
		}
		
		
		$data = array();
		$output = array();
		$no = 0;
		
		foreach ($list as $counter) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $counter->id;
			$row[] = $counter->date_time;
			$row[] = $counter->com;
			$row[] = $counter->modbus;
			$row[] = $counter->type;
			$row[] = $counter->status;
			$row[] = $counter->v1;
			$row[] = $counter->v2;
			$row[] = $counter->v3;
			$row[] = $counter->v12;
			$row[] = $counter->v23;
			$row[] = $counter->v31;
			$row[] = $counter->i1;
			$row[] = $counter->i2;
			$row[] = $counter->i3;
			$row[] = $counter->inet;
			$row[] = $counter->watt1;
			$row[] = $counter->watt2;
			$row[] = $counter->watt3;
			$row[] = $counter->watt;
			$row[] = $counter->va1;
			$row[] = $counter->va2;
			$row[] = $counter->va3;
			$row[] = $counter->va;
			$row[] = $counter->freq;
			$row[] = $counter->pf1;
			$row[] = $counter->pf2;
			$row[] = $counter->pf3;
			$row[] = $counter->kwh_imp;
			$row[] = $counter->kwh_exp;
			$row[] = $counter->kvarh_imp;
			$row[] = $counter->kvarh_exp;
			$row[] = $counter->kvah;
			$row[] = $counter->thd_v1;
			$row[] = $counter->thd_v2;
			$row[] = $counter->thd_v3;
			$row[] = $counter->thd_i1;
			$row[] = $counter->thd_i2;
			$row[] = $counter->thd_i3;			
			
			$data[] = $row;
		}
		
		//$column = '[0,3,4,7,8,9,10]';
		//$output[]['dataku'] = $data;
		//$output[]['dataku'] = $column;
		//output to json format
		echo json_encode($data);
		       
	}


}