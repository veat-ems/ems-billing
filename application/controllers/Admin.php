<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
	}

	public function index(){
		$d['title'] = 'EMS Application &minus; AneIqbalcom';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';
		$this->load->view('admin', $d);
	}
}