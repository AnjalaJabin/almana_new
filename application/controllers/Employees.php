<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {

	public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
          $this->load->library('phpqrcode/QRcode');
          //load the models
          $this->load->model('Login_model');
		  $this->load->model('Employees_model');
		  $this->load->model('Xin_model');
		  $this->load->model('Budgeting_model');
     }

	/*Function to set JSON output*/
	public function output($Return=array()){
		/*Set response header*/
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		/*Final JSON response*/
		exit(json_encode($Return));
	}

	public function index()
	{
	    $session = $this->session->userdata('username');
		if(!empty($session)){
		} else {
			redirect('');
		}

		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = '';
		$data['path_url'] = 'employees';
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if(in_array('7',$role_resources_ids)) {

            if(!empty($session)){
		   $data['subview'] = $this->load->view("employees/employees_list", $data, TRUE);
		   $this->load->view('layout_dashboard', $data); //page load
		} else {
			redirect('');
		}} else {
            redirect('dashboard/');
        }
	}


	public function empolyee_list()
     {

		$data['title'] = $this->Xin_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){
			$this->load->view("employees/employees_list", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$employee = $this->Employees_model->get_employees();

		$data = array();

        foreach($employee->result() as $r) {

		$option = '';
            $role_resources_ids = $this->Xin_model->user_role_resource();


                if($r->is_active==2): $status = '<span data-toggle="tooltip" data-placement="top" title="In-Active" class="badge badge-light-danger">In-Active</span>';
		elseif($r->is_active==1): $status = '<span data-toggle="tooltip" data-placement="top" title="Active" class="badge badge-light-success">Active</span>'; endif;

            if(in_array('8',$role_resources_ids))
                $option.= '<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"  data-bs-toggle="modal" data-bs-target=".edit-modal-data"  data-employee_id="'. $r->user_id . '"><i class="fas fa-edit"></i></button></span>';
            if(in_array('9',$role_resources_ids))
                $option.= '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_delete').'"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->user_id . '"><i class="fas fa-trash"></i></button></span>';



		$data[] = array(
			$r->first_name,
			$r->emp_code,
			$r->email,
			$r->contact_no,
			$r->created_at,
			$r->last_login_date,
			$status,
			$option
		);

	  }
	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $employee->num_rows(),
			 "recordsFiltered" => $employee->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }


	// Validate and add info in database
	public function add_employee() {

		if($this->input->post('add_type')=='add_employee') {
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');

		/* Server side PHP input validation */
		if($this->input->post('user_name')==='') {
       		 $Return['error'] = $this->lang->line('xin_employee_error_first_name');
		}  else if(empty($this->input->post('user_email'))) {
			 $Return['error'] = $this->lang->line('xin_employee_error_email');
		} else if (!filter_var($this->input->post('user_email'), FILTER_VALIDATE_EMAIL)) {
			$Return['error'] = $this->lang->line('xin_employee_error_invalid_email');
		} else if(empty($this->input->post('user_mobile'))) {
			 $Return['error'] = $this->lang->line('xin_employee_error_contact_number');
		}else if(empty($this->input->post('roles'))) {
            $Return['error'] = $this->lang->line('xin_employee_error_user_role');
        }else if($this->Employees_model->check_employees($this->input->post('user_email'))){
            $Return['error'] = "User with email already exists!";

        }


		if($Return['error']!=''){
       		$this->output($Return);
    	}

    	$fname='';
    	/* Check if file uploaded..*/
		if(isset($_FILES['avatar']['tmp_name']) && is_uploaded_file($_FILES['avatar']['tmp_name'])) {
            $filename = $_FILES['avatar']['name'];
            $uploadedfile = $_FILES['avatar']['tmp_name'];

            //checking image type
            $fname = $this->check_profile_image($filename,$uploadedfile);



			}

    	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $password = implode($pass); //turn the array into a string
        $salt = $password;
        $pw_hash = sha1($salt.$password);

		$data = array(
		'emp_code'=>$this->input->post('emp_code'),
		'first_name' => $this->input->post('user_name'),
		'email' => $this->input->post('user_email'),
		'department_id' => $this->input->post('department'),
		'sec_pass' => $pw_hash,
		'pslt' => $salt,
		'user_role_id' => $this->input->post('roles'),
		'profile_picture' => $fname,
		'contact_no' => $this->input->post('user_mobile'),
		'created_at' => date('d-m-Y'),
		);

		$result = $this->Employees_model->add_employee($data);
		//$result = TRUE;
		if ($result == TRUE) {
			$Return['result'] = "User Added Successfully";

			//get setting info
			$setting = $this->Xin_model->read_setting_info(1);
			if($setting[0]->enable_email_notification == 'yes') {

				// load email library
				$this->load->library('email');
				$this->email->set_mailtype("html");

				//get company info
				$cinfo = $this->Xin_model->read_company_setting_info(1);
				//get email template
				$template = $this->Xin_model->read_email_template(8);
				$subject = $template[0]->subject.' - '.$cinfo[0]->application_name;
				$logo = base_url().'uploads/logo/al_mana_retail_logo.png';

				// get user full name
				$full_name = $this->input->post('user_name');

				$message = '
    			<div style="background:#f6f6f6;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;">
    			<img src="'.$logo.'" title="Price Check" style="max-width:200px;"><br>'.str_replace(array("{var site_name}","{var site_url}","{var username}","{var employee_id}","{var employee_name}","{var email}","{var password}"),array($cinfo[0]->application_name,site_url(),$this->input->post('user_email'),$this->input->post('employee_id'),$full_name,$this->input->post('user_email'),$password),htmlspecialchars_decode(stripslashes($template[0]->message))).'</div>';

				require './mail/gmail.php';
                $mail->addAddress($this->input->post('user_email'), $full_name);
                $mail->Subject = $subject;
                $mail->msgHTML($message);

                if (!$mail->send()) {
                    //echo "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    //echo "Message sent!";
                }

                $Return['result'] = "User Added Successfully";

			}
		} else {
			$Return['error'] = $this->lang->line('xin_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}



	public function read_employee()
	{
		$id = $this->input->get('employee_id');
		$session = $this->session->userdata('username');
		$result = $this->Employees_model->read_employee_information($id);
		$data['breadcrumbs'] = $this->lang->line('xin_employee_details');
		$data['path_url'] = 'employees';

		$data = array(
			'emp_code'=>$result[0]->emp_code,
			'first_name' => $result[0]->first_name,
			'user_id' => $result[0]->user_id,
			'contact_no' => $result[0]->contact_no,
			'email' => $result[0]->email,
			'status' => $result[0]->is_active,
			'profile_picture' => $result[0]->profile_picture,
			'user_role_id' =>$result[0]->user_role_id,
			'department_id' =>$result[0]->department_id,
			'user_type' =>$result[0]->designation_id,
			);

		if(!empty($session)){
			$this->load->view('employees/dialoge_employee', $data);
		} else {
			redirect('');
		}
	 }



	 // Validate and update info in database
	public function update() {

		if($this->input->post('edit_type')=='edit_employee') {
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'');

		/* Server side PHP input validation */
		if($this->input->post('first_name')==='') {
       		 $Return['error'] = $this->lang->line('xin_employee_error_first_name');
		}else if(empty($this->input->post('user_email'))) {
			 $Return['error'] = $this->lang->line('xin_employee_error_email');
		} else if (!filter_var($this->input->post('user_email'), FILTER_VALIDATE_EMAIL)) {
			$Return['error'] = $this->lang->line('xin_employee_error_invalid_email');
		}else if(empty($this->input->post('permission'))) {
            $Return['error'] = $this->lang->line('xin_employee_error_user_role');
        }

		if($Return['error']!=''){
       		$this->output($Return);
    	}
            $fname='';
            /* Check if file uploaded..*/
            if(isset($_FILES['avatar']['tmp_name']) && is_uploaded_file($_FILES['avatar']['tmp_name'])) {
                $filename = $_FILES['avatar']['name'];
                $uploadedfile = $_FILES['avatar']['tmp_name'];

                //checking image type
                $fname = $this->check_profile_image($filename,$uploadedfile);



            }

            $data = array(
				'emp_code'=>$this->input->post('emp_code'),
		'first_name' => $this->input->post('user_name'),
		'email' => $this->input->post('user_email'),
		'user_role_id' => $this->input->post('permission'),
		'department_id' => $this->input->post('department'),
		'is_active' => $this->input->post('status'),
		'contact_no' => $this->input->post('user_mobile'),
		);
            if($fname)
            {
                $data['profile_picture'] =$fname;
            }


		$id = $this->input->post('user_id');
            $result = $this->Employees_model->update_employee($data,$id);
        //check if the logged in user is edited
        if($this->session->userdata('username')['user_id']==$id){
            $user_info = $this->Employees_model->read_user_by_id($id);
            $designation = $user_info[0]->designation_name ?? "General";
            $department = $user_info[0]->name ?? "General";
            $device_id  = $this->session->userdata('username')['device_id'];

            $session_data = array(
                'user_id' => $user_info[0]->user_id,
                'username' => $user_info[0]->username,
                'email' => $user_info[0]->email,
                'name'       =>$user_info[0]->first_name." ".$user_info[0]->last_name,
                'device_id' => $device_id,
                'department' =>$department,
                'designation'=>$designation,
                'profile_picture'=>$user_info[0]->profile_picture??'',

            );


            // Add user data in session
            $this->session->set_userdata('username', $session_data);
            $cookie_name  = "mycbusername";
            $cookie_value = $session_data;

            setcookie($cookie_name, serialize($cookie_value), time() + (86400 * 30), "/"); // 86400 = 1 day



        }
		if ($result == TRUE) {
            $Return['session']=$session_data??'';
			$Return['result'] = 'User info Updated';
		} else {
			$Return['error'] = $this->lang->line('xin_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}


    public function delete()
    {
        $id = $this->input->post('employee_id');
        $result = $this->Employees_model->delete_record ($id);
        if ($result == TRUE) {
            $Return['result'] = 'User Deleted';
        } else {
            $Return['error'] = $this->lang->line('xin_error_msg');
        }

        $this->output($Return);
        exit;

    }

    public function check_profile_image($filename,$uploadedfile)
    {
        $allowed =  array('png','jpg','jpeg','gif');
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(in_array($ext,$allowed)){



            if ($ext == "jpg" || $ext == "jpeg")
            {
                $src = imagecreatefromjpeg($uploadedfile);
            }
            else if ($ext == "png")
            {
                $src = imagecreatefrompng($uploadedfile);
            }
            else
            {
                $src = imagecreatefromgif($uploadedfile);
            }

            list($width, $height) = getimagesize($uploadedfile);
            $newwidth = 250;
            $newheight = ($height / $width) * $newwidth;
            $tmp = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $uxi = rand(111, 999).round(microtime(true)).'.'.$ext;
            $fname = $photo = "profile_" . $uxi;
            $filename = "uploads/profile/" . $photo;
            imagejpeg($tmp, $filename, 100);
            imagedestroy($src);
            imagedestroy($tmp);
            return $fname;

        }
    }
	public function my_expence()
	{
	    $session = $this->session->userdata('username');
		//print_r($session);
		if(!empty($session)){

		} else {
			redirect('');
		}

		$data = array();
		$user = $this->Xin_model->read_user_info($session['user_id']);
		$data['department_id'] = $user[0]->department_id;
		$data['all_categories'] = $this->Xin_model->get_categories_by_department($data['department_id']);
		$data['all_sub_categories'] = $this->Xin_model->get_sub_categories_by_department($data['department_id']);
		$data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
		$data['user_id']=$session['user_id'];
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = 'My Expence';
		$data['path_url'] = 'my_expence';

		if(!empty($session)){

		    $user = $this->Xin_model->read_user_info($session['user_id']);
    		$data['subview'] = $this->load->view("employees/my_expense", $data, TRUE);

		   $this->load->view('layout_main', $data); //page load
		} else {
			redirect('');
		}
	}
	public function my_expense_list(){
		//echo "hi";
		$data['title'] = $this->Xin_model->site_title();
		$session = $this->session->userdata('username');
		//print_r($session);
		if(!empty($session)){
			$this->load->view("employees/my_expense", $data);
		} else {
			redirect('');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$employee_id = $session['user_id'];
		//echo $employee_id;
		$emp_expense=$this->Budgeting_model->read_expense_data_by_empid($employee_id);
		$data = array();

        foreach($emp_expense as $r) {
			//print_r($r);

		$expnse_type;
		$budget_name=$this->Budgeting_model->read_budget_data_by_id($r->budget_id);

		foreach($budget_name as $n){
		$b_name=$n->budget_name;
		}
		$cat_name=$this->Xin_model->read_category_data_by_id($r->main_category_id) ;
		//print_r($cat_name);
		foreach($cat_name as $c){
			$maincat_name=$c->name;
			}
		$subcat_name=$this->Xin_model->read_sub_category_data_by_id($r->sub_category);
		foreach($subcat_name as $sub_c){
			$scat_name=$sub_c->name;
			}
		$data[] = array(
			$r->id,
			$r->date,
			$b_name,
			$r->amount,
			$maincat_name,
			$scat_name
		);

	  }
	  $output = array(
		   "draw" => $draw,
			 //"recordsTotal" => $emp_expense->num_rows(),
			// "recordsFiltered" => $emp_expense->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();

	}
    function get_employees_from_azure(){
        require_once './azure/GraphServiceAccessHelper.php';
        $users = GraphServiceAccessHelper::getFeed('users');
       // print_r($users);
    	$departments = $this->Xin_model->get_all_departments();
        $data=array();
        $key=0;
        $Return = array('result'=>'', 'error'=>'');

        foreach($users as $user) {
            $data[$key]['first_name'] = $user->givenName;
            $data[$key]['last_name'] = $user->surname;
            $data[$key]['username'] = $user->userPrincipalName;
            $data[$key]['email'] = ($user->mail != '') ? $user->mail : $user->otherMails[0];

            $data[$key]['user_role_id'] = "1132";

            $data[$key]['department_id'] = '';
            $data[$key]['contact_no'] = $user->telephoneNumber;
            if (!$this->Employees_model->check_employees($data[$key]['email'])) {
                $this->Employees_model->add_employee($data[$key]);

            }

            $key++;
        }
            $Return = array('result'=>'Users inserted!!', 'error'=>'');
            $this->output($Return);
            exit;
    }
    
    public function get_employee_qrcode(){
        $user_id = $this->uri->segment(3);
        if($user_id>0)
        {
            $user = $this->Xin_model->read_user_info($user_id);
            if(isset($user[0]->user_id)){
                $user_id  = $user[0]->user_id;
                $emp_code = $user[0]->emp_code;
                
                $directory = $_SERVER['DOCUMENT_ROOT'].'/uploads/qrcode/';
    		    $phpqrcodefilenm = $directory.$user_id.".png";
    		    if(!file_exists($phpqrcodefilenm)){
        		    $ecc = 'L';
                    $pixel_Size = 50;
                    $frame_Size = 50;
                     
                    //Generates QR Code and Stores it in directory given
        		    //QRcode::png($emp_code,$phpqrcodefilenm, $ecc, $pixel_Size, $frame_Size);
        		    QRcode::png($emp_code, $phpqrcodefilenm, QR_ECLEVEL_L, 15, 6);
    		    }
    		    
    		    header('Content-type: image/png');
                $gd = imagecreatefrompng($phpqrcodefilenm);
                imagepng($gd);
                imagedestroy($gd);
            }
        }
    }

}