<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller{
	
	function __construct(){
		parent::__construct();	
		
		//$ckv = $this->model_login->ckv();
		$ckv = 'Verified';
		if($ckv!='Verified')
		{
			$this->session->set_flashdata('pesan', 'Lisensi data mesin'.$ckv.' OK..!');
			redirect('verifikasi');
		}
		
	}
	
	
	function index() {
		$period = date('Y-m-d');

		$this->load->view('login/login_form_v3');
	}
	
	public function index_OLD(){
		$d['title'] = 'LOGIN - PMS';
		$d['judul'] = 'PT. MENARA ANTAM SEJAHTERA';
		$d['alamat'] = 'ANTAM Office Park, Tower B, MZ zone   |   TB Simatupang No.1   |   Jakarta 12530, Indonesia  |  +6221  29634901 - 04';
		$this->load->view('login', $d);
	}

	function masuk()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      		$ip_num = $_SERVER['HTTP_CLIENT_IP'];
    	}
    	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      		$ip_num = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	}
    	elseif(!empty($_SERVER['HTTP_X_FORWARDED'])){
      		$ip_num = $_SERVER['HTTP_X_FORWARDED'];
    	}
    	else{
      		$ip_num = $_SERVER['REMOTE_ADDR'];
    	}
		$host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		
		

		$cek = $this->model_login->cek($username, $password);
		if($cek->num_rows() == 1)
		{
			foreach($cek->result() as $data){
				$sess_data['id_user'] = $data->id_user;
				$sess_data['username'] = $data->username;
				$sess_data['nama'] = $data->nama;
				$sess_data['email'] = $data->email;
				$sess_data['avatar'] = $data->avatar;
				$sess_data['background'] = $data->background;
				$sess_data['level'] = $data->level;
				$sess_data['id_jenis_user'] = $data->id_jenis_user;
				$this->session->set_userdata($sess_data);
			}

			if($this->session->userdata('level') == 'ADM')
			{
				$datalog = $this->session->userdata('nama').' melakukan login melalui IP '.$ip_num.' dengan nama komputer '.$host_name;
				//helper_log("login", $datalog);
				redirect('dashboardgroup');
			}
			elseif($this->session->userdata('level') == 'USR')
			{
				$datalog = $this->session->userdata('nama').' melakukan login melalui IP '.$ip_num.' dengan nama komputer '.$host_name;
				//helper_log("login", $datalog);
				redirect('dashboardgroup');
			}
			else
			{
				$datalog = $this->session->userdata('nama').' melakukan login melalui IP '.$ip_num.' dengan nama komputer '.$host_name;
				//helper_log("login", $datalog);
				redirect('dashboardgroup');
			}
		}
		else
		{
			$this->session->set_flashdata('pesan', 'Maaf, kombinasi username dengan password salah.');
			redirect('login');
		}
	}

	function keluar()
	{
		$datalog = 'Melakukan Logout username : '.$this->session->userdata('username');
		// helper_log("logout", $datalog);
		$this->session->sess_destroy();
		redirect('login');
	}
}