<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 function helper_log($tipe = "", $str = ""){
    $CI =& get_instance();
 
    if (strtolower($tipe) == "login"){
        $log_tipe   = 0;
    }
    elseif(strtolower($tipe) == "logout")
    {
        $log_tipe   = 1;
    }
    elseif(strtolower($tipe) == "add"){
        $log_tipe   = 2;
    }
    elseif(strtolower($tipe) == "edit"){
        $log_tipe  = 3;
    }
    elseif(strtolower($tipe) == "delete"){
        $log_tipe  = 4;
    }
    else{
        $log_tipe  = 5;
    }
 
    // paramter
	$data = array(
			  	 'log_user' => $CI->session->userdata('username'),
			  	 'log_tipe' => $log_tipe,
			  	 'log_desc' => $str
			);
 
    //load model log
    $CI->load->model('model_log');
 
    //save to database
    $CI->model_log->save_log($data);
 
    
}