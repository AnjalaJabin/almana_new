<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends MY_Controller
{
    public function __construct()
    {
        Parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        // load email library

        $this->load->database();
        $this->load->library('Pdf');
        //$this->load->library('email');
        $this->load->library('form_validation');
        //load the model
        $this->load->model("Xin_model");
        $this->load->model("Request_model");
        $this->load->model("Budgeting_model");
    }
    public function add_request(){
        $session = $this->session->userdata('username');
        $budget_id = $this->uri->segment(3);
        if(!empty($session) && !empty($budget_id) && is_numeric($budget_id)){

        } else {
            redirect('');
        }
        $this->session->set_userdata('previous_url', current_url());

        $data = array();
        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $data['assigned_budget_category'] = $this->Budgeting_model->get_budget_categories($budget_id);
        $data['all_sub_categories'] = $this->Xin_model->get_sub_categories_by_user_and_budget_id($session['user_id'],$budget_id);
        $data['all_cost_centers'] = $this->Xin_model->get_all_cost_centers();
        $data['all_suppliers'] = $this->Xin_model->get_all_suppliers();
        $data['budget_details_info'] = $this->Budgeting_model->read_budget_data_by_id($budget_id);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['budget_id'] = $budget_id;
        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Add Request';
        $data['path_url'] = 'add_request';
       
        /*if(empty($data['all_sub_categories']->result()))
        {
            redirect('budgeting/budget_details/'.$budget_id);
        }*/
        if(!empty($session)){

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $data['subview'] = $this->load->view("request/add_request", $data, TRUE);

            $this->load->view('layout_main', $data); //page load
        } else {
            redirect('');
        }
    }
    // get allocated amount details for sub category
    public function get_budget_total_by_sub_cat(){
        $budget_id = $this->uri->segment(3);
        $sub_cat_id = $this->uri->segment(4);
        $employee_id = $this->session->userdata('username')['user_id'];

        $cat_total = 0;
        $total_used = 0;
        $total_by_user=0;
        $query_a = $this->db->query("SELECT * FROM `assigned_budget_sub_cats` WHERE `budget_id`='".$budget_id."' and `sub_category_id`='".$sub_cat_id."'");
        foreach($query_a->result() as $cat_data){
            $cat_total=$cat_total+$cat_data->amount;
        }
        $query_b = $this->db->query("SELECT * FROM `budget_subcat_employee_assign` WHERE `budget_id`='".$budget_id."' and `sub_cat_id`='".$sub_cat_id."'and `employee_id`='".$employee_id."'");
        $total_assigned =$query_b->result()?$query_b->result()[0]->amount:'0';
        $query_c = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."' and `sub_category`='".$sub_cat_id."'");
        if($query_c->result()) {
            foreach ($query_c->result() as $expense_data) {
                $total_used = $total_used + $expense_data->amount;
            }
        }

        $query_d= $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."' and `sub_category`='".$sub_cat_id."'and `added_by`='".$employee_id."'");
        if($query_d->result()) {
            foreach ($query_d->result() as $expense_user) {
                $total_by_user = $total_by_user + $expense_user->amount;
            }
        }
        echo json_encode(array('cat_total'=> $cat_total,'total_assigned'=>$total_assigned,'total_used'=>$total_used,'total_by_user'=>$total_by_user),true);
    }


    //save new request
    public function add_new_budget_request()
    {
        if($this->input->post('add_type')=='add_new_budget_request') {

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $session = $this->session->userdata('username');
            $file = '';
            /* Server side PHP input validation */
            if($this->input->post('date')==='') {
                $Return['error'] = 'Date is required!';
            } else if($this->input->post('sub_category_id')==='') {
                $Return['error'] = 'Category is required!';
            } else if($this->input->post('amount')==='') {
                $Return['error'] = 'Amount is required!';
            } else if ($this->input->post('currency') === '') {
                $Return['error'] = 'Currency is required!';
            }else if(!isset($session['user_id'])){
                $Return['error'] = 'Login is expired!';
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $budget_id = $this->input->post('budget_id');
            //convert to budget currency
            $budget= $this->Budgeting_model->read_budget_data_by_id($budget_id);
            $currency_1     =   $this->input->post('currency');
            $currency_b     =   $budget[0]->currency;
            $initial_amount         =   $this->input->post('amount');
            if($currency_1!=$currency_b)
                $amount =  $this->convert_to_current_currency($initial_amount,$currency_1,$currency_b,0);
            else
                $amount =  $initial_amount;

            $data = array(
                'department_id' => $user[0]->department_id,
                'budget_id' => $this->input->post('budget_id'),
                'expense_type' => $this->input->post('expense_type'),
                'status'       =>0,
                'requested_date' => date('Y-m-d',strtotime($this->input->post('date'))),
                'initial_req_amount'=>$initial_amount,
                'requested_amount' => $amount,
                'currency'      =>  $currency_1,
                'main_cat_id' => $this->input->post('selected_main_cat_id'),
                'sub_cat_id' => $this->input->post('sub_category_id'),
                'remarks' => $this->input->post('remarks'),
                'requester_id' => $session['user_id'],
                'created_date' => date('Y-m-d H:i:s'),
            );
            $result = $this->Request_model->add_request($data);


            if ($result == TRUE) {
                $Return['result'] = 'Successfully added your request!';
                $Return['redirect_url'] = site_url('budgeting/budget_details/'.$budget_id);
            } else {
                $Return['error'] = $this->lang->line('xin_error_msg');
            }
            $this->output($Return);
            exit;
        }

    }
    /*Function to set JSON output*/
    public function output($Return=array()){
        /*Set response header*/
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        /*Final JSON response*/
        exit(json_encode($Return));
    }

    public function request_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        $employee_id = $session['user_id'];
        $user = $this->Xin_model->read_user_info($employee_id);

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $budget_id = $this->uri->segment(3);

        $data = array();
        $req_query = $this->db->query("SELECT e.expense_type,e.requested_date, e.approver_id,e.requested_amount,e.sub_cat_id,e.status as request_status,e.approved_amount ,e.budget_id, e.id as request_id,  e.approver_id,e.requester_id, c.name as category_name, sc.name as sub_category_name ,d.name as department_name,u.first_name as requested_by,case when a.user_id =e.approver_id then a.first_name   else '' end as approved_by FROM requests e, categories c, sub_categories sc,departments d,xin_employees u,xin_employees a WHERE e.budget_id='".$budget_id."' and c.id=e.main_cat_id  and d.id=e.department_id and u.user_id=e.requester_id  and sc.id=e.sub_cat_id group by request_id");
        foreach($req_query->result() as $request_data)
        {

            $sub_cat_total = 0;

            $option='';
            if ($request_data->request_status ==1)
            {
                $approved_by= $this->Xin_model->read_user_info($request_data->approver_id);
                $status = '<span class=" fw-bolder px-4 py-3 title="Approved!">
				<span class="svg-icon svg-icon-1 svg-icon-success">
					<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
						<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF"></path>
						<path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
					</svg>
				</span>
			</span>';
            }
            else if($request_data->request_status ==0){
                $status ='<span class=" fw-bolder px-4 py-3" title="Pending">
<i class="fa fa-spinner" aria-hidden="true"></i>
			</span>';
                $option= '<a class="symbol symbol-20px mb-5" target="blank" href="'.site_url('request/edit_request/'.$budget_id.'/'.$request_data->request_id).'"><i title="Edit" class="fa fa-pen"></i></a>&nbsp;';

            }
            else{
             $status=  ' <span class=" fw-bolder px-4 py-3" title="Rejected">
<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
			</span>';
            }
            if($user[0]->user_role_id==1 ){
                $option.= '<span data-toggle="tooltip" data-placement="top" title="View"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"  data-bs-toggle="modal" data-bs-target=".view-modal-data"  id="req_view_button" data-request_id="'. $request_data->request_id . '"><i class="fas fa-eye"></i></button></span>';


            }
            $cat_total=0;$total_used=0;
            $query_a = $this->db->query("SELECT amount FROM `assigned_budget_sub_cats` WHERE `budget_id`='".$budget_id."' and `sub_category_id`='".$request_data->sub_cat_id."'");
             if($query_a->result()){
               foreach($query_a->result() as $expense_data){
                   $cat_total=$cat_total+$expense_data->amount;
               }
             }

            $query_c = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."' and `sub_category`='".$request_data->sub_cat_id."'");
            if($query_c->result()) {
                foreach ($query_c->result() as $expense_data) {
                    $total_used = $total_used + $expense_data->amount;
                }
            }
            $sub_cat_balance = $cat_total-$total_used;


            $data[] = array(
                $request_data->request_id,
                date('d-m-Y',strtotime($request_data->requested_date)),
                $request_data->expense_type,
                $request_data->sub_category_name,
                $request_data->category_name,
                number_format($request_data->requested_amount),
                $request_data->requested_by,
                $request_data->department_name,
                $sub_cat_balance,
                $status,
                $request_data->request_status,
                $request_data->approved_amount,
                $request_data->approved_by,
                $option,
            );
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $req_query->num_rows(),
            "recordsFiltered" => $req_query->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    public function edit_request(){

        $session = $this->session->userdata('username');
        $budget_id = $this->uri->segment(3);
        $request_id = $this->uri->segment(4);

        if(!empty($session) && !empty($budget_id) && is_numeric($budget_id) && !empty($request_id) && is_numeric($request_id)){

        } else {
            redirect('');
        }

        $data = array();

        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $data['assigned_budget_category'] = $this->Budgeting_model->get_budget_categories($budget_id);
        $data['all_sub_categories'] = $this->Xin_model->get_sub_categories_by_department_and_budget_id($data['department_id'],$budget_id);
        $data['budget_details_info'] = $this->Budgeting_model->read_budget_data_by_id($budget_id);
        $data['request_data'] = $this->Request_model->read_request_data_by_id($request_id);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['budget_id'] = $budget_id;
        $data['request_id'] = $request_id;
        $data['currency_data']       = $this->Xin_model->get_currencies(1);
        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Edit Request';
        $data['path_url'] = 'edit_request';
        if(!empty($session)){

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $data['subview'] = $this->load->view("request/edit_request", $data, TRUE);

            $this->load->view('layout_main', $data); //page load
        } else {
            redirect('');
        }
    }
    public function update_request()
    {
        if($this->input->post('add_type')=='add_new_budget_request') {

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $session = $this->session->userdata('username');
            $file = '';
            /* Server side PHP input validation */
            if($this->input->post('date')==='') {
                $Return['error'] = 'Date is required!';
            } else if($this->input->post('sub_category_id')==='') {
                $Return['error'] = 'Category is required!';
            } else if($this->input->post('amount')==='') {
                $Return['error'] = 'Amount is required!';
            } else if ($this->input->post('currency') === '') {
                $Return['error'] = 'Currency is required!';
            }else if(!isset($session['user_id'])){
                $Return['error'] = 'Login is expired!';
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $budget_id = $this->input->post('budget_id');
            $request_id = $this->input->post('request_id');
            //convert to budget currency
            $budget= $this->Budgeting_model->read_budget_data_by_id($budget_id);
            $currency_1     =   $this->input->post('currency');
            $currency_b     =   $budget[0]->currency;
            $initial_amount         =   $this->input->post('amount');
            if($currency_1!=$currency_b)
                $amount =  $this->convert_to_current_currency($initial_amount,$currency_1,$currency_b,0);
            else
                $amount =  $initial_amount;
            $data = array(
                'department_id' => $user[0]->department_id,
                'budget_id' => $this->input->post('budget_id'),
                'expense_type' => $this->input->post('expense_type'),
                'status'       =>0,
                'requested_date' => date('Y-m-d',strtotime($this->input->post('date'))),
                'initial_req_amount'=>$initial_amount,
    		    'requested_amount' => $amount,
                'currency'      =>  $currency_1,
                'main_cat_id' => $this->input->post('selected_main_cat_id'),
                'sub_cat_id' => $this->input->post('sub_category_id'),
                'remarks' => $this->input->post('remarks'),
                'requester_id' => $session['user_id'],
            );
            $result = $this->Request_model->update_request($data,$request_id);


            if ($result == TRUE) {
                $Return['result'] = 'Successfully updated your request!';
                $Return['redirect_url'] = site_url('budgeting/budget_details/'.$budget_id);
            } else {
                $Return['error'] = $this->lang->line('xin_error_msg');
            }
            $this->output($Return);
            exit;
        }


    }
     public function read_request()
     {
            $session = $this->session->userdata('username');

             $budget_id = $this->input->post('budget_id');
             $request_id = $this->input->post('request_id');
             $user = $this->Xin_model->read_user_info($session['user_id']);
             $employee_id = $session['user_id'];

             $req_query = $this->db->query("SELECT e.expense_type,e.requested_date,e.requester_id, e.requested_amount,e.sub_cat_id,e.status as request_status,e.approved_amount ,e.budget_id, e.id as request_id,  e.approver_id, c.name as category_name, sc.name as sub_category_name ,d.name as department_name,u.first_name as requested_by,case when a.user_id =e.approver_id then a.first_name   else '-------' end as approved_by FROM requests e, categories c, sub_categories sc,departments d,xin_employees u,xin_employees a WHERE e.id='".$request_id."' and c.id=e.main_cat_id  and d.id=e.department_id and u.user_id=e.requester_id  and sc.id=e.sub_cat_id group by request_id");

             $request_data =$req_query->result();

         $cat_total=0;$total_used=0;
         $total_by_user=0;

         $query_a = $this->db->query("SELECT amount FROM `assigned_budget_sub_cats` WHERE `budget_id`='".$budget_id."' and `sub_category_id`='".$request_data[0]->sub_cat_id."'");

         if($query_a->result()){
             foreach($query_a->result() as $expense_data){
                 $cat_total=$cat_total+$expense_data->amount;
             }
         }

         $query_b = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."' and `sub_category`='".$request_data[0]->sub_cat_id."'");
         if($query_b->result()) {
             foreach ($query_b->result() as $expense_data) {
                 $total_used = $total_used + $expense_data->amount;
             }
         }
         $sub_cat_balance = $cat_total-$total_used;
         $query_c = $this->db->query("SELECT * FROM `budget_subcat_employee_assign` WHERE `budget_id`='".$budget_id."' and `sub_cat_id`='".$request_data[0]->sub_cat_id."'and `employee_id`='".$employee_id."'");
         $total_assigned =$query_c->result()?$query_c->result()[0]->amount:'0';
         $query_d= $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."' and `sub_category`='".$request_data[0]->sub_cat_id."'and `added_by`='".$employee_id."'");
         if($query_d->result()) {
             foreach ($query_d->result() as $expense_user) {
                 $total_by_user = $total_by_user + $expense_user->amount;
             }
         }
         if($request_data[0]->request_status==0){
             $status = "Pending";
         }
         elseif ($request_data[0]->request_status==1){
             $status    =   "Approved";

         }else{
             $status    ="Declined";
         }
         $data      = array(
             'budget_id'        =>$budget_id,
             'request_data'     => $request_data,
             'cat_total'        =>$cat_total,
             'total_used'       =>$total_used,
             'total_assigned'   =>$total_assigned,
             'total_by_user'=>$total_by_user,
             'user_details'     => $user,
             'request_status'  => $status,
         );


         if(!empty($session)){
             $this->load->view('request/dialog_request', $data);
         } else {
             redirect('');
         }


     }
     public function request_action()
     {
         $Return = array('result'=>'', 'error'=>'','redirect_url'=>'');

         $request_id= $this->input->post('request_id');
         $method= $this->input->post('method');
         $budget_id = $this->input->post('budget_id');

         $session = $this->session->userdata('username');
         $user = $this->Xin_model->read_user_info($session['user_id']);

         if($method=="approve") {
             if(!isset($_POST['amount'])||($_POST['amount']==0)) {
                 $Return['error'] = 'Please enter approved amount!';
             }



             if($Return['error']!=''){
                 $this->output($Return);
             }
             $data = array(
                 'status' => 1,
                 'approved_date' => date('Y-m-d', strtotime($this->input->post('date'))),
                 'approved_amount' => $this->input->post('amount'),
                 'approver_id' => $session['user_id'],
             );
         }else{
             $data = array(
                 'status' => 2,

             );
         }
             $result = $this->Request_model->update_request($data,$request_id);

             if ($result == TRUE) {

                 $Return['result'] = $method=="approve"? "Request Approved":"Request Denied!!";
             } else {
                 $Return['error'] = 'Bug. Something went wrong, please try again.';
                 $Return['redirect_url'] = site_url('budgeting/budget_details/'.$budget_id);

             }
         $this->output($Return);
         exit;


     }
    /* function to convert to usd*/
    public function convert_to_current_currency($value,$currencyfrom,$currencyto,$type=0)
    {
        $currency_from = $this->Xin_model->get_currency_data_by_code($currencyfrom);
        $currency_to = $this->Xin_model->get_currency_data_by_code($currencyto);
        if(($currency_from) && ($currency_to) &&($value!='')){
            $amount= ($value/$currency_from[0]->one_usd)*($currency_to[0]->one_usd);

        }
        else{
            $amount =   $value;

        }
        if ($type==1)
        {
            echo json_encode(array('amount'=> $amount),true);
            exit;

        }
        else{
            return $amount;
        }




    }


}