<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Allowances extends MY_Controller {

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
        $data['path_url'] = 'allowances';
        $role_resources_ids = $this->Xin_model->user_role_resource();
        if(in_array('7',$role_resources_ids)) {

            if(!empty($session)){
                $data['subview'] = $this->load->view("allowances/allowance_list", $data, TRUE);
                $this->load->view('layout_dashboard', $data); //page load
            } else {
                redirect('');
            }} else {
            redirect('dashboard/');
        }
    }


    public function employee_list()
    {

        $data['title'] = $this->Xin_model->site_title();
        $session = $this->session->userdata('username');
        if(!empty($session)){
            $this->load->view("allowances/allowance_list", $data);
        } else {
            redirect('');
        }
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $employee = $this->Employees_model->get_employee_allowances();
        $data = array();

        foreach($employee->result() as $r) {

            $option = '';
            $role_resources_ids = $this->Xin_model->user_role_resource();

            $stores =$this->Employees_model->read_stores_allocated($r->stores);
            $stores_user ='';
            if(!empty($stores)) {
                foreach ($stores as $store) {
                    $stores_user .= $store->code . " ";
                }
            }




            if(in_array('8',$role_resources_ids))
                $option.= '<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"  data-bs-toggle="modal" data-bs-target=".edit-modal-data"  data-allowance_id="'. $r->id . '"><i class="fas fa-edit"></i></button></span>';
            if(in_array('9',$role_resources_ids))
                $option.= '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_delete').'"><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete" data-bs-toggle="modal" data-bs-target=".delete-modal" data-record-id="'. $r->id . '"><i class="fas fa-trash"></i></button></span>';

            $max_chars = 10;

            if (strlen($stores_user) > $max_chars) {
                $stores_user = substr($stores_user, 0, $max_chars) . "..";
            }


            $data[] = array(
                $r->first_name,
                $r->emp_code,
                $r->email,
                $stores_user,
                date('j M Y', strtotime($r->from_date))." - ".date('j M Y', strtotime($r->to_date)),
                number_format($r->amount,2),
                number_format($r->amount-$r->spent_amount,2),
                $r->category,
                $r->category_id,
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
    public function add_allowance() {

        if($this->input->post('add_type')=='add_allowance') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result' => '', 'error' => '');

            /* Server side PHP input validation */
            if ($this->input->post('employee') === '') {
                $Return['error'] = "please Elect an Employee";
            } else if (empty($this->input->post('period'))) {
                $Return['error'] = "Date Range is Mandatory";
            }
            if ($Return['error'] != '') {
                $this->output($Return);
            }
            $employee = $this->input->post('employee');
            $periods = $this->input->post('period');
            $amounts = $this->input->post('amount');
            foreach ($periods as $i => $period) {
                $amount = $amounts[$i];
                if (!empty($period) && !empty($amount)) {
                    $period_exist= $this->Xin_model->check_allowance_exists($employee,$period);
                    if($period_exist){
                        $Return['error'] = "Allowance Already Exists For ".$period."!!";
                        $this->output($Return);

                    }
                    $this->db->insert('allowances', array('employee_id' => $employee, 'period_id' => $period, 'amount' => $amount, 'updated_at' => date('Y-m-d H:i:s'),));
                }
            }
            $Return['result'] = "User Allowance Added Successfully";

            $this->output($Return);
        }
        exit;

    }



    public function read_allowance()
    {

        $id = $this->input->get('allowance_id');
        $session = $this->session->userdata('username');
//        $result = $this->Xin_model->read_allowance_by_employee($id);
        $result = $this->Xin_model->read_allowance_by_id($id);
        $data['breadcrumbs'] = "Allowance Details";
        $data['path_url'] = 'allowances';

        $data = array(
            'allowance'=>$result[0],
        );

        if(!empty($session)){
            $this->load->view('allowances/dialog_allowance', $data);
        } else {
            redirect('');
        }
    }



    // Validate and update info in database
    public function update() {

        if($this->input->post('edit_type')=='edit_allowance') {
            /* Define return | here result is used to return user data and error for error message */
            $Return = array('result'=>'', 'error'=>'');
            $id = $this->input->post('allowance_id');

            /* Server side PHP input validation */
            /* Server side PHP input validation */
            if ($this->input->post('employee') === '') {
                $Return['error'] = "please Select an Employee";
            } else if (empty($this->input->post('period'))) {
                $Return['error'] = "Date Range is Mandatory";
            }
            if ($Return['error'] != '') {
                $this->output($Return);
            }
            $data=array(
                'employee_id' => $this->input->post('employee'),
                'period_id' =>  $this->input->post('period'),
                'amount'=> $this->input->post('amount'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $period_exist= $this->Xin_model->check_allowance_exists($this->input->post('employee'),$this->input->post('period'));
            if($period_exist&&($period_exist[0]->id!=$id)){
                $Return['error'] = "Allowance Already Exists!!";
                $this->output($Return);

            }
            $result = $this->Xin_model->update_allowance($data,$id);

            if ($result == TRUE) {
                $Return['result'] = 'Allowance Updated';
            } else {
                $Return['error'] = $this->lang->line('xin_error_msg');
            }
            $this->output($Return);
            exit;
        }
    }


    public function delete()
    {
        $Return = array('result' => '', 'error' => '');

        $id = $this->input->post('allowance_id');
        $result = $this->db->where('id', $id)->delete('allowances');
        if ($result == TRUE) {
            $Return['result'] = 'Allowance Deleted';
        } else {
            $Return['error'] = $this->lang->line('xin_error_msg');
        }

        $this->output($Return);
        exit;

    }



}