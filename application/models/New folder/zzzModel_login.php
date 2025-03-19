<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Model_login extends CI_Model{

	public function cek($username, $password){
		//Secure password
        //$enc_password = md5($password);

        //Validate
		$pengacak 	= 'AJBBBLAJSCLWLWJJJJKLLL';
		$passwordku	= md5($pengacak . md5($password) . $pengacak );
		
        $this->db->where('username',$username);
        $this->db->where('password',md5($password));
        
        return $this->db->get('user');
	}
	
	  
}