<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();			
		$this->load->model(array('model_user', 'model_metergroup'));
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
        $this->template->display_table('user/user',$d);
    }

	//=================
	function data_list(){
		$data=$this->model_user->data_list($this->session->userdata('level'));
		echo json_encode($data);
	}
	
	public function create()
	{
		if ($this->session->userdata('level') <> "ADM") {
			redirect(site_url('user')); 
		}
        
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
		
		$this->form_validation->set_rules('username','Username','trim|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]');
		$this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password]');
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
					$datalog = $this->session->userdata('nama').' menambahkan data user  dengan username :'.$username;
					//helper_log("add", $datalog);
					redirect(site_url('user')); 
				 }
		}else{
			$this->template->display_form('user/create',$d);
		}
	}
	
	
	public function delete($id_user)
	{
		if ($this->session->userdata('level') <> "ADM") {
			redirect(site_url('user')); 
		}
		
        $where = array(
			   'id_user' => $id_user
		);
		$this->model_user->delete_user($where,'user');
		$datalog = $this->session->userdata('nama').' menghapus data user dengan username : '.$username;
		//helper_log("delete", $datalog);
		redirect(site_url('user'));       
	}
	
	
	
	public function edit($id_user)
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
			
		$d['data_form'] = $this->model_user->formdata($id_user)->row();
		
		//$this->form_validation->set_rules('username','Username','trim|required|min_length[4]|max_length[10]');
		//$this->form_validation->set_rules('password','Password','trim|required|min_length[4]');
		//$this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('name','Name','trim|required|min_length[5]');
		$this->form_validation->set_rules('email','Email','trim|trim|required|valid_email');
 
		if($this->form_validation->run() != false){
			
			if ($this->session->userdata('level') <> "ADM") {
				redirect(site_url('user')); 
			}
			
			/*
			$id = $this->model_user->get_id();
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$pengacak = 'AJBBBLAJSCLWLWJJJJKLLL';
			$passwordku = md5($pengacak . md5($password) . $pengacak );
			*/
			$id 	= $id_user;
			$nama 	= $this->input->post('name');
			$email 	= $this->input->post('email');
			$level 	= $this->input->post('level');
			$aktif 	= $this->input->post('aktif');
 
			$data = array(
			  	 'nama' => $nama,
			  	 'email' => $email,
			  	 'level' => $level,
			  	 'aktif' => $aktif
			);
			
			$where = array(
				   'id_user' => $id
			);
			$this->model_user->update_user($where,$data,'user');

			$datalog = $this->session->userdata('nama').' mengubah data user dengan nama : '.$nama;
			//helper_log("edit", $datalog);
			redirect(site_url('user'));  
			
		}else{
			$this->template->display_form('user/edit',$d);
		}
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
		
		$datalog = $this->session->userdata('nama').' mengubah data user dengan username : '.$username;
		//helper_log("edit", $datalog);
		
		redirect(site_url('user'));       
	}
	
	
	public function usermetergroup($id_user=false)
	{
		

		$d['title'] = 'USER METER GROUP';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';		
		$d['user'] = $this->model_user->tampil_user()->result();
		
		$d['id_user'] 		= $id_user;
		
		$data_form 		= $this->model_user->formdata($id_user)->row();	
		$d['data_form'] = $data_form;
		
		$metergroups = $this->model_metergroup->tampil()->result();
		$d['metergroups'] = $metergroups;
		
		$selectedusername			= $data_form->username;
		$metergroups_selected		= $this->model_metergroup->metergroup_selected($selectedusername);
		$metergroups_notselected	= $this->model_metergroup->metergroup_notselected($selectedusername);
		
		$d['metergroups_selected'] 		= $metergroups_selected;
		$d['metergroups_notselected'] 	= $metergroups_notselected;
		
		$this->form_validation->set_rules('username','Username','trim|required');
 		$this->form_validation->set_rules('my-select[]','Meter Group','trim|required');

		if($this->form_validation->run() != false){
			
			if ($_POST['my-select']) {
				
				$post_username 	= $this->input->post('username');
				
				//delete first
				$where_delete['username'] = $post_username;
				$this->model_user->delete_user($where_delete, 'usermetergroups');
				
				$str_metergroup = '';
				foreach ($_POST['my-select'] as $metergroup) {
					if ($metergroup != '') {
						$data_metergroups['username'] = $post_username;
						$data_metergroups['metergroupid'] = $metergroup;
						$this->model_metergroup->created_metergroup($data_metergroups,'usermetergroups');
						echo '<br>a';
					}
				}

			}
			redirect(site_url('user'));  
			
		}else{
			$this->template->display_trend('user/usermetergroup',$d);
		}
	}
	
	
	public function changepassword()
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
		
		$this->form_validation->set_rules('username','Username','trim|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('passwordnew','New Password','trim|required|min_length[4]');
 
		if($this->form_validation->run() != false){
			
			$id 			= $this->model_user->get_id();
  			$username 		= $this->input->post('username');
			$password 		= $this->input->post('password');
			$passwordnew 	= $this->input->post('passwordnew');
			$pengacak 		= 'AJBBBLAJSCLWLWJJJJKLLL';
			
			$passwordku 	= md5($pengacak . md5($password) . $pengacak );
			$passwordku_new = md5($pengacak . md5($passwordnew) . $pengacak );
 
			$data = array(
			  	 'password' => $passwordku_new
			);
			
			$cek = $this->model_user->cek_password($username, $passwordku);
				 if($cek->num_rows() < 1) {
				 	$this->session->set_flashdata('pesan', 'Maaf, password tidak cocok.');
					$this->template->display('user/changepassword',$d);
				 }
				 else{ 
				  	$where = array(
						   'username' => $username
					);
					$this->model_user->update_user($where,$data,'user');
					$datalog = $this->session->userdata('nama').' berhasil mengganti password';
					//helper_log("edit", $datalog);
					redirect(site_url('dashboard')); 
				 }
		}else{
			$this->template->display_form('user/changepassword',$d);
		}
	}

}