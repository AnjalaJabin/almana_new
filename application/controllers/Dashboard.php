<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->library('form_validation');
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
    public function forgot_password()
    {
        $this->load->view('dashboard/forgot_password'); //page load

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
        $data['path_url'] = 'dashboard';
        $data['all_expenses'] = $this->Xin_model->get_all_expenses();
        $all_expenses =$this->Xin_model->get_all_expense_counts();
        $budget_amount =$this->Xin_model->get_tot_budget_amount();
        $my_exp=$this->Xin_model->get_my_exp_count();
        $dir_exp=$this->Xin_model->get_direct_exp_count();
        $bud_exp=$this->Xin_model->get_budget_exp_count();
        $data['expense_counts'] = $all_expenses['count'];
        $data['total_expense'] = $all_expenses['amount'];
        $data['total_bud_exp'] =$bud_exp['amount'];
        $data['total_dir_exp'] =$dir_exp['amount'];
        $data['total_my_exp'] =$my_exp?$my_exp[0]->total_amount:'0';

        $data['budget_expense_counts'] = $bud_exp['count'];
        $data['direct_expense_counts'] = $dir_exp['count'];
        $data['my_expense_counts'] = $my_exp?$my_exp[0]->my_expense_count:'0';
        $data['total_budget_amount'] = $budget_amount;
        $data['all_employees'] = $this->Xin_model->get_all_employees();
        $data['employee_count'] = $this->Xin_model->get_all_employee_count()[0]->employee_count;
        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $dept = $this->Budgeting_model->read_budget_dept($user[0]->department_id);
        $data['dept_name'] = $dept[0]->name;
        if(!empty($session)){
            $data['subview'] = $this->load->view("dashboard/index_new", $data, TRUE);
            $this->load->view('layout_dashboard', $data); //page load
        } else {
            redirect('');
        }
    }

    public function index2()
    {
        $session = $this->session->userdata('username');
        if(!empty($session)){
        } else {
            redirect('');
        }

        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = '';
        $data['path_url'] = '';

        if(!empty($session)){
            $root_id   = $_SESSION['root_id'];
            $data['employees'] = $this->Reports_model->get_all_employees();
            $data['subview'] = $this->load->view("dashboard/dashboard", $data, TRUE);
            $this->load->view('layout_dashboard', $data); //page load
        } else {
            redirect('');
        }
    }


    // get opened and closed tickets for chart
    public function tickets_data()
    {
        /* Define return | here result is used to return user data and error for error message */
        $Return = array('opened'=>'', 'closed'=>'');
        // open
        //$Return['opened'] = $this->Xin_model->all_open_tickets();
        // closed
        //$Return['closed'] = $this->Xin_model->all_closed_tickets();
        $this->output($Return);
        exit;
    }

    public function get_chart_data()
    {
        $session = $this->session->userdata('username');
        $user = $this->Xin_model->read_user_info($session['user_id']);
        $query_b= $this->db->query("SELECT month(added_date) AS month_name,
        SUM(amount) AS sum_of_month
FROM budget_expenses
WHERE YEAR(added_date) = YEAR(CURDATE()) AND exp_type=0 AND department_id =".$user[0]->department_id."
GROUP BY month(added_date)");
        $expenses = $query_b->result();
        $query_d= $this->db->query("SELECT month(added_date) AS month_name,
        SUM(amount) AS sum_of_month
FROM budget_expenses
WHERE YEAR(added_date) = YEAR(CURDATE()) AND exp_type=1 AND department_id =".$user[0]->department_id."
GROUP BY month(added_date)");
        $expenses = $query_b->result();
        $direct_expenses = $query_d->result();

        $key=1;
        $exp_array=array();
        while($key<=12){
           $exp_array['budget'][$key]=0;
            $exp_array['direct'][$key]=0;
           $key++;
        }
        foreach ($expenses as $exp)
        {
            $exp_array['budget'][$exp->month_name]=$exp->sum_of_month;
        }
        foreach ($direct_expenses as $d_exp)
        {
            $exp_array['direct'][$exp->month_name]=$d_exp->sum_of_month;
        }

        echo json_encode($exp_array,true);
    }
    public function add_new_product_popup()
    {
        $data['title'] = $this->Xin_model->site_title();
        $data = array(
            'suppliers' => $this->Xin_model->get_all_suppliers(),
            'product_cats' => $this->Xin_model->get_all_product_cats(),
            'product_brand' => $this->Xin_model->get_all_product_brand()
        );
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view('dashboard/dialog_products', $data);
        } else {
            redirect('');
        }
    }


    // set new language
    public function set_language($language = "") {

        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER']);

    }

    private function update_user_device(){

        function randomPassword() {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 200; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }

        $ccsession_data = unserialize($_COOKIE['mycbusername']);
        if(!isset($ccsession_data['device_id']) || empty($ccsession_data['device_id'])){
            /*
            $condition = "user_id =".$ccsession_data['user_id']." and root_id=".$ccsession_data['root_id']." and device_id='".$ccsession_data['device_id']."'";
    		$this->db->select('*');
    		$this->db->from('active_devices');
    		$this->db->where($condition);
    		$this->db->limit(1);
    		$query = $this->db->get();
		
    		if ($query->num_rows() == 1 ) {
    		    echo 1;
    		}else{
        */
            /////////////////////////////////////////////////////////////////////////
            $device_id = randomPassword();
            $session_data = array(
                'user_id' => $ccsession_data['user_id'],
                'username' => $ccsession_data['username'],
                'email' => $ccsession_data['email'],
                'root_id' => $ccsession_data['root_id'],
                'device_id' => $device_id,
            );


            $user_os        = $this->getOS();
            $user_browser   = $this->getBrowser();
            $user_ip        = $this->input->ip_address();

            $active_device_data = array(
                'user_id'   =>  $ccsession_data['user_id'],
                'root_id'   =>  $ccsession_data['root_id'],
                'ip'        =>  $user_ip,
                'date'      =>  date('Y-m-d H:i:s'),
                'time'      =>  time(),
                'browser'   =>  $user_browser,
                'os'        =>  $user_os,
                'device_id' =>  $device_id
            );

            $this->Employees_model->add_user_device($active_device_data);

            /////////////////////////////////////////////////////////////////////////

            $cookie_name  = "mycbusername";
            $cookie_value = $session_data;

            setcookie($cookie_name, serialize($cookie_value), time() + (86400 * 30), "/"); // 86400 = 1 day

        }
    }

    private function getOS() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform  = "Unknown OS Platform";

        $os_array     = array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $os_platform = $value;

        return $os_platform;
    }

    private function getBrowser() {

        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $browser        = "Unknown Browser";

        $browser_array = array(
            '/msie/i'      => 'Internet Explorer',
            '/firefox/i'   => 'Firefox',
            '/safari/i'    => 'Safari',
            '/chrome/i'    => 'Google Chrome',
            '/edge/i'      => 'Edge',
            '/opera/i'     => 'Opera',
            '/netscape/i'  => 'Netscape',
            '/maxthon/i'   => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i'    => 'Mobile Browser'
        );

        foreach ($browser_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $browser = $value;

        return $browser;
    }

    public function check_session(){
        $cookie_name = "mycbusername";

        if(!isset($_COOKIE[$cookie_name])) {
            $this->session->unset_userdata('username');
            $this->session->sess_destroy();
            session_destroy();
            echo 0;
            exit();
        } else {
            $session_data = unserialize($_COOKIE[$cookie_name]);


            if(!isset($session_data['device_id'])){
                $this->update_user_device();
            }

            $MainDb = $this->load->database('maindb', TRUE);
            $condition2 = "user_id =".$session_data['user_id']." and root_id=".$session_data['root_id']." and device_id='".$session_data['device_id']."'";
            $MainDb->select('*');
            $MainDb->from('active_devices');
            $MainDb->where($condition2);
            $MainDb->limit(1);
            $query2 = $MainDb->get();

            $set_session_data = array(
                'user_id' => $session_data['user_id'],
                'username' => $session_data['username'],
                'email' => $session_data['email'],
                'root_id' => $session_data['root_id'],
            );

            $ck_session = $this->session->userdata('username');
            if(empty($ck_session))
            {
                $this->session->set_userdata('username', $set_session_data);
            }
            if(!isset($_SESSION['user_id']) || !isset($_SESSION['root_id']))
            {
                $_SESSION['user_id'] = $session_data['user_id'];
                $_SESSION['root_id'] = $session_data['root_id'];
            }

            $condition = "user_id =".$_SESSION['user_id']." and root_id=".$_SESSION['root_id']." and deleted=0 and is_active=1 and is_logged_in=1";
            $this->db->select('*');
            $this->db->from('xin_employees');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();

            if ($query->num_rows() == 1 && $query2->num_rows() == 1) {
                $MainDb->query("UPDATE `active_devices` SET `time`='".time()."',`date`='".date('Y-m-d H:i:s')."' WHERE user_id =".$session_data['user_id']." and root_id=".$session_data['root_id']." and device_id='".$session_data['device_id']."'");
                echo 1;
                $this->update_online_users();
            }else{
                $this->session->unset_userdata('username');
                $this->session->sess_destroy();
                session_destroy();
                if (isset($_SERVER['HTTP_COOKIE'])) {
                    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                    foreach($cookies as $cookie) {
                        $parts = explode('=', $cookie);
                        $name = trim($parts[0]);
                        setcookie($name, '', time()-1000);
                        setcookie($name, '', time()-1000, '/');
                    }
                }
                echo 0;
                exit();
            }
            $this->db->query("UPDATE `xin_employees` SET `online`=1,`last_online`='".time()."' WHERE `user_id`='".$_SESSION['user_id']."' and `root_id`='".$_SESSION['root_id']."'");
        }

        $log_out_time = time()-20;
        $this->db->query("UPDATE `xin_employees` SET `online`=0 WHERE `last_online`<'".$log_out_time."'");
    }

    private function update_online_users(){
        $cookie_name = "mycbusername";
        $MainDb = $this->load->database('maindb', TRUE);
        if(isset($_COOKIE[$cookie_name])) {
            $session_data = unserialize($_COOKIE[$cookie_name]);
            if(isset($session_data['device_id'])){
                $condition2 = "user_id =".$session_data['user_id']." and root_id=".$session_data['root_id']." and device_id='".$session_data['device_id']."'";
                $MainDb->select('*');
                $MainDb->from('online_users');
                $MainDb->where($condition2);
                $MainDb->limit(1);
                $query2 = $MainDb->get();

                if ($query2->num_rows() == 1) {
                    $MainDb->query("UPDATE `online_users` SET `time`='".time()."' WHERE user_id ='".$session_data['user_id']."' and root_id='".$session_data['root_id']."' and device_id='".$session_data['device_id']."'");
                }
                else{
                    $user_os        = $this->getOS();
                    $user_browser   = $this->getBrowser();
                    $user_ip        = $this->input->ip_address();

                    $root_account_details = $this->Xin_model->get_root_account();
                    $user_information     = $this->Xin_model->read_user_info($session_data['user_id']);

                    $active_device_data = array(
                        'corbuz_name'   =>  $root_account_details[0]->corbuz_name,
                        'company_name'  =>  $root_account_details[0]->company_name,
                        'user_name'     =>  $user_information[0]->first_name.' '.$user_information[0]->last_name,
                        'user_id'       =>  $session_data['user_id'],
                        'root_id'       =>  $session_data['root_id'],
                        'ip'            =>  $user_ip,
                        'date'          =>  date('Y-m-d H:i:s'),
                        'time'          =>  time(),
                        'browser'       =>  $user_browser,
                        'os'            =>  $user_os,
                        'device_id'     =>  $session_data['device_id']
                    );

                    $this->Employees_model->add_user_online($active_device_data);
                }

            }
        }
    }

    public function delete_online_users(){
        $MainDb = $this->load->database('maindb', TRUE);
        $time_less = time()-100;
        $MainDb->query("DELETE FROM `online_users` WHERE time <='".$time_less."'");
    }

    public function delete_old_active_devices(){
        $MainDb = $this->load->database('maindb', TRUE);
        $MainDb->query("DELETE FROM active_devices WHERE date < DATE_SUB(NOW(), INTERVAL 1 MONTH);");
    }

    public function update_show_all_data(){
        if($this->input->post('add_type')=='show_all') {
            $session = $this->session->userdata('username');
            $root_id = $_SESSION['root_id'];
            $value = $this->input->post('ins_val');
            $col_name = 'show_all_'.$this->input->post('ins_col');
            $query = $this->db->query("SELECT * FROM employee_settings where emp_id='".$session['user_id']."' and root_id='".$root_id."'");
            $query->result();
            if($query->num_rows()==1){
                $this->db->query("UPDATE `employee_settings` SET `".$col_name."`='".$value."' WHERE `emp_id`='".$session['user_id']."' and root_id='".$root_id."'");
            }
            else
            {
                $this->db->query("INSERT INTO `employee_settings`(`root_id`, `emp_id`, `$col_name`) VALUES ('".$root_id."',".$session['user_id'].",'".$value."')");
            }
        }
    }

    public function search(){
        $query_data = '';
        if(isset($_REQUEST['q']))
        {
            $query_data = $_REQUEST['q'];
            $search_result = $this->Dashboard_model->search_full_datas($query_data);
            echo '<pre>';
            print_r($search_result);
        }
    }

    public function reports() {
        $fromdate=$this->uri->segment(3);
        $todate=$this->uri->segment(4);
        $employee=$_SESSION['user_id'];
        $fromdate1=date("Y-m-d",strtotime($fromdate));
        $todate1=date("Y-m-d",strtotime($todate));

        $data = $this->Dashboard_model->countPerMonth($fromdate1,$todate1,$employee);
        /*echo "<pre>";
        print_r($data);exit();*/
        $category = array();
        $category['name'] = 'Category';

        $series1 = array();
        $series1['name'] = 'Quote';

        $series2 = array();
        $series2['name'] = 'invoice';

        $series3 = array();
        $series3['name'] = 'profroma';

        $series4 = array();
        $series4['name'] = 'purchase';

        foreach ($data as $row) {
            $category['data'][] = $row['month'];
            $series1['data'][] = $row['total'];
            $series2['data'][] = $row['total1'];
            $series3['data'][] =$row['total2'];
            $series4['data'][] = $row['total3'];
        }

        $result = array();
        array_push($result,$category);
        array_push($result,$series1);
        array_push($result,$series2);
        array_push($result,$series3);
        array_push($result,$series4);

        print json_encode($result, JSON_NUMERIC_CHECK);

    }

    public function most_sell_prdt() {

        $fromdate=$this->uri->segment(3);
        $todate=$this->uri->segment(4);
        $employee=$this->uri->segment(5);
        $fromdate1=date("Y-m-d",strtotime($fromdate));
        $todate1=date("Y-m-d",strtotime($todate));

        $data1 = $this->Dashboard_model->most_sell_prdt($fromdate1,$todate1,$employee);
        /*echo "<pre>";
        print_r($data1);exit();*/
        $category = array();
        $category['name'] = 'Category';

        $series1 = array();
        $series1['name'] = 'Product';


        foreach ($data1 as $row) {

            $category['data'][] = $row->description;
            $series1['data'][] = $row->TotalQuantity;
        }

        $result = array();
        array_push($result,$category);
        array_push($result,$series1);

        print json_encode($result, JSON_NUMERIC_CHECK);

    }

    public function most_sell_brand() {

        $fromdate=$this->uri->segment(3);
        $todate=$this->uri->segment(4);
        $employee=$this->uri->segment(5);
        $fromdate1=date("Y-m-d",strtotime($fromdate));
        $todate1=date("Y-m-d",strtotime($todate));

        $data1 = $this->Dashboard_model->most_sell_brand($fromdate1,$todate1,$employee);
        /*echo "<pre>";
        print_r($data1);exit();*/
        $category = array();
        $category['name'] = 'Category';

        $series1 = array();
        $series1['name'] = 'Brand';


        foreach ($data1 as $row) {

            $category['data'][] = $row->name;
            $series1['data'][] = $row->TotalQuantity;
        }

        $result = array();
        array_push($result,$category);
        array_push($result,$series1);

        print json_encode($result, JSON_NUMERIC_CHECK);

    }

    public function reportsyear() {

        $yearreport = $this->Dashboard_model->countPerYear();
        $category = array();
        $category['name'] = 'C.O.D';

        $series1 = array();
        $series1['name'] = 'Shipment';

        $series2 = array();
        $series2['name'] = "SHIPPER's A/C";

        $series3 = array();
        $series3['name'] = 'CONSIGNEES A/C';

        foreach ($yearreport as $row) {
            $category['data'][] = $row->year;
            $series1['data'][] = $row->total;
            /*$series2['data'][] = $row->total1;
            $series3['data'][] = $row->total2;*/
        }

        $result = array();
        array_push($result,$category);
        array_push($result,$series1);
        /*array_push($result,$series2);
        array_push($result,$series3);*/

        print json_encode($result, JSON_NUMERIC_CHECK);

    }
    public function getdata() {

        $data = $this->Dashboard_model->countPerYear();
        //print_r($data);exit();
        $category = array();
        $category['name'] = 'Category';

        $series1 = array();
        $series1['name'] = 'Quote';

        $series2 = array();
        $series2['name'] = 'invoice';

        $series3 = array();
        $series3['name'] = 'profroma';

        $series4 = array();
        $series4['name'] = 'purchase';

        foreach ($data as $row) {
            $category['data'][] = $row->year;
            $series1['data'][] = $row->total;
            /*			$series3['data'][] =$row->total;
                        $series4['data'][] = $row->total;*/
        }

        $result = array();
        array_push($result,$category);
        //array_push($result,$series1);
        array_push($result,$series1);
        /*array_push($result,$series3);
        array_push($result,$series4);*/

        print json_encode($result, JSON_NUMERIC_CHECK);

    }


    public function pie()
    {

        $session = $this->session->userdata('username');
        $user_id = $session['user_id'];
        $root_id   = $_SESSION['root_id'];
        $fromdate=$this->uri->segment(3);
        $todate=$this->uri->segment(4);
        $employee=$this->uri->segment(5);
        $fromdate1=date("Y-m-d",strtotime($fromdate));
        $todate1=date("Y-m-d",strtotime($todate));

        $datediff = strtotime($todate1)-strtotime($fromdate1);
        $date_diff = round($datediff / (60 * 60 * 24));

        if($date_diff>31){
            $date_format = '%Y-%m';
        }else{
            $date_format = '%Y-%m-%d';
        }

        $sql = 'SELECT DATE_FORMAT(invoice_date, "'.$date_format.'") AS year, COUNT(*) AS total FROM pricing_invoices where root_id =' . $root_id . '  and DATE_FORMAT(invoice_date, "%Y-%m-%d")>= "'.$fromdate1.'" and DATE_FORMAT(invoice_date, "%Y-%m-%d")<= "'.$todate1.'" GROUP BY DATE_FORMAT(invoice_date, "'.$date_format.'")  ';
        $result = $this->db->query($sql);
        $rows =array();

        if(!empty($result->result()))
        {
            foreach($result->result() as $r)   {
                $row[0] = $r->total."<b style='font-size:10px'>:".$r->year;
                $row[1] = $r->total;
                array_push($rows,$row);
            }
        }
        else
        {
            $row[0] = 0;
            $row[1] = 0;
            array_push($rows,$row);
        }
        //print_r($rows);exit();
        print json_encode($rows, JSON_NUMERIC_CHECK);
    }


    public function donut()
    {
        $session = $this->session->userdata('username');
        $user_id = $session['user_id'];
        $root_id   = $_SESSION['root_id'];
        $fromdate=$this->uri->segment(3);
        $todate=$this->uri->segment(4);
        $employee=$this->uri->segment(5);
        $fromdate1=date("Y-m-d",strtotime($fromdate));
        $todate1=date("Y-m-d",strtotime($todate));

        if($employee>0)
        {
            $sql = 'SELECT DATE_FORMAT(quotation_date, "%Y-%m") AS month, COUNT(*) AS total FROM pricing_quotes where DATE_FORMAT(quotation_date, "%Y-%m-%d")>= "'.$fromdate1.'" and DATE_FORMAT(quotation_date, "%Y-%m-%d")<= "'.$todate1.'" and root_id='.$root_id.' and added_by='.$employee.' GROUP BY DATE_FORMAT(quotation_date, "%Y-%m")  ';

            $query1 = $this->db->query($sql);
            $recv = $query1->result();

            $sql1 = 'SELECT DATE_FORMAT(invoice_date, "%Y-%m") AS month, COUNT(*) AS total FROM pricing_invoices where DATE_FORMAT(invoice_date, "%Y-%m-%d")>= "'.$fromdate1.'" and DATE_FORMAT(invoice_date, "%Y-%m-%d")<= "'.$todate1.'" and root_id='.$root_id.' and added_by='.$employee.' GROUP BY DATE_FORMAT(invoice_date, "%Y-%m")  ';
            $query2 = $this->db->query($sql1);
            $recv1 = $query2->result();

        }

        else
        {
            $sql = 'SELECT DATE_FORMAT(quotation_date, "%Y-%m") AS month, COUNT(*) AS total FROM pricing_quotes where DATE_FORMAT(quotation_date, "%Y-%m-%d")>= "'.$fromdate1.'" and DATE_FORMAT(quotation_date, "%Y-%m-%d")<= "'.$todate1.'" and root_id='.$root_id.' GROUP BY DATE_FORMAT(quotation_date, "%Y-%m")  ';

            $query1 = $this->db->query($sql);
            $recv = $query1->result();

            $sql1 = 'SELECT DATE_FORMAT(invoice_date, "%Y-%m") AS month, COUNT(*) AS total FROM pricing_invoices where DATE_FORMAT(invoice_date, "%Y-%m-%d")>= "'.$fromdate1.'" and DATE_FORMAT(invoice_date, "%Y-%m-%d")<= "'.$todate1.'" and root_id='.$root_id.' GROUP BY DATE_FORMAT(invoice_date, "%Y-%m")  ';
            $query2 = $this->db->query($sql1);
            $recv1 = $query2->result();

        }


        for ($i=0; $i < sizeof($recv); $i++)
        {


            if(isset($recv1[$i]->total)){
                $total1=$recv1[$i]->total;
                $recv[$i]->total1=$total1;
            }
            else{
                $recv[$i]->total1="0";
            }


        }
        /* echo "<pre>";
        print_r($recv);exit();*/
        $result=$recv;
        $rows =array();

        if(!empty($result))
        {
            foreach($result as $r)   {
                $row[0] = $r->total."<b style='font-size:10px'>:".$r->month;
                $row[1] = $r->total1;
                array_push($rows,$row);
            }
        }
        else
        {
            $row[0] = 0;
            $row[1] = 0;
            array_push($rows,$row);
        }
        //print_r($rows);exit();
        print json_encode($rows, JSON_NUMERIC_CHECK);
    }

    public function getsuppliers()
    {

        $data = $this->Dashboard_model->countPerYearSuppliers();
        /*echo "<pre>";
        print_r($data);exit();*/
        $category = array();


        foreach ($data as $row) {
            $category[0] = $row->year;
            //$series1['data'][] = $row->total;
            $category[1] = $row->total;
            /*			$series3['data'][] =$row->total;
                        $series4['data'][] = $row->total;*/
        }

        //$result = array();
        array_push($category);

        print json_encode($category, JSON_NUMERIC_CHECK);

    }

    //Dashboard


    public function dash_reports() {

        $fromdate=$this->uri->segment(3);
        $todate=$this->uri->segment(4);
        $fromdate1=date("Y-m-d",strtotime($fromdate));
        $todate1=date("Y-m-d",strtotime($todate));

        $data = $this->Dashboard_model->dash_countPerMonth($fromdate1,$todate1);
        echo "<pre>";
        print_r($data);exit();
        $category = array();
        $category['name'] = 'Category';

        $series1 = array();
        $series1['name'] = 'Quote';

        $series2 = array();
        $series2['name'] = 'invoice';

        $series3 = array();
        $series3['name'] = 'profroma';

        $series4 = array();
        $series4['name'] = 'purchase';

        foreach ($data as $row) {
            $category['data'][] = $row['month'];
            $series1['data'][] = $row['total'];
            $series2['data'][] = $row['total1'];
            $series3['data'][] =$row['total2'];
            $series4['data'][] = $row['total3'];
        }

        $result = array();
        array_push($result,$category);
        array_push($result,$series1);
        array_push($result,$series2);
        array_push($result,$series3);
        array_push($result,$series4);

        print json_encode($result, JSON_NUMERIC_CHECK);

    }

    public function dash_most_sell_prdt() {

        $fromdate=$this->uri->segment(3);
        $todate=$this->uri->segment(4);
        $fromdate1=date("Y-m-d",strtotime($fromdate));
        $todate1=date("Y-m-d",strtotime($todate));

        $data1 = $this->Dashboard_model->dash_most_sell_prdt($fromdate1,$todate1);
        /*echo "<pre>";
        print_r($data1);exit();*/
        $category = array();
        $category['name'] = 'Category';

        $series1 = array();
        $series1['name'] = 'Product';


        foreach ($data1 as $row) {

            $category['data'][] = $row->description;
            $series1['data'][] = $row->TotalQuantity;
        }

        $result = array();
        array_push($result,$category);
        array_push($result,$series1);

        print json_encode($result, JSON_NUMERIC_CHECK);

    }

    public function dash_most_sell_brand() {

        $fromdate=$this->uri->segment(3);
        $todate=$this->uri->segment(4);
        $fromdate1=date("Y-m-d",strtotime($fromdate));
        $todate1=date("Y-m-d",strtotime($todate));

        $data1 = $this->Dashboard_model->dash_most_sell_brand($fromdate1,$todate1);
        /*echo "<pre>";
        print_r($data1);exit();*/
        $category = array();
        $category['name'] = 'Category';

        $series1 = array();
        $series1['name'] = 'Brand';


        foreach ($data1 as $row) {

            $category['data'][] = $row->name;
            $series1['data'][] = $row->TotalQuantity;
        }

        $result = array();
        array_push($result,$category);
        array_push($result,$series1);

        print json_encode($result, JSON_NUMERIC_CHECK);

    }


    public function dash_pie()
    {


        $session = $this->session->userdata('username');
        $user_id = $session['user_id'];
        $root_id   = $_SESSION['root_id'];
        $fromdate=$this->uri->segment(3);
        $todate=$this->uri->segment(4);
        $fromdate1=date("Y-m-d",strtotime($fromdate));
        $todate1=date("Y-m-d",strtotime($todate));

        $datediff = strtotime($todate1)-strtotime($fromdate1);
        $date_diff = round($datediff / (60 * 60 * 24));

        if($date_diff>31){
            $date_format = '%Y-%m';
        }else{
            $date_format = '%Y-%m-%d';
        }

        $sql = 'SELECT DATE_FORMAT(invoice_date, "'.$date_format.'") AS year, COUNT(*) AS total FROM pricing_invoices where root_id =' . $root_id . '  and DATE_FORMAT(invoice_date, "%Y-%m-%d")>= "'.$fromdate1.'" and DATE_FORMAT(invoice_date, "%Y-%m-%d")<= "'.$todate1.'" and added_by='.$user_id.' GROUP BY DATE_FORMAT(invoice_date, "'.$date_format.'")  ';

        //$query1 = $this->db->query($sql);
        $result = $this->db->query($sql);
        $rows =array();

        if(!empty($result->result()))
        {
            foreach($result->result() as $r)   {
                $row[0] = $r->total."<b style='font-size:10px'>:".$r->year;
                $row[1] = $r->total;
                array_push($rows,$row);
            }
        }
        else
        {
            $row[0] = 0;
            $row[1] = 0;
            array_push($rows,$row);
        }
        //print_r($rows);exit();
        print json_encode($rows, JSON_NUMERIC_CHECK);
    }

    public function get_count()
    {
        $fromdate=$this->input->get('fromdate');
        $todate=$this->input->get('todate');
        $fromdate1=date("Y-m-d",strtotime($fromdate));
        $todate1=date("Y-m-d",strtotime($todate));
        $data = $this->Dashboard_model->countPerdate($fromdate1,$todate1);
        print json_encode($data);

    }

    public function product_brand()
    {
        $fromdate=$this->input->get('fromdate');
        $todate=$this->input->get('todate');
        $employee=$this->input->get('employee');
        $fromdate1=date("Y-m-d",strtotime($fromdate));
        $todate1=date("Y-m-d",strtotime($todate));
        $data = $this->Dashboard_model->product_brand($fromdate1,$todate1,$employee);
        //print_r($data);exit();
        print json_encode($data);

    }

    public function search_keywords_data_list(){
        if(isset($_REQUEST['term']))
        {
            if(!isset($_SESSION['root_id'])){
                exit();
            }
            $return_arr = array();
            $q=$this->input->get('term');

            $session = $this->session->userdata('username');
            $root_id = $_SESSION['root_id'];
            $user_id = $session['user_id'];
            //$sql_res = $this->db->query("select * from all_email_ids where email like '%$q%' and root_id=".$root_id." and user_id=".$user_id." order by email LIMIT 5");
            //echo "select * from all_email_ids where email like '%$q%' and email NOT IN ( '" . implode( "', '" , $q_array ) . "' ) and root_id=".$root_id." and user_id=".$user_id." LIMIT 5";
            $sql_res = $this->db->query("select * from search_keywords_main where keyword like '%$q%' and root_id=".$root_id." and user_id=".$user_id." group by keyword LIMIT 5 ");
            foreach($sql_res->result() as $row)
            {
                $return_arr[] =  $row->keyword;
            }

            echo json_encode($return_arr);
        }

    }

    public function data_encryption(){

        $session = $this->session->userdata('username');
        if(!empty($session)){

        } else {
            redirect('');
        }

        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = '';
        $data['path_url'] = 'data_encryption';

        if(!empty($session)){
            $data['subview'] = $this->load->view("dashboard/data_encryption", $data, TRUE);
            $this->load->view('layout_dashboard', $data); //page load
        } else {
            redirect('');
        }

    }

    public function get_encrypted_data(){
        $data = $this->input->post('data');
        if(!empty($data)){
            $key  = hash('sha256', rand(111,9999));
            $method = 'AES-256-CBC';
            $ivSize = openssl_cipher_iv_length($method);
            $iv = openssl_random_pseudo_bytes($ivSize);
            $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
            echo $encrypted = base64_encode($iv . $encrypted);
        }
    }

    public function add_schedule_callback_request(){
        $session = $this->session->userdata('username');
        if(!empty($session)){

        } else {
            exit();
        }
        $data = array(
            'user_id'       =>  $session['user_id'],
            'root_id'       =>  $session['root_id'],
            'name'          =>  $this->input->post('schedule_contact_name'),
            'mobile'        =>  $this->input->post('schedule_mobile_number'),
            'call_time'     =>  $this->input->post('schedule_date'),
            'description'   =>  $this->input->post('schedule_description'),
            'created_date'  =>  date('Y-m-d H:i:s'),
        );
        $this->Xin_model->add_schedule_callback_request($data);

        $message = 'Name : '.$this->input->post('schedule_contact_name').'<br>';
        $message.= 'Mobile : '.$this->input->post('schedule_mobile_number').'<br>';
        $message.= 'Time : '.$this->input->post('schedule_date').'<br>';
        $message.= 'Remarks : '.$this->input->post('schedule_description').'<br>';
        $email_data = array(
            'email'   => 'basimaslamkp@gmail.com',
            'name'    => 'Basim Aslam',
            'subject' => 'Callback Request',
            'body'    => htmlentities(addslashes($message)),
            'time'    => date('Y-m-d H:i:s'),
            'user_id' => $session['user_id']
        );
        $this->Xin_model->update_email_notification_data($email_data);

    }

}
