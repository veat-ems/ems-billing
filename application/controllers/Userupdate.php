<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userupdate extends CI_Controller {

	function __construct(){
		parent::__construct();			
		$this->load->model('model_user');
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
        $this->template->display('user/userupdate',$d);
    }


}