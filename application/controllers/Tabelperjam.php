<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabelperjam extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model(array('model_tabelperjam', 'model_trend', 'mcrud'));
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
	}
	
    public function index() {
		$d['title'] = 'TABEL PER JAM';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';	
		$d['data_meter'] = $this->model_tabelperjam->getdata('data_meter', $this->session->userdata('username'))->result();
		$d['parameter'] = $this->model_tabelperjam->getdata_all('parameter')->result();
		
		$id 		= $this->input->post('meterid');
		$dari 	 	= $this->input->post('dari');

		//--exception
		if ($id == '') {
			//$conditions_min['active'] = 1;
			$conditions_min = "(metergroupid in (select metergroupid from usermetergroups where username = '" . $this->session->userdata('username') . "' ))";
			$id = $this->model_trend->searchmin('data_meter', 'id', $conditions_min);
		}
		$id_name		= $this->mcrud->getvalue('data_meter', 'id_name', 'id', $id);
		
		if ($dari == '' or $dari == '0000-00-00') {
			$dari = date('Y-m-d');
		}
		
		$d['id'] 				= $id;
		$d['dari'] 				= $dari;
		
        $this->template->display_table('tabelperjam',$d);
    }
	
	
	public function datameter_horizontal()
	{
	 	$id 	 = $this->input->post('id');
		// $id		 = 'ALL';
		$tanggal = $this->input->post('tanggal');
		
		if($id=='ALL'){
			$list = $this->model_tabelperjam->tampil()->result();
			$data = array();
			$no = 0;
			foreach ($list as $meter) {
    			$row = array();
				
				$id_meter   = $meter->id_meter;
    			$panel  	= $meter->id_name;
			
    			$row[] = $panel;
        		$row[] = $tanggal;
        		
        		$no = 0;
            	while($no<24){
            	   if($no<10){
            	   		$nj = '0'.$no;
            	   }
            	   else{
            	   		$nj = $no;
            	   }
            	   
        		   $list = $this->model_tabelperjam->id_jam($panel, $tanggal, $nj)->result();
        		   
        		   
        		   if($list=='' or $list==null){
        		   		$row[] = '0';
        		   }
        		   else{
        		   		$dtku  = $this->model_tabelperjam->data_jam($panel, $tanggal, $nj)->row();
        				$row[] = number_format(($dtku->kwh_exp / 1000), 2);
        		   }
        		   
            	   $no++;
            	
            	}	
			
				$data[] = $row;
				
				
			}
		
			echo json_encode($data);
		
		 }
		 
		else{
		
    	   	$row[] = $this->mcrud->getvalue('data_meter', 'id_name', 'id', $id);
    		$row[] = $tanggal;
    		
    		$no = 0;
        	while($no<24){
        	   if($no<10){
        	   		$nj = '0'.$no;
        	   }
        	   else{
        	   		$nj = $no;
        	   }
        	   
    		   $list = $this->model_tabelperjam->id_jam($id, $tanggal, $nj)->result();
    		   
    		   
    		   if($list=='' or $list==null){
    		   		$row[] = '0';
    		   }
    		   else{
    		   		$dtku  = $this->model_tabelperjam->data_jam($id, $tanggal, $nj)->row();
    				$row[] = number_format(($dtku->kwh_exp / 1000), 2);
    		   }
    		   
        	   $no++;
        	
        	}	
    				
    		$data[] = $row;
    		echo json_encode($data);
		
		 }
	}
	
	
	public function datameter()
	{
	 	//$id 	= $this->input->post('id');
		//$id	= 'ALL';
		//$id 	= 'COM10_1';
		
		$id 	 = $this->input->post('meterid2');
		$tanggal = $this->input->post('dari');
		
		//$id 	 = 'LP_100_1';
		//$tanggal = '2021-08-21';
		
		if($id=='ALL'){
			$list = $this->model_tabelperjam->tampil()->result();
			$data = array();
			$no = 0;
			foreach ($list as $meter) {
    			$row = array();
				
				$id_meter   = $meter->id_meter;
    			$panel  	= $meter->id_name;
			
    			$row[] = $panel;
        		$row[] = $tanggal;
        		
        		$no = 0;
            	while($no<24){
            	   if($no<10){
            	   		$nj = '0'.$no;
            	   }
            	   else{
            	   		$nj = '"' . $no . '"';
            	   }
            	   
        		   $list = $this->model_tabelperjam->id_jam($panel, $tanggal, $nj)->result();
        		   
        		   
        		   if($list=='' or $list==null){
        		   		$row[] = '0';
        		   }
        		   else{
        		   		$dtku  = $this->model_tabelperjam->data_jam($panel, $tanggal, $nj)->row();
        				$row[] = number_format(($dtku->kwh_exp / 1000), 2);
        		   }
        		   
            	   $no++;
            	
            	}	
			
				$data[] = $row;
				
				
			}
		
			echo json_encode($data);
		
		 }
		 
		else{
		
    	   	
    		
    		$no = 0;
        	while($no<24){
				$row = array();
				
        	   if($no<10){
        	   		$nj = '0'.$no;
        	   }
        	   else{
        	   		$nj = $no;
        	   }

        	   	$row[] = $this->mcrud->getvalue('data_meter', 'id_name', 'id', $id);;
	    		$row[] = $tanggal;
				$row[] = $nj;
	
    		   $list = $this->model_tabelperjam->id_jam($id, $tanggal, $nj)->result();
    		   
    		   if($list=='' or $list==null){
    		   		$row[] = '0';
    		   }
    		   else{
    		   		$dtku  = $this->model_tabelperjam->data_jam($id, $tanggal, $nj)->row();
    				$row[] = number_format(($dtku->kwh_exp / 1000), 2);
    		   }
    		   
        	   $no++;
        	
				$data[] = $row;
        	}	
    				
    		
    		echo json_encode($data);
		
		 }
	}
	
	public function printexcel()
	{
	 	$id 	 = $this->input->post('meterid');
		$tanggal = $this->input->post('tanggal');
		
		// $id		 = 'ALL';
		// $tanggal = '2018-05-22';
		
		if($id=='ALL'){
			$list = $this->model_tabelperjam->tampil()->result();
			$data = array();
			$no = 0;
			foreach ($list as $meter) {
    			$row = array();
				
				$id_meter   = $meter->id_meter;
    			$panel  	= $meter->id_name;
			
    			$row['panel'] = $panel;
        		$row['tanggal'] = $tanggal;
        		
        		$no = 0;
            	while($no<24){
            	   if($no<10){
            	   		$nj = '0'.$no;
            	   }
            	   else{
            	   		$nj = $no;
            	   }
            	   
        		   $list = $this->model_tabelperjam->id_jam($panel, $tanggal, $nj)->result();
        		   
        		   
        		   if($list=='' or $list==null){
        		   		$row['a'.$nj] = '0';
        		   }
        		   else{
        		   		$dtku  = $this->model_tabelperjam->data_jam($panel, $tanggal, $nj)->row();
        				$row['a'.$nj] = number_format(($dtku->kwh_exp / 1000), 2);
        		   }
        		   
            	   $no++;
            	
            	}	
			
				$data[] = $row;
				
				
			}
		
			$d['data'] = json_encode($data);
			// echo json_encode($data);
		
		 }
		 
		else{
		
    		
    		$no = 0;
        	while($no<24){
				$row = array();
				
        	   if($no<10){
        	   		$nj = '0'.$no;
        	   }
        	   else{
        	   		$nj = $no;
        	   }

        	   	$row['panel'] = $this->mcrud->getvalue('data_meter', 'id_name', 'id', $id);
	    		$row['tanggal'] = $tanggal;
				$row['jam'] = $nj;
	
    		   $list = $this->model_tabelperjam->id_jam($id, $tanggal, $nj)->result();
    		   
    		   if($list=='' or $list==null){
    		   		$row['kwh'] = '0';
    		   }
    		   else{
    		   		$dtku  = $this->model_tabelperjam->data_jam($id, $tanggal, $nj)->row();
    				$row['kwh'] = number_format(($dtku->kwh_exp / 1000), 2);
    		   }
    		   
        	   $no++;
        	
				$data[] = $row;
        	}

    		$d['data'] = json_encode($data);
			//echo json_encode($data);
		
		
		 }
		
		
		$d['title'] = 'Data Kwh Per Jam';
		$d['judul'] = 'EMS Application';
		$d['tanggal'] = tgl_indolengkap($tanggal);
		$this->load->view('tabeljam_excel', $d);
	
	}
	
	
	
	public function ajax_list()
	{
		$tarif 	 		= $this->input->post('tarif');
		$kurs 	 		= $this->input->post('kurs');
		$dari 	 		= $this->input->post('dari');
		$dari_time 	 	= $this->input->post('dari_time');
		$sampai 	 	= $this->input->post('sampai');
		$sampai_time	= $this->input->post('sampai_time');
		
		//$var_date_from	= date('Y-m-1');
		//$var_date_thru	= date('Y-m-t');

		$var_date_from	= $dari . ' ' . $dari_time;
		$var_date_thru	= $sampai . ' ' . $sampai_time;
		
		$list = $this->model_billing->usagereport($var_date_from, $var_date_thru)->result();
		$data = array();
		$no = 0;
		foreach ($list as $billing) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $billing->id;
			$row[] = $billing->date_time_start;
			$row[] = $billing->date_time_stop;
			$row[] = number_format($billing->kwh_exp_start/1000, 2);
			$row[] = number_format($billing->kwh_exp_stop/1000, 2);
			$row[] = number_format($billing->kwh_exp_usage/1000, 2);
			$row[] = number_format( (($billing->kwh_exp_usage/1000) * $kurs * $tarif), 2);
			

			//add html for action
			$row[] = '';
		
			$data[] = $row;
		}

		$output = array($data
				);
		//output to json format
		echo json_encode($data);
	}


}