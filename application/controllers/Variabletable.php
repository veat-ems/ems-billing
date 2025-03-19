<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Variabletable extends CI_Controller {

	function __construct(){
		parent::__construct();	
		$this->load->model(array('model_variabletable', 'mcrud'));
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
	}
	
    public function index() {
		$d['title'] = 'VARIABLE TABLE';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';
        
		$this->template->display_table('variabletable',$d);
    }
	
	//=================
	function data_list(){
		$data=$this->model_variabletable->data_list($this->session->userdata('username'));
		echo json_encode($data);
	}
	
	public function datameter()
	{
		//$list = $this->person->get_datatables();
		$list = $this->model_variabletable->tampil()->result();
		$data = array();
		$no = 0;
		foreach ($list as $meter) {
			$no++;
			$row = array();
			
			$id_meter    = $meter->id_meter;
			$id    		 = $meter->id;
					
			//$id_counter = $this->model_variabletable->getcounter_id('counter2',$id);			
			$dtcounter = $this->model_variabletable->dt_counter2($id)->row();
			
			if($dtcounter=='' or $dtcounter==null){
			
				$row[] = $no;
				$row[] = $meter->id_name;
				$row[] = $meter->id;
				$row[] = '0000-00-00 00:00:00';
				//$row[] = $meter->com;
				//$row[] = $meter->modbus;
				//$row[] = $meter->type;
				//$row[] = 'SIMULATION';
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
				$row[] = 0;
			
			}
			else{
			
				$row[] = $no;
				$row[] = $this->mcrud->getvalue('data_meter', 'id_name', 'id', $dtcounter->id);
				$row[] = $dtcounter->id;
				$row[] = $dtcounter->date_time;
				//$row[] = $dtcounter->com;
				//$row[] = $dtcounter->modbus;
				//$row[] = $dtcounter->type;
				//$row[] = $dtcounter->status;
				$row[] = number_format($dtcounter->v1, 2);
				$row[] = number_format($dtcounter->v2, 2);
				$row[] = number_format($dtcounter->v3, 2);
				$row[] = number_format($dtcounter->v12, 2);
				$row[] = number_format($dtcounter->v23, 2);
				$row[] = number_format($dtcounter->v31, 2);
				$row[] = number_format($dtcounter->i1, 2);
				$row[] = number_format($dtcounter->i2, 2);
				$row[] = number_format($dtcounter->i3, 2);
				$row[] = number_format($dtcounter->inet, 2);
				$row[] = number_format($dtcounter->watt1, 2);
				$row[] = number_format($dtcounter->watt2, 2);
				$row[] = number_format($dtcounter->watt3, 2);
				$row[] = number_format($dtcounter->watt, 2);
				$row[] = number_format($dtcounter->va1, 2);
				$row[] = number_format($dtcounter->va2, 2);
				$row[] = number_format($dtcounter->va3, 2);
				$row[] = number_format($dtcounter->va, 2);
				$row[] = number_format($dtcounter->freq, 2);
				$row[] = number_format($dtcounter->pf1, 2);
				$row[] = number_format($dtcounter->pf2, 2);
				$row[] = number_format($dtcounter->pf3, 2);
				$row[] = number_format(($dtcounter->kwh_imp/1000), 2);
				$row[] = number_format(($dtcounter->kwh_exp/1000), 2);
				$row[] = number_format(($dtcounter->kvarh_imp/1000), 2);
				$row[] = number_format(($dtcounter->kvarh_exp/1000), 2);
				$row[] = number_format(($dtcounter->kvah/1000), 2);
				$row[] = number_format($dtcounter->thd_v1, 2);
				$row[] = number_format($dtcounter->thd_v2, 2);
				$row[] = number_format($dtcounter->thd_v3, 2);
				$row[] = number_format($dtcounter->thd_i1, 2);
				$row[] = number_format($dtcounter->thd_i2, 2);
				$row[] = number_format($dtcounter->thd_i3, 2);
			}
			
			$data[] = $row;
		}

		$output = array($data
				);
		//output to json format
		echo json_encode($data);
	}


}