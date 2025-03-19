<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['tittle'] = 'LOGIN - PRA BAYAR';
		$data['judul']  = 'SISTEM INFORMASI PRA BAYAR';
		$data['alamat'] = 'Jl. BORAL JAYA RATO NO. 1O JATI MAKMUR BEKASI';
		$this->load->view('login', $data);
		
	}
	
	function masuk() {
	
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$cek = $this->model_login->cek($username,$password);
		if($cek->num_rows()==1){
		
			foreach($cek->result() as $data){
				$sess_data['id_user'] = $data->id_user;
				$sess_data['username'] = $data->username;
				$this->session->set_userdata($sess_data);			
			}
			
			redirect('admin','refresh');
			
		}
		
		else{
		
			$this->session->set_flashdata('pesan', 'Maaf, kombinasi username dan password Salah.');
		}	
	
	}
	
	
	function keluar() {
	
		$this->session->sess_destroy();
		redirect('../login', 'refresh');
		
	}
	
	
        
        
}
