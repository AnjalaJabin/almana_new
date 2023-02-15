<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    public function __construct() {
        parent::__construct();    
		$ci =& get_instance();
        $ci->load->helper('language');
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            $ci->lang->load('workablezone',$siteLang);
        } else {
            $ci->lang->load('workablezone','english');
        } 
        
        $cookie_name = "mycbusername";
        if(isset($_COOKIE[$cookie_name])) {
	    
            $session_data = unserialize($_COOKIE[$cookie_name]);
            
            $session_data = array(
        	'user_id' => $session_data['user_id'],
        	'username' => $session_data['username'],
        	'email' => $session_data['email'],
                'name'  =>$session_data['name'],
                'device_id'=>$session_data['device_id'],
                'department'=>$session_data['department'],
                'designation'=>$session_data['designation'],
                'profile_picture'=> $session_data['profile_picture'],


            );
        	
        	$this->session->set_userdata('username', $session_data);
            
            $_SESSION['user_id'] = $session_data['user_id'];
        
    	}
        
        
    }
	

}
?>