<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template {

    protected $_CI;

    function __construct() {
        $this->_CI = &get_instance();
    }

    function display($template, $data = null) {
		$js = 'js/'.$template;
		$data['_sidebar'] = $this->_CI->load->view('template/sidebar', $data, true);
		$data['_header'] = $this->_CI->load->view('template/header', $data, true);        	
        $data['_content'] = $this->_CI->load->view($template, $data, true);		//----
		$data['_footer'] = $this->_CI->load->view('template/footer', $data, true);	
		$data['_offsidebar'] = $this->_CI->load->view('template/offsidebar', $data, true);		
		$data['_setting'] = $this->_CI->load->view('template/setting', $data, true); 	
		$data['_js'] = $this->_CI->load->view($js, $data, true);    //---
        $this->_CI->load->view('template/template', $data);
    }

	function display_graphical($template, $data = null) {
		$js = 'js/'.$template;
		$data['_sidebar'] = $this->_CI->load->view('template/sidebar', $data, true);
		$data['_header'] = $this->_CI->load->view('template/header', $data, true);        	
        $data['_content'] = $this->_CI->load->view($template, $data, true);		//----
		$data['_footer'] = $this->_CI->load->view('template/footer', $data, true);	
		$data['_offsidebar'] = $this->_CI->load->view('template/offsidebar', $data, true);		
		$data['_setting'] = $this->_CI->load->view('template/setting', $data, true); 	
		$data['_js'] = $this->_CI->load->view($js, $data, true);    //---
		$this->_CI->load->view('template/template_graphical', $data);
    }

    function display_table($template, $data = null) {
		$js = 'js/'.$template;
		$data['_sidebar'] = $this->_CI->load->view('template/sidebar', $data, true);
		$data['_header'] = $this->_CI->load->view('template/header', $data, true);        	
        $data['_content'] = $this->_CI->load->view($template, $data, true);		
		$data['_footer'] = $this->_CI->load->view('template/footer', $data, true);	
		$data['_offsidebar'] = $this->_CI->load->view('template/offsidebar', $data, true);		
		$data['_setting'] = $this->_CI->load->view('template/setting', $data, true);    	
		$data['_js'] = $this->_CI->load->view($js, $data, true);    
        $this->_CI->load->view('template/template_table', $data);
    }

    function display_form($template, $data = null) {
		$js = 'js/'.$template;
		$data['_sidebar'] = $this->_CI->load->view('template/sidebar', $data, true);
		$data['_header'] = $this->_CI->load->view('template/header', $data, true);        	
        $data['_content'] = $this->_CI->load->view($template, $data, true);		
		$data['_footer'] = $this->_CI->load->view('template/footer', $data, true);	
		$data['_offsidebar'] = $this->_CI->load->view('template/offsidebar', $data, true);		
		$data['_setting'] = $this->_CI->load->view('template/setting', $data, true);    	
		$data['_js'] = $this->_CI->load->view($js, $data, true);    
        $this->_CI->load->view('template/template_form', $data);
    }
	

    function display_trend($template, $data = null) {
		$js = 'js/'.$template;
		$data['_sidebar'] = $this->_CI->load->view('template/sidebar', $data, true);
		$data['_header'] = $this->_CI->load->view('template/header', $data, true);        	
        $data['_content'] = $this->_CI->load->view($template, $data, true);		
		$data['_footer'] = $this->_CI->load->view('template/footer', $data, true);	
		$data['_offsidebar'] = $this->_CI->load->view('template/offsidebar', $data, true);		
		$data['_setting'] = $this->_CI->load->view('template/setting', $data, true);    	
		$data['_js'] = $this->_CI->load->view($js, $data, true);    
        $this->_CI->load->view('template/template_trend', $data);
    }

    function display_billingform($template, $data = null) {
		$js = 'js/'.$template;
		$data['_sidebar'] = $this->_CI->load->view('template/sidebar', $data, true);
		$data['_header'] = $this->_CI->load->view('template/header', $data, true);        	
        $data['_content'] = $this->_CI->load->view($template, $data, true);		
		$data['_footer'] = $this->_CI->load->view('template/footer', $data, true);	
		$data['_offsidebar'] = $this->_CI->load->view('template/offsidebar', $data, true);		
		$data['_setting'] = $this->_CI->load->view('template/setting', $data, true);    	
		$data['_js'] = $this->_CI->load->view($js, $data, true);    
        $this->_CI->load->view('template/template_billingform', $data);
    }

}
