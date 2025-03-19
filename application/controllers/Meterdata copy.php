<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Meterdata extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('model_meterdata');
		$this->load->library('form_validation');		
        $this->load->library('upload');
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
	}
	
    public function index() {
		$d['title'] = 'METER DATA';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';
		
        $this->template->display_table('meterdata',$d);
    }
	
	//=================
	function data_list(){
		$data=$this->model_meterdata->data_list($this->session->userdata('username'), $this->session->userdata('level'));
		
		echo json_encode($data);
		
	}
		
	public function delete($id_meter)
	{
		if ($this->session->userdata('level') <> "ADM") {
			redirect(site_url('meterdata')); 
		}
		
        $where = array(
			   'id_meter' => $id_meter
		);
		
		$data = $this->model_meterdata->formdata($id_meter);
		
		$this->model_meterdata->delete($where,'data_meter');
		
		$datalog = $this->session->userdata('nama').' menghapus data Meter Data dengan ID : '.$data->id;
		helper_log("delete", $datalog);
		redirect(site_url('meterdata'));       
	}
	
    public function create() {
		if ($this->session->userdata('level') <> "ADM") {
			redirect(site_url('meterdata')); 
		}
		
		$d['title'] = 'CREATE METER DATA';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';
		$d['com'] = '';//$this->model_meterdata->getdata('com')->result();
		$d['modbus'] = '';//$this->model_meterdata->getdata('modbus')->result();	
		
		$d['metergroupid'] = '';
		$d['id'] = '';
		// $d['data_metergroup'] = $this->model_meterdata->getdata('metergroups')->result();
		$d['data_metergroup'] = $this->model_meterdata->getdata_all('metergroups')->result();
		$d['data_id'] = $this->model_meterdata->getlistfree_id('pg_counter_live');

		$this->form_validation->set_rules('id','ID METER','trim|required');
		$this->form_validation->set_rules('id_serial','Meter SN','required');
		$this->form_validation->set_rules('id_name','Meter Name','required');
		$this->form_validation->set_rules('metergroupid','Meter Group ID','trim|required');
		$this->form_validation->set_rules('type','Meter Type','trim|required');
		$this->form_validation->set_rules('v_nominal','V Nominal','trim|required');
		$this->form_validation->set_rules('i_nominal','I Nominal','trim|required');
		$this->form_validation->set_rules('p_nominal','POWER','trim|required');

		if($this->form_validation->run() != false) {
			// $id_meter 		= $this->input->post('id_meter');
			$id_meter		= $this->model_meterdata->get_id();
			$id 	 		= $this->input->post('id'); // di Form as Meter ID      
			$id_serial  	= $this->input->post('id_serial');
			$id_name  		= $this->input->post('id_name');
			$metergroupid  	= $this->input->post('metergroupid');
			$com 	  		= 1;
			$modbus   		= 1;
			$type 	  		= $this->input->post('type');
			$v_nominal 		= $this->input->post('v_nominal');
			$i_nominal  	= $this->input->post('i_nominal');
			$p_nominal    	= $this->input->post('p_nominal');
			$is_active 		= 1;
			$f_kali 		= 1;
			$lokasi    		= $this->input->post('lokasi');


			// Default Value when Created Data Meter
			$alarm_to_high_limit	= 15;
			$alarm_vt_low_limit		= 120;
			$alarm_vt_high_limit	= 80;
			$alarm_uc_high_limit	= 80;
			$alarm_oc_high_limit	= 150;
			$alarm_pf_low_limit		= 0.8;
			$alarm_hv_high_limit	= 10;
			$alarm_hc_high_limit	= 35;
			$alarm_to_yesno			= 1;
			$alarm_vt_yesno			= 1;
			$alarm_uc_yesno			= 1;
			$alarm_oc_yesno			= 1;
			$alarm_pf_yesno			= 1;
			$alarm_rp_yesno			= 1;
			$alarm_hv_yesno			= 1;
			$alarm_hc_yesno			= 1;

			$frontpicture			= 'front_1.jpg';
			$backpicture			= 'back_1.jpg';
			

			$data = array(
				'id_meter' 				=> $id_meter, 	//
				'id' 					=> $id,			//
				'id_serial' 			=> $id_serial,
				'id_name' 				=> $id_name,
				'metergroupid' 			=> $metergroupid,
				'lokasi'				=> $lokasi,
				'com' 					=> $com,
				'modbus' 				=> $modbus,
				'type' 					=> $type,
				'is_active'				=> $is_active,
				'f_kali'				=> $f_kali,
				'v_nominal'				=> $v_nominal,
				'i_nominal'				=> $i_nominal,
				'p_nominal'				=> $p_nominal,
				'alarm_to_high_limit' 	=> $alarm_to_high_limit,
				'alarm_vt_low_limit' 	=> $alarm_vt_low_limit,
				'alarm_vt_high_limit' 	=> $alarm_vt_high_limit,
				'alarm_uc_high_limit' 	=> $alarm_uc_high_limit,
				'alarm_oc_high_limit' 	=> $alarm_oc_high_limit,
				'alarm_pf_low_limit' 	=> $alarm_pf_low_limit,
				'alarm_hv_high_limit' 	=> $alarm_hv_high_limit,
				'alarm_hc_high_limit' 	=> $alarm_hc_high_limit,
				'alarm_to_yesno' 		=> $alarm_to_yesno,
				'alarm_vt_yesno' 		=> $alarm_vt_yesno,
				'alarm_uc_yesno' 		=> $alarm_uc_yesno,
				'alarm_oc_yesno' 		=> $alarm_oc_yesno,
				'alarm_pf_yesno' 		=> $alarm_pf_yesno,
				'alarm_rp_yesno' 		=> $alarm_rp_yesno,
				'alarm_hv_yesno' 		=> $alarm_hv_yesno,
				'alarm_hc_yesno' 		=> $alarm_hc_yesno,
				'frontpicture'			=> $frontpicture,
				'backpicture'			=> $backpicture
			);
			// var_dump($data);
			// print_r($data); 
			// die;

			$cek = $this->model_meterdata->cek_id($id);
				if($cek->num_rows() >= 1)
				{
				$this->session->set_flashdata('pesan', 'Maaf, ID sudah ADA, silahkan ganti dengan yang lain.');
				$this->template->display('meterdata_create',$d);
				}
				else{ 
					
					$cekcm = $this->model_meterdata->cek_cm($com,$modbus);
					//if($cekcm->num_rows() >= 1)
					if($cekcm->num_rows() == -999)
					{
						$this->session->set_flashdata('pesan', 'Maaf, Kombinasi COM dan MODBUS sudah digunakan, silahkan ganti dengan yang lain.');
						$this->template->display('meterdata_create',$d);	
					}
					else{
						$this->model_meterdata->created_meterdata($data,'data_meter');
						
						$datalog = $this->session->userdata('nama').' menambahkan data meterdata  dengan ID :'.$id;
						helper_log("add", $datalog);
					
						redirect(site_url('meterdata')); 
					}
				}
		}else{
			$this->template->display_form('meterdata_create',$d);
		}
		
		
    }
	
	
    public function edit($id_meter, $random=false) {
		$d['title'] = 'EDIT METER DATA';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';
		$d['com'] = $this->model_meterdata->getdata_all('com')->result();
		$d['modbus'] = $this->model_meterdata->getdata_all('modbus')->result();		
		
		$d['random'] = $random;	
		
		$d['data_metergroup'] = $this->model_meterdata->getdata_all('metergroups')->result();
		$d['data_form'] = $this->model_meterdata->formdata($id_meter)->row();	// id
		
		$this->form_validation->set_rules('id','ID METER','trim|required');
		$this->form_validation->set_rules('id_serial','Meter SN','required');
		$this->form_validation->set_rules('id_name','Meter Name','required');
		$this->form_validation->set_rules('metergroupid','Meter Group ID','trim|required');
		$this->form_validation->set_rules('type','Meter Type','trim|required');
		$this->form_validation->set_rules('v_nominal','V Nominal','trim|required');
		$this->form_validation->set_rules('i_nominal','I Nominal','trim|required');
		$this->form_validation->set_rules('p_nominal','POWER','trim|required');
		
		if($this->form_validation->run() != false){
			
			if ($this->session->userdata('level') <> "ADM") {
				redirect(site_url('meterdata')); 
			}
	
			$id_meter 		= $this->input->post('id_meter');
			$id 	 		= $this->input->post('id'); // di Form as Meter ID             
			$id_serial  	= $this->input->post('id_serial');
			$id_name  		= $this->input->post('id_name');
			$metergroupid  	= $this->input->post('metergroupid');
			$com 	  		= 1;
			$modbus   		= 1;
			$type 	  		= $this->input->post('type');
			$v_nominal 		= $this->input->post('v_nominal');
			$i_nominal  	= $this->input->post('i_nominal');
			$p_nominal    	= $this->input->post('p_nominal');
			$is_active 		= 1;
			$f_kali 		= 1;
			$lokasi    		= $this->input->post('lokasi');
				
			$alarm_to_high_limit 	= $this->input->post('alarm_to_high_limit');
			$alarm_vt_low_limit  	= $this->input->post('alarm_vt_low_limit');
			$alarm_vt_high_limit  	= $this->input->post('alarm_vt_high_limit');
			$alarm_uc_high_limit  	= $this->input->post('alarm_uc_high_limit');
			$alarm_oc_high_limit  	= $this->input->post('alarm_oc_high_limit');
			$alarm_pf_low_limit  	= $this->input->post('alarm_pf_low_limit');
			$alarm_hv_high_limit  	= $this->input->post('alarm_hv_high_limit');
			$alarm_hc_high_limit  	= $this->input->post('alarm_hc_high_limit');
			$alarm_to_yesno  		= $this->input->post('alarm_to_yesno');
			$alarm_vt_yesno  		= $this->input->post('alarm_vt_yesno');
			$alarm_uc_yesno  		= $this->input->post('alarm_uc_yesno');
			$alarm_oc_yesno 		= $this->input->post('alarm_oc_yesno');
			$alarm_pf_yesno  		= $this->input->post('alarm_pf_yesno');
			$alarm_rp_yesno  		= $this->input->post('alarm_rp_yesno');
			$alarm_hv_yesno 		= $this->input->post('alarm_hv_yesno');
			$alarm_hc_yesno 		= $this->input->post('alarm_hc_yesno');
			
			if ($alarm_to_yesno == '') {
				$alarm_to_yesno = 0;
			}
			if ($alarm_vt_yesno == '') {
				$alarm_vt_yesno = 0;
			}
			if ($alarm_uc_yesno == '') {
				$alarm_uc_yesno = 0;
			}
			if ($alarm_oc_yesno == '') {
				$alarm_oc_yesno = 0;
			}
			if ($alarm_pf_yesno == '') {
				$alarm_pf_yesno = 0;
			}
			if ($alarm_rp_yesno == '') {
				$alarm_rp_yesno = 0;
			}
			if ($alarm_hv_yesno == '') {
				$alarm_hv_yesno = 0;
			}
			if ($alarm_hc_yesno == '') {
				$alarm_hc_yesno = 0;
			}
			
			$data = array(
				'id_meter' 				=> $id_meter, 	//
				'id' 					=> $id,			//
				'id_serial' 			=> $id_serial,
				'id_name' 				=> $id_name,
				'metergroupid' 			=> $metergroupid,
				'lokasi'				=> $lokasi,
				'com' 					=> $com,
				'modbus' 				=> $modbus,
				'type' 					=> $type,
				'is_active'				=> $is_active,
				'f_kali'				=> $f_kali,
				'v_nominal'				=> $v_nominal,
				'i_nominal'				=> $i_nominal,
				'p_nominal'				=> $p_nominal,
				'alarm_to_high_limit' 	=> $alarm_to_high_limit,
				'alarm_vt_low_limit' 	=> $alarm_vt_low_limit,
				'alarm_vt_high_limit' 	=> $alarm_vt_high_limit,
				'alarm_uc_high_limit' 	=> $alarm_uc_high_limit,
				'alarm_oc_high_limit' 	=> $alarm_oc_high_limit,
				'alarm_pf_low_limit' 	=> $alarm_pf_low_limit,
				'alarm_hv_high_limit' 	=> $alarm_hv_high_limit,
				'alarm_hc_high_limit' 	=> $alarm_hc_high_limit,
				'alarm_to_yesno' 		=> $alarm_to_yesno,
				'alarm_vt_yesno' 		=> $alarm_vt_yesno,
				'alarm_uc_yesno' 		=> $alarm_uc_yesno,
				'alarm_oc_yesno' 		=> $alarm_oc_yesno,
				'alarm_pf_yesno' 		=> $alarm_pf_yesno,
				'alarm_rp_yesno' 		=> $alarm_rp_yesno,
				'alarm_hv_yesno' 		=> $alarm_hv_yesno,
				'alarm_hc_yesno' 		=> $alarm_hc_yesno
			);
			// var_dump($data);
			// print_r($data); 
			// die;

			$this->model_meterdata->get_insertpicture($id_meter,$data, 'data_meter');
			// $datalog = $this->session->userdata('nama').' mengubah data meterdata  dengan ID :'.$id;
			// helper_log("edit", $datalog);
			

			$this->load->library('upload');

			$nmfile = "front_".$id_meter; //nama file saya beri nama langsung dan diikuti fungsi time
			$config['upload_path'] = 'assets/img/meterdata/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['max_size'] = '2048'; //maksimum besar file 2M
			$config['max_width']  = '1288'; //lebar maksimum 1288 px
			$config['max_height']  = '768'; //tinggi maksimu 768 px
			$config['file_name'] = $nmfile; //nama yang terupload nantinya

			if($_FILES['frontpicture']['name'])
			{
			 	
				$pathfront1 = 'assets/img/meterdata/'.$nmfile.'.gif';
				if(file_exists($pathfront1)) {
			   		unlink($pathfront1);
			   		}
				$pathfront2 = 'assets/img/meterdata/'.$nmfile.'.jpg';
				if(file_exists($pathfront2)) {
			   		unlink($pathfront2);
			   		}
				$pathfront3 = 'assets/img/meterdata/'.$nmfile.'.png';
				if(file_exists($pathfront3)) {
			   		unlink($pathfront3);
			   		}
				$pathfront4 = 'assets/img/meterdata/'.$nmfile.'.jpeg';
				if(file_exists($pathfront4)) {
			   		unlink($pathfront4);
			   		}
				$pathfront5 = 'assets/img/meterdata/'.$nmfile.'.bmp';
				if(file_exists($pathfront5)) {
			   		unlink($pathfront5);
			   		}
			   
			 }
			   
			$this->upload->initialize($config);

			if($_FILES['frontpicture']['name'])
			{
			 	if ($this->upload->do_upload('frontpicture'))
				{
    			   	$gbr 		= $this->upload->data();
    				$nm_gbr 	= $gbr['file_name'];
      				$tipe_gbr 	= $gbr['file_type'];								
					$ext		= explode(".",$nm_gbr);							
					$extension	= $ext[1];
					$filefront	= $nmfile.'.'.$extension;
					
					$dataf2 = array(
      					  'frontpicture' => $filefront
       
       				 );

    				$this->model_meterdata->get_insertpicture($id_meter,$dataf2, 'data_meter'); //akses model untuk menyimpan ke database
				}
				else{
    				$this->session->set_flashdata('pesan', 'Maaf, Gambar Front Picture GAgal Diupload...');
					$this->template->display('meterdata_edit',$d);
				}
			}
			
			$nmfile2 = "back_".$id_meter; //nama file saya beri nama langsung dan diikuti fungsi time
			$config2['upload_path'] = 'assets/img/meterdata/'; //path folder
			$config2['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config2['max_size'] = '2048'; //maksimum besar file 2M
			$config2['max_width']  = '1288'; //lebar maksimum 1288 px
			$config2['max_height']  = '768'; //tinggi maksimu 768 px
			$config2['file_name'] = $nmfile2; //nama yang terupload nantinya

			
			if($_FILES['backpicture']['name'])
			{
			
			 	$pathback1 = 'assets/img/meterdata/'.$nmfile2.'.gif';
				if(file_exists($pathback1)) {
			   		unlink($pathback1);
			   		}
				$pathback2 = 'assets/img/meterdata/'.$nmfile2.'.jpg';
				if(file_exists($pathback2)) {
			   		unlink($pathback2);
			   		}
				$pathback3 = 'assets/img/meterdata/'.$nmfile2.'.png';
				if(file_exists($pathback3)) {
			   		unlink($pathback3);
			   		}
				$pathback4 = 'assets/img/meterdata/'.$nmfile2.'.jpeg';
				if(file_exists($pathback4)) {
			   		unlink($pathback4);
			   		}
				$pathback5 = 'assets/img/meterdata/'.$nmfile2.'.bmp';
				if(file_exists($pathback5)) {
			   		unlink($pathback5);
			   		}
			
			
			}
			
			
			$this->upload->initialize($config2);

			if($_FILES['backpicture']['name'])
			{
			 	if ($this->upload->do_upload('backpicture'))
				{
    			   	$gbr2 		= $this->upload->data();
    				$nm_gbr2 	= $gbr2['file_name'];
      				$tipe_gbr2 	= $gbr2['file_type'];								
					$ext2		= explode(".",$nm_gbr2);							
					$extension2	= $ext2[1];
					$fileback	= $nmfile2.'.'.$extension2;

    				$datab2 = array(
      					  'backpicture' => $fileback
       
       				 );

    				$this->model_meterdata->get_insertpicture($id_meter,$datab2, 'data_meter');
				}
				else{
    				$this->session->set_flashdata('pesan', 'Maaf, Gambar Back Picture Gagal Diupload...');
					$this->template->display('meterdata_edit',$d);
				}
			}
			
			redirect(site_url('meterdata'), 'refresh');
						
						
		}else{
			$this->template->display_form('meterdata_edit',$d);
		}
		
		
    }
	

}