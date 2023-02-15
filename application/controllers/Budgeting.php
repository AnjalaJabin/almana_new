<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PDFMerger\PDFMerger;

class Budgeting extends MY_Controller {

    public function __construct() {
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
        $this->load->model("Budgeting_model");
        $this->load->library('../controllers/mypdf');
        $this->load->helper("file");




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

    }

    public function allocated_budget()
    {
        $session = $this->session->userdata('username');
        if(!empty($session)){

        } else {
            redirect('');
        }

        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Budgeting';
        $data['path_url'] = 'budgeting';
        $user = $this->Xin_model->read_user_info($session['user_id']);
        $dep_id = $user[0]->department_id;
        $role_resources_ids = $this->Xin_model->user_role_resource();
        $data['all_budgeting'] = $this->Budgeting_model->get_all_budgeting($dep_id);
        if(in_array('3',$role_resources_ids)) {
            if(!empty($session)){
                $user = $this->Xin_model->read_user_info($session['user_id']);
                $data['subview'] = $this->load->view("budgeting/budgeting_board", $data, TRUE);
                $this->load->view('layout_main', $data); //page load
            } else {
                redirect('');
            }
        }else{
            redirect('dashboard/');
        }
    }

    public function allocated_budget_list()
    {
        $session = $this->session->userdata('username');
        if(!empty($session)){

        } else {
            redirect('');
        }

        $data['title'] = $this->Xin_model->site_title();
        $user = $this->Xin_model->read_user_info($session['user_id']);
        $dep_id = $user[0]->department_id;

        $data['breadcrumbs'] = 'Budgeting';
        $data['path_url'] = 'budgeting';
        $data['all_budgeting'] = $this->Budgeting_model->get_all_budgeting($dep_id);

        $role_resources_ids = $this->Xin_model->user_role_resource();
        if(in_array('3',$role_resources_ids)) {
            if(!empty($session)){

                $user = $this->Xin_model->read_user_info($session['user_id']);
                $data['subview'] = $this->load->view("budgeting/budgeting_list", $data, TRUE);

                $this->load->view('layout_main', $data); //page load
            } else {
                redirect('');
            }}else{
            redirect('dashboard/');

        }
    }

    public function add_budget()
    {

        $session = $this->session->userdata('username');
        if(!empty($session)){

        } else {
            redirect('');
        }

        $data = array();
        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $dept = $this->Budgeting_model->read_budget_dept($user[0]->department_id);
        $data['dept_name'] = $dept[0]->name;
        $data['all_categories'] = $this->Xin_model->get_categories_by_department($data['department_id']);
        $data['all_sub_categories'] = $this->Xin_model->get_sub_categories_by_department($data['department_id']);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Add Budget';
        $data['path_url'] = 'add_budget';
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if(in_array('3',$role_resources_ids)) {
            if (!empty($session)) {

                $user = $this->Xin_model->read_user_info($session['user_id']);
                $data['subview'] = $this->load->view("budgeting/add_budget", $data, TRUE);

                $this->load->view('layout_main', $data); //page load
            } else {
                redirect('');
            }
        }else{
            redirect('dashboard/');

        }
    }

    public function edit_budget()
    {
        $session = $this->session->userdata('username');
        $budget_id = $this->uri->segment(3);
        if(!empty($session)){

        } else {
            redirect('');
        }

        $data = array();
        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $dept = $this->Budgeting_model->read_budget_dept($user[0]->department_id);
        $data['dept_name'] = $dept[0]->name;

        $data['all_categories'] = $this->Xin_model->get_categories_by_department($data['department_id']);
        $data['all_sub_categories'] = $this->Xin_model->get_sub_categories_by_department($data['department_id']);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['assigned_budget_category'] = $this->Budgeting_model->get_budget_categories($budget_id);
        $data['budget_details_info'] = $this->Budgeting_model->read_budget_data_by_id($budget_id);
        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Edit Budget';
        $data['path_url'] = 'edit_budget';
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if(in_array('3',$role_resources_ids)) {
            if(!empty($session)){

                $user = $this->Xin_model->read_user_info($session['user_id']);
                $data['subview'] = $this->load->view("budgeting/edit_budget", $data, TRUE);

                $this->load->view('layout_main', $data); //page load
            } else {
                redirect('');
            }
        }else{
            redirect('dashboard/');

        }
    }
    public function edit_direct_expense()
    {
        $session = $this->session->userdata('username');
        //print_r($this->input->get());
        // $expense_id = $this->uri->segment(3);
        $expense_id = $this->input->get('exp_id');

        $result = $this->Budgeting_model->read_expense_data_by_id($expense_id);
        $costcenter=$this->Xin_model->read_cost_center_data_by_id($result[0]->cost_center);

        $department=$this->Xin_model->read_department_data_by_id($result[0]->department_id);
        $vendor=$this->Xin_model->read_suppliers_data_by_id($result[0]->supplier_id);

        $data['breadcrumbs'] = $this->lang->line('xin_employee_details');
        $data['path_url'] = 'edit_expense';

        $data = array(
            'exp_id'=>$expense_id,
            'exp_title'=>$result[0]->exp_title,
            'date' => $result[0]->date,
            'cost_center' => $result[0]->cost_center,
            'department' => $result[0]->department_id,
            'vendor' => $result[0]->supplier_id,
            'supp_refno' => $result[0]->supplier_ref,
            'employee_code' => $result[0]->emp_code,
            'amt' =>$result[0]->amount,
            'currency' =>$result[0]->currency,
            'tax_code' =>$result[0]->tax_code,
            'file' =>$result[0]->file,
            'company_id' =>$result[0]->company_id,
            'detail_des'=>$result[0]->description
        );


        if(!empty($session)){
            $this->load->view("budgeting/edit_direct_expense", $data);
        } else {
            redirect('');
        }

    }

    public function add_budget_sub_cats()
    {
        exit();
        $session = $this->session->userdata('username');
        $budget_id = $this->uri->segment(3);
        if(!empty($session) && !empty($budget_id)){

        } else {
            redirect('');
        }

        $data = array();

        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $data['assigned_budget_category'] = $this->Budgeting_model->get_budget_categories($budget_id);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['budget_id'] = $budget_id;
        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Add Budget';
        $data['path_url'] = 'add_budget_sub_cats';

        if(!empty($session)){

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $data['subview'] = $this->load->view("budgeting/add_budget_sub_cats", $data, TRUE);

            $this->load->view('layout_main', $data); //page load
        } else {
            redirect('');
        }
    }

    public function budget_details(){
        $session = $this->session->userdata('username');
        $budget_id = $this->uri->segment(3);
        if(!empty($session) && !empty($budget_id)){

        } else {
            redirect('');
        }

        $data = array();

        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $data['budget_id'] = $budget_id;
        $data['assigned_budget_category'] = $this->Budgeting_model->get_budget_categories($budget_id);
        $data['budget_details_info'] = $this->Budgeting_model->read_budget_data_by_id($budget_id);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['budget_id'] = $budget_id;
        $data['title'] = $this->Xin_model->site_title();
        $data['all_expenses'] = $this->Xin_model->get_all_expenses();
        $data['breadcrumbs'] = 'Add Budget';
        $data['path_url'] = 'budget_details';
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if(in_array('2',$role_resources_ids)) {
            if(!empty($session)){

                $user = $this->Xin_model->read_user_info($session['user_id']);
                $data['subview'] = $this->load->view("budgeting/budget_details", $data, TRUE);

                $this->load->view('layout_main', $data); //page load
            } else {
                redirect('');
            }
        }
        else{
            redirect('dashboard/');

        }
    }


    public function pending_budget_details(){
        $session = $this->session->userdata('username');
        $budget_id = $this->uri->segment(3);
        if(!empty($session) && !empty($budget_id)){

        } else {
            redirect('');
        }

        $data = array();

        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $data['assigned_budget_category'] = $this->Budgeting_model->get_budget_categories($budget_id);
        $data['budget_details_info'] = $this->Budgeting_model->read_budget_data_by_id($budget_id);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['budget_id'] = $budget_id;
        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Add Budget';
        $data['path_url'] = 'budget_details';
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if(in_array('4',$role_resources_ids)) {
            if(!empty($session)){

                $user = $this->Xin_model->read_user_info($session['user_id']);
                $data['subview'] = $this->load->view("budgeting/pending_budget_details", $data, TRUE);

                $this->load->view('layout_main', $data); //page load
            } else {
                redirect('');
            }}else{
            redirect('dashboard/');

        }
    }


    public function approve_budget(){
        $session = $this->session->userdata('username');
        $budget_id = $this->uri->segment(3);
        if(!empty($session) && !empty($budget_id)){

        } else {
            redirect('');
        }

        $data = array();

        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $data['assigned_budget_category'] = $this->Budgeting_model->get_budget_categories($budget_id);
        $data['budget_details_info'] = $this->Budgeting_model->read_budget_data_by_id($budget_id);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['budget_id'] = $budget_id;
        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Approve Budget';
        $data['path_url'] = 'approve_budget';

        if(!empty($session)){

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $data['subview'] = $this->load->view("budgeting/approve_budget_details", $data, TRUE);

            $this->load->view('layout_main', $data); //page load
        } else {
            redirect('');
        }
    }
    public function budget_allocation($budget_id)
    {
        $data = array();
        $session = $this->session->userdata('username');
        if(!empty($session) && !empty($budget_id)){

        } else {
            redirect('');
        }

        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $data['budget_id']=$budget_id;
        $data['budget_details_info'] = $this->Budgeting_model->read_budget_data_by_id($budget_id);
        $data['assigned_budget_category'] = $this->Budgeting_model->get_budget_categories($budget_id);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Budget Allocation';
        $data['path_url'] = 'budget_allocation';
        $data['subview'] =$this->load->view("budgeting/budget_allocation",$data,TRUE);
        $this->load->view('layout_main', $data);
    }
    public function budget_allocation_employees($budget_id)
    {
        $data = array();
        $session = $this->session->userdata('username');
        if(!empty($session) && !empty($budget_id)){

        } else {
            redirect('');
        }

        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $data['budget_id']=$budget_id;
        $data['budget_details_info'] = $this->Budgeting_model->read_budget_data_by_id($budget_id);
        $data['assigned_budget_category'] = $this->Budgeting_model->get_budget_categories($budget_id);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Budget Allocation';
        $data['path_url'] = 'budget_allocation';
        $data['subview'] =$this->load->view("budgeting/budget_allocation_employees",$data,TRUE);
        $this->load->view('layout_main', $data);
    }
    public function allocation_view($id)
    {
        $data = array();
        $session = $this->session->userdata('username');
        if(!empty($session) && !empty($budget_id)){

        } else {
            redirect('');
        }

        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['allocation'] =$this->Budgeting_model->get_budget_allocations($id);
        var_dump($data);
        die;

    }

    public function add_expense(){
        $session = $this->session->userdata('username');
        $budget_id = $this->uri->segment(3);
        if(!empty($session) && !empty($budget_id) && is_numeric($budget_id)){

        } else {
            redirect('');
        }

        $data = array();

        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $data['assigned_budget_category'] = $this->Budgeting_model->get_budget_categories($budget_id);
        $data['all_sub_categories'] = $this->Xin_model->get_sub_categories_by_department_and_budget_id($data['department_id'],$budget_id);
        $data['all_cost_centers'] = $this->Xin_model->get_all_cost_centers();
        $data['all_suppliers'] = $this->Xin_model->get_all_suppliers();
        $data['budget_details_info'] = $this->Budgeting_model->read_budget_data_by_id($budget_id);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['budget_id'] = $budget_id;
        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Add Budget';
        $data['path_url'] = 'add_expense';
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if(in_array('33',$role_resources_ids)) {

            if(!empty($session)){

                $user = $this->Xin_model->read_user_info($session['user_id']);
                $data['subview'] = $this->load->view("budgeting/add_expense", $data, TRUE);

                $this->load->view('layout_main', $data); //page load
            } else {
                redirect('');
            }}else{
            redirect('dashboard/');

        }
    }


    public function edit_expense(){
        $session = $this->session->userdata('username');
        $budget_id = $this->uri->segment(3);
        $expense_id = $this->uri->segment(4);
        if(!empty($session) && !empty($budget_id) && is_numeric($budget_id) && !empty($expense_id) && is_numeric($expense_id)){

        } else {
            redirect('');
        }

        $data = array();

        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $data['assigned_budget_category'] = $this->Budgeting_model->get_budget_categories($budget_id);
        $data['all_sub_categories'] = $this->Xin_model->get_sub_categories_by_department_and_budget_id($data['department_id'],$budget_id);
        $data['all_cost_centers'] = $this->Xin_model->get_all_cost_centers();
        $data['all_suppliers'] = $this->Xin_model->get_all_suppliers();
        $data['currency_data']       = $this->Xin_model->get_currencies(1);

        $data['budget_details_info'] = $this->Budgeting_model->read_budget_data_by_id($budget_id);
        $data['expense_data'] = $this->Budgeting_model->read_expense_data_by_id($expense_id);
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['budget_id'] = $budget_id;
        $data['expense_id'] = $expense_id;
        $data['title'] = $this->Xin_model->site_title();
        $data['breadcrumbs'] = 'Add Budget';
        $data['path_url'] = 'edit_expense';


        if(!empty($session)){

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $data['subview'] = $this->load->view("budgeting/edit_expense", $data, TRUE);

            $this->load->view('layout_main', $data); //page load
        } else {
            redirect('');
        }
    }


    public function get_main_cat_name_by_sub_cat_id(){
        $sub_cat_id = $this->uri->segment(3);
        $query = $this->db->query("SELECT * FROM `categories` WHERE id IN(select main_cat_id from sub_categories where id='".$sub_cat_id."')")->result();
        echo json_encode(array('id'=> $query[0]->id, 'name' => $query[0]->name),true);
    }

    public function get_budget_total_expense_by_main_cat(){
        $budget_id = $this->uri->segment(3);
        $main_cat_id = $this->uri->segment(4);
        $cat_total = 0;
        $grand_tot = 0;
        $query = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."' and `main_category_id`='".$main_cat_id."'");
        foreach($query->result() as $expense_data){
            $cat_total=$cat_total+$expense_data->amount;
        }

        $query = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."'");
        foreach($query->result() as $expense_data){
            $grand_tot=$grand_tot+$expense_data->amount;
        }

        $b_query = $this->db->query("SELECT * FROM `budgeting` WHERE `id`='".$budget_id."'")->result();
        $budget_available = $b_query[0]->amount-$grand_tot;
        echo json_encode(array('cat_total'=> $cat_total, 'grand_tot' => $grand_tot, 'total_available' => $budget_available),true);
    }

    public function get_budget_total_expense_by_main_cat_edit(){
        $budget_id = $this->uri->segment(3);
        $main_cat_id = $this->uri->segment(4);
        $expense_id = $this->uri->segment(5);
        $cat_total = 0;
        $grand_tot = 0;
        $query = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."' and `id`!='".$expense_id."' and `main_category_id`='".$main_cat_id."'");
        foreach($query->result() as $expense_data){
            $cat_total=$cat_total+$expense_data->amount;
        }

        $query = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."' and `id`!='".$expense_id."'");
        foreach($query->result() as $expense_data){
            $grand_tot=$grand_tot+$expense_data->amount;
        }

        $b_query = $this->db->query("SELECT * FROM `budgeting` WHERE `id`='".$budget_id."'")->result();
        $budget_available = $b_query[0]->amount-$grand_tot;
        echo json_encode(array('cat_total'=> $cat_total, 'grand_tot' => $grand_tot, 'total_available' => $budget_available),true);
    }


    public function save_new_budget(){

        if($this->input->post('add_type')=='budget') {

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('budget_name')==='') {
                $Return['error'] = 'Budget Name is required';
            } else if($this->input->post('start_date')==='') {
                $Return['error'] = 'Budget Start Date is required!';
            } else if($this->input->post('end_date')==='') {
                $Return['error'] = 'Budget End Date is required!';
            } else if(!isset($session['user_id'])){
                $Return['error'] = 'Login is expired!';
            } else if(strtotime($this->input->post('end_date'))<strtotime($this->input->post('start_date'))) {
                $Return['error'] = 'End date should be greater than start date!';
            } else if(!isset($_POST['main_category'][0])) {
                $Return['error'] = 'Select category.';
            }

            $total_assigned_budget = 0;
            foreach($_POST['main_category'] as $main_cat_key=>$main_cat_id){

                if(empty($_POST['main_category'][$main_cat_key])) {
                    $Return['error'] = 'Select category name.';
                }

                foreach($_POST['sub_category'][$main_cat_id] as $sub_cat_key=>$sub_item){

                    if(empty($_POST['sub_category'][$main_cat_id][$sub_cat_key])) {
                        $Return['error'] = 'Select category name.';
                    }
                    else if(empty($_POST['sub_cat_amount'][$main_cat_id][$sub_cat_key])) {
                        $Return['error'] = 'Type selected category budget.';
                    }
                }
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $user = $this->Xin_model->read_user_info($session['user_id']);

            $data = array(
                'department_id' => $user[0]->department_id,
                'budget_name' => $this->input->post('budget_name'),
                'currency'   => $this->input->post('currency'),
                'date_from' => date('Y-m-d',strtotime($this->input->post('start_date'))),
                'date_to' => date('Y-m-d',strtotime($this->input->post('end_date'))),
                'amount' => $this->input->post('budget_amount'),
                'added_by' => $session['user_id'],
                'added_date' => date('Y-m-d H:i:s'),
            );
            $result = $this->Budgeting_model->add_budget($data);
            $budget_id = $this->db->insert_id();
            $dept = $this->Budgeting_model->read_budget_dept($user[0]->department_id);
            //save budget code
            $budget_code = strtoupper(substr($dept[0]->name,0,2))."-".date('y')."-".sprintf('%03d', $budget_id);
            $data = array(
                'budget_code' => $budget_code,
            );
            $this->Budgeting_model->update_budget($data,$budget_id);
            foreach($_POST['main_category'] as $main_cat_key=>$main_cat_id){

                $data2 = array(
                    'budget_id'     => $budget_id,
                    'category_id'   => $_POST['main_category'][$main_cat_key],
                    'amount'        => $_POST['main_category_budget'][$main_cat_key],
                    'added_by'      => $session['user_id'],
                    'added_date'    => date('Y-m-d H:i:s'),
                );
                $result_x = $this->Budgeting_model->add_budget_category_assign($data2);

                foreach($_POST['sub_category'][$main_cat_id] as $sub_cat_key=>$sub_item){

                    $data3 = array(
                        'budget_id'          => $budget_id,
                        'main_category_id'   => $main_cat_id,
                        'sub_category_id'    => $_POST['sub_category'][$main_cat_id][$sub_cat_key],
                        'amount'             => $_POST['sub_cat_amount'][$main_cat_id][$sub_cat_key],
                        'added_by'           => $session['user_id'],
                        'added_date'         => date('Y-m-d H:i:s'),
                    );
                    $result_x = $this->Budgeting_model->add_budget_sub_category_assign($data3);
                }
            }

            if ($result == TRUE) {
                $Return['result'] = 'Successfully added your new budget!';
                $Return['redirect_url'] = site_url('budgeting/pending_budget_details/'.$budget_id);
            } else {
                $Return['error'] = $this->lang->line('xin_error_msg');
            }
            $this->output($Return);
            exit;
        }
    }

    public function save_new_budget_sub_cats(){

        if($this->input->post('add_type')=='save_new_budget_sub_cats') {

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if(!isset($_POST['sub_category'][0])) {
                $Return['error'] = 'Select category.';
            }

            foreach($_POST['sub_category'] as $key=>$item){

                if(empty($_POST['sub_category'][$key])) {
                    $Return['error'] = 'Select category name.';
                }
                else if(empty($_POST['sub_cat_amount'][$key])) {
                    $Return['error'] = 'Assign selected category budget.';
                }
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $user = $this->Xin_model->read_user_info($session['user_id']);

            $budget_id = $this->input->post('budget_id');

            foreach($_POST['sub_category'] as $key=>$item){

                $data2 = array(
                    'budget_id'     => $budget_id,
                    'main_category_id'   => $_POST['main_category_id'][$key],
                    'sub_category_id'   => $_POST['sub_category'][$key],
                    'amount'        => $_POST['sub_cat_amount'][$key],
                    'assigned_to'   => $_POST['employee_id'][$key],
                    'added_by'      => $session['user_id'],
                    'added_date'    => date('Y-m-d H:i:s'),
                );
                $result_x = $this->Budgeting_model->add_budget_sub_category_assign($data2);
            }

            if ($result_x == TRUE) {
                $Return['result'] = 'Successfully updated your new budget!';
                $Return['redirect_url'] = site_url('budgeting/budget_details/'.$budget_id);
            } else {
                $Return['error'] = $this->lang->line('xin_error_msg');
            }
            $this->output($Return);
            exit;
        }
    }

    public function read_approve_budget()
    {

        if($this->input->post('add_type')=='update_approve_budget') {

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $session = $this->session->userdata('username');
            if(isset($_POST['budget_file_name']) && empty($_FILES['budget_document']['tmp_name']))
            {
                $budget_document = $this->input->post('budget_file_name');
            }
            else{
                if(is_uploaded_file($_FILES['budget_document']['tmp_name'])) {
                    //checking image type
                    $allowed =  array('png','jpg','gif','jpeg','JPEG','JPG','pdf','doc','docx','xls','xlsx','txt','ppt');
                    $filename = $_FILES['budget_document']['name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    if(in_array($ext,$allowed)){
                        $tmp_name = $_FILES["budget_document"]["tmp_name"];
                        $bill_copy = "uploads/budget_files/";
                        // basename() may prevent filesystem traversal attacks;
                        // further validation/sanitation of the filename may be appropriate
                        $lname = basename($_FILES["budget_document"]["name"]);
                        $newfilename = 'budget_'.round(microtime(true)).'.'.$ext;
                        move_uploaded_file($tmp_name, $bill_copy.$newfilename);
                        $budget_document = $newfilename;
                    } else {
                        $Return['error'] = $this->lang->line('xin_error_attatchment_type');
                    }
                }
                else{
                    $Return['error'] = 'Budget Approval Document is required';
                }
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $user = $this->Xin_model->read_user_info($session['user_id']);

            $budget_id = $this->input->post('budget_id');

            $data = array(
                'budget_document' => $budget_document,
                'status' => 1,
            );
            $result = $this->Budgeting_model->update_budget($data,$budget_id);
            /*
            foreach($_POST['assigned_main_cat_employee'] as $main_cat_id_key => $main_cat_id_data){
                foreach($main_cat_id_data as $cat_assigned_id => $assigned_id_data)
                {
                    foreach($assigned_id_data as $assigned_id)
                    {
                        $this->db->query("UPDATE `assigned_budget_cats` SET `assigned_to`='".$assigned_id."' WHERE `budget_id`='".$budget_id."' and `category_id`='".$main_cat_id_key."' and `id`='".$cat_assigned_id."'");
                    }
                }
            }

            foreach($_POST['assigned_sub_cat_employee'] as $main_cat_id_key => $main_cat_id_data){
                foreach($main_cat_id_data as $sub_cat_id_key => $sub_cat_id_data){
                    foreach($sub_cat_id_data as $sub_cat_assign_id_key => $assigned_id_data){
                        foreach($assigned_id_data as $assigned_id)
                        {
                            $this->db->query("UPDATE `assigned_budget_sub_cats` SET `assigned_to`='".$assigned_id."' WHERE `budget_id`='".$budget_id."' and `sub_category_id`='".$sub_cat_id_key."' and `main_category_id`='".$main_cat_id_key."' and `id`='".$sub_cat_assign_id_key."'");
                        }
                    }
                }
            }
            */
            if ($result == TRUE) {
                $Return['result'] = 'Successfully updated your new budget!';
                $Return['redirect_url'] = site_url('budgeting/budget_details/'.$budget_id);
            } else {
                $Return['error'] = $this->lang->line('xin_error_msg');
            }
            $this->output($Return);
            exit;
        }
    }

    public function add_new_budget_expense()
    {

        if($this->input->post('add_type')=='add_new_budget_expense') {

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
            }else if ($this->input->post('currency') === '') {
                $Return['error'] = 'Currency is required!';
            } else if(!isset($session['user_id'])){
                $Return['error'] = 'Login is expired!';
            }else {
                if(is_uploaded_file($_FILES['file']['tmp_name'])) {
                    //checking image type
                    $allowed =  array('png','jpg','gif','jpeg','JPEG','JPG','pdf','doc','docx','xls','xlsx','txt','zip','rar','gzip','ppt');
                    $filename = $_FILES['file']['name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    if(in_array($ext,$allowed)){
                        $tmp_name = $_FILES["file"]["tmp_name"];
                        $bill_copy = "uploads/expense_files/";
                        // basename() may prevent filesystem traversal attacks;
                        // further validation/sanitation of the filename may be appropriate
                        $lname = basename($_FILES["file"]["name"]);
                        $newfilename = 'expense_'.round(microtime(true)).'.'.$ext;
                        move_uploaded_file($tmp_name, $bill_copy.$newfilename);
                        $file = $newfilename;
                    } else {
                        $Return['error'] = $this->lang->line('xin_error_attatchment_type');
                    }
                }
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
            $initial_amount   =   $this->input->post('amount');
            if($currency_1!=$currency_b)
                $amount =  $this->convert_to_current_currency($initial_amount,$currency_1,$currency_b,0);
            else
                $amount =  $initial_amount;

            $data = array(
                'department_id' => $user[0]->department_id,
                'budget_id' => $this->input->post('budget_id'),
                'emp_id'=>$this->input->post('emp_id'),
                'exp_title' => $this->input->post('remarks'),
                'date' => date('Y-m-d',strtotime($this->input->post('date'))),
                'amount' => $amount,
                'initial_amount'=>$initial_amount,
                'currency'=> $currency_1,
                'main_category_id' => $this->input->post('selected_main_cat_id'),
                'sub_category' => $this->input->post('sub_category_id'),
                'cost_center' => $this->input->post('cost_center'),
                'tax_code' => $this->input->post('tax'),
                'company_id' => $this->input->post('company'),
                'supplier_id' => $this->input->post('supplier_id'),
                'supplier_ref' => $this->input->post('supplier_ref'),
                'remarks' => $this->input->post('remarks'),
                'description' => $this->input->post('expense_description'),
                'file' => $file,
                'added_by' => $session['user_id'],
                'added_date' => date('Y-m-d H:i:s'),
            );
            $result = $this->Budgeting_model->add_expense($data);


            if ($result == TRUE) {
                $Return['result'] = 'Successfully added your expense!';
                $Return['redirect_url'] = site_url('budgeting/budget_details/'.$budget_id);
            } else {
                $Return['error'] = $this->lang->line('xin_error_msg');
            }
            $this->output($Return);
            exit;
        }
    }
    //add direct_expense
    public function add_direct_expense()
    {

        if ($this->input->post('add_type') == 'add_direct_expense') {

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result' => '', 'error' => '');
            $session = $this->session->userdata('username');
            $file = '';
            /* Server side PHP input validation */
            if ($this->input->post('date') === '') {
                $Return['error'] = 'Date is required!';
            } else if ($this->input->post('amount') === '') {
                $Return['error'] = 'Amount is required!';
            } else if ($this->input->post('currency') === '') {
                $Return['error'] = 'Currency is required!';
            }else if (!isset($session['user_id'])) {
                $Return['error'] = 'Login is expired!';
            } else {
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    //checking image type
                    $allowed = array('png', 'jpg', 'gif', 'jpeg', 'JPEG', 'JPG', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'zip', 'rar', 'gzip', 'ppt');
                    $filename = $_FILES['file']['name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    if (in_array($ext, $allowed)) {
                        $tmp_name = $_FILES["file"]["tmp_name"];
                        $bill_copy = "uploads/expense_files/";
                        // basename() may prevent filesystem traversal attacks;
                        // further validation/sanitation of the filename may be appropriate
                        $lname = basename($_FILES["file"]["name"]);
                        $newfilename = 'expense_' . round(microtime(true)) . '.' . $ext;
                        move_uploaded_file($tmp_name, $bill_copy . $newfilename);
                        $file = $newfilename;
                    } else {
                        $Return['error'] = $this->lang->line('xin_error_attatchment_type');
                    }
                }
            }

            if ($Return['error'] != '') {
                $this->output($Return);
            }

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $budget_id = $this->input->post('budget_id');

            $data = array(
                'department_id' => $user[0]->department_id,
                'emp_code'=>$this->input->post('emp_code'),
                'exp_title' => $this->input->post('exp_title'),
                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'amount' => $this->input->post('amount'),
                'initial_amount'=>$this->input->post('amount'),
                'cost_center' => $this->input->post('cost_center'),
                'supplier_id' => $this->input->post('supplier_id'),
                'supplier_ref' => $this->input->post('supplier_ref'),
                'description' => $this->input->post('expense_description'),
                'company_id' => $this->input->post('company'),
                'currency' => $this->input->post('currency'),
                'tax_code' => $this->input->post('tax'),
                'file' => $file,
                'exp_type'=>1,
                'added_by' => $session['user_id'],
                'added_date' => date('Y-m-d H:i:s'),
            );

            $result = $this->Budgeting_model->add_expense($data);


            if ($result == TRUE) {
                $Return['result'] = 'Successfully added your expense!';
                $Return['redirect_url'] = site_url('budgeting/direct_expense/' . $budget_id);
            } else {
                $Return['error'] = $this->lang->line('xin_error_msg');
            }
            $this->output($Return);
            exit;
        }
    }
    public function update_budget_expense()
    {
        if($this->input->post('add_type')=='update_budget_expense') {

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('date')==='') {
                $Return['error'] = 'Date is required!';
            } else if($this->input->post('sub_category_id')==='') {
                $Return['error'] = 'Category is required!';
            } else if($this->input->post('amount')==='') {
                $Return['error'] = 'Amount is required!';
            }else if ($this->input->post('currency') === '') {
                $Return['error'] = 'Currency is required!';
            } else if(!isset($session['user_id'])){
                $Return['error'] = 'Login is expired!';
            }else {
                $file ='';
                if(isset($_POST['expense_file_name']) && empty($_FILES['file']['tmp_name']))
                {
                    $file = $this->input->post('expense_file_name');
                }
                else
                {
                    if(is_uploaded_file($_FILES['file']['tmp_name'])) {
                        //checking image type
                        $allowed =  array('png','jpg','gif','jpeg','JPEG','JPG','pdf','doc','docx','xls','xlsx','txt','zip','rar','gzip','ppt');
                        $filename = $_FILES['file']['name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);

                        if(in_array($ext,$allowed)){
                            $tmp_name = $_FILES["file"]["tmp_name"];
                            $bill_copy = "uploads/expense_files/";
                            // basename() may prevent filesystem traversal attacks;
                            // further validation/sanitation of the filename may be appropriate
                            $lname = basename($_FILES["file"]["name"]);
                            $newfilename = 'expense_'.round(microtime(true)).'.'.$ext;
                            move_uploaded_file($tmp_name, $bill_copy.$newfilename);
                            $file = $newfilename;

                            if(isset($_POST['expense_file_name']) && !empty($_POST['expense_file_name']))
                            {
                                $old_file_url = $bill_copy.$_POST['expense_file_name'];
                                if(file_exists($old_file_url)){
                                    unlink($old_file_url);
                                }
                            }

                        } else {
                            $Return['error'] = $this->lang->line('xin_error_attatchment_type');
                        }
                    }
                }
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $expense_id = $this->input->post('expense_id');

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
                'exp_title' => $this->input->post('remarks'),
                'date' => date('Y-m-d',strtotime($this->input->post('date'))),
                'amount' => $amount,
                'initial_amount'=>$initial_amount,
                'main_category_id' => $this->input->post('selected_main_cat_id'),
                'sub_category' => $this->input->post('sub_category_id'),
                'cost_center' => $this->input->post('cost_center'),
                'supplier_id' => $this->input->post('supplier_id'),
                'supplier_ref' => $this->input->post('supplier_ref'),
                'remarks' => $this->input->post('remarks'),
                'tax_code' => $this->input->post('tax'),
                'company_id' => $this->input->post('company'),
                'currency'=> $this->input->post('currency'),
                'description' => $this->input->post('expense_description'),
                'file' => $file,
            );
            
            $result = $this->Budgeting_model->update_expense($data,$expense_id);

            if ($result == TRUE) {
                $Return['result'] = 'Successfully updated your expense!';
                $Return['redirect_url'] = site_url('budgeting/budget_details/'.$budget_id);
            } else {
                $Return['error'] = $this->lang->line('xin_error_msg');
            }
            $this->output($Return);
            exit;
        }
    }
    public function update_direct_expense()
    {


        if($this->input->post('edit_type')=='update_direct_expense') {

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('date')==='') {
                $Return['error'] = 'Date is required!';
            } else if($this->input->post('sub_category_id')==='') {
                $Return['error'] = 'Category is required!';
            } else if($this->input->post('amount')==='') {
                $Return['error'] = 'Amount is required!';
            }else if ($this->input->post('currency') === '') {
                $Return['error'] = 'Currency is required!';
            } else if(!isset($session['user_id'])){
                $Return['error'] = 'Login is expired!';
            }else {
                $file ='';
                if(isset($_POST['expense_file_name']) && empty($_FILES['file']['tmp_name']))
                {
                    $file = $this->input->post('expense_file_name');
                }
                else
                {
                    if(is_uploaded_file($_FILES['file']['tmp_name'])) {
                        //checking image type
                        $allowed =  array('png','jpg','gif','jpeg','JPEG','JPG','pdf','doc','docx','xls','xlsx','txt','zip','rar','gzip','ppt');
                        $filename = $_FILES['file']['name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);

                        if(in_array($ext,$allowed)){
                            $tmp_name = $_FILES["file"]["tmp_name"];
                            $bill_copy = "uploads/expense_files/";
                            // basename() may prevent filesystem traversal attacks;
                            // further validation/sanitation of the filename may be appropriate
                            $lname = basename($_FILES["file"]["name"]);
                            $newfilename = 'expense_'.round(microtime(true)).'.'.$ext;
                            move_uploaded_file($tmp_name, $bill_copy.$newfilename);
                            $file = $newfilename;

                            if(isset($_POST['expense_file_name']) && !empty($_POST['expense_file_name']))
                            {
                                $old_file_url = $bill_copy.$_POST['expense_file_name'];
                                if(file_exists($old_file_url)){
                                    unlink($old_file_url);
                                }
                            }

                        } else {
                            $Return['error'] = $this->lang->line('xin_error_attatchment_type');
                        }
                    }
                }
            }

            if($Return['error']!=''){
                $this->output($Return);
            }
            $user = $this->Xin_model->read_user_info($session['user_id']);
            $expense_id = $this->input->post('exp_id');



            $data = array(
                'department_id' => $user[0]->department_id,
                'emp_code'=>$this->input->post('emp_code'),
                'exp_title' => $this->input->post('expense_title'),
                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'amount' => $this->input->post('amount'),
                'initial_amount'=>$this->input->post('amount'),
                'cost_center' => $this->input->post('cost_center'),
                'supplier_id' => $this->input->post('supplier_id'),
                'supplier_ref' => $this->input->post('supplier_ref'),
                'description' => $this->input->post('expense_description'),
                'currency' => $this->input->post('currency'),
                'company_id' => $this->input->post('company'),
                'tax_code' => $this->input->post('tax'),
                'file' => $file,
                'exp_type'=>1,
                'added_by' => $session['user_id'],
                'added_date' => date('Y-m-d H:i:s'),
            );
            $result = $this->Budgeting_model->update_expense($data,$expense_id);


            if ($result == TRUE) {
                $Return['result'] = 'Successfully updated your expense!';
                $Return['redirect_url'] = site_url('budgeting/direct_expenses/'.$expense_id);
            } else {
                $Return['error'] = $this->lang->line('xin_error_msg');
            }
            $this->output($Return);
            exit;
        }
    }

    public function update_new_budget(){

        if($this->input->post('add_type')=='budget') {

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('budget_name')==='') {
                $Return['error'] = 'Budget Name is required';
            } else if($this->input->post('start_date')==='') {
                $Return['error'] = 'Budget Start Date is required!';
            } else if($this->input->post('end_date')==='') {
                $Return['error'] = 'Budget End Date is required!';
            } else if(!isset($session['user_id'])){
                $Return['error'] = 'Login is expired!';
            } else if(strtotime($this->input->post('end_date'))<strtotime($this->input->post('start_date'))) {
                $Return['error'] = 'End date should be greater than start date!';
            } else if(!isset($_POST['main_category'][0])) {
                $Return['error'] = 'Select category.';
            }

            $total_assigned_budget = 0;
            foreach($_POST['main_category'] as $main_cat_key=>$main_cat_id){

                if(empty($_POST['main_category'][$main_cat_key])) {
                    $Return['error'] = 'Select category name.';
                }

                foreach($_POST['sub_category'][$main_cat_id] as $sub_cat_key=>$sub_item){

                    if(empty($_POST['sub_category'][$main_cat_id][$sub_cat_key])) {
                        $Return['error'] = 'Select category name.';
                    }
                    else if(empty($_POST['sub_cat_amount'][$main_cat_id][$sub_cat_key])) {
                        $Return['error'] = 'Type selected category budget.';
                    }
                }
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $budget_id = $this->input->post('budget_id');

            $data = array(
                'department_id' => $user[0]->department_id,
                'budget_name' => $this->input->post('budget_name'),
                'currency' => $this->input->post('currency'),
                'date_from' => date('Y-m-d',strtotime($this->input->post('start_date'))),
                'date_to' => date('Y-m-d',strtotime($this->input->post('end_date'))),
                'amount' => $this->input->post('budget_amount'),
                'added_by' => $session['user_id'],
                'added_date' => date('Y-m-d H:i:s'),
            );
            $result = $this->Budgeting_model->update_budget($data,$budget_id);
            if ($result == TRUE) {
                $this->db->query("DELETE FROM `assigned_budget_cats` WHERE `budget_id`='".$budget_id."'");
                $this->db->query("DELETE FROM `assigned_budget_sub_cats` WHERE `budget_id`='".$budget_id."'");
            }

            foreach($_POST['main_category'] as $main_cat_key=>$main_cat_id){

                $data2 = array(
                    'budget_id'     => $budget_id,
                    'category_id'   => $_POST['main_category'][$main_cat_key],
                    'amount'        => $_POST['main_category_budget'][$main_cat_key],
                    'added_by'      => $session['user_id'],
                    'added_date'    => date('Y-m-d H:i:s'),
                );
                $result_x = $this->Budgeting_model->add_budget_category_assign($data2);

                foreach($_POST['sub_category'][$main_cat_id] as $sub_cat_key=>$sub_item){

                    $data3 = array(
                        'budget_id'          => $budget_id,
                        'main_category_id'   => $main_cat_id,
                        'sub_category_id'    => $_POST['sub_category'][$main_cat_id][$sub_cat_key],
                        'amount'             => $_POST['sub_cat_amount'][$main_cat_id][$sub_cat_key],
                        'added_by'           => $session['user_id'],
                        'added_date'         => date('Y-m-d H:i:s'),
                    );
                    $result_x = $this->Budgeting_model->add_budget_sub_category_assign($data3);
                }
            }

            if ($result == TRUE) {
                $Return['result'] = 'Successfully updated your budget!';
                $Return['redirect_url'] = site_url('budgeting/pending_budget_details/'.$budget_id);
            } else {
                $Return['error'] = $this->lang->line('xin_error_msg');
            }
            $this->output($Return);
            exit;
        }
    }

    public function get_budget_sub_cat_div_by_main_cat_id()
    {
        $main_cat_id = $this->uri->segment(3);
        $session = $this->session->userdata('username');
        $data = array();
        $data['main_cat_id'] = $main_cat_id;

        if(!empty($session)){

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $this->load->view("budgeting/sub_category_div_by_main_cat", $data);

        }
    }
    public function supplier_list_dropdown(){
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $all_suppliers =$this->Xin_model->get_all_suppliers();
            $html ='<option value="">Select Supplier...</option>';

            foreach($all_suppliers->result() as $suppliers){
                $html.= '<option value="'.$suppliers->id.'">'.$suppliers->name.'</option>';
            }
            echo $html;
            return $html;
        }
    }
    public function print_budget_pdf()
    {

        // create new PDF document
        $pdf = new Mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $id = $this->input->method() == "post" ? json_decode($this->input->post('budgets'))[0] : $this->uri->segment(3);
        $budget_data    = $this->Budgeting_model->read_budget_data_by_id($id);
        $all_categories = $this->Xin_model->get_categories_by_department($id);
        $all_sub_categories = $this->Xin_model->get_sub_categories_by_department($id);
        $all_employees = $this->Xin_model->get_employees_by_department($id);
        $assigned_budget_category = $this->Budgeting_model->get_budget_categories($id);
        $table_height = (count($assigned_budget_category->result())+2)*10;
        $table_height = ($table_height > 120)?$table_height:120;
        if(empty($budget_data)){
            exit();
        }
        //save budget code
        $dept = $this->Budgeting_model->read_budget_dept($budget_data[0]->department_id);
        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);

        //  $budget_code = strtoupper(substr($dept[0]->name,0,2))."-".date('y')."-".sprintf('%03d', $budget_data[0]->id);
        $headerstring = '<table width="100%" border="0" align="center">
		    <tr><td height="20"></td></tr>
		    <tr>
		    <td height="36" style="width:100%;" align="left!important"><img  src="https://almana.g4demo.com/assets/media/logos/logo-dark.svg"></td></tr><tr>
		      <td height="9"style="width:61%;"> <h2  align="right" style=" border-bottom: 1px solid grey; line-height:0.1em; margin:10px 0 20px;"><span style="background:white; padding:0 10px;"></span></h2></td>
		      <td height="9"style="width:22%;"> <h3  align="center" style="  line-height:0.1em; margin:10px 0 20px;">APPROVAL NOTE</h3></td>
		        <td height="9"style="width:17%;"> <h2  align="right" style="border-bottom: 1px solid grey; line-height:0.1em; margin:10px 0 20px;"></h2></td>

                </tr>
                <tr height="15px" width="100%">
                <td></td>
                </tr>
                <tr><td height="6px"  width= "106%" colspan="3" align="right" style="font-size: 11px">Page '.$pdf->getAliasNumPage().' of '.$pdf->getAliasNbPages().' </td></tr>
                </table>';

        $tbl = '
        <br><br>
        <table width="100%" align="center" height="300px"><tr><td height="'.$table_height.'px"></td></tr></table>
		<table width="100%" align="center">
		  
		      
    		<tr>
    		<td style="bgcolor=white;" height="30px"></td>
                </tr>
            <tr>
        		<td colspan="2" width="100%" >';

        $pdf->header_for_first=' 
 
  <table  align="left" border="0" bgcolor="#d9e1f4" border-collapse: separate !important; style="padding:10px; border:2px solid  #362035;border-radius: 13%; border-spacing: 0;   ">                    <tr>
                        <td width="50%" height="360px">
                            <table style="width: 100%; padding:0px; background:#000; color: #ccc;" cellspacing="0">
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #ca3c3c;">
            		            <td height="30px" colspan="2"><b style="font-size:18px">' . $budget_data[0]->budget_name . ' (' . $budget_data[0]->currency . ')</b></td>
            		            
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px" width="23%" style="font-size:12px"><i>Project ID:</i> </td><td>' . $budget_data[0]->budget_code . '</td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		           <td height="13px" style="font-size:12px"><i>Period:</i></td><td>' . date('d-m-Y', strtotime($budget_data[0]->date_from)) . ' - ' . date('d-m-Y', strtotime($budget_data[0]->date_to)) . '</td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		             <td height="13px"  style="font-size:12px"><i>Department:</i></td><td>' . $dept[0]->name . '</td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px"  style="font-size:12px"><i>Date:</i></td><td>' . date("d.m.Y") . ' </td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px" style="font-size:12px;"><i>Currency </i></td><td>' . $budget_data[0]->currency . ' </td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px" style="font-size:12px"> </td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td   width="70%" cellpadding="10px" height="50px" style="text-align:left;border:solid 2px black;">
            		            <table border="0" style="width=100%;padding-right: 3px;">
            		            <tr><td></td></tr>
            		            <tr><td align="right">  <b style="font-size:12px;" >' . $budget_data[0]->currency . '.</b><b style ="font-size:20px" >&nbsp;' . number_format($budget_data[0]->amount, 2) . '</b><br> 
            		          </td></tr>
            		          
</table>
            		            </td>
            		          </tr>
            		         
            		        </table>
            		        <p style="font-style: italic;font-size: 10px"> ( '.$this->convertNumberToWord($budget_data[0]->amount,$budget_data[0]->currency).')</p>
                        </td>
                        <td width="50%" style="padding:20px;">
                        	<table border="0" class="box-one" style="width: 100%; padding:5px; background:#f1f4f6; color: #ccc;" cellspacing="0">
            		          <tr style="background:#f1f4f6; color: #000;">
            		            <td width="63%"><b style="font-size:13px">Category</b></td>
            		            <td width="35%" style="text-align:right;"><b style="font-size:13px">Budget</b></td>
                                <td width="3%" style="text-align:right;border-bottom: 1px dashed #bdbdbd"></td>

            		          </tr>';

        $total_budget = 0;
        $total_expense = 0;
        foreach($assigned_budget_category->result() as $assigned_budget_category_data)
        {
            $category_name = $this->Xin_model->read_category_data_by_id($assigned_budget_category_data->category_id);
            if(isset($category_name[0]->name)){
                $category_name = $category_name[0]->name;
            }else{
                $category_name = '--';
            }
            $total_budget = $total_budget+$assigned_budget_category_data->amount;
            $pdf->header_for_first.='<tr>
            		            <td width="63%" style=" color:black;border-style: dashed;border-color: #bdbdbd">'.$category_name.'</td>
            		            <td width="35%" style=" color:black; border-style: dashed;text-align:right;border-color: #bdbdbd">'.number_format($assigned_budget_category_data->amount,2).'</td>
            		            <td width="3%" style="border-style: dashed;text-align:right;border-color: #bdbdbd"></td>

            		          </tr>';
        }
        $pdf->header_for_first.='
                            <tr>
                   
                       <td width="63%" style="color:black; border-style: dashed;border-color: #bdbdbd "><b>Total :</b></td>
            		   <td style="color:green;text-align:right;border-style: dashed;text-align:right!important;border-color: #bdbdbd"  align="right" width="35%"><b>'.number_format($total_budget,2).'</b></td>
            		            <td width="3%" style="border-style: dashed;text-align:right;border-color: #bdbdbd"></td>


</tr></table>
                    	  </td>
                      </tr>
                      <tr>
                   <td width="1%" ></td>
                      <td width="35%"  style=" text-align:center; font-size: 13px;border-top: 3px double dimgrey;">Approved by</td>
                     <td width="64%"></td>

</tr>
                     
                    </table>';

        $pdf->header_for_all='<table border="0" align="left" bgcolor="#d9e1f4" border-collapse: separate !important; style="padding:10px; border:2px solid #362035;border-radius: 13%; border-spacing: 0;   ">                    <tr>
                        <td width="60%" height="100px">
                            <table style="width: 100%; padding:0px; background:#000; color: #ccc;" cellspacing="0">
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #ca3c3c;">
            		            <td height="30px" colspan="2"><b style="font-size:18px">' . $budget_data[0]->budget_name . ' (' . $budget_data[0]->currency . ')</b></td>
            		            
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px" width="23%" style="font-size:12px"><i>Project ID:</i> </td><td>' . $budget_data[0]->budget_code . '</td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		           <td height="13px" style="font-size:12px"><i>Period:</i></td><td>' . date('d-m-Y', strtotime($budget_data[0]->date_from)) . ' - ' . date('d-m-Y', strtotime($budget_data[0]->date_to)) . '</td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		             <td height="13px"  style="font-size:12px"><i>Department:</i></td><td>' . $dept[0]->name . '</td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px"  style="font-size:12px"><i>Date:</i></td><td>' . date("d.m.Y") . ' </td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px" style="font-size:12px"><i>Currency </i></td><td>' . $budget_data[0]->currency . ' </td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px" style="font-size:12px"> </td>
            		          </tr>
            		         
            		        </table>
                        </td>
                        <td width="40%" align="center" style="padding:20px;padding-top: 200px">
                        <table border="0" height="100px">
                        <tr  height="30px"><td></td></tr>
                         <tr><td height="30%"></td></tr>
                          <tr><td></td></tr>
                          
                          <tr><td><b style="font-size:12px">Budget Value : '. $budget_data[0]->currency . '.</b><b style ="font-size:18px" >&nbsp;' . number_format($budget_data[0]->amount, 2) . '</b></td></tr>
                          <tr><td></td></tr>
</table>

                        	</td>
                      </tr>
                      
                     
                    </table>';




        $tbl.=   '</td>
            </tr>
           
                                	<tr>
                                		<td style="width:100%; ">
                                		<br><br><br><br>
                                			<table border="0"  width="100%" cellspacing="0" cellpadding="6">
                                				';
        $total_budget = 0;
        $category_total_array = array();
        foreach($assigned_budget_category->result() as $assigned_budget_category_data)
        {
            $category_name = $this->Xin_model->read_category_data_by_id($assigned_budget_category_data->category_id);
            if(isset($category_name[0]->name)){
                $category_name = $category_name[0]->name;
            }else{
                $category_name = '--';
            }

            $category_total_array[] = array('cat_name' => $category_name, 'amount' => $assigned_budget_category_data->amount);
            $total_budget = $total_budget+$assigned_budget_category_data->amount;
            $tbl.='<tr style="background-color: #f7f7f7;">
                                					<td width="20%" ></td>

                                					<td width ="55%" style=" font-weight: 700;text-align:center "><b>'.$category_name.'</b></td>
                                		            <td width ="22%" style= " text-align:right">Amount</td>
                                                    <td width="3%" ></td>  
                                					
                                					
                                				</tr>
                                				';
            $bg_color = 0;
            $sub_cat_assign_query = $this->Budgeting_model->get_budget_sub_categories($assigned_budget_category_data->budget_id,$assigned_budget_category_data->category_id);
            foreach($sub_cat_assign_query->result() as $sub_cat_assign_data)
            {
                $sub_category_name = $this->Xin_model->read_sub_category_data_by_id($sub_cat_assign_data->sub_category_id);
                if(isset($sub_category_name[0]->name)){
                    $sub_category_name = $sub_category_name[0]->name;
                }else{
                    $sub_category_name = '--';
                }



                $bg_color = '';


                $tbl.='
                                				<tr style="height:11px; line-height:11px;">
                                					<td width="2%" bgcolor="white"></td>
                                					<td width="73%" style="border-bottom: 1px solid #ccc;text-align:right;font-size:12px;">'.$sub_category_name.'</td>
                                					<td width="23%" style="text-align: right!important; border-bottom: 1px solid #ccc;">'.number_format($sub_cat_assign_data->amount,2).'</td>
                                					<td width="3%" bgcolor="white"></td>
                                				</tr>';
            }

            $tbl.='<tr>
                                    				<td width="1%" bgcolor="white"></td>
                                    				<td width="72%"></td>
                                    				<td width="25%" valign="top" style="text-align: right; margin-top:5px;" bgcolor="#676767" color="white"> &nbsp; <b>Total: '.number_format($assigned_budget_category_data->amount,2).'</b> </td>
                                    				<td width="2%" bgcolor="#676767"></td>
                                				</tr>
                                				<tr><td width="100%" height="2" bgcolor="white"></td></tr>';
        }
        $tbl.='
                                			</table>
                                		</td>
                                	</tr>
                               
                    
        </table>';

        $footerhtml = '<table height="40px" cellpadding="10px" >
                        <tr ><td style="border-top: 1px solid grey;"align="left" width="30%">Prepared By :'.$this->session->userdata("username")["name"].'</td>
                        <td style="border-top: 1px solid grey;"align="center" width="40%">'.$dept[0]->name .' - Internal Document - Confidential</td>
                        <td style="border-top: 1px solid grey;"align="center" width="14%"></td>
                        <td align="center" style="border-top: 1px solid grey; text-align:center;"  width="16%"></td>
</tr>
                        </table>';
        $pdf->setHeaderData($ln='', $lw=0, $ht='', $hs=$headerstring, $tc=array(0,0,0), $lc=array(0,0,0));

        $pdf->headertext=$headerstring;

        // set document information
        $pdf->SetCreator('Gligx');
        $pdf->SetAuthor('Gligx');

        $pdf->SetDefaultMonospacedFont('courier');

        // set margins
        $pdf->SetMargins(6, 80, 7);

        $pdf->SetFooterMargin(3);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(1.25);
        $pdf->SetAuthor('Al Mana');
        $pdf->SetTitle('Al Mana - Budget ');
        // set font
        $pdf->SetFont('helvetica', 'B', 10);

        // set header and footer fonts
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-15, PDF_MARGIN_RIGHT);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-25);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // helvetica is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('helvetica', '', 10, '', true);
        $pdf->setFooterData(array(0, 0, 0), array(0, 64, 128));

        $pdf->setFooterFont(array('helvetica', '', '10'));

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));




        // -----------------------------------------------------------------------------

        $pdf->xfootertext =$footerhtml;
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        //print_r($tbl);exit();
        $pdf->writeHTML($tbl, true, false, false, false, '');


        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        //Close and output PDF document
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if(in_array('4',$role_resources_ids)) {
            if($this->input->method() == "post" ){
                $fname =$_SERVER['DOCUMENT_ROOT'].'/uploads/budget_files/al_mana_'.$budget_data[0]->id.'pdf';
                $urltopdf = site_url('/uploads/budget_files/al_mana_'.$budget_data[0]->id.'pdf');
                $pdf->Output($fname, 'F');
                $Return['result'] = 'PDF Generated!';
                $Return['error'] = '';
                $Return['data'] =$urltopdf;
                $this->output($Return);
                exit;

            }else{
                if(isset($_REQUEST['download']))
                {
                    $pdf->Output('al_mana_'.$budget_data[0]->id.'.pdf', 'D');
                }
                else
                {
                    $pdf->Output();
                }}}else{
            redirect('dashboard/');

        }
    }


    public function print_expense_sheet()
    {

        // create new PDF document
        $pdf = new Mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        $budget_id = $this->uri->segment(3);
        $expense_id = $this->uri->segment(4);
        $session = $this->session->userdata('username');

        $budget_data = $this->Budgeting_model->read_budget_data_by_id($budget_id);
        $dept = $this->Budgeting_model->read_budget_dept($budget_data[0]->department_id);
        $assigned_budget_category = $this->Budgeting_model->get_budget_categories($budget_id);
        $user = $this->Xin_model->read_user_info($session['user_id']);


        $pdf->headertext = "EXPENSE REPORT";
        $headerstring = '<table width="100%" align="center">
		    <tr><td height="20"></td></tr>
		    <tr>
		    <td height="36" style="width:100%;" align="left!important"><img  src="'.site_url('assets/media/logos/logo-dark.svg').'"></td></tr><tr>
		      <td height="9"style="width:64%;"> <h2  align="right" style=" border-bottom: 1px solid black; line-height:0.1em; margin:10px 0 20px;"><span style="background:white; padding:0 10px;"></span></h2></td>
		      <td height="9"style="width:16%;"> <h3  align="center" style="  line-height:0.1em; margin:10px 0 20px;">EXPENSE REPORT </h3></td>
		        <td height="9"style="width:20%;"> <h2  align="right" style=" border-bottom: 1px solid black; line-height:0.1em; margin:10px 0 20px;"></h2></td>

                </tr>
                <tr height="15px" width="100%">
                <td></td>
                </tr>
                </table>';
        $pdf->headertext = $headerstring;
        //  $pdf->xfootertext ="<hr>";


        $first_header = '<table border="0" width="100%"><tr height="200px"><td width="51%">
<table  align="left"  style="padding:10px;font-style:italic;  ">                    <tr>
                        <td width="100%" height="200px">
                            <table  style="width: 100%; padding:0px;  color: #000000;" cellspacing="0">
            		          <tr>
            		            <td height="30px" colspan="2"><i>Project</i><br><b style="font-size:18px">' . $budget_data[0]->budget_name . '</b></td>
            		            
            		          </tr>
            		          <tr>
            		            <td height="13px" width="23%" style="font-size:12px"><i>Project ID:</i> </td><td>' . $budget_data[0]->budget_code . '</td>
            		          </tr>
            		          <tr>
            		           <td height="13px" style="font-size:12px"><i>Period:</i></td><td>' . date('d-m-Y', strtotime($budget_data[0]->date_from)) . ' - ' . date('d-m-Y', strtotime($budget_data[0]->date_to)) . '</td>
            		          </tr>';
        if($expense_id){
            $first_header.='<tr>
            		            <td height="13px" width="23%" style="font-size:12px"><i>Expense ID:</i> </td><td>' . $budget_data[0]->budget_code .'-'.$expense_id. '</td>
            		          </tr>';
        }

        $first_header.=     '<tr>
            		             <td height="13px"  style="font-size:12px"><i>Department:</i></td><td>' . $dept[0]->name . '</td>
            		          </tr>
            		          <tr>
            		            <td height="13px"  style="font-size:12px"><i>Date:</i></td><td>' . date("d.m.Y") . ' </td>
            		          </tr>
            		          <tr>
            		            <td height="13px" style="font-size:12px;"><i>Currency </i></td><td>' . $budget_data[0]->currency . ' </td>
            		          </tr>
            		          <tr>
            		            <td height="13px" style="font-size:12px"> </td>
            		          </tr>
            		         
            		         
            		        </table></td></tr></table></td>
            		        <td height="200px">
            		        <br><br>';
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if((in_array('35',$role_resources_ids))) {

            $first_header .= ' <table border="0" height="100%" cellpadding="7px" style="   border-collapse: collapse;text-align:left; font-size:11px;font-weight:700;text-align:left;font-family: Poppins, Helvetica, "sans-serif"">
									<!--begin::Table head-->
									<thead>
										<tr align="left" style="color: dimgrey;">
											<th style="border-bottom:1px dashed grey;" width="38%"><b>Category </b></th>
											<th style="border-bottom:1px dashed grey;text-align: right;" width="23%"><b>Approved Budget</b></th>
											<th style="border-bottom:1px dashed grey;text-align: right;" width="18%"><b> Expenses</b></th>
											<th style="border-bottom:1px dashed grey;text-align: right;" width="18%"><b>Balance</b></th>
										</tr>
									</thead>
									<!--end::Table head-->
									<!--begin::Table body-->
									<tbody>';
        }
        $total_budget = 0;
        $total_expense = 0;
        $category_total_array = array();
        $last_index = count($assigned_budget_category->result()) - 1;
        $table_height = (($last_index) * 17);
        if($last_index<5)$table_height=50;
        $index = -1;

        foreach ($assigned_budget_category->result() as $assigned_budget_category_data) {
            $index = $index + 1;
            $category_name = $this->Xin_model->read_category_data_by_id($assigned_budget_category_data->category_id);
            if (isset($category_name[0]->name)) {
                $category_name = $category_name[0]->name;
            } else {
                $category_name = '--';
            }
            $total_budget = $total_budget + $assigned_budget_category_data->amount;
            $category_total_array[] = array('cat_name' => $category_name, 'amount' => $assigned_budget_category_data->amount);

            $cat_total = 0;
            $qe = "SELECT * FROM `budget_expenses` WHERE `budget_id`='" . $budget_id . "' and `main_category_id`='" . $assigned_budget_category_data->category_id . "'";

            $query = $this->db->query($qe);


            foreach ($query->result() as $expense_data) {
                $cat_total = $cat_total + $expense_data->amount;
            }

            $total_expense = $total_expense + $cat_total;
            //for removing last item border
            /*  if ($last_index == $index) {
                    $tbl .= '	<tr>
                 <td  align="left" >' . $category_name . '</td>
                 <td align="right" ><b>' . number_format($assigned_budget_category_data->amount, 2) . '</b></td>
                 <td align="right"><b>' . number_format($cat_total, 2) . '</b></td>
                 <td align="right"><b>' . number_format($assigned_budget_category_data->amount - $cat_total, 2) . '</b></td>
             </tr>';

                } else {*/
            $table_height = (($last_index + 2) * 15) +5;

            if ((in_array('35', $role_resources_ids))) {


                $first_header .= '	<tr>
											<td style="border-bottom:1px dashed grey;" align="left" >' . $category_name . '</td>
											<td style="border-bottom:1px dashed grey;text-align:right"><b>' . number_format($assigned_budget_category_data->amount, 2) . '</b></td>
											<td style="border-bottom:1px dashed grey;text-align:right"><b>' . number_format($cat_total, 2) . '</b></td>
											<td style="border-bottom:1px dashed grey;text-align:right"><b>' . number_format($assigned_budget_category_data->amount - $cat_total, 2) . '</b></td>
										</tr>';
                //   }

            }
        }
        if ((in_array('35', $role_resources_ids))) {

            $first_header .= ' 		</tbody>
									<tfoot >
									<tr style="border:1px dashed grey; background-color:#f3f2f7 ;">
										<th style="border-bottom:1px dashed grey; color: black"><b>Total :</b></th>
										<td style="border-bottom:1px dashed grey;color: dimgray; text-align:right" ><b>' . number_format($total_budget, 2) . '</b></td>
										<td style="border-bottom:1px dashed grey; color:#2566c0;text-align:right"><b>' . number_format($total_expense, 2) . '</b></td>
										<td style="border-bottom:1px dashed grey;color: darkgreen;text-align:right"><b>' . number_format($total_budget - $total_expense, 2) . '</b></td>
									</tr> 
									</tfoot>
								</table>';

        }
        $first_header.='</td></tr>
        <tr><td></td></tr>
        </table>';
//<p  align="right" style=" border-bottom: 1px solid grey; font-size:11px; line-height:0.2em; margin:10px 0 10px;"><span style="background:white; padding:0 10px;"></span>Page '.$pdf->getAliasNumPage().' of '.$pdf->getAliasNbPages().'</p></td>';
        $tbl = '
		<table  cellpadding="3px" cellspacing="0" border="0">
		
	<tr>	    
		<td height=" '.$table_height   .'"></td></tr>
		<tr><td style="font-size:12px" width="105%" align="right">Page ' . $pdf->getAliasNumPage() . ' of ' . $pdf->getAliasNbPages() . '</td></tr>
    		<tr  style="background-color:#444; color:#fff;font-size: 10px;">
    		    <th align="left" width="7%">Expense ID</th>
				<th align="left" width="7%">Date</th>
				<th align="left" width="16%">Description</th>
				<th align="left" width="12%">Budget Line</th>
                <th  align="left"width="12%">Category</th>
                <th  align="left"width="6%">Cost Centre </th>
                <th align="right" width="8%">Amount</th>
                <th align="right"align="right" width="8%">Tot.Cat Spend </th>
				<th align="right" width="9%">Cat Available Bal </th>
				<th align="right" width="8%">Total Exp</th>
				<th align="right" width="7%">Avl.Budget </th>
			</tr>';
        $bg_color = 1;
        $file_name = '';
        $total_bud_expense = 0;
        $avl_budget = $this->db->query("SELECT amount FROM `budgeting` WHERE `id`='" . $budget_id . "'")->result()[0]->amount;

        $sub_cat_totals = array();
        $sub_cat_total = 0;
        $sub_cat_assigned_amt = array();

        $q_exp="SELECT e.date, e.remarks,e.amount, e.exp_title,e.budget_id,e.main_category_id,e.sub_category as sub_cat_id , e.id as expense_id, e.sub_category, e.file, c.name as category_name, cc.cost_center_code as cost_center_name, sc.name as sub_category_name FROM budget_expenses e ";
        $q_exp.="left join suppliers s on s.id=e.supplier_id left join  budget_cost_center cc on cc.id=e.cost_center left join xin_employees u on u.user_id=e.added_by left join categories c on e.main_category_id=c.id left join sub_categories sc on e.sub_category=sc.id WHERE e.budget_id='" . $budget_id . "' and  e.department_id='".$user[0]->department_id."'";
        if((!in_array('35',$role_resources_ids))) {
            $q_exp.=" and e.added_by = ".$user[0]->user_id;

        }
        $q_exp.= " order by e.id ASC ";
        $exp_query = $this->db->query($q_exp);

        foreach ($exp_query->result() as $expense_data) {


            $total_bud_expense += $expense_data->amount;//calculate change in total budget expense
            $avl_budget -= $expense_data->amount;//calculate change in available budget
            //calculate total expense under the sub category
            $sub_cat_totals[$expense_data->main_category_id] = isset($sub_cat_totals[$expense_data->main_category_id]) ? $sub_cat_totals[$expense_data->main_category_id] + $expense_data->amount : $expense_data->amount;

            //calculate the change in budget available for sub category
            $sub_cat_assigned = $this->db->query("SELECT amount FROM `assigned_budget_cats` WHERE `budget_id`='" . $budget_id . "' and `category_id`='" . $expense_data->main_category_id . "'")->result();
            if (isset($sub_cat_assigned[0]->amount)) {
                $sub_cat_assigned_amt[$expense_data->main_category_id] = isset($sub_cat_assigned_amt[$expense_data->main_category_id]) ? $sub_cat_assigned_amt[$expense_data->main_category_id] - $expense_data->amount : $sub_cat_assigned[0]->amount - $expense_data->amount;
            } else {
                $sub_cat_assigned_amt[$expense_data->sub_cat_id] = 0;
            }

            if (empty($bg_color)) {
                $bg_color = 'style="background-color:#eee;border-bottom:1px solid dimgrey;font-size:10px;"';
            } else {
                $bg_color = 'style="font-size:10px;"';
            }

            if ($expense_data->expense_id == $expense_id) {
                $bg_color = 'style="background-color:yellow;border-bottom:1px solid dimgrey;font-size:10px;"';
                $file_name = $expense_data->file;
            }

            $tbl .= '<tr  ' . $bg_color . '>
    			            <td style="border-bottom:1px solid dimgrey;" align="left">' . $budget_data[0]->budget_code .'-'.$expense_data->expense_id . '</td>
                    		<td style="border-bottom:1px solid dimgrey;" align="left">' . date('d-m-Y', strtotime($expense_data->date)) . '</td>
                    		<td style="border-bottom:1px solid dimgrey;" align="left">' . $expense_data->remarks . '</td>
                            <td style="border-bottom:1px solid dimgrey;vertical-align: middle;"align="left">' . $expense_data->sub_category_name . '</td>
                    		<td style="border-bottom:1px solid dimgrey;vertical-align: middle;"align="left">' . $expense_data->category_name . '</td>
                    		<td style="border-bottom:1px solid dimgrey;"align="left">' . $expense_data->cost_center_name . '</td>
                    		<td style="border-bottom:1px solid dimgrey;"align="right"><b>' . number_format($expense_data->amount, 2) . '</b></td>
                    		<td style="border-bottom:1px solid dimgrey;font-size:9px;"align="right"><i>' . number_format($sub_cat_totals[$expense_data->main_category_id],2) . '</i></td>
                    		<td style="border-bottom:1px solid dimgrey;font-size:9px;"align="right"><i>' . number_format($sub_cat_assigned_amt[$expense_data->main_category_id],2) . '</i></td>
                     		<td style="border-bottom:1px solid dimgrey;font-size:9px;"align="right"><i>' . number_format($total_bud_expense,2) . '</i></td>
                   		<td style="border-bottom:1px solid dimgrey;font-size:9px;"align="right"><i>' . number_format($avl_budget,2) . '</i></td>
                        </tr>';

        }

        $tbl .= '</table>';
        $header_2 = '<table border="0" width="95%" ><tr height="100px" ><td width="55%" >
<table  align="left"  style="font-style:italic;  ">                    <tr>
                        <td  width="100%">
                            <table border="0"style="width: 100%; padding:0px;  color: #000000;" cellspacing="0">
            		          <tr>
            		            <td height="30px" colspan="2"><i>Project</i><br><b style="font-size:18px">' . $budget_data[0]->budget_name . '</b></td>
            		            
            		          </tr>
            		          <tr>
            		            <td height="13px" width="23%" style="font-size:12px"></td>
            		          </tr>
            		          <tr>
            		            <td height="13px" width="23%" style="font-size:12px"><i>Project ID:</i> </td><td>' . $budget_data[0]->budget_code . '</td>
            		          </tr>';
        if($expense_id){
            $header_2.='<tr>
            		            <td height="13px" width="23%" style="font-size:12px"><i>Expense ID:</i> </td><td>' . $budget_data[0]->budget_code .'-'.$expense_id. '</td>
            		          </tr>';
    }

            		   $header_2.=     '  <tr>
            		             <td height="13px"  style="font-size:12px"><i>Department:</i></td><td>' . $dept[0]->name . '</td>
            		          </tr>
            		          <tr>
            		            <td height="13px"  style="font-size:12px"><i>Date:</i></td><td>' . date("d.m.Y") . ' </td>
            		          </tr>
            		          <tr>
            		            <td height="13px" style="font-size:12px;"><i>Currency </i></td><td>' . $budget_data[0]->currency . ' </td>
            		          </tr>
            		         
            		         
            		        </table></td></tr>
            		        </table></td><td><table border="0">
            		        <tr ><td height="97px"></td></tr>

            		         <tr><td></td></tr>
               

    		
</table></td> 	
	  </tr>
	  <tr><td></td><td width="56%" align="right" style="font-size:11px"height="10px">Page ' . $pdf->getAliasNumPage() . ' of ' . $pdf->getAliasNbPages() . '
</td></tr>
	  <tr><td width="100% "><table  border="0"width="100%"  cellpadding="5px" >
            		 <tr  style="background-color:#444; color:#fff;font-size: 10px;">
    		    <th align="left" width="7%">Expense ID</th>
				<th align="left" width="7%">Date</th>
				<th align="left" width="18%">Description</th>
				<th align="left" width="13%">Budget Line</th>
                <th  align="left"width="12%">Category</th>
                <th  align="left"width="7%">Cost Centre</th>
                <th align="center" width="9%">Amount</th>
                <th align="right"align="right" width="8%">Tot.Cat Spend </th>
				<th align="center" width="10%">Cat Available Bal </th>
				<th align="right" width="8%">Total Exp</th>
				<th align="right" width="7%">Avl.Budget </th>
			</tr>
</table></td></tr>
         		  </table>
            		  
            		  <br><br><br>.<br>
            		  
';
        $footerhtml = '<table height="40px" cellpadding="10px" >
                        <tr ><td style="border-top: 1px solid grey;"align="left" width="30%">Prepared By :' . $this->session->userdata("username")["name"] . '</td>
                        <td style="border-top: 1px solid grey;"align="center" width="40%">' . $dept[0]->name . ' - Internal Document - Confidential</td>
                        <td style="border-top: 1px solid grey;"align="center" width="14%"></td>
                        <td align="center" style="border-top: 1px solid grey; text-align:center;"  width="16%"></td>
</tr>
                        </table>';
        $pdf->header_for_first=$first_header;
        $pdf->header_for_all = $header_2;
        $pdf->xfootertext = $footerhtml;


        // set document information
        $pdf->SetCreator('Almana');
        $pdf->SetAuthor('Almana');
        $pdf->setHeaderData($ln = '', $lw = 0, $ht = '', $hs = $headerstring, $tc = array(0, 0, 0), $lc = array(0, 0, 0));

        $pdf->SetDefaultMonospacedFont('courier');
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set margins

        $pdf->SetMargins(6, 70, 7);
        // $pdf->SetMargins_1(6, 27, 7,false,320);

        $pdf->SetFooterMargin(3);
        $pdf->SetHeaderMargin(0);
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', 16));
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(1.25);
        $pdf->SetAuthor('Al Mana');
        $pdf->SetTitle('Al Mana - Budget ');
        // set font
        $pdf->SetFont('helvetica', 'B', 10);

        // set header and footer fonts
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-15, PDF_MARGIN_RIGHT);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-25);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // helvetica is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('helvetica', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage('L');

        // set text shadow effect
        //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        if (!empty($file_name)) {
            $file_parts = pathinfo($file_name);
            // $file_ext = strtolower($file_parts['extension']);
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

            if ($file_ext == 'png' || $file_ext == 'jpg' || $file_ext == 'jpeg') {
                $tbl .= '<table><tr><td><img src="' . site_url('uploads/expense_files/' . $file_name) . '"  width="300px" height="300px"/ ></td></tr></table>';
            } else if ($file_ext == 'pdf') {

            }
        }

        // $pdf->setY(100);
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        //Close and output PDF document
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if (in_array('4', $role_resources_ids)) {

            $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/uploads/expense_files/al_mana_1' . $expense_id . '.pdf', 'F');
            require_once APPPATH.'/libraries/PDFMerger/PDFMerger.php';
            $pdf_m = new PDFMerger;
            $pdf_m->addPDF($_SERVER['DOCUMENT_ROOT'].'/uploads/expense_files/al_mana_1' . $expense_id . '.pdf');

            if(!empty($file_name) && ($file_ext == 'pdf')) {


                $pdf_m->addPDF($_SERVER['DOCUMENT_ROOT'].'/uploads/expense_files/'.$file_name);

                $pdf_m->addPDF($_SERVER['DOCUMENT_ROOT'] . '/uploads/budget_files/' . $budget_data[0]->budget_document);


                // $pdf_m->merge('file', $_SERVER['DOCUMENT_ROOT'].'/uploads/expense_files/al_mana_1' . $expense_id . '.pdf');


            }else {
                $pdf_m->addPDF($_SERVER['DOCUMENT_ROOT'] . '/uploads/budget_files/' . $budget_data[0]->budget_document);
            }
            $pdf_m->merge('browser', 'al_mana_' . $expense_id . '.pdf');

            if (isset($_REQUEST['download'])) {
                $pdf->Output('al_mana_' . $expense_id . '.pdf', 'D');
            }
        }else {
            redirect('dashboard/');

        }

    }
    
    
    
    public function print_direct_expense_sheet()
    {

        // create new PDF document
        $pdf = new Mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        $budget_id = 0;
        $expense_id = $this->uri->segment(3);
        $session = $this->session->userdata('username');

        $assigned_budget_category = $this->Budgeting_model->get_budget_categories($budget_id);
        $user = $this->Xin_model->read_user_info($session['user_id']);


        $pdf->headertext = "EXPENSE REPORT";
        $headerstring = '<table width="100%" align="center">
		    <tr><td height="20"></td></tr>
		    <tr>
		    <td height="36" style="width:100%;" align="left!important"><img  src="'.site_url('assets/media/logos/logo-dark.svg').'"></td></tr><tr>
		      <td height="9"style="width:64%;"> <h2  align="right" style=" border-bottom: 1px solid black; line-height:0.1em; margin:10px 0 20px;"><span style="background:white; padding:0 10px;"></span></h2></td>
		      <td height="9"style="width:16%;"> <h3  align="center" style="  line-height:0.1em; margin:10px 0 20px;">EXPENSE REPORT </h3></td>
		        <td height="9"style="width:20%;"> <h2  align="right" style=" border-bottom: 1px solid black; line-height:0.1em; margin:10px 0 20px;"></h2></td>

                </tr>
                <tr height="15px" width="100%">
                <td></td>
                </tr>
                </table>';
        $pdf->headertext = $headerstring;
        //  $pdf->xfootertext ="<hr>";


        $first_header = '<table border="0" width="100%"><tr height="200px"><td width="51%">
<table  align="left"  style="padding:10px;font-style:italic;  ">                    <tr>
                        <td width="100%" height="200px">
                            <table  style="width: 100%; padding:0px;  color: #000000;" cellspacing="0">
            		          <tr>
            		            <td height="30px" colspan="2"><i>Project</i><br><b style="font-size:18px">Direct Expenses</b></td>
            		            
            		          </tr>
            		          <tr>
            		            <td height="13px" width="23%" style="font-size:12px"><i>Project ID:</i> </td><td></td>
            		          </tr>
            		          <tr>
            		           <td height="13px" style="font-size:12px"><i>Period:</i></td><td></td>
            		          </tr>';
        if($expense_id){
            $first_header.='<tr>
            		            <td height="13px" width="23%" style="font-size:12px"><i>Expense ID:</i> </td><td>'.$expense_id. '</td>
            		          </tr>';
        }

        $first_header.=     '<tr>
            		             <td height="13px"  style="font-size:12px"><i>Department:</i></td><td></td>
            		          </tr>
            		          <tr>
            		            <td height="13px"  style="font-size:12px"><i>Date:</i></td><td>' . date("d.m.Y") . ' </td>
            		          </tr>
            		          <tr>
            		            <td height="13px" style="font-size:12px;"><i>Currency </i></td><td>AED</td>
            		          </tr>
            		          <tr>
            		            <td height="13px" style="font-size:12px"> </td>
            		          </tr>
            		         
            		         
            		        </table></td></tr></table></td>
            		        <td height="200px">
            		        <br><br>';
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if((in_array('35',$role_resources_ids))) {

            $first_header .= ' <table border="0" height="100%" cellpadding="7px" style="   border-collapse: collapse;text-align:left; font-size:11px;font-weight:700;text-align:left;font-family: Poppins, Helvetica, "sans-serif"">
									<!--begin::Table head-->
									<!--end::Table head-->
									<!--begin::Table body-->
									<tbody>';
        }
        $total_budget = 0;
        $total_expense = 0;
        $category_total_array = array();
        $last_index = count($assigned_budget_category->result()) - 1;
        $table_height = (($last_index) * 17);
        if($last_index<5)$table_height=50;
        $index = -1;

        if ((in_array('35', $role_resources_ids))) {

            $first_header .= ' 		</tbody>
								</table>';

        }
        $first_header.='</td></tr>
        <tr><td></td></tr>
        </table>';
//<p  align="right" style=" border-bottom: 1px solid grey; font-size:11px; line-height:0.2em; margin:10px 0 10px;"><span style="background:white; padding:0 10px;"></span>Page '.$pdf->getAliasNumPage().' of '.$pdf->getAliasNbPages().'</p></td>';
        $tbl = '
		<table  cellpadding="3px" cellspacing="0" border="0">
		
	<tr>	    
		<td height=" '.$table_height   .'"></td></tr>
		<tr><td style="font-size:12px" width="105%" align="right">Page ' . $pdf->getAliasNumPage() . ' of ' . $pdf->getAliasNbPages() . '</td></tr>
    		<tr  style="background-color:#444; color:#fff;font-size: 10px;">
    		    <th align="left" width="7%">Expense ID</th>
				<th align="left" width="7%">Date</th>
				<th align="left" width="16%">Description</th>
				<th align="left" width="12%">Budget Line</th>
                <th  align="left"width="12%">Category</th>
                <th  align="left"width="6%">Cost Centre </th>
                <th align="right" width="8%">Amount</th>
                <th align="right"align="right" width="8%">Tot.Cat Spend </th>
				<th align="right" width="9%">Cat Available Bal </th>
				<th align="right" width="8%">Total Exp</th>
				<th align="right" width="7%">Avl.Budget </th>
			</tr>';
        $bg_color = 1;
        $file_name = '';
        $total_bud_expense = 0;

        $sub_cat_totals = array();
        $sub_cat_total = 0;
        $sub_cat_assigned_amt = array();

        $q_exp="SELECT e.date, e.description,e.amount, e.initial_amount, e.exp_title,e.budget_id,e.main_category_id,e.sub_category as sub_cat_id , e.id as expense_id, e.sub_category, e.file, c.name as category_name, cc.cost_center_code as cost_center_name, sc.name as sub_category_name FROM budget_expenses e ";
        $q_exp.="left join suppliers s on s.id=e.supplier_id left join  budget_cost_center cc on cc.id=e.cost_center left join xin_employees u on u.user_id=e.added_by left join categories c on e.main_category_id=c.id left join sub_categories sc on e.sub_category=sc.id WHERE e.budget_id is null and e.department_id='".$user[0]->department_id."'";
        if((!in_array('35',$role_resources_ids))) {
            $q_exp.=" and e.added_by = ".$user[0]->user_id;

        }
        $q_exp.= " order by e.id ASC ";
        $exp_query = $this->db->query($q_exp);
        $total_exp = 0;
        foreach ($exp_query->result() as $expense_data) {

            //calculate total expense under the sub category
            $sub_cat_totals[$expense_data->main_category_id] = isset($sub_cat_totals[$expense_data->main_category_id]) ? $sub_cat_totals[$expense_data->main_category_id] + $expense_data->amount : $expense_data->amount;

            //calculate the change in budget available for sub category
            $sub_cat_assigned = $this->db->query("SELECT amount FROM `assigned_budget_cats` WHERE `budget_id`='" . $budget_id . "' and `category_id`='" . $expense_data->main_category_id . "'")->result();
            if (isset($sub_cat_assigned[0]->amount)) {
                $sub_cat_assigned_amt[$expense_data->main_category_id] = isset($sub_cat_assigned_amt[$expense_data->main_category_id]) ? $sub_cat_assigned_amt[$expense_data->main_category_id] - $expense_data->amount : $sub_cat_assigned[0]->amount - $expense_data->amount;
            } else {
                $sub_cat_assigned_amt[$expense_data->sub_cat_id] = 0;
            }

            if (empty($bg_color)) {
                $bg_color = 'style="background-color:#eee;border-bottom:1px solid dimgrey;font-size:10px;"';
            } else {
                $bg_color = 'style="font-size:10px;"';
            }

            if ($expense_data->expense_id == $expense_id) {
                $bg_color = 'style="background-color:yellow;border-bottom:1px solid dimgrey;font-size:10px;"';
                $file_name = $expense_data->file;
            }

            $total_exp = $total_exp+$expense_data->initial_amount;
            $tbl .= '<tr  ' . $bg_color . '>
    			            <td style="border-bottom:1px solid dimgrey;" align="left">'.$expense_data->expense_id . '</td>
                    		<td style="border-bottom:1px solid dimgrey;" align="left">' . date('d-m-Y', strtotime($expense_data->date)) . '</td>
                    		<td style="border-bottom:1px solid dimgrey;" align="left">' . $expense_data->description . '</td>
                            <td style="border-bottom:1px solid dimgrey;vertical-align: middle;"align="left">' . $expense_data->sub_category_name . '</td>
                    		<td style="border-bottom:1px solid dimgrey;vertical-align: middle;"align="left">' . $expense_data->category_name . '</td>
                    		<td style="border-bottom:1px solid dimgrey;"align="left">' . $expense_data->cost_center_name . '</td>
                    		<td style="border-bottom:1px solid dimgrey;"align="right"><b>' . number_format($expense_data->initial_amount, 2) . '</b></td>
                    		<td style="border-bottom:1px solid dimgrey;font-size:9px;"align="right"><i>' . number_format($sub_cat_totals[$expense_data->main_category_id],2) . '</i></td>
                    		<td style="border-bottom:1px solid dimgrey;font-size:9px;"align="right"><i></i></td>
                     		<td style="border-bottom:1px solid dimgrey;font-size:9px;"align="right"><i>' . number_format($total_exp,2) . '</i></td>
                   		<td style="border-bottom:1px solid dimgrey;font-size:9px;"align="right"><i></i></td>
                        </tr>';

        }

        $tbl .= '</table>';
        $header_2 = '<table border="0" width="95%" ><tr height="100px" ><td width="55%" >
<table  align="left"  style="font-style:italic;  ">                    <tr>
                        <td  width="100%">
                            <table border="0"style="width: 100%; padding:0px;  color: #000000;" cellspacing="0">
            		          <tr>
            		            <td height="30px" colspan="2"><i>Project</i><br><b style="font-size:18px"></b></td>
            		            
            		          </tr>
            		          <tr>
            		            <td height="13px" width="23%" style="font-size:12px"></td>
            		          </tr>
            		          <tr>
            		            <td height="13px" width="23%" style="font-size:12px"><i>Project ID:</i> </td><td></td>
            		          </tr>';
        if($expense_id){
            $header_2.='<tr>
            		            <td height="13px" width="23%" style="font-size:12px"><i>Expense ID:</i> </td><td>'.$expense_id. '</td>
            		          </tr>';
    }

            		   $header_2.=     '  <tr>
            		             <td height="13px"  style="font-size:12px"><i>Department:</i></td><td></td>
            		          </tr>
            		          <tr>
            		            <td height="13px"  style="font-size:12px"><i>Date:</i></td><td>' . date("d.m.Y") . ' </td>
            		          </tr>
            		          <tr>
            		            <td height="13px" style="font-size:12px;"><i>Currency </i></td><td></td>
            		          </tr>
            		         
            		         
            		        </table></td></tr>
            		        </table></td><td><table border="0">
            		        <tr ><td height="97px"></td></tr>

            		         <tr><td></td></tr>
               

    		
</table></td> 	
	  </tr>
	  <tr><td></td><td width="56%" align="right" style="font-size:11px"height="10px">Page ' . $pdf->getAliasNumPage() . ' of ' . $pdf->getAliasNbPages() . '
</td></tr>
	  <tr><td width="100% "><table  border="0"width="100%"  cellpadding="5px" >
            		 <tr  style="background-color:#444; color:#fff;font-size: 10px;">
    		    <th align="left" width="7%">Expense ID</th>
				<th align="left" width="7%">Date</th>
				<th align="left" width="18%">Description</th>
				<th align="left" width="13%">Budget Line</th>
                <th  align="left"width="12%">Category</th>
                <th  align="left"width="7%">Cost Centre</th>
                <th align="center" width="9%">Amount</th>
                <th align="right"align="right" width="8%">Tot.Cat Spend </th>
				<th align="center" width="10%">Cat Available Bal </th>
				<th align="right" width="8%">Total Exp</th>
				<th align="right" width="7%">Avl.Budget </th>
			</tr>
</table></td></tr>
         		  </table>
            		  
            		  <br><br><br>.<br>
            		  
';
        $footerhtml = '<table height="40px" cellpadding="10px" >
                        <tr ><td style="border-top: 1px solid grey;"align="left" width="30%">Prepared By :' . $this->session->userdata("username")["name"] . '</td>
                        <td style="border-top: 1px solid grey;"align="center" width="40%">Internal Document - Confidential</td>
                        <td style="border-top: 1px solid grey;"align="center" width="14%"></td>
                        <td align="center" style="border-top: 1px solid grey; text-align:center;"  width="16%"></td>
</tr>
                        </table>';
        $pdf->header_for_first=$first_header;
        $pdf->header_for_all = $header_2;
        $pdf->xfootertext = $footerhtml;


        // set document information
        $pdf->SetCreator('Almana');
        $pdf->SetAuthor('Almana');
        $pdf->setHeaderData($ln = '', $lw = 0, $ht = '', $hs = $headerstring, $tc = array(0, 0, 0), $lc = array(0, 0, 0));

        $pdf->SetDefaultMonospacedFont('courier');
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set margins

        $pdf->SetMargins(6, 70, 7);
        // $pdf->SetMargins_1(6, 27, 7,false,320);

        $pdf->SetFooterMargin(3);
        $pdf->SetHeaderMargin(0);
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', 16));
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(1.25);
        $pdf->SetAuthor('Al Mana');
        $pdf->SetTitle('Al Mana - Budget ');
        // set font
        $pdf->SetFont('helvetica', 'B', 10);

        // set header and footer fonts
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-15, PDF_MARGIN_RIGHT);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-25);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // helvetica is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('helvetica', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage('L');

        // set text shadow effect
        //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        if (!empty($file_name)) {
            $file_parts = pathinfo($file_name);
            // $file_ext = strtolower($file_parts['extension']);
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

            if ($file_ext == 'png' || $file_ext == 'jpg' || $file_ext == 'jpeg') {
                $tbl .= '<table><tr><td><img src="' . site_url('uploads/expense_files/' . $file_name) . '"  width="300px" height="300px"/ ></td></tr></table>';
            } else if ($file_ext == 'pdf') {

            }
        }

        // $pdf->setY(100);
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        //Close and output PDF document
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if (in_array('4', $role_resources_ids)) {

            $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/uploads/expense_files/al_mana_1' . $expense_id . '.pdf', 'F');
            require_once APPPATH.'/libraries/PDFMerger/PDFMerger.php';
            $pdf_m = new PDFMerger;
            $pdf_m->addPDF($_SERVER['DOCUMENT_ROOT'].'/uploads/expense_files/al_mana_1' . $expense_id . '.pdf');

            if(!empty($file_name) && ($file_ext == 'pdf')) {

                $pdf_m->addPDF($_SERVER['DOCUMENT_ROOT'].'/uploads/expense_files/'.$file_name);

            }
            $pdf_m->merge('browser', 'al_mana_' . $expense_id . '.pdf');

            if (isset($_REQUEST['download'])) {
                $pdf->Output('al_mana_' . $expense_id . '.pdf', 'D');
            }
        }else {
            redirect('dashboard/');

        }

    }



    public function budget_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        $user = $this->Xin_model->read_user_info($session['user_id']);

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $budget_id = $this->uri->segment(3);

        $data = array();
        $q="SELECT e.date, e.remarks,e.initial_amount,e.amount,cm.name as comp_name,e.supplier_ref,e.currency, e.exp_title,e.budget_id,s.name as sup_name,e.main_category_id,e.sub_category as sub_cat_id , e.id as expense_id, e.sub_category, e.file, c.name as category_name, cc.cost_center_code as cost_center_name, sc.name as sub_category_name FROM budget_expenses e ";
        $q.=" left join companies cm on cm.id=e.company_id left join suppliers s on s.id=e.supplier_id left join  budget_cost_center cc on cc.id=e.cost_center left join xin_employees u on u.user_id=e.added_by left join categories c on e.main_category_id=c.id left join sub_categories sc on e.sub_category=sc.id WHERE e.budget_id='" . $budget_id . "' and  e.department_id='".$user[0]->department_id."'";
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if(!(in_array('35',$role_resources_ids))) {
            $q.=" and e.added_by = ".$user[0]->user_id;
        }
        $q.= " order by e.id ASC ";

        $exp_query = $this->db->query($q);
        $total_bud_expense=0;
        $sub_cat_totals = array();
        $sub_cat_total = 0;
        $sub_cat_assigned_amt = array();
        $avl_budget = $this->db->query("SELECT amount FROM `budgeting` WHERE `id`='" . $budget_id . "'")->result()[0]->amount;
        foreach($exp_query->result() as $expense_data)
        {
            $total_bud_expense += $expense_data->amount;//calculate change in total budget expense
            $avl_budget -= $expense_data->amount;//calculate change in available budget

//            //calculate total expense under the category
            $sub_cat_totals[$expense_data->main_category_id] = isset($sub_cat_totals[$expense_data->main_category_id]) ? $sub_cat_totals[$expense_data->main_category_id] + $expense_data->amount : $expense_data->amount;
//
//            //calculate the change in budget available for sub category
//            $sub_cat_assigned = $this->db->query("SELECT amount FROM `assigned_budget_cats` WHERE `budget_id`='" . $budget_id . "' and `category_id`='" . $expense_data->main_category_id . "'")->result();
//            if (isset($sub_cat_assigned[0]->amount)) {
//                $sub_cat_assigned_amt[$expense_data->main_category_id] = isset($sub_cat_assigned_amt[$expense_data->main_category_id]) ? $sub_cat_assigned_amt[$expense_data->main_category_id] - $expense_data->amount : $sub_cat_assigned[0]->amount - $expense_data->amount;
//            } else {
//                $sub_cat_assigned_amt[$expense_data->sub_cat_id] = 0;
//            }

            $sub_cat_total = 0;
            $query = $this->db->query("SELECT * FROM `budget_expenses` WHERE `budget_id`='".$budget_id."' and `sub_category`='".$expense_data->sub_category."'");
            foreach($query->result() as $sub_expense_data){
                $emp=$sub_expense_data->emp_id;
                //echo $emp;
                $emp_name=$this->Xin_model->get_employees_by_id($emp);
                $e_name ='';
                foreach($emp_name->result() as $ename){
                    $e_name=$ename->first_name." ".$ename->last_name;

                }

                $sub_cat_total=$sub_cat_total+$sub_expense_data->amount;
            }

            $expense_avalable_budget = $this->db->query("SELECT amount FROM `assigned_budget_sub_cats` WHERE `budget_id`='".$budget_id."' and `sub_category_id`='".$expense_data->sub_category."'")->result();
            if(isset($expense_avalable_budget[0]->amount))
            {
                $expense_avalable_budget = $expense_avalable_budget[0]->amount;
            }
            else
            {
                $expense_avalable_budget = 0;
            }

            $data[] = array(
                $expense_data->expense_id,
                $expense_data->comp_name,
                date('d-m-Y',strtotime($expense_data->date)),
                $expense_data->exp_title,
                $expense_data->category_name,
                $expense_data->sub_category_name,
                $expense_data->cost_center_name,
                $expense_data->sup_name,
                $expense_data->supplier_ref,
                $expense_data->currency,
                number_format($expense_data->initial_amount,2),
                number_format( $sub_cat_totals[$expense_data->main_category_id],2),
                number_format($total_bud_expense,2),
                number_format($avl_budget,2),
                '<span class=" fw-bolder px-4 py-3">
				<span class="svg-icon svg-icon-1 svg-icon-success">
					<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
						<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF"></path>
						<path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
					</svg>
				</span>
			</span>',
                '<a class="symbol symbol-20px mb-5" target="blank" href="'.site_url('budgeting/print_expense_sheet/'.$expense_data->budget_id.'/'.$expense_data->expense_id).'"><i class="fa fa-file"></i></a>',
                '<a class="symbol symbol-20px mb-5" href="'.site_url('budgeting/edit_expense/'.$expense_data->budget_id.'/'.$expense_data->expense_id).'"><i class="fa fa-pen"></i></a>',
            );

        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $exp_query->num_rows(),
            "recordsFiltered" => $exp_query->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }


    public function budget_assign_read()
    {
        $session = $this->session->userdata('username');
        $data['title'] = $this->Xin_model->site_title();
        $user = $this->Xin_model->read_user_info($session['user_id']);
        $data['department_id'] = $user[0]->department_id;
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        if(!empty($session)){
            $this->load->view('budgeting/dialog_budget_user_assign', $data);
        }
    }

    public function update_budget_assign()
    {
        if($this->input->post('add_type')=='update_budget_assign') {
            $Return = array('result'=>'', 'error'=>'');
            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('budget_id')==='') {
                $Return['error'] = 'Invalid budget.';
            } else if($this->input->post('sub_cat_id')==='') {
                $Return['error'] = 'Invalid budget.';
            }
            if(isset($_POST['assigned_sub_cat_employee'])){
                foreach($_POST['assigned_sub_cat_employee'] as $assigned_key => $assigned_data){
//    		        if(!empty($_POST['assigned_sub_cat_employee'][$assigned_key]) && empty($_POST['assigned_sub_cat_amount'][$assigned_key]))
//    		        {
//    		            $Return['error'] = 'Assign amount for selected employee!';
//    		        }
                    if(empty($_POST['assigned_sub_cat_employee'][$assigned_key]) && $_POST['assigned_sub_cat_amount'][$assigned_key]!=0)
                    {
                        $Return['error'] = 'Select employee for assigned amount!';
                    }
                }
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $budget_id  = $this->input->post('budget_id');
            $sub_cat_id = $this->input->post('sub_cat_id');
            $query = $this->db->query("SELECT * FROM `sub_categories` WHERE id='".$sub_cat_id."'")->result();
            $main_cat_id = 0;
            if(isset($query[0]->main_cat_id)){
                $main_cat_id = $query[0]->main_cat_id;
            }

            $this->db->query("DELETE FROM `budget_subcat_employee_assign` WHERE `budget_id`='".$budget_id."' and `main_cat_id`='".$main_cat_id."' and `sub_cat_id`='".$sub_cat_id."'");

            foreach($_POST['assigned_sub_cat_employee'] as $assigned_key => $assigned_data){
                if(!empty($_POST['assigned_sub_cat_employee'][$assigned_key]))
                {

                    $data = array(
                        'budget_id'   => $budget_id,
                        'employee_id' => $_POST['assigned_sub_cat_employee'][$assigned_key],
                        'main_cat_id' => $main_cat_id,
                        'sub_cat_id'  => $sub_cat_id,
                        'amount'      => 0,                    //$_POST['assigned_sub_cat_amount'][$assigned_key],
                        'added_by'    => $session['user_id'],
                        'date'        => date('Y-m-d H:i:s'),
                    );

                    $this->Budgeting_model->add_budget_subcat_employee_assign($data);
                }
            }
            $Return['result'] = 'Successfully updated!';
            $this->output($Return);

        }
    }

    public function direct_expense()
    {
        $session = $this->session->userdata('username');
        if(!empty($session) ){

        } else {
            redirect('');
        }
        $user = $this->Xin_model->read_user_info($session['user_id']);
        $q="SELECT e.date, e.amount,e.currency,e.description, e.exp_type, e.id ,e.emp_code,e.added_by, e.exp_title, s.name as supplier_name,u.first_name as added_by_name, cc.name as cost_center_name FROM budget_expenses e ";
        $role_resources_ids = $this->Xin_model->user_role_resource();
           $q.="left join suppliers s on s.id=e.supplier_id left join  budget_cost_center cc on cc.id=e.cost_center left join xin_employees u on u.user_id=e.added_by WHERE e.department_id='".$user[0]->department_id."'";
        if(!(in_array('35',$role_resources_ids))) {
            $q.=" and e.added_by = ".$user[0]->user_id ;
        }

        $exp_query = $this->db->query($q);
        $expense_data =$exp_query->result();

        $data = array();

        $data['department_id'] = $user[0]->department_id;
        $data['all_employees'] = $this->Xin_model->get_employees_by_department($data['department_id']);
        $data['title'] = $this->Xin_model->site_title();
        $data['expenses'] = $expense_data;
        $data['user_data'] = $user;
        $data['breadcrumbs'] = 'Direct Expenses';
        $data['path_url'] = 'direct_expenses';
        if(in_array('27',$role_resources_ids)) {
            if(!empty($session)){

                $user = $this->Xin_model->read_user_info($session['user_id']);
                $data['subview'] = $this->load->view("budgeting/direct_expenses", $data, TRUE);

                $this->load->view('layout_main', $data); //page load
            } else {
                redirect('');
            }} else {
            redirect('dashboard/');
        }
    }

    public function  direct_expense_list()
    {
        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));



        $user = $this->Xin_model->read_user_info($session['user_id']);
        //  $query.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $role_resources_ids = $this->Xin_model->user_role_resource();
        $q="SELECT e.date, e.amount,e.initial_amount, e.budget_id, e.currency,e.description, e.exp_type, e.id ,e.emp_code,e.added_by, e.exp_title, s.name as supplier_name,u.first_name as added_by_name, cc.name as cost_center_name FROM budget_expenses e ";
        $q.="left join suppliers s on s.id=e.supplier_id left join  budget_cost_center cc on cc.id=e.cost_center left join xin_employees u on u.user_id=e.added_by WHERE e.department_id='".$user[0]->department_id."'";
        if(!(in_array('35',$role_resources_ids))) {
            $q.=" and e.added_by = ".$user[0]->user_id ;
        }

        $exp_query = $this->db->query($q);
        $expense_data =$exp_query->result();

        $data = array();

        foreach($expense_data as $r) {

            $option = '';
            $role_resources_ids = $this->Xin_model->user_role_resource();



            if(in_array('28',$role_resources_ids)) {
                $option .= '<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" id="edit_exp" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"  data-bs-toggle="modal" data-bs-target=".view-modal-data"  data-exp_id="' . $r->id . '"><i class="fas fa-edit"></i></button></span>
';
                $option .= '<span data-toggle="tooltip" data-placement="top" title="Sync"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 sync"  id="sync_button" data-bs-toggle="modal" data-bs-target=".approve-modal" data-record-id="' . $r->id . '" title="Sync" data-token_type="direct_expense"><i class="fas fa-sync"></i></button></span>';
            }
            
            if(in_array('29',$role_resources_ids)){
                $option.= '<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete"  id="delete_button" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'.$r->id .'" title="Delete" data-token_type="direct_expense"><i class="fas fa-trash"></i></button></span>';
                
                $exp_print_url = site_url('budgeting/print_direct_expense_sheet/'.$r->id);
                if($r->budget_id>0){
                    $exp_print_url = site_url('budgeting/print_expense_sheet/'.$r->budget_id.'/'.$r->id);
                }
                $option.= '<span data-toggle="tooltip" data-placement="top" title="Print PDF"><a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" target="blank" href="'.$exp_print_url.'"><i class="fa fa-file-pdf"></i></a></span>';
            }

            $data[] = array(
                $r->id,
                $r->date,
                $r->exp_title,
                number_format($r->initial_amount,2),
                $r->currency,
                $r->cost_center_name,
                $r->supplier_name,
                $r->added_by_name,
                $r->added_by,
                $r->exp_type,
                $option
            );

        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $exp_query->num_rows(),
            "recordsFiltered" => $exp_query->num_rows(),
            "data" => $data
        );
        if(in_array('27',$role_resources_ids)) {
            echo json_encode($output);
        }
        exit();
    }



    public function delete_expense()
    {
        $id = $this->input->post('expense_id');
        $result = $this->Budgeting_model->delete_expense($id);

        if(isset($result) && $result==1){
            $Return['result'] = 'Expense Deleted';
            $Return['error'] = '';
            $Return['redirect_url'] = site_url('budgeting/direct_expense');

        } else {
            $Return['error'] = $this->lang->line('xin_error_msg');
        }

        $this->output($Return);
        exit;

    }
    /* function to convert to usd*/
    public function convert_to_base($value,$currency)
    {

        $currency = $this->Xin_model->get_currency_data_by_code($currency);
        if($currency[0])
            return $value*$currency[0]->one_usd;
        else
            return 0;


        die;
    }
    /* function to convert to usd*/
    public function convert_to_current_currency($value='',$currencyfrom,$currencyto,$type=0)
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
    public function print_selected_budgets()
    {
        $budget_ids = json_decode($this->input->post('budgets'));
        $title = $this->input->post('title');
        $pdf = new Mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $budget_data = $this->Budgeting_model->read_budgets_by_id($budget_ids);

        $table_height = (count($budget_data) + 2) * 10;
        $table_height = ($table_height > 120) ? $table_height : 120;
        if (empty($budget_data)) {
            exit();
        }
        //save budget code
        $dept = $this->Budgeting_model->read_budget_dept($budget_data[0]->department_id);
        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);

        //  $budget_code = strtoupper(substr($dept[0]->name,0,2))."-".date('y')."-".sprintf('%03d', $budget_data[0]->id);
        $headerstring = '<table width="100%" border="0" align="center">
		    <tr><td height="20"></td></tr>
		    <tr>
		    <td height="36" style="width:100%;" align="left!important"><img  src="https://almana.g4demo.com/assets/media/logos/logo-dark.svg"></td></tr><tr>
		      <td height="9"style="width:61%;"> <h2  align="right" style=" border-bottom: 1px solid grey; line-height:0.1em; margin:10px 0 20px;"><span style="background:white; padding:0 10px;"></span></h2></td>
		      <td height="9"style="width:22%;"> <h3  align="center" style="  line-height:0.1em; margin:10px 0 20px;">APPROVAL NOTE</h3></td>
		        <td height="9"style="width:17%;"> <h2  align="right" style="border-bottom: 1px solid grey; line-height:0.1em; margin:10px 0 20px;"></h2></td>

                </tr>
                <tr height="15px" width="100%">
                <td></td>
                </tr>
                <tr><td height="6px"  width= "106%" colspan="3" align="right" style="font-size: 11px">Page ' . $pdf->getAliasNumPage() . ' of ' . $pdf->getAliasNbPages() . ' </td></tr>
                </table>';

        $tbl = '
        <br><br>
        <table width="100%" align="center" height="300px"><tr><td height="' . $table_height . 'px"></td></tr></table>
		<table width="100%" align="center">
		  
		      
    		<tr>
    		<td style="bgcolor=white;" height="30px"></td>
                </tr>
            <tr>
        		<td colspan="2" width="100%" >';
        $total_budget=0;
        foreach ($budget_data as $budget) {
            $amt  = $this->convert_to_current_currency($budget->amount,$budget->currency,"AED",0);


            $total_budget = $total_budget + $amt;
        }

        $pdf->header_for_first = ' 
 
  <table  align="left" border="0" bgcolor="#d9e1f4" border-collapse: separate !important; style="padding:10px; border:2px solid  #362035;border-radius: 13%; border-spacing: 0;   ">                   
  <tr>
                                <td width="50%" height="360px">
                                          <table style="width: 100%; padding:0px; background:#000; color: #ccc;" cellspacing="0">
            		                              <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #ca3c3c;">
            		                                 <td height="30px" colspan="2"><b style="font-size:18px">' .$title.'</b></td>

            		                                </tr>
            		          
            		          
            		                               <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		                                         <td height="13px"  style="font-size:12px"><i>Department:</i></td><td>' . $dept[0]->name . '</td>
            		                                </tr>
                                                  <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
                                                    <td height="13px"  style="font-size:12px"><i>Date:</i></td><td>' . date("d.m.Y") . ' </td>
                                                  </tr>
                                                   <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px" style="font-size:12px"><i>Currency </i></td><td> AED </td>
            		          </tr>
                                                   <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
                                                    <td height="33px"  style="font-size:12px"></td>
                                                  </tr>
                                                  
                                              <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td   width="70%" cellpadding="10px" height="50px" style="text-align:left;border:solid 2px black;">
            		            <table border="0" style="width=100%;padding-right: 3px;">
            		            <tr><td></td></tr>
            		            <tr><td align="right">  <b style="font-size:12px;" >AED .</b><b style ="font-size:20px" >&nbsp;' . number_format($total_budget, 2) . '</b><br>
            		          </td></tr>

</table>
            		            </td>
            		          </tr>

            		        </table>
            		        <p style="font-style: italic;font-size: 10px"> ('.$this->convertNumberToWord(number_format($total_budget,2,".",""),"AED").')</p>
                        </td>
                                 <td width="50%" style="padding:20px;">
                        	<table border="0" class="box-one" style="width: 100%; padding:5px; background:#f1f4f6; color: #ccc;" cellspacing="0">
            		          <tr style="background:#f1f4f6; color: #000;">
            		            <td width="63%"><b style="font-size:13px">Budget Name</b></td>
            		            <td width="35%" style="text-align:right;"><b style="font-size:13px">Amount</b></td>
                                <td width="3%" style="text-align:right;border-bottom: 1px dashed #bdbdbd"></td>

            		          </tr>';


        $total_expense = 0;
        foreach ($budget_data as $budget) {
            $amt  = $this->convert_to_current_currency($budget->amount,$budget->currency,"AED",0);

            $pdf->header_for_first .= '<tr>
            		            <td width="63%" style=" color:black;border-style: dashed;border-color: #bdbdbd">' . $budget->budget_name . '</td>
            		            <td width="35%" style=" color:black; border-style: dashed;text-align:right;border-color: #bdbdbd">' . number_format($amt, 2) . '</td>
            		            <td width="3%" style="border-style: dashed;text-align:right;border-color: #bdbdbd"></td>

            		          </tr>';
        }
        $pdf->header_for_first .= '
                            <tr>
                   
                       <td width="63%" style="color:black; border-style: dashed;border-color: #bdbdbd "><b>Total :</b></td>
            		   <td style="color:green;text-align:right;border-style: dashed;text-align:right!important;border-color: #bdbdbd"  align="right" width="35%"><b>' . number_format($total_budget, 2) . '</b></td>
            		            <td width="3%" style="border-style: dashed;text-align:right;border-color: #bdbdbd"></td>


</tr></table>
                    	  </td>
                      </tr>
                      <tr>
                   <td width="1%" ></td>
                      <td width="35%"  style=" text-align:center; font-size: 13px;border-top: 3px double dimgrey;">Approved by</td>
                     <td width="64%"></td>

</tr>

                     
                    </table>';

        $pdf->header_for_all = '<table border="0" align="left" bgcolor="#d9e1f4" border-collapse: separate !important; style="padding:10px; border:2px solid #362035;border-radius: 13%; border-spacing: 0;   ">                    <tr>
                        <td width="50%" height="100px">
                            <table style="width: 100%; padding:0px; background:#000; color: #ccc;" cellspacing="0">
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #ca3c3c;">
            		            <td height="30px" colspan="2"><b style="font-size:18px">' . $title.'</b></td>

            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px"  style="font-size:12px"><i>Date:</i></td><td>' . date("d.m.Y") . ' </td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		             <td height="13px"  style="font-size:12px"><i>Department:</i></td><td>' . $dept[0]->name . '</td>
            		          </tr>
            		            <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px" style="font-size:12px"><i>Currency </i></td><td> AED </td>
            		          </tr>
            		          <tr style="background:#f1f4f6; color: #000; border-right: 1px solid #c3c3c3;">
            		            <td height="13px" style="font-size:12px"> </td>
            		          </tr>

            		        </table>
                        </td>
                        <td width="50%" align="center" style="padding:20px;padding-top: 120px">
                        <table border="0" height="100px">
                        <tr  height="30px"><td></td></tr>
                         <tr><td height="30%"></td></tr>
                          

                          <tr><td><b style="font-size:12px">Budget Value : AED . </b><b style ="font-size:18px" >&nbsp;' . number_format($total_budget, 2) . '</b></td></tr>
                          <tr><td></td></tr>
</table>

                        	</td>
                      </tr>


                    </table>';


        $tbl .= '</td>
            </tr>
           
                                	<tr>
                                		<td style="width:100%; ">
                                		<br><br><br><br>
                                			<table border="0"  width="100%" cellspacing="0" cellpadding="6">
                                				';
        $total_budget = 0;
        $category_total_array = array();
        foreach ($budget_data as $budget) {
            $category_total_array[] = array('cat_name' => $budget->budget_name, 'amount' => $budget->amount);
            $amt  = $this->convert_to_current_currency($budget->amount,$budget->currency,"AED",0);
            $total_budget+=$amt;
            $tbl .= '<tr style="background-color: #f7f7f7;">
                                					<td width="20%" ></td>

                                					<td width ="55%" style=" font-weight: 700;text-align:center "><b>' . $budget->budget_name . '</b></td>
                                		            <td width ="22%" style= " text-align:right">Amount</td>
                                                    <td width="3%" ></td>  
                                					
                                					
                                				</tr>
                                				';
            $bg_color = 0;
            $assigned_budget_category = $this->Budgeting_model->get_budget_categories_withname($budget->id);

            foreach ($assigned_budget_category->result() as $category) {


                $bg_color = '';
                $catamt  = $this->convert_to_current_currency($category->amount,$budget->currency,"AED",0);


                $tbl .= '
                                				<tr style="height:11px; line-height:11px;">
                                					<td width="2%" bgcolor="white"></td>
                                					<td width="73%" style="border-bottom: 1px solid #ccc;text-align:right;font-size:12px;">' . $category->name . '</td>
                                					<td width="23%" style="text-align: right!important; border-bottom: 1px solid #ccc;">' . number_format($catamt, 2) . '</td>
                                					<td width="3%" bgcolor="white"></td>
                                				</tr>';
            }

            $tbl .= '<tr>
                                    				<td width="1%" bgcolor="white"></td>
                                    				<td width="72%"></td>
                                    				<td width="25%" valign="top" style="text-align: right; margin-top:5px;" bgcolor="#676767" color="white"> &nbsp; <b>Total: ' . number_format($amt, 2) . '</b> </td>
                                    				<td width="2%" bgcolor="#676767"></td>
                                				</tr>
                                				<tr><td width="100%" height="2" bgcolor="white"></td></tr>';
        }
        $tbl .= '
                                			</table>
                                		</td>
                                	</tr>
                               
                    
        </table>';

        $footerhtml = '<table height="40px" cellpadding="10px" >
                        <tr ><td style="border-top: 1px solid grey;"align="left" width="30%">Prepared By :' . $this->session->userdata("username")["name"] . '</td>
                        <td style="border-top: 1px solid grey;"align="center" width="40%">' . $dept[0]->name . ' - Internal Document - Confidential</td>
                        <td style="border-top: 1px solid grey;"align="center" width="14%"></td>
                        <td align="center" style="border-top: 1px solid grey; text-align:center;"  width="16%"></td>
</tr>
                        </table>';
        $pdf->setHeaderData($ln = '', $lw = 0, $ht = '', $hs = $headerstring, $tc = array(0, 0, 0), $lc = array(0, 0, 0));

        $pdf->headertext = $headerstring;

        // set document information
        $pdf->SetCreator('Gligx');
        $pdf->SetAuthor('Gligx');

        $pdf->SetDefaultMonospacedFont('courier');

        // set margins
        $pdf->SetMargins(6, 80, 7);

        $pdf->SetFooterMargin(3);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(1.25);
        $pdf->SetAuthor('Al Mana');
        $pdf->SetTitle('Al Mana - Budget ');
        // set font
        $pdf->SetFont('helvetica', 'B', 10);

        // set header and footer fonts
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-15, PDF_MARGIN_RIGHT);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-25);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // helvetica is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('helvetica', '', 10, '', true);
        $pdf->setFooterData(array(0, 0, 0), array(0, 64, 128));

        $pdf->setFooterFont(array('helvetica', '', '10'));

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


        // -----------------------------------------------------------------------------

        $pdf->xfootertext = $footerhtml;
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        //print_r($tbl);exit();
        $pdf->writeHTML($tbl, true, false, false, false, '');


        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        //Close and output PDF document
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if (in_array('4', $role_resources_ids)) {

            $fname =$_SERVER['DOCUMENT_ROOT'].'/uploads/budget_files/al_mana_'.$title.'.pdf';
            $urltopdf = site_url('/uploads/budget_files/al_mana_'.$title.'.pdf');
            $pdf->Output($fname, 'F');
            $Return['result'] = 'PDF Generated!';
            $Return['error'] = '';
            $Return['data'] =$urltopdf;
            $this->output($Return);
            exit;
        } else {
            redirect('dashboard/');

        }

    }
    public function convertNumberToWord($value,$currency)
    {
        $currency_data =$this->Xin_model->get_currency_data_by_code($currency)[0];
        $value=round($value,$currency_data->after_decimal_length);

        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);

        $amt = explode(".",$value);
        if(!isset($amt[1])){
            $amt[1]= "00";
        }
        $words= ucfirst($f->format($amt[0])." ".$currency_data->name."s and ".$f->format($amt[1])." ".$currency_data->decimal_point);
        return $words;


    }

}