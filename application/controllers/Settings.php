<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

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
        $session = $this->session->userdata('username');
        if(!empty($session)){

        } else {
            redirect('');
        }

        $data['title'] = $this->Xin_model->site_title();
        $data = array(
            'title' => $this->Xin_model->site_title(),
        );
        $data['breadcrumbs'] = 'Settings';

        if(!empty($tab_link)){
            if($tab_link=='invoice_settings'){
                $data['breadcrumbs'] = 'Invoice Configuration';
            }else if($tab_link=='pinvoice_settings'){
                $data['breadcrumbs'] = 'Proforma Invoice Configuration';
            }else if($tab_link=='porder_settings'){
                $data['breadcrumbs'] = 'Purchase Order Configuration';
            }else if($tab_link=='dnote_settings'){
                $data['breadcrumbs'] = 'Delivery Note Configuration';
            }else if($tab_link=='product_category'){
                $data['breadcrumbs'] = 'Product Category Settings';
            }else if($tab_link=='product_brand'){
                $data['breadcrumbs'] = 'Product Brand Settings';
            }else if($tab_link=='system'){
                $data['breadcrumbs'] = 'CRM Configuration';
            }else if($tab_link=='expense'){
                $data['breadcrumbs'] = 'Expense Category Settings';
            }else if($tab_link=='currency_type'){
                $data['breadcrumbs'] = 'Currency Type Settings';
            }else if($tab_link=='lead_status'){
                $data['breadcrumbs'] = 'Lead Status Settings';
            }else if($tab_link=='lead_source'){
                $data['breadcrumbs'] = 'Lead Source Settings';
            }else if($tab_link=='web_to_lead'){
                $data['breadcrumbs'] = 'Web to Lead Settings';
            }else if($tab_link=='tax_settings'){
                $data['breadcrumbs'] = 'Tax Settings';
            }else if($tab_link=='import_products'){
                $data['breadcrumbs'] = 'Import Products';
            }else if($tab_link=='active_devices'){
                $data['breadcrumbs'] = 'Active Devices';
            }
        }

        $data['path_url'] = 'settings';
        $session = $this->session->userdata('username');
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if(in_array('21',$role_resources_ids)) {

            if(!empty($session)){
                $data['subview'] = $this->load->view("settings/settings", $data, TRUE);
                $this->load->view('layout_main', $data); //page load
            } else {
                redirect('');
            }} else {
            redirect('dashboard/');
        }
    }

    public function add_budget_main_category() {
        if($this->input->post('type')=='add_budget_main_category') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The category name field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $cat_exist = $this->Xin_model->check_budget_main_cat_exist($this->input->post('name'),$user[0]->department_id);

            if($cat_exist==true)
            {
                $Return['error'] = 'This category already exists in your database.';
            }
            else
            {
                $data = array(
                    'name' => $this->input->post('name'),
                    'department_id' => $user[0]->department_id,
                    'date' => date('Y-m-d H:i:s'),
                    'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_budget_main_cat($data);
                if ($result == TRUE) {
                    $Return['result'] = 'Budget category added.';

                    $user_data = array(
                        'page' => 'settings/index/budget_category',
                        'page_title' => $this->input->post('name'),
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'date_time' => date('Y-m-d H:i:s'),
                        'user_id' => $session['user_id'],
                        'activity' => 'Added New Budget Category'
                    );
                    $this->Xin_model->add_user_activity_log($user_data);

                } else {
                    $Return['error'] = 'Bug. Something went wrong, please try again.';
                }
            }

            $this->output($Return);
            exit;
        }
    }


    public function add_budget_sub_category() {
        if($this->input->post('type')=='add_budget_sub_category') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            $main_cat_id = $this->uri->segment(3);
            $main_cat= $this->input->post('main_category');
            if(isset($main_cat) && !empty($main_cat))
            {
                $main_cat_id = $this->input->post('main_category');
            }

            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The sub category name field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $user = $this->Xin_model->read_user_info($session['user_id']);
            $cat_exist = $this->Xin_model->check_budget_sub_cat_exist($this->input->post('name'),$user[0]->department_id,$main_cat_id);

            if($cat_exist==true)
            {
                $Return['error'] = 'This category already exists in your database.';
            }
            else
            {
                $data = array(
                    'name' => $this->input->post('name'),
                    'department_id' => $user[0]->department_id,
                    'main_cat_id' => $main_cat_id,
                    'date' => date('Y-m-d H:i:s'),
                    'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_budget_sub_cat($data);
                if ($result == TRUE) {
                    $Return['result'] = 'Budget sub category added.';

                    $user_data = array(
                        'page' => 'settings/index/budget_category',
                        'page_title' => $this->input->post('name'),
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'date_time' => date('Y-m-d H:i:s'),
                        'user_id' => $session['user_id'],
                        'activity' => 'Added New Budget Sub Category'
                    );
                    $this->Xin_model->add_user_activity_log($user_data);

                } else {
                    $Return['error'] = 'Bug. Something went wrong, please try again.';
                }
            }

            $this->output($Return);
            exit;
        }
    }

    public function add_currency() {


        if($this->input->post('type')=='add_currency') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The Currency name field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $currency_exist = $this->Xin_model->check_currency_exist($this->input->post('name'));

            if($currency_exist==true)
            {
                $Return['error'] = 'This curency already exists in your database.';
            }
            else
            {
                $data = array(
                    'name' => $this->input->post('name'),
                    'code' => $this->input->post('code'),
                    'symbol' => $this->input->post('symbol'),
                    'decimal_point' => $this->input->post('decimalpoint'),
                    'after_decimal_length' => $this->input->post('decimallength'),
                    'one_usd' => $this->input->post('usd'),

                    'created_at' => date('Y-m-d H:i:s'),
                    //'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_currencies($data);
                if ($result == TRUE) {
                    $Return['result'] = 'Currency added.';

                    $user_data = array(
                        'page' => '',
                        'page_title' => $this->input->post('name'),
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'date_time' => date('Y-m-d H:i:s'),
                        'user_id' => $session['user_id'],
                        'activity' => 'Added New Currency'
                    );
                    $this->Xin_model->add_user_activity_log($user_data);

                } else {
                    $Return['error'] = 'Bug. Something went wrong, please try again.';
                }
            }

            $this->output($Return);
            exit;
        }
    }

    public function add_departments() {
        if($this->input->post('type')=='add_departments') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The department name field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $dept_exist = $this->Xin_model->check_department_exist($this->input->post('name'));

            if($dept_exist==true)
            {
                $Return['error'] = 'This department already exists in your database.';
            }
            else
            {
                $data = array(
                    'name' => $this->input->post('name'),
                    'added_date' => date('Y-m-d H:i:s'),
                    'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_departments($data);
                if ($result == TRUE) {
                    $Return['result'] = 'Department added.';

                    $user_data = array(
                        'page' => '',
                        'page_title' => $this->input->post('name'),
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'date_time' => date('Y-m-d H:i:s'),
                        'user_id' => $session['user_id'],
                        'activity' => 'Added New Department'
                    );
                    $this->Xin_model->add_user_activity_log($user_data);

                } else {
                    $Return['error'] = 'Bug. Something went wrong, please try again.';
                }
            }

            $this->output($Return);
            exit;
        }
    }

    public function add_doctype() {
        if($this->input->post('type')=='add_doctype') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The name field is required.";
            }
             if($this->input->post('code')==='') {
                $Return['error'] = "The code field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $cost_exist = $this->Xin_model->check_doc_type_exist($this->input->post('name'));

            if($cost_exist==true)
            {
                $Return['error'] = 'This Document Type already exists in your database.';
            }
            else
            {
                $data = array(
                    'name' => $this->input->post('name'),
                    'code'=>$this->input->post('code'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_doc_type($data);
                if ($result == TRUE) {
                    $Return['result'] = 'Document Type added.';

                    $user_data = array(
                        'page' => '',
                        'page_title' => $this->input->post('name'),
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'date_time' => date('Y-m-d H:i:s'),
                        'user_id' => $session['user_id'],
                        'activity' => 'Added New Cost Center'
                    );
                    $this->Xin_model->add_user_activity_log($user_data);

                } else {
                    $Return['error'] = 'Bug. Something went wrong, please try again.';
                }
            }

            $this->output($Return);
            exit;
        }
    }


    public function add_cost_center() {
        if($this->input->post('type')=='add_cost_center') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The Cost Center name field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $cost_exist = $this->Xin_model->check_cost_center_exist($this->input->post('name'));

            if($cost_exist==true)
            {
                $Return['error'] = 'This Cost Center already exists in your database.';
            }
            else
            {
                $data = array(
                    'name' => $this->input->post('name'),
                    'cost_center_code'=>$this->input->post('export'),
                    'date' => date('Y-m-d H:i:s'),
                    'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_cost_center($data);
                if ($result == TRUE) {
                    $Return['result'] = 'Cost Center added.';

                    $user_data = array(
                        'page' => '',
                        'page_title' => $this->input->post('name'),
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'date_time' => date('Y-m-d H:i:s'),
                        'user_id' => $session['user_id'],
                        'activity' => 'Added New Cost Center'
                    );
                    $this->Xin_model->add_user_activity_log($user_data);

                } else {
                    $Return['error'] = 'Bug. Something went wrong, please try again.';
                }
            }

            $this->output($Return);
            exit;
        }
    }
    public function add_store() {
        if($this->input->post('type')=='add_store') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The name field is required.";
            }
            if($this->input->post('code')==='') {
                $Return['error'] = "The code field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $cost_exist = $this->Xin_model->check_store_exist($this->input->post('name'));

            if($cost_exist==true)
            {
                $Return['error'] = 'This Store already exists in your database.';
            }
            else
            {
                $data = array(
                    'name' => $this->input->post('name'),
                    'code'=>$this->input->post('code'),
                    'latitude'=>$this->input->post('latitude'),
                    'longitude'=>$this->input->post('longitude'),
                    'address'=>$this->input->post('address'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_store($data);
                if ($result == TRUE) {
                    $Return['result'] = 'Store added!';

                    $user_data = array(
                        'page' => '',
                        'page_title' => $this->input->post('name'),
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'date_time' => date('Y-m-d H:i:s'),
                        'user_id' => $session['user_id'],
                        'activity' => 'Added New Store'
                    );
                    $this->Xin_model->add_user_activity_log($user_data);

                } else {
                    $Return['error'] = 'Bug. Something went wrong, please try again.';
                }
            }

            $this->output($Return);
            exit;
        }
    }

    public function add_period() {
        if($this->input->post('type')=='add_period') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            $range= $this->input->post('range');
            if($this->input->post('range')==='') {
                $Return['error'] = " Date Range is required.";
            }
            if($Return['error']!=''){
                $this->output($Return);
            }

            $dates = explode(" - ", $range);
            $from_date = date("Y-m-d", strtotime($dates[0]));
            $to_date = date("Y-m-d", strtotime($dates[1]));

                $data = array(
                    'from_date' => $from_date,
                    'to_date'=>$to_date,
                    'category_id'=>$this->input->post('category'),
                    'created_at' => date('Y-m-d H:i:s'),
                );
                $period_exist= $this->Xin_model->check_period_exists($data);
                if($period_exist){
                    $Return['error'] = "Period Already Exists!!";
                    $this->output($Return);

                }


                $result = $this->Xin_model->add_period($data);
                if ($result == TRUE) {
                    $Return['result'] = 'Allowance Period added!';

                    $user_data = array(
                        'page' => 'period',
                        'page_title' => 'add_period',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'date_time' => date('Y-m-d H:i:s'),
                        'user_id' => $session['user_id'],
                        'activity' => 'Added New PEriod of allowance'
                    );
                    $this->Xin_model->add_user_activity_log($user_data);

                } else {
                    $Return['error'] = 'Bug. Something went wrong, please try again.';
                }


            $this->output($Return);
            exit;
        }
    }

    public function add_company() {
        if($this->input->post('type')=='add_company') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The Company name field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $cost_exist = $this->Xin_model->check_company_exist($this->input->post('name'));

            if($cost_exist==true)
            {
                $Return['error'] = 'This Company already exists in your database.';
            }
            else
            {
                $data = array(
                    'name' => $this->input->post('name'),
                    'company_code'=>$this->input->post('code'),
                    'created_date' => date('Y-m-d H:i:s'),
                    'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_company($data);
                if ($result == TRUE) {
                    $Return['result'] = 'Company added.';

                    $user_data = array(
                        'page' => '',
                        'page_title' => $this->input->post('name'),
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'date_time' => date('Y-m-d H:i:s'),
                        'user_id' => $session['user_id'],
                        'activity' => 'Added New Company'
                    );
                    $this->Xin_model->add_user_activity_log($user_data);

                } else {
                    $Return['error'] = 'Bug. Something went wrong, please try again.';
                }
            }

            $this->output($Return);
            exit;
        }
    }

    public function add_supplier() {
        if($this->input->post('type')=='add_supplier') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            $session = $this->session->userdata('username');
            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The Supplier field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $cost_exist = $this->Xin_model->check_supplier_exist($this->input->post('name'));

            if($cost_exist==true)
            {
                $Return['error'] = 'This Supplier already exists in your database.';
            }
            else
            {
                $data = array(
                    'name' => $this->input->post('name'),
                    'ref_no' => $this->input->post('ref_no'),
                    'date' => date('Y-m-d H:i:s'),
                    'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_supplier($data);
                if ($result == TRUE) {
                    $Return['result'] = 'Supplier Added.';

                    $user_data = array(
                        'page' => '',
                        'page_title' => $this->input->post('name'),
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'date_time' => date('Y-m-d H:i:s'),
                        'user_id' => $session['user_id'],
                        'activity' => 'Added New Supplier'
                    );
                    $this->Xin_model->add_user_activity_log($user_data);

                } else {
                    $Return['error'] = 'Bug. Something went wrong, please try again.';
                }
            }

            $this->output($Return);
            exit;
        }
    }


    public function budget_category_list() {
        $data['title'] = $this->Xin_model->site_title();
        $user_id = $this->session->userdata('user_id');
        $data = array();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("settings/budget_category_list", $data);
        }
    }
    public function currency_list() {
        $data['title'] = $this->Xin_model->site_title();
        $user_id = $this->session->userdata('user_id');
        $data = array();
        $session = $this->session->userdata('username');

        if(!empty($session)){
            $this->load->view("settings/settings", $data);
        } else {
            redirect('');
        }
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $constant = $this->Xin_model->get_currencies($user_id);

        $data = array();

        foreach($constant->result() as $r) {

            $edit='<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".edit_setting_datail" data-field_id="'. $r->currency_id . '" data-field_type="currency"><i class="fas fa-edit"></i></button></span>';

            $delete='<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->currency_id . '" title="Delete" data-token_type="currency"><i class="fas fa-trash"></i></button></span>';


            $data[] = array(
                $edit.' '.$delete,
                $r->name,
                $r->code,
                $r->symbol,
                $r->decimal_point,
                $r->after_decimal_length,
                $r->one_usd
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $constant->num_rows(),
            "recordsFiltered" => $constant->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
        exit();

    }

    public function budget_sub_category_list() {
        $data['title'] = $this->Xin_model->site_title();
        $main_cat_id = $this->uri->segment(3);
        $user_id = $this->session->userdata('user_id');
        $data = array();
        $data['main_cat_id'] = $main_cat_id;
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("settings/budget_sub_category_list", $data);
        }
    }


    public function department_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("settings/settings", $data);
        } else {
            redirect('');
        }
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $constant = $this->Xin_model->get_all_departments();

        $data = array();

        foreach($constant->result() as $r) {

            $edit='<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".edit_setting_datail" data-field_id="'. $r->id . '" data-field_type="departments"><i class="fas fa-edit"></i></button></span>';

            $delete='<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->id . '" title="Delete" data-token_type="departments"><i class="fas fa-trash"></i></button></span>';


            $data[] = array(
                $edit.' '.$delete,
                $r->name
            );
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $constant->num_rows(),
            "recordsFiltered" => $constant->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }


    public function category_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("settings/settings", $data);
        } else {
            redirect('');
        }
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $constant = $this->Xin_model->get_all_categories();

        $data = array();

        foreach($constant->result() as $r) {

            $edit='<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".edit_setting_datail" data-field_id="'. $r->id . '" data-field_type="category"><i class="fas fa-edit"></i></button></span>';

            $delete='<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->id . '" title="Delete" data-token_type="category"><i class="fas fa-trash"></i></button></span>';


            $data[] = array(
                $edit.' '.$delete,
                $r->name
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $constant->num_rows(),
            "recordsFiltered" => $constant->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }



    public function sub_category_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("settings/settings", $data);
        } else {
            redirect('');
        }
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $constant = $this->Xin_model->get_all_sub_categories();

        $data = array();

        foreach($constant->result() as $r) {

            $edit='<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".edit_setting_datail" data-field_id="'. $r->id . '" data-field_type="sub_category"><i class="fas fa-edit"></i></button></span>';

            $delete='<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->id . '" title="Delete" data-token_type="sub_category"><i class="fas fa-trash"></i></button></span>';

            $category = $this->Xin_model->read_category_data_by_id($r->main_cat_id);

            $data[] = array(
                $edit.' '.$delete,
                $category[0]->name,
                $r->name
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $constant->num_rows(),
            "recordsFiltered" => $constant->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }



    public function cost_center_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("settings/settings", $data);
        } else {
            redirect('');
        }
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $constant = $this->Xin_model->get_all_cost_centers();

        $data = array();

        foreach($constant->result() as $r) {

            $edit='<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".edit_setting_datail" data-field_id="'. $r->id . '" data-field_type="cost_center"><i class="fas fa-edit"></i></button></span>';

            $delete='<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->id . '" title="Delete" data-token_type="cost_center"><i class="fas fa-trash"></i></button></span>';


            $data[] = array(
                $edit.' '.$delete,
                $r->name,
                $r->cost_center_code
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $constant->num_rows(),
            "recordsFiltered" => $constant->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function doc_type_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("settings/settings", $data);
        } else {
            redirect('');
        }
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $constant = $this->Xin_model->get_all_doc_types();

        $data = array();

        foreach($constant->result() as $r) {

            $edit='<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".edit_setting_datail" data-field_id="'. $r->id . '" data-field_type="doc_type"><i class="fas fa-edit"></i></button></span>';

            $delete='<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->id . '" title="Delete" data-token_type="doc_type"><i class="fas fa-trash"></i></button></span>';


            $data[] = array(
                $edit.' '.$delete,
                $r->name,
                $r->code
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $constant->num_rows(),
            "recordsFiltered" => $constant->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function store_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("settings/settings", $data);
        } else {
            redirect('');
        }
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $constant = $this->Xin_model->get_all_stores();

        $data = array();

        foreach($constant->result() as $r) {

            $edit='<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".edit_setting_datail" data-field_id="'. $r->id . '" data-field_type="store"><i class="fas fa-edit"></i></button></span>';

            $delete='<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->id . '" title="Delete" data-token_type="store"><i class="fas fa-trash"></i></button></span>';


            $data[] = array(
                $edit.' '.$delete,
                $r->name,
                $r->code,
                $r->currency,
                $r->latitude,
                $r->longitude,
                $r->address,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $constant->num_rows(),
            "recordsFiltered" => $constant->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function company_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("settings/settings", $data);
        } else {
            redirect('');
        }
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $constant = $this->Xin_model->get_all_companies();

        $data = array();

        foreach($constant->result() as $r) {

            $edit='';//'<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".edit_setting_datail" data-field_id="'. $r->id . '" data-field_type="cost_center"><i class="fas fa-edit"></i></button></span>';

            $delete='<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->id . '" title="Delete" data-token_type="company"><i class="fas fa-trash"></i></button></span>';


            $data[] = array(
                $edit.' '.$delete,
                $r->name,
                $r->company_code
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $constant->num_rows(),
            "recordsFiltered" => $constant->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }
    public function supplier_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("settings/settings", $data);
        } else {
            redirect('');
        }
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $constant = $this->Xin_model->get_all_suppliers();

        $data = array();

        foreach($constant->result() as $r) {

            $edit='<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".edit_setting_datail" data-field_id="'. $r->id . '" data-field_type="supplier"><i class="fas fa-edit"></i></button></span>';

            $delete='<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->id . '" title="Delete" data-token_type="supplier"><i class="fas fa-trash"></i></button></span>';


            $data[] = array(
                $edit.' '.$delete,
                $r->name,
                $r->ref_no
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $constant->num_rows(),
            "recordsFiltered" => $constant->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

 public function period_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("settings/settings", $data);
        } else {
            redirect('');
        }
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $constant = $this->Xin_model->get_all_periods();

        $data = array();

        foreach($constant->result() as $r) {

            $edit='<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".edit_setting_datail" data-field_id="'. $r->id . '" data-field_type="period"><i class="fas fa-edit"></i></button></span>';

            $delete='<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->id . '" title="Delete" data-token_type="period"><i class="fas fa-trash"></i></button></span>';


            $data[] = array(
                $edit.' '.$delete,
                $r->id,
                date('j M Y', strtotime($r->from_date)),
                date('j M Y', strtotime($r->to_date)),
                $r->category,


            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $constant->num_rows(),
            "recordsFiltered" => $constant->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }


    // read and view all constants data > modal form
    public function constants_read()
    {
        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view('settings/dialog_constants', $data);
        } else {
            redirect('');
        }
    }


    /*  UPDATE RECORD > CONSTANTS*/


    // Validate and update info in database
    public function update_category() {

        if($this->input->post('type')=='edit_category') {

            $id = $this->uri->segment(3);

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The Category field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $data = array(
                'name' => $this->input->post('name')
            );

            $result = $this->Xin_model->update_category($data,$id);

            if ($result == TRUE) {
                $Return['result'] = 'Category Updated.';
            } else {
                $Return['error'] = 'Bug. Something went wrong, please try again.';
            }
            $this->output($Return);
            exit;
        }
    }


    public function update_currency() {

        if($this->input->post('type')=='edit_currency') {

            $id = $this->uri->segment(3);

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The Name field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $data = array(
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'symbol' => $this->input->post('symbol'),
                'decimal_point' => $this->input->post('decimalpoint'),
                'after_decimal_length' => $this->input->post('decimallength'),
                'one_usd' => $this->input->post('usd'),
            );

            $result = $this->Xin_model->update_currency($data,$id);

            if ($result == TRUE) {
                $Return['result'] = 'Currency Updated.';
            } else {
                $Return['error'] = 'Bug. Something went wrong, please try again.';
            }
            $this->output($Return);
            exit;
        }
    }



    // Validate and update info in database
    public function update_sub_category() {

        if($this->input->post('type')=='edit_sub_category') {

            $id = $this->uri->segment(3);

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The Category field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $data = array(
                'name' => $this->input->post('name')
            );

            $result = $this->Xin_model->update_sub_category($data,$id);

            if ($result == TRUE) {
                $Return['result'] = 'Sub Category Updated.';
            } else {
                $Return['error'] = 'Bug. Something went wrong, please try again.';
            }
            $this->output($Return);
            exit;
        }
    }



    // Validate and update info in database
    public function update_department() {

        if($this->input->post('type')=='edit_department') {

            $id = $this->uri->segment(3);

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The Category field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $data = array(
                'name' => $this->input->post('name')
            );

            $result = $this->Xin_model->update_department($data,$id);

            if ($result == TRUE) {
                $Return['result'] = 'Department Updated.';
            } else {
                $Return['error'] = 'Bug. Something went wrong, please try again.';
            }
            $this->output($Return);
            exit;
        }
    }




    // Validate and update info in database
    public function update_cost_center() {

        if($this->input->post('type')=='cost_center') {

            $id = $this->uri->segment(3);

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The Cost Center field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $data = array(
                'name' => $this->input->post('name'),
                'cost_center_code'=>$this->input->post('export')
            );

            $result = $this->Xin_model->update_cost_center($data,$id);

            if ($result == TRUE) {
                $Return['result'] = 'Cost Center Updated.';
            } else {
                $Return['error'] = 'Bug. Something went wrong, please try again.';
            }
            $this->output($Return);
            exit;
        }
    }
 public function update_doc_type() {

        if($this->input->post('type')=='doc_type') {

            $id = $this->uri->segment(3);

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result' => '', 'error' => '');

            /* Server side PHP input validation */
            /* Server side PHP input validation */
            if ($this->input->post('name') === '') {
                $Return['error'] = "The name field is required.";
            }
            if ($this->input->post('code') === '') {
                $Return['error'] = "The code field is required.";
            }

            if ($Return['error'] != '') {
                $this->output($Return);
            }


            $data = array(
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),

            );

            $result = $this->Xin_model->update_doc_type($data, $id);

            if ($result == TRUE) {
                $Return['result'] = 'Document Type Updated.';
            } else {
                $Return['error'] = 'Bug. Something went wrong, please try again.';
            }
            $this->output($Return);
            exit;
        }
    }

    public function update_store() {

        if($this->input->post('type')=='store') {

            $id = $this->uri->segment(3);

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The Name field is required.";
            }
            if($this->input->post('code')==='') {
                $Return['error'] = "The Code field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }
            $session = $this->session->userdata('username');

            $data = array(
                'name' => $this->input->post('name'),
                'code'=>$this->input->post('code'),
                'latitude'=>$this->input->post('latitude'),
                'longitude'=>$this->input->post('longitude'),
                'address'=>$this->input->post('address'),
                'created_at' => date('Y-m-d H:i:s'),
                'added_by' => $session['user_id']
            );


            $result = $this->Xin_model->update_store($data,$id);

            if ($result == TRUE) {
                $Return['result'] = 'Cost Center Updated.';
            } else {
                $Return['error'] = 'Bug. Something went wrong, please try again.';
            }
            $this->output($Return);
            exit;
        }
    }


    // Validate and update info in database
    public function update_supplier() {

        if($this->input->post('type')=='edit_supplier') {

            $id = $this->uri->segment(3);

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            /* Server side PHP input validation */
            if($this->input->post('name')==='') {
                $Return['error'] = "The Supplier field is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $data = array(
                'name' => $this->input->post('name'),
                'ref_no' => $this->input->post('ref_no'),
            );

            $result = $this->Xin_model->update_supplier($data,$id);

            if ($result == TRUE) {
                $Return['result'] = 'Supplier Updated.';
            } else {
                $Return['error'] = 'Bug. Something went wrong, please try again.';
            }
            $this->output($Return);
            exit;
        }
    }

 public function update_period() {

        if($this->input->post('type')=='edit_period') {

            $id = $this->uri->segment(3);

            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');

            $range= $this->input->post('range');
            if($this->input->post('range')==='') {
                $Return['error'] = " Date Range is required.";
            }

            if($Return['error']!=''){
                $this->output($Return);
            }

            $dates = explode(" - ", $range);
            $from_date = date("Y-m-d", strtotime($dates[0]));
            $to_date = date("Y-m-d", strtotime($dates[1]));

            $data = array(
                'from_date' => $from_date,
                'to_date'=>$to_date,
                'category_id'=>$this->input->post('category'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $period_exist= $this->Xin_model->check_period_exists($data);
            if($period_exist&&$period_exist[0]->id!=$id){
                $Return['error'] = "Period Already Exists!!";
                $this->output($Return);

            }

            $result = $this->Xin_model->update_period($data,$id);

            if ($result == TRUE) {
                $Return['result'] = 'Period Updated.';
            } else {
                $Return['error'] = 'Bug. Something went wrong, please try again.';
            }
            $this->output($Return);
            exit;
        }
    }


    /*  DELETE CONSTANTS */
    // delete constant record > table
    public function delete_category() {

        if($this->input->post('type')=='delete_record') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $id = $this->uri->segment(3);
            $result = $this->Xin_model->delete_category($id);
            if(isset($result) && $result==1) {
                $Return['result'] = 'Category Deleted.';
            } else {
                $Return['error'] = "Item Already connected can't be deleted";
            }
            $this->output($Return);
        }
    }
    public function delete_doc_type() {

        if($this->input->post('type')=='delete_record') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $id = $this->uri->segment(3);
            $result = $this->Xin_model->delete_doc_type($id);
            if(isset($result) && $result==1) {
                $Return['result'] = 'Document type Deleted.';
            } else {
                $Return['error'] = "Item Already connected can't be deleted";
            }
            $this->output($Return);
        }
    } public function delete_period() {

        if($this->input->post('type')=='delete_record') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $id = $this->uri->segment(3);
            $result = $this->Xin_model->delete_period($id);
            if(isset($result) && $result==1) {
                $Return['result'] = 'Period Deleted.';
            } else {
                $Return['error'] = "Item Already connected can't be deleted";
            }
            $this->output($Return);
        }
    }
     public function delete_store() {

        if($this->input->post('type')=='delete_record') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $id = $this->uri->segment(3);
            $result = $this->Xin_model->delete_store($id);
            if(isset($result) && $result==1) {
                $Return['result'] = 'Store Deleted.';
            } else {
                $Return['error'] = "Item Already connected can't be deleted";
            }
            $this->output($Return);
        }
    }


    public function delete_sub_category() {

        if($this->input->post('type')=='delete_record') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $id = $this->uri->segment(3);
            $result = $this->Xin_model->delete_sub_category($id);
            if(isset($result) && $result==1) {
                $Return['result'] = 'Sub Category Deleted.';
            } else {
                $Return['error'] = "Item Already connected can't be deleted";
            }
            $this->output($Return);
        }
    }

    public function delete_currency() {

        if($this->input->post('type')=='delete_record') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $id = $this->uri->segment(3);
            $result = $this->Xin_model->delete_currency($id);
            if(isset($result) && $result==1) {
                $Return['result'] = 'Currency Deleted.';
            } else {
                $Return['error'] = "Item Already connected can't be deleted";
            }
            $this->output($Return);
        }
    }
    public function delete_departments() {

        if($this->input->post('type')=='delete_record') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $id = $this->uri->segment(3);
            $result = $this->Xin_model->delete_department($id);
            if(isset($result) && $result==1) {
                $Return['result'] = 'Department Deleted.';
            } else {
                $Return['error'] = "Item Already connected can't be deleted";
            }
            $this->output($Return);
        }
    }



    public function delete_cost_center() {

        if($this->input->post('type')=='delete_record') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $id = $this->uri->segment(3);
            $result = $this->Xin_model->delete_cost_center($id);
            if(isset($result) && $result==1) {
                $Return['result'] = 'Cost Center Deleted.';
            } else {
                $Return['error'] = "Item Already connected can't be deleted";
            }
            $this->output($Return);
        }
    }
    public function delete_company() {

        if($this->input->post('type')=='delete_record') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $id = $this->uri->segment(3);

            $result = $this->Xin_model->delete_company($id);

            if(isset($result) && $result==1) {
                $Return['result'] = 'Company Deleted.';
            } else {
                $Return['error'] = "Item Already connected can't be deleted";
            }
            $this->output($Return);
        }
    }


    public function delete_supplier() {

        if($this->input->post('type')=='delete_record') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $id = $this->uri->segment(3);
            $result = $this->Xin_model->delete_supplier($id);
            if(isset($result) && $result==1) {
                $Return['result'] = 'Supplier Deleted.';
            } else {
                $Return['error'] = "Item Already connected can't be deleted";
            }
            $this->output($Return);
        }
    }

}
