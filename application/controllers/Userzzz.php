<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userzzz extends CI_Controller {

	function __construct(){
		parent::__construct();			
		$this->load->model('model_user');
		$this->load->library('form_validation');
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
	}
	
    public function index() {
		$d['title'] = 'USER';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';		
		$d['user'] = $this->model_user->tampil_user()->result();	
		$d['data_form'] = '';
        $this->template->display('user/user',$d);
    }
	
	public function delete($id_user)
	{
        $where = array(
			   'id_user' => $id_user
		);
		$this->model_user->delete_user($where,'user');
		redirect(site_url('user'));       
	}
	
	
	
	public function edit($id_user)
	{        
		$d['title'] = 'USER-EDIT';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';		
		$d['user'] = $this->model_user->tampil_user()->result();	
		$d['data_form'] = $this->model_user->id_user($id_user)->row();
        $this->template->display('user/user',$d);
	}
	
	public function update()
	{
        $id = $this->input->post('id');
		$username = $this->input->post('username');
		$nama = $this->input->post('name');
		$email = $this->input->post('email');
		$level = $this->input->post('level');
		$aktif = $this->input->post('aktif');
 
		$data = array(
			  'username' => $username,
			  'nama' => $nama,
			  'email' => $email,
			  'level' => $level,
			  'aktif' => $aktif
		);
 
		$where = array(
			   'id_user' => $id
		);
		$this->model_user->update_user($where,$data,'user');
		redirect(site_url('user'));       
	}
	
	public function create()
	{
        
		$d['title'] = 'USER';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';		
		$d['user'] = $this->model_user->tampil_user()->result();	
		$d['data_form'] = '';
		
		$this->form_validation->set_rules('username','Username','trim|required|min_length[4]|max_length[10]');
		$this->form_validation->set_rules('password1','Password','trim|required|min_length[4]');
		$this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password1]');
		$this->form_validation->set_rules('name','Name','trim|required|min_length[5]');
		$this->form_validation->set_rules('email','Email','trim|trim|required|valid_email');
 
		if($this->form_validation->run() != false){
			
			$id = $this->model_user->get_id();
  			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$pengacak = 'AJBBBLAJSCLWLWJJJJKLLL';
			$passwordku = md5($pengacak . md5($password) . $pengacak );
			$nama = $this->input->post('name');
			$email = $this->input->post('email');
			$level = $this->input->post('level');
			$aktif = $this->input->post('aktif');
 
			$data = array(
			  	 'id_user' => $id,
			  	 'username' => $username,
			  	 'password' => $passwordku,
			  	 'nama' => $nama,
			  	 'email' => $email,
			  	 'level' => $level,
			  	 'aktif' => $aktif
			);
			
			$cek = $this->model_user->cek_username($username);
				 if($cek->num_rows() >= 1)
				 {
				 	$this->session->set_flashdata('pesan', 'Maaf, Username sudah ADA, silahkan ganti dengan yanglain.');
					$this->template->display('user/user',$d);
				 }
				 else{ 
				  	$this->model_user->created_user($data,'user');
					redirect(site_url('user')); 
				 }
		}else{
			$this->template->display('user/user',$d);
		}
		
		
		
		      
	}


}