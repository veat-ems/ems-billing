<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Metergroup extends CI_Controller {

	function __construct(){
		parent::__construct();			
		$this->load->model('model_metergroup');
		$this->load->library('form_validation');
		if($this->session->userdata('id_jenis_user') <> '1')
		{
			redirect('login');
		}
	}
	
    public function index() {
		$d['title'] = 'METER GROUP';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';		
		$d['metergroup'] = $this->model_metergroup->tampil()->result();	
		$d['data_form'] = '';
        $this->template->display_table('metergroup/metergroup',$d);
    }

	//=================
	function data_list(){
		$data=$this->model_metergroup->data_list($this->session->userdata('level'));
		echo json_encode($data);
	}
	
	public function create()
	{
        
		if ($this->session->userdata('level') <> "ADM") {
			redirect(site_url('metergroup')); 
		}
		
		$d['title'] = 'METER GROUP';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';		
		$d['metergroup'] = $this->model_metergroup->tampil()->result();	
		$d['data_form'] = '';
		

		$this->form_validation->set_rules('metergroupid','Meter Group ID','trim|required|min_length[3]');
		$this->form_validation->set_rules('metergroupname','Meter Group Name','trim|trim|required|min_length[2]');
 
		if($this->form_validation->run() != false){
			$metergroupid = $this->input->post('metergroupid');
			$metergroupname = $this->input->post('metergroupname');
 
			$data = array(
			  	 'metergroupid' => $metergroupid,
			  	 'metergroupname' => $metergroupname
			);
			
			$cek = $this->model_metergroup->cek_metergroupid($metergroupid);
				 if($cek->num_rows() >= 1)
				 {
				 	$this->session->set_flashdata('pesan', 'Maaf, Meter Group ID sudah ADA, silahkan ganti dengan yang lain.');

                ?>
                <script type="text/javascript">
                    alert("Meter Group ID sudah ADA");
                </script>
                
				<?php

					//  $this->template->display('metergroup',$d);
					 redirect(site_url('metergroup/create')); 
					//  $this->template->display('metergroup/metergroup',$d);
				 }
				 else{ 
				  	$this->model_metergroup->created_metergroup($data,'metergroups');
					$datalog = $this->session->userdata('nama').' menambahkan data Metergroup  dengan nama :'.$metergroupname;
					//helper_log("add", $datalog);
					redirect(site_url('metergroup')); 
				 }

		
		}else{
			$this->template->display_form('metergroup/create',$d);
		}
	}
	
	
	public function delete($metergroupid)
	{
		if ($this->session->userdata('level') <> "ADM") {
			redirect(site_url('metergroup')); 
		}
		
        $where = array(
			   'metergroupid' => $metergroupid
		);
		$this->model_metergroup->delete_metergroup($where,'metergroups');
		$datalog = $this->session->userdata('nama').' menghapus data Meter Group dengan id : '.$metergroupid;
		//helper_log("delete", $datalog);
		redirect(site_url('metergroup'));       
	}
	
	
	
	public function edit($metergroupid)
	{
        
		$d['title'] = 'METER GROUP';
		$d['judul'] = 'EMS Application';
		$d['username'] = $this->session->userdata('username');
		$d['level'] = $this->session->userdata('level');
		$d['nama'] = $this->session->userdata('nama');
		$d['email'] = $this->session->userdata('email');
		$d['avatar'] = $this->session->userdata('avatar');
		$d['background'] = $this->session->userdata('background');
		$d['page'] = 'admin';		
		$d['metergroup'] = $this->model_metergroup->tampil()->result();
			
		$d['data_form'] = $this->model_metergroup->formdata($metergroupid)->row();
		
		$this->form_validation->set_rules('metergroupname','Meter Group Name','trim|trim|required|min_length[2]');
 
		if($this->form_validation->run() != false){
			
			if ($this->session->userdata('level') <> "ADM") {
				redirect(site_url('metergroup')); 
			}
			
			$id 				= $metergroupid;
			$metergroupname 	= $this->input->post('metergroupname');
 
			$data = array(
			  	 'metergroupname' => $metergroupname
			);
			
			$where = array(
				   'metergroupid' => $id
			);
			$this->model_metergroup->update_metergroup($where,$data,'metergroups');

			$datalog = $this->session->userdata('nama').' mengubah data Meter Group dengan nama : '.$metergroupname;
			//helper_log("edit", $datalog);
			redirect(site_url('metergroup'));  
			
		}else{
			$this->template->display_form('metergroup/edit',$d);
		}
	}
	
	public function update()
	{
        $metergroupid = $this->input->post('metergroupid');
		$metergroupname = $this->input->post('metergroupname');
 
		$data = array(
			  'metergroupname' => $metergroupname
		);
 
		$where = array(
			   'metergroupid' => $metergroupid
		);
		$this->model_metergroup->update_metergroup($where,$data,'metergroups');
		
		$datalog = $this->session->userdata('nama').' mengubah data Meter group dengan nama : '.$metergroupname;
		//helper_log("edit", $datalog);
		
		redirect(site_url('metergroup'));       
	}
	

}