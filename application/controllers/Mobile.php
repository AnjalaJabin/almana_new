<?php

require APPPATH . 'libraries/REST_Controller.php';

class Mobile extends REST_Controller {

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('form_validation');
        //load the login model
        $this->load->model('Login_model');
        $this->load->model('Xin_model');
        $this->load->model('Employees_model');
        $this->load->model('Budgeting_model');

        // $this->load->library('../controllers/Index.php');
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_get($id = 0)
    {
//        if(!empty($id)){
//            $data = $this->db->get_where("items", ['id' => $id])->row_array();
//        }else{
//            $data = $this->db->get("items")->result();
//        }

        $this->response("ttt", REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('items',$input);

        $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('items', $input, array('id'=>$id));

        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_delete($id)
    {
        $this->db->delete('items', array('id'=>$id));

        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }
    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function login_post()
    {
        $input = $this->input->post();

        $this->form_validation->set_rules('email', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $Return = array('status' => false, 'result' => '', 'error' => '', 'data' => '');

        $username = trim($this->input->post('email', TRUE));
        $password = trim($this->input->post('password', TRUE));
        /* Define return | here result is used to return user data and error for error message */

        /* Server side PHP input validation */
        if ($username === '') {
            $Return['error'] = "Login email field is required.";
        } elseif ($password === '') {
            $Return['error'] = "Password field is required.";
        }
        if ($Return['error'] != '') {
            $this->response($Return, REST_Controller::HTTP_OK);
        }

        $query = $this->Xin_model->read_user_info_byemail($username);
        $q_result = $query->result();

        if ($q_result) {
            $salt = $q_result[0]->pslt;

            $pw_hash = sha1($salt . $password);

            $data = array(
                'username' => $username,
                'sec_pass' => $pw_hash,
            );
            $result = $this->Login_model->login($data);
        } else {
            $result = 0;
        }
        function randomPassword()
        {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 200; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }


        if ($result == TRUE) {

            $device_id = randomPassword();
            $result = $this->Login_model->read_user_information_login($username, $pw_hash);
            $designation = $result[0]->designation_name ?? "General";
            $department = $result[0]->name ?? "General";
            $data = array(
                'user_id' => $result[0]->user_id,
                'username' => $result[0]->username,
                'email' => $result[0]->email,
                'dep_id' => $result[0]->department_id,
                'device_id' => $device_id,
                'name' => $result[0]->first_name . " " . $result[0]->last_name,
                'department' => $department,
                'designation' => $designation,
                'contact_no' => $result[0]->contact_no,
                'profile_picture' => 'uploads/profile/' . $result[0]->profile_picture ?? 'assets/media/avatars/blank.png',

            );


            // Add user data in session
            $Return['result'] = 'Successfully Logged In.';

            /////////////////////////////////////////////////////////////////////////
            function getOS()
            {
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                $os_platform = "Unknown OS Platform";

                $os_array = array(
                    '/windows nt 10/i' => 'Windows 10',
                    '/windows nt 6.3/i' => 'Windows 8.1',
                    '/windows nt 6.2/i' => 'Windows 8',
                    '/windows nt 6.1/i' => 'Windows 7',
                    '/windows nt 6.0/i' => 'Windows Vista',
                    '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
                    '/windows nt 5.1/i' => 'Windows XP',
                    '/windows xp/i' => 'Windows XP',
                    '/windows nt 5.0/i' => 'Windows 2000',
                    '/windows me/i' => 'Windows ME',
                    '/win98/i' => 'Windows 98',
                    '/win95/i' => 'Windows 95',
                    '/win16/i' => 'Windows 3.11',
                    '/macintosh|mac os x/i' => 'Mac OS X',
                    '/mac_powerpc/i' => 'Mac OS 9',
                    '/linux/i' => 'Linux',
                    '/ubuntu/i' => 'Ubuntu',
                    '/iphone/i' => 'iPhone',
                    '/ipod/i' => 'iPod',
                    '/ipad/i' => 'iPad',
                    '/android/i' => 'Android',
                    '/blackberry/i' => 'BlackBerry',
                    '/webos/i' => 'Mobile'
                );

                foreach ($os_array as $regex => $value)
                    if (preg_match($regex, $user_agent))
                        $os_platform = $value;

                return $os_platform;
            }

            function getBrowser()
            {

                $user_agent = $_SERVER['HTTP_USER_AGENT'];

                $browser = "Unknown Browser";

                $browser_array = array(
                    '/msie/i' => 'Internet Explorer',
                    '/firefox/i' => 'Firefox',
                    '/safari/i' => 'Safari',
                    '/chrome/i' => 'Google Chrome',
                    '/edge/i' => 'Edge',
                    '/opera/i' => 'Opera',
                    '/netscape/i' => 'Netscape',
                    '/maxthon/i' => 'Maxthon',
                    '/konqueror/i' => 'Konqueror',
                    '/mobile/i' => 'Mobile Browser'
                );

                foreach ($browser_array as $regex => $value)
                    if (preg_match($regex, $user_agent))
                        $browser = $value;

                return $browser;
            }

            $user_os = getOS();
            $user_browser = getBrowser();
            $user_ip = $this->input->ip_address();

            $active_device_data = array(
                'user_id' => $result[0]->user_id,
                'ip' => $user_ip,
                'date' => date('Y-m-d H:i:s'),
                'time' => time(),
                'browser' => $user_browser,
                'os' => $user_os,
                'device_id' => $device_id
            );

            $this->Employees_model->add_user_device($active_device_data);

            /////////////////////////////////////////////////////////////////////////


            // update last login info
            $ipaddress = $this->input->ip_address();
            $now = new \DateTime();
            $future = new \DateTime("now +" . $this->config->item('jwt_token_valid_hours') . " hours");

            $jti = base64_encode(random_bytes(16));
            $payload = array(
                "iat" => $now->getTimeStamp(),
                "exp" => $future->getTimeStamp(),
                "user" => ['id' => $result[0]->user_id, 'email' => $result[0]->email],
                'jti' => $jti,
            );
            $data['token'] = $this->create_token($payload);
            $last_data = array(
                'last_login_date' => date('d-m-Y H:i:s'),
                'last_login_ip' => $ipaddress,
                'is_logged_in' => '1',
                'device_token'=>$data['token'],
            );


            $id = $result[0]->user_id; // user id
            $this->Employees_model->update_employee($last_data, $id);
            $this->response($Return, REST_Controller::HTTP_OK);

        } else if (isset($q_result[0]->is_active) && $q_result[0]->is_active == 0) {
            $Return['error'] = "Your account is deactivated by your admin.";
        } else {
            $Return['error'] = "Invalid Login Credential.";
            /*Return*/
            $this->response($Return, REST_Controller::HTTP_OK);
        }
        if ($Return['error'] == '') {

            $Return['data'] = $data;
            $Return['status'] = true;

        }
        $this->response($Return, REST_Controller::HTTP_OK);

    }
    /**
     * View Home PAge.
     *
     * @return Response
     */
    public function home_post()
    {

        $input = $this->input->post();
        $Return = array('status'=>false,'result'=>'', 'error'=>'','data'=>'');
        if($this->authorize()) {
            if ((!$input['dep_id']) || ($input['dep_id'] == '')) {
                $Return['error'] = "Dep id required!";
                /*Return*/
                $this->response($Return, REST_Controller::HTTP_OK);
            } elseif ((!$input['user_id']) || ($input['user_id'] == '')) {
                $Return['error'] = "User id required!";
                /*Return*/
                $this->response($Return, REST_Controller::HTTP_OK);
            } else {
                $budget_data = $this->Budgeting_model->get_all_budgeting_alloc($input['dep_id']);
                $data['total_budget'] = $budget_data[0]->total_amount;
                $expense_data = $this->Budgeting_model->get_all_user_exp($input['user_id']);
                $data['total_expense'] = $expense_data[0]->total_amount;
                $Return['data'] = $data;
                $Return['result'] = "Success";
                $Return['status'] = true;
                $this->response($Return, REST_Controller::HTTP_OK);

            }
        }else{
            $Return['result'] ="Unauthorize access";
            $Return['status'] =true;
            $this->response($Return, 401);

        }
    }
    /**
     * View Budget Data PAge.
     *
     * @return Response
     */
    public function budget_post()
    {

        $input = $this->input->post();
        $Return = array('status'=>false,'result'=>'', 'error'=>'','data'=>'');
        if($this->authorize()) {
            if ((!$input['dep_id']) || ($input['dep_id'] == '')) {
                $Return['error'] = "Dep id required!";
                /*Return*/
                $this->response($Return, REST_Controller::HTTP_OK);
            } elseif ((!$input['user_id']) || ($input['user_id'] == '')) {
                $Return['error'] = "User id required!";
                /*Return*/
                $this->response($Return, REST_Controller::HTTP_OK);
            } else {
                $budget_data = $this->Budgeting_model->get_all_budgeting_alloc($input['dep_id']);
                $data['total_budget'] = $budget_data[0]->total_amount;
                $expense_data = $this->Budgeting_model->get_all_user_exp($input['user_id']);
                $data['total_expense'] = $expense_data[0]->total_amount;
                $data['budget_detail']=$this->Budgeting_model->get_all_budget_data($input['dep_id']);

                $Return['data'] = $data;
                $Return['result'] = "Success";
                $Return['status'] = true;
                $this->response($Return, REST_Controller::HTTP_OK);

            }
        }else{
            $Return['result'] ="Unauthorize access";
            $Return['status'] =true;
            $this->response($Return, 401);

        }
    }
    public function expenses_post()
    {

        $input = $this->input->post();
        $Return = array('status'=>false,'result'=>'', 'error'=>'','data'=>'');
        if($this->authorize()) {
            if ((!$input['dep_id']) || ($input['dep_id'] == '')) {
                $Return['error'] = "Dep id required!";
                /*Return*/
                $this->response($Return, REST_Controller::HTTP_OK);
            } elseif ((!$input['user_id']) || ($input['user_id'] == '')) {
                $Return['error'] = "User id required!";
                /*Return*/
                $this->response($Return, REST_Controller::HTTP_OK);
            } else {
                $data['expenses']=$this->Budgeting_model->get_all_expense_data($input['dep_id']);

                $Return['data'] = $data;
                $Return['result'] = "Success";
                $Return['status'] = true;
                $this->response($Return, REST_Controller::HTTP_OK);

            }
        }else{
            $Return['result'] ="Unauthorize access";
            $Return['status'] =true;
            $this->response($Return, 401);

        }
    }
    public function profile_post()
{

    $input = $this->input->post();
    $Return = array('status'=>false,'result'=>'', 'error'=>'','data'=>'');
    if($this->authorize()) {
        if ((!$input['user_id']) || ($input['user_id'] == '')) {
            $Return['error'] = "User id required!";
            /*Return*/
            $this->response($Return, REST_Controller::HTTP_OK);
        } else {
            $data['user_data']= $this->Budgeting_model->get_user_profile($input['user_id']);

            $Return['data'] = $data;
            $Return['result'] = "Success";
            $Return['status'] = true;
            $this->response($Return, REST_Controller::HTTP_OK);

        }
    }else{
        $Return['result'] ="Unauthorize access";
        $Return['status'] =true;
        $this->response($Return, 401);

    }
}


    function create_token($payload){
        $this->load->helper('jwt');
        $jwt = new JWT();

        $token = $jwt->encode($payload, JWT_KEY,'HS256');//key is a constant defined once
        return $token;
           }
    function authorize(){
        $Return = array('status'=>false,'result'=>'', 'error'=>'','data'=>'');

        $headers = $this->input->request_headers();
        $this->load->helper('jwt');
        $input = $this->input->post();
        if(!isset($headers['Authorization'])){
            echo "no token!!";
            $Return['result'] ="'Please Send Authorization token!'";
            $Return['status'] =true;
            $this->response($Return, 401);
        }
        else {
            $token = $headers['Authorization'];
            $splitToken = explode(" ", $token);
            $token1 = $splitToken[1];
            $jwt = new JWT();
            try {
                $now = new \DateTime();
                $current = $now->getTimeStamp();
                $payload = $jwt->decode($token1, JWT_KEY, 'HS256');//$payload is your metadata send by you & key is the contant value ones defined by you.
                if ($payload->exp < $current) {
                    $Return['result'] = "Token Expired";
                    $Return['status'] = true;
                    $this->response($Return, 401);

                } //          if($tok === $token){//$tok is your saved token in databse
                elseif($payload->user->id==$input['user_id']){
                        return 1;
                }
            else{
                    $Return['result'] = "User Mismatch!";
                    $Return['status'] = true;
                    $this->response($Return, 401);            }
            } catch (Exception $e) {
                $Return['result'] = "Unauthorize access";
                $Return['status'] = true;
                $this->response($Return, 401);
            }
        }
    }
}