<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->helper('masterku');	
		$this->load->library('form_validation');	
		
  		$ckv = $this->model_login->ckv();
  		if($ckv=='Verified')
  		{
  			redirect('login');
  		}
		
	}
	public function index(){
		$d['title'] = 'VERIFIKASI';
		$d['judul'] = 'IAS PREPAID SYSTEM';
		$d['alamat'] = 'Jl. BORAL JAYA RATO NO. 1O JATI MAKMUR BEKASI';		
		$d['mc'] = '';
		$ckb = $this->model_login->ckb();
		$d['ckb'] = $ckb;
		$this->load->view('verifikasi', $d);
	}
	
	function generate(){
		$d['title'] = 'VERIFIKASI';
		$d['judul'] = 'IAS PREPAID SYSTEM';
		$d['alamat'] = 'Jl. BORAL JAYA RATO NO. 1O JATI MAKMUR BEKASI';
		$ckb = $this->model_login->ckb();
		$d['ckb'] = $ckb;	
		$mc		  = mcNCdy();
		$where = array(
					  'id' => '1'
					  );
		$data = array( 
  				  'mc' => $mc				  
  				  );
		$this->model_login->update($where, $data,'tb_sip');
		
		$d['mc'] = $mc;
		$this->load->view('verifikasi', $d);
	}
	
	function aktivasi(){
		$d['title'] = 'VERIFIKASI';
		$d['judul'] = 'IAS PREPAID SYSTEM';
		$d['alamat'] = 'Jl. BORAL JAYA RATO NO. 1O JATI MAKMUR BEKASI';
		
		$machine_code = mcNCdy();
		
		$data      = $this->input->post('lisensi');
		$datamesin = KdTyJmsw($data);
		
		
		
		$d['mc'] = $machine_code;
		
		if($machine_code==$datamesin){
			$cks = $this->model_login->cks();	
			if($cks>0){			  
    			$where = array(
					  'id' => '1'
					  );
				$data = array(    				  
    				  'nama' => $data,
    				  'mc' => $machine_code,
    				  'kd' => '1',
    				  'keterangan' => ''				  
    				  );
				$this->model_login->update($where, $data,'tb_sip');
			}
			else{			  
    			$data = array(
    				  'id' => '1',
    				  'nama' => $data,
    				  'mc' => $machine_code,
    				  'kd' => '1',
    				  'keterangan' => ''				  
    				  );
				$this->model_login->created($data,'tb_sip');
			}	
				  
			
			redirect('login');
		
		}
		else
		{			  
   			$cks = $this->model_login->cks();	
			if($cks>0){			  
    			
				$ckb = $this->model_login->ckb();
				$kd = $ckb+1;
				$where = array(
					  'id' => '1'
					  );
				$data = array(    				  
    				  'nama' => '',
    				  'mc' => $machine_code,
    				  'kd' => $kd,
    				  'keterangan' => ''				  
    				  );
				$this->model_login->update($where, $data,'tb_sip');				
				$d['ckb'] = $kd;
			}
			else{		  
    			$data = array(
    				  'id' => '1',
    				  'nama' => '',
    				  'mc' => $machine_code,
    				  'kd' => '1',
    				  'keterangan' => ''				  
    				  );
				$this->model_login->created($data,'tb_sip');			
				$d['ckb'] = 1;
			}
			
			$this->session->set_flashdata('pesan', 'LISENSI TIDAK VALID..!!!'.$datamesin.' tidak sesuai dengan Machine Code'.$machine_code.'.');
			
			
			$this->load->view('verifikasi', $d);
		}
		
	}

}