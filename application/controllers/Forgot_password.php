<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends MY_Controller {

    public function __construct() {
        Parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->library('form_validation');
        //load the model
        $this->load->model("Xin_model");
        $this->load->model("Employees_model");
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
        $data['title'] = 'HR Software';
        $this->load->view('user/forgot_password', $data);
    }

    private function curl_get_file_contents($URL)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
        else return FALSE;
    }

    public function send_mail()
    {
       /* if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
        {

            $secret = '6LdYsK0UAAAAABKfwJd9eceQspwC4FRjarVA_PHL';
            $verifyResponse = $this->curl_get_file_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if($responseData->success)
            {*/
                $data['title'] = 'Al mana';

                /* Define return | here result is used to return user data and error for error message */
                $Return = array('result'=>'', 'error'=>'');
                /* Server side PHP input validation */
                if($this->input->post('iemail')==='') {
                    $Return['error'] = "Please enter your email.";
                } else if (!filter_var($this->input->post('iemail'), FILTER_VALIDATE_EMAIL)) {
                    $Return['error'] = "Invalid email format";
                }

                if($Return['error']!=''){
                    $this->output($Return);
                }

                if($this->input->post('iemail')) {

                    $query = $this->Xin_model->read_user_info_byemail($this->input->post('iemail'));

                    $this->load->library('email');
                    $this->email->set_mailtype("html");
                    //get company info
                    //$cinfo = $this->Xin_model->read_company_setting_info(1);
                    //get email template
                    $template = $this->Xin_model->read_email_template(2);
                    //get employee info

                    $user = $query->num_rows();
                    if($user > 0) {

                        $user_info = $query->result();
                        $full_name = $user_info[0]->first_name.' '.$user_info[0]->last_name;

                        $subject = 'Al Mana Password Reset Link';
                        $logo = base_url().'uploads/logo/al_mana_retail_logo.png';
                        //$cid = $this->email->attachment_cid($logo);


                        function randomPassword() {
                            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                            $pass = array(); //remember to declare $pass as an array
                            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                            for ($i = 0; $i < 16; $i++) {
                                $n = rand(0, $alphaLength);
                                $pass[] = $alphabet[$n];
                            }
                            return implode($pass); //turn the array into a string
                        }

                        $reset_key1 = randomPassword();
                        $reset_key2 = randomPassword();

                        $r_data = array(
                            'uid'    => $user_info[0]->user_id,
                            'email'  => $user_info[0]->email,
                            'code_1' => $reset_key1,
                            'code_2' => $reset_key2,
                            'time'   => time(),
                        );

                        $this->Xin_model->update_password_reset_data($r_data);

                        $reset_url = site_url('forgot_password/reset/'.$reset_key1.'/'.$reset_key2.'/');

                        $message = '
        					<div style="background:#f6f6f6;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;">
        					<img src="'.$logo.'" title="Almana" style="max-width:200px;"><br>'.str_replace(array("{var site_name}","{var username}","{var email}","{var password}"),array('Al Mana',$user_info[0]->username,$user_info[0]->email,'<a href="'.$reset_url.'">Reset Link</a>'),htmlspecialchars_decode(stripslashes($template[0]->message))).'</div>';


                        $to = $this->input->post('iemail');
                        require './mail/gmail.php';
                        $mail->addAddress($to, $full_name);
                        $mail->setFrom('support@almana.app', 'Al mana');
                        $mail->Subject = $subject;
                        $message = html_entity_decode(stripslashes($message));
                        $mail->msgHTML($message);

                        if (!$mail->send()) {
                            //echo "Mailer Error: " . $mail->ErrorInfo;
                            $Return['error'] = 'Email error! - '. $mail->ErrorInfo;

                        } else {
                            $Return['result'] = 'Password reset link has been sent to your email address.';
                        }

                    } else {
                        /* Unsuccessful attempt: Set error message */
                        $Return['error'] = "Email address doesn't exist.";
                    }
                    $this->output($Return);
                    exit;
                }
            /*}else{
                $Return['error'] = "Recaptcha Verification Error! Reload Page.";
                $this->output($Return);
            }
        }else{
            $Return['error'] = "Recaptcha Verification Error! Reload Page.";
            $this->output($Return);
        }*/
    }

    public function reset(){
        $code_1 = $this->uri->segment(3);
        $code_2 = $this->uri->segment(4);
        if(isset($code_1) && isset($code_2)){

            $query  = $this->Xin_model->check_password_reset_data($code_1,$code_2);

            if(isset($query[0]->uid)){
                $_SESSION['password_reset_id']  = $query[0]->uid;
                $this->load->view('dashboard/reset_password');
            }
            else
            {
                header('location:'.site_url());
            }
        }
        else{
            header('location:'.site_url());
        }

    }

    public function update_new_password()
    {

        /* Define return | here result is used to return user data and error for error message */
        $Return = array('result'=>'', 'error'=>'');
        /* Server side PHP input validation */
        if($this->input->post('ixpassw1')==='') {
            $Return['error'] = "Please enter new password.";
        } else if($this->input->post('ixpassw2')==='') {
            $Return['error'] = "Please enter confirm new password.";
        } else if($this->input->post('ixpassw2')!=$this->input->post('ixpassw1')) {
            $Return['error'] = "New password and confirm password are not match.";
        } else if(empty($_SESSION['password_reset_id'])) {
            $Return['error'] = "Your session expired.";
        }

        $password = $this->input->post('ixpassw1');
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $password_check= 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            $Return['error'] = $password_check;
        }else{
            $password_check='';
        }

        if($Return['error']!=''){
            $this->output($Return);
        }

        if($this->input->post('ixpassw2')===$this->input->post('ixpassw1') && !empty($this->input->post('ixpassw1'))) {

            function randomPassword() {
                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $pass = array(); //remember to declare $pass as an array
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                for ($i = 0; $i < 16; $i++) {
                    $n = rand(0, $alphaLength);
                    $pass[] = $alphabet[$n];
                }
                return implode($pass); //turn the array into a string
            }

            $salt    = randomPassword();
            $pw_hash = sha1($salt.$password);

            $data = array(
                'sec_pass' => $pw_hash,
                'pslt' => $salt
            );

            $p_update = $this->Xin_model->update_new_password($data,$_SESSION['password_reset_id']);

            if($p_update==1){

                $Return['result'] = 'Your Password has been successfully updated.';
            }
            else{
                $Return['error'] = "Error on your data.";
            }

            $this->output($Return);
            exit;
        }
    }

}
