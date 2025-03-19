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
		// tkh
		// var_dump($d);
		// die;
		$this->form_validation->set_rules('id','ID Line','trim|required|min_length[2]');
		$this->form_validation->set_rules('id_name','Meter Name','trim|required|min_length[2]');
		$this->form_validation->set_rules('id_serial','Meter SN','trim|required|min_length[2]');
		$this->form_validation->set_rules('type','Meter Type','trim|required');
		$this->form_validation->set_rules('power','Daya','trim|required');
		$this->form_validation->set_rules('v_nominal','V Nominal','trim|required');
		$this->form_validation->set_rules('i_nominal','I Nominal','trim|required');
		$this->form_validation->set_rules('metergroupid','Meter Group ID');
		/*
		$this->form_validation->set_rules('uvlimit','UV LIMIT','trim|required');
		$this->form_validation->set_rules('ovlimit','OV LIMIT','trim|required');
		$this->form_validation->set_rules('uclimit','UC LIMIT','trim|required');
		$this->form_validation->set_rules('oclimit','OC LIMIT','trim|required');
		*/
 
		// DLPD default value
		$d['dlpd_v_low_yesno'] 	= 1;
	  	$d['dlpd_v_low'] 		= 80;
	  	$d['dlpd_v_high_yesno'] = 1;
	  	$d['dlpd_v_high'] 		= 110;
	  	$d['dlpd_c_low_yesno'] 	= 1;
	  	$d['dlpd_c_low'] 		= 80;
	  	$d['dlpd_o_high_yesno'] = 1;
	  	$d['dlpd_o_high'] 		= 120;
	  	$d['dlpd_q_low_yesno'] 	= 1;
	  	$d['dlpd_q_low'] 		= 0.80;
	  	$d['dlpd_t_high_yesno'] = 1;
	  	$d['dlpd_t_high'] 		= 15;
	  	$d['dlpd_p_yesno'] 		= 1;
	 
		if($this->form_validation->run() != false){
			
			$id_meter = $this->model_meterdata->get_id();
  			$id 	  = $this->input->post('id');
			$type 	  = $this->input->post('type');
			$power    = $this->input->post('power');
			
			$com 	  = 0;
			$modbus   = 0;
			$uvlimit  = 0;
			$ovlimit  = 0;
			$uclimit  = 0;
			$oclimit  = 0;
			
			$id_serial  	= $this->input->post('id_serial');
			$id_name  		= $this->input->post('id_name');
			$metergroupid  	= $this->input->post('metergroupid');
			$v_nominal 		= $this->input->post('v_nominal');
			$i_nominal  	= $this->input->post('i_nominal');
 			
			$dlpd_v_low_yesno  	= $this->input->post('dlpd_v_low_yesno');
			$dlpd_v_low  		= $this->input->post('dlpd_v_low');
			$dlpd_v_high_yesno  = $this->input->post('dlpd_v_high_yesno');
			$dlpd_v_high  		= $this->input->post('dlpd_v_high');
			$dlpd_c_low_yesno  	= $this->input->post('dlpd_c_low_yesno');
			$dlpd_c_low  		= $this->input->post('dlpd_c_low');
			$dlpd_o_high_yesno  = $this->input->post('dlpd_o_high_yesno');
			$dlpd_o_high  		= $this->input->post('dlpd_o_high');
			$dlpd_q_low_yesno  	= $this->input->post('dlpd_q_low_yesno');
			$dlpd_q_low  		= $this->input->post('dlpd_q_low');
			$dlpd_t_high_yesno  = $this->input->post('dlpd_t_high_yesno');
			$dlpd_t_high  		= $this->input->post('dlpd_t_high');
			$dlpd_p_yesno  		= $this->input->post('dlpd_p_yesno');
			
			if ($dlpd_v_low_yesno == '') {
				$dlpd_v_low_yesno = 0;
			}
			if ($dlpd_v_high_yesno == '') {
				$dlpd_v_high_yesno = 0;
			}
			if ($dlpd_c_low_yesno == '') {
				$dlpd_c_low_yesno = 0;
			}
			if ($dlpd_o_high_yesno == '') {
				$dlpd_o_high_yesno = 0;
			}
			if ($dlpd_q_low_yesno == '') {
				$dlpd_q_low_yesno = 0;
			}
			if ($dlpd_t_high_yesno == '') {
				$dlpd_t_high_yesno = 0;
			}
			
			$data = array(
			  	 'id_meter' => $id_meter,
			  	 'id' => $id,
			  	 'com' => $com,
			  	 'modbus' => $modbus,
			  	 'type' => $type,
			  	 'power' => $power,
			  	 'uvlimit' => $uvlimit,
			  	 'ovlimit' => $ovlimit,
			  	 'uclimit' => $uclimit,
			  	 'oclimit' => $oclimit,
				'id_serial' => $id_serial,
				'id_name' => $id_name,
				'metergroupid' => $metergroupid,
				'v_nominal' => $v_nominal,
				'i_nominal' => $i_nominal,
			  	 'dlpd_v_low_yesno' 	=> $dlpd_v_low_yesno,
			  	 'dlpd_v_low' 			=> $dlpd_v_low,
			  	 'dlpd_v_high_yesno' 	=> $dlpd_v_high_yesno,
			  	 'dlpd_v_high' 			=> $dlpd_v_high,
			  	 'dlpd_c_low_yesno' 	=> $dlpd_c_low_yesno,
			  	 'dlpd_c_low' 			=> $dlpd_c_low,
			  	 'dlpd_o_high_yesno' 	=> $dlpd_o_high_yesno,
			  	 'dlpd_o_high' 			=> $dlpd_o_high,
			  	 'dlpd_q_low_yesno' 	=> $dlpd_q_low_yesno,
			  	 'dlpd_q_low' 			=> $dlpd_q_low,
			  	 'dlpd_t_high_yesno' 	=> $dlpd_t_high_yesno,
			  	 'dlpd_t_high' 			=> $dlpd_t_high,
			  	 'dlpd_p_yesno' 		=> $dlpd_p_yesno
			);
			
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
						
						$this->load->library('upload');
       
						$nmfile = "front_".$id_meter; //nama file saya beri nama langsung dan diikuti fungsi time
        				$config['upload_path'] = 'assets/img/meterdata/'; //path folder
        				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        				$config['max_size'] = '2048'; //maksimum besar file 2M
        				$config['max_width']  = '1288'; //lebar maksimum 1288 px
        				$config['max_height']  = '768'; //tinggi maksimu 768 px
        				$config['file_name'] = $nmfile; //nama yang terupload nantinya
 
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
								
								$data = array(
                  					  'frontpicture' => $filefront
                   
                   				 );
 
                				$this->model_meterdata->get_insertpicture($id_meter,$data, 'data_meter'); //akses model untuk menyimpan ke database
            				}
							else{
                				$this->session->set_flashdata('pesan', 'Maaf, Gambar Front Picture GAgal Diupload...');
								$this->template->display('meterdata_create',$d);
            				}
        				}
						
						$nmfile2 = "back_".$id_meter; //nama file saya beri nama langsung dan diikuti fungsi time
        				$config2['upload_path'] = 'assets/img/meterdata/'; //path folder
        				$config2['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        				$config2['max_size'] = '2048'; //maksimum besar file 2M
        				$config2['max_width']  = '1288'; //lebar maksimum 1288 px
        				$config2['max_height']  = '768'; //tinggi maksimu 768 px
        				$config2['file_name'] = $nmfile2; //nama yang terupload nantinya
 
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
 
                				$data2 = array(
                  					  'backpicture' => $fileback
                   
                   				 );
 
                				$this->model_meterdata->get_insertpicture($id_meter,$data2, 'data_meter');
            				}
							else{
                				$this->session->set_flashdata('pesan', 'Maaf, Gambar Back Picture Gagal Diupload...');
								$this->template->display('meterdata_create',$d);
            				}
        				}
						
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
		$d['data_form'] = $this->model_meterdata->formdata($id_meter)->row();	
		
		$this->form_validation->set_rules('id','ID LINE','trim|required|min_length[4]');
		$this->form_validation->set_rules('power','POWER','trim|required');
		$this->form_validation->set_rules('id_name','Meter Name','required');
		$this->form_validation->set_rules('type','Meter Type','trim|required');
		$this->form_validation->set_rules('id_serial','Meter SN','required');
		$this->form_validation->set_rules('v_nominal','V Nominal','trim|required');
		$this->form_validation->set_rules('i_nominal','I Nominal','trim|required');
		$this->form_validation->set_rules('metergroupid','Meter Group ID');
		
		if($this->form_validation->run() != false){
			
			if ($this->session->userdata('level') <> "ADM") {
				redirect(site_url('meterdata')); 
			}
			
			$id_meter = $this->input->post('id_meter');
  			$id 	  = $this->input->post('id');
			$com 	  = $this->input->post('com');
			$modbus   = $this->input->post('modbus');
			$type 	  = $this->input->post('type');
			$lokasi   = $this->input->post('lokasi');
			$power 	  = $this->input->post('power');
			$uvlimit  = $this->input->post('uvlimit');
			$ovlimit  = $this->input->post('ovlimit');
			$uclimit  = $this->input->post('uclimit');
			$oclimit  = $this->input->post('oclimit');
			
			$id_name  		= $this->input->post('id_name');
			$metergroupid  	= $this->input->post('metergroupid');
			$id_serial  	= $this->input->post('id_serial');
			$v_nominal  	= $this->input->post('v_nominal');
			$i_nominal  	= $this->input->post('i_nominal');
			
			
			$dlpd_v_low_yesno  	= $this->input->post('dlpd_v_low_yesno');
			$dlpd_v_low  		= $this->input->post('dlpd_v_low');
			$dlpd_v_high_yesno  = $this->input->post('dlpd_v_high_yesno');
			$dlpd_v_high  		= $this->input->post('dlpd_v_high');
			$dlpd_c_low_yesno  	= $this->input->post('dlpd_c_low_yesno');
			$dlpd_c_low  		= $this->input->post('dlpd_c_low');
			$dlpd_o_high_yesno  = $this->input->post('dlpd_o_high_yesno');
			$dlpd_o_high  		= $this->input->post('dlpd_o_high');
			$dlpd_q_low_yesno  	= $this->input->post('dlpd_q_low_yesno');
			$dlpd_q_low  		= $this->input->post('dlpd_q_low');
			$dlpd_t_high_yesno  = $this->input->post('dlpd_t_high_yesno');
			$dlpd_t_high  		= $this->input->post('dlpd_t_high');
			$dlpd_p_yesno  		= $this->input->post('dlpd_p_yesno');
			
			if ($dlpd_v_low_yesno == '') {
				$dlpd_v_low_yesno = 0;
			}
			if ($dlpd_v_high_yesno == '') {
				$dlpd_v_high_yesno = 0;
			}
			if ($dlpd_c_low_yesno == '') {
				$dlpd_c_low_yesno = 0;
			}
			if ($dlpd_o_high_yesno == '') {
				$dlpd_o_high_yesno = 0;
			}
			if ($dlpd_q_low_yesno == '') {
				$dlpd_q_low_yesno = 0;
			}
			if ($dlpd_t_high_yesno == '') {
				$dlpd_t_high_yesno = 0;
			}
 
			$data = array(
			  	 'com' => $com,
			  	 'modbus' => $modbus,
			  	 'type' => $type,
				 'lokasi' => $lokasi,
			  	 'power' => $power,
			  	 'uvlimit' => $uvlimit,
			  	 'ovlimit' => $ovlimit,
			  	 'uclimit' => $uclimit,
			  	 'oclimit' => $oclimit,
				'id_name' 	=> $id_name,
				'metergroupid' 	=> $metergroupid,
				'id_serial' => $id_serial,
				'v_nominal' => $v_nominal,
				'i_nominal' => $i_nominal,
			  	 'dlpd_v_low_yesno' 	=> $dlpd_v_low_yesno,
			  	 'dlpd_v_low' 			=> $dlpd_v_low,
			  	 'dlpd_v_high_yesno' 	=> $dlpd_v_high_yesno,
			  	 'dlpd_v_high' 			=> $dlpd_v_high,
			  	 'dlpd_c_low_yesno' 	=> $dlpd_c_low_yesno,
			  	 'dlpd_c_low' 			=> $dlpd_c_low,
			  	 'dlpd_o_high_yesno' 	=> $dlpd_o_high_yesno,
			  	 'dlpd_o_high' 			=> $dlpd_o_high,
			  	 'dlpd_q_low_yesno' 	=> $dlpd_q_low_yesno,
			  	 'dlpd_q_low' 			=> $dlpd_q_low,
			  	 'dlpd_t_high_yesno' 	=> $dlpd_t_high_yesno,
			  	 'dlpd_t_high' 			=> $dlpd_t_high,
			  	 'dlpd_p_yesno' 		=> $dlpd_p_yesno			
				
			);
			
				  	// var_dump($data);
					//   die;
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
	
	
	public function ajax_list_tkhxxx()
	{
		//$list = $this->person->get_datatables();
		$list = $this->model_meterdata->tampil()->result();
		$data = array();
		$no = 0;
		foreach ($list as $meter) {
			$no++;
			$row = array();
			$row[] = $meter->id;
			$row[] = $meter->id_name;
			$row[] = $meter->id_serial;
			$row[] = $meter->lokasi;
			$row[] = $meter->type;
			$row[] = $meter->power;
			$row[] = $meter->v_nominal;
			$row[] = $meter->i_nominal;
			

			//add html for action
			$row[] = "
				   	  <a href='".base_url()."meterdata/edit/".$meter->id_meter."' class='btn btn-warning btn-o  btn-sm' ><i class='ti-pencil-alt'></i></a>
                      <a href='".base_url()."meterdata/delete/".$meter->id_meter."' class='btn btn-danger btn-o  btn-sm' onClick='return doconfirm();'><i class='ti-trash'></i></a>";
		
			$data[] = $row;
		}

		$output = array($data
				);
		//output to json format
		echo json_encode($data);
	}
	
	
	
	
	


}