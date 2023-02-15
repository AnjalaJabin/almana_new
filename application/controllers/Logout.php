<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logout extends CI_Controller
{

   /*Function to set JSON output*/
	public function output($Return=array()){
		/*Set response header*/
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		/*Final JSON response*/
		exit(json_encode($Return));
	}
	
	public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
          //load the login model
          $this->load->model('Login_model');
		  $this->load->model('Employees_model');
     }
	 
	// Logout from admin page
	public function index() {
	
		$session = $this->session->userdata('username');
		if(!isset($_COOKIE['mycbusername'])){
		    redirect('', 'refresh');
		}
		$ccsession_data = unserialize($_COOKIE['mycbusername']);
		if(!empty($session) || isset($_COOKIE['mycbusername'])){ 
    		if (isset($_COOKIE['mycbusername'])) {
                unset($_COOKIE['mycbusername']);
                setcookie('mycbusername', null, -1, "/");
            } 
    		
    		$last_data = array(
    			//'is_logged_in' => '0',
    			'last_logout_date' => date('d-m-Y H:i:s')
    		); 
    		if(!empty($session)){ 
    		    $this->Employees_model->update_employee($last_data, $session['user_id']);
    		    if(isset($ccsession_data['device_id'])){
    		        $this->Employees_model->delete_user_device($ccsession_data['device_id'], $session['user_id']);
    		    }
    		}
    				
    		// Removing session data
    		$data['title'] = 'Al Mana App';
    		$sess_array = array('username' => '');
            $this->session->unset_userdata('username');
    		$this->session->sess_destroy();
		}
		if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }

		$Return['result'] = 'Successfully Logout.';
		redirect('', 'refresh');
	}
} 
?>