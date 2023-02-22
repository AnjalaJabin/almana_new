<?php

class xin_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_information($id) {
        $condition = "user_id ='".$id."'";
        $this->db->select('*');
        $this->db->from('xin_employees');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function read_designation_info($id) {
        $condition = "designation_id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('xin_designations');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function check_password_reset_data($code1,$code2)
    {
        $this->db->select('*');
        $this->db->from('password_reset');
        $this->db->where('code_1',$code1);
        $this->db->where('code_2',$code2);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    // get email template info
    public function read_email_template($id) {

        $condition = "template_id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('xin_email_template');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }


    // get company setting info
    public function read_company_setting_info($id) {
        $this->db->select('*');
        $this->db->from('xin_system_setting');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    // is logged in to system
    public function is_logged_in($id)
    {
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata($id);
        return $is_logged_in;
    }

    // generate random string
    public function generate_random_string($length = 7) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function read_setting_info($id) {
        $this->db->select('*');
        $this->db->from('xin_system_setting');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    // get title
    public function site_title() {
        return 'AL MANA | APP';
    }

    public function read_user_info($id) {
        $condition = "user_id='".$id."'";
        $this->db->select('*');
        $this->db->from('xin_employees');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    public function read_allowance_by_employee($employee_id){
        $condition = "employee_id='".$employee_id."'";
        $this->db->select('*');
        $this->db->from('allowances');
        $this->db->where($condition);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function read_allowance_by_id($id){
        $this->db->select('*');
        $this->db->from('allowances');
        $this->db->where('id',$id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }


    public function convert_to_current_currency($value='',$currencyfrom,$currencyto,$type=0)
    {
        $currency_from = $this->get_currency_data_by_code($currencyfrom);
        $currency_to = $this->get_currency_data_by_code($currencyto);
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


    // get user role > links > all
    public function user_role_resource(){

        // get session
        $session = $this->session->userdata('username');
        // get userinfo and role
        $user = $this->read_user_info($session['user_id']);
        $role_user = $this->read_user_role_info($user[0]->user_role_id);

        $role_resources_ids = explode(',',$role_user[0]->role_resources);
        return $role_resources_ids;
    }

    // get single user role info
    public function read_user_role_info($id) {
        $condition = "role_id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('xin_user_roles');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }

    // get single user > by email
    public function read_user_info_byemail($email) {
        $condition = "email ='".$email."' and deleted=0 and is_active='1'";
        $this->db->select('*');
        $this->db->from('xin_employees');
        $this->db->where($condition);
        $this->db->limit(1);
        return $query = $this->db->get();

        //return $query->num_rows();
    }

    public function get_categories_by_department($department_id) {
        $condition = "department_id='".$department_id."'";
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where($condition);
        $this->db->order_by('name', 'ASC');
        return $this->db->get();
    }
    public function get_currencies($user_id) {
        //$condition = "added_by='".$user_id."'";
        $this->db->select('*');
        $this->db->from('xin_currencies');
        //$this->db->where($condition);
        $this->db->order_by('name', 'ASC');
        return $this->db->get();
    }
    public function get_taxes()
    {
        $this->db->select('*');
        $this->db->from('tax');
        $this->db->order_by('name', 'ASC');
        return $this->db->get();
    }
    public function get_companies()
    {
        $this->db->select('*');
        $this->db->from('companies');
        $this->db->order_by('name', 'ASC');
        return $this->db->get();
    }

    public function read_currency_by_id($id)
    {
        $condition = "currency_id='".$id."'";
        $this->db->select('*');
        $this->db->from('xin_currencies');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();

    }
    public function get_default_currency()
    {
        $this->db->select('default_currency_symbol');
        $this->db->from('xin_system_setting');
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();

    }

    public function get_currency_data_by_code($code)
    {
        $condition = "code='".$code."'";
        $this->db->select('*');
        $this->db->from('xin_currencies');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();

    }
    public function get_sub_categories_by_department($department_id) {
        $condition = "department_id='".$department_id."'";
        $this->db->select('*');
        $this->db->from('sub_categories');
        $this->db->where($condition);
        return $this->db->get();
    }

    public function get_sub_categories_by_department_and_budget_id($department_id,$budget_id) {
        $condition = "department_id='".$department_id."' and id IN(select sub_category_id from assigned_budget_sub_cats where budget_id='".$budget_id."') ";
        $this->db->select('*');
        $this->db->from('sub_categories');
        $this->db->where($condition);
        return $this->db->get();
    }
    public function get_sub_categories_by_user_and_budget_id($employee_id,$budget_id) {
        $condition = " id IN(select sub_cat_id from budget_subcat_employee_assign where budget_id='".$budget_id."' and employee_id='".$employee_id."') ";
        $this->db->select('*');
        $this->db->from('sub_categories');
        $this->db->where($condition);
        return $this->db->get();
    }

    public function get_sub_categories_by_main_cat($category_id) {
        $condition = "main_cat_id='".$category_id."'";
        $this->db->select('*');
        $this->db->from('sub_categories');
        $this->db->where($condition);
        return $this->db->get();
    }

    public function get_employees_by_department($department_id) {
        $condition = "department_id='".$department_id."'";
        $this->db->select('*');
        $this->db->from('xin_employees');
        $this->db->where($condition);
        return $this->db->get();
    }

    public function read_category_data_by_id($id) {
        $condition = "id ='".$id."'";
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }

    public function read_sub_category_data_by_id($id) {
        $condition = "id ='".$id."'";
        $this->db->select('*');
        $this->db->from('sub_categories');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }


    public function read_department_data_by_id($id) {
        $condition = "id ='".$id."'";
        $this->db->select('*');
        $this->db->from('departments');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }

    public function read_cost_center_data_by_id($id) {
        $condition = "id ='".$id."'";
        $this->db->select('*');
        $this->db->from('budget_cost_center');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }
    public function read_doc_type_data_by_id($id) {
        $condition = "id ='".$id."'";
        $this->db->select('*');
        $this->db->from('doc_types');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }
    public function read_periods_data_by_id($id) {
        $condition = "id ='".$id."'";
        $this->db->select('*');
        $this->db->from('allowance_period');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }
    public function read_store_data_by_id($id) {
        $condition = "id ='".$id."'";
        $this->db->select('*');
        $this->db->from('stores');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }

    public function read_suppliers_data_by_id($id) {
        $condition = "id ='".$id."'";
        $this->db->select('*');
        $this->db->from('suppliers');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }


    public function get_all_cost_centers() {
        $this->db->select('*');
        $this->db->from('budget_cost_center');
        return $this->db->get();
    }
    public function get_all_doc_types() {
        $this->db->select('*');
        $this->db->from('doc_types');
        return $this->db->get();
    }
    public function get_all_allowance_category() {
        $this->db->select('*');
        $this->db->from('allowance_category');
        return $this->db->get();
    }


    public function get_all_stores() {
        $this->db->select('*');
        $this->db->from('stores');
        return $this->db->get();
    }
    public function get_all_periods() {
        $this->db->select('allowance_period.*,allowance_category.name as category');
        $this->db->from('allowance_period');
        $this->db->join('allowance_category','allowance_category.id=allowance_period.category_id');
        return $this->db->get();
    }
    public function get_all_companies() {
        $this->db->select('*');
        $this->db->from('companies');
        return $this->db->get();
    }

    public function get_all_employees() {
        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);

        $this->db->select('*');
        $this->db->from('xin_employees');
        $this->db->where('department_id', $user[0]->department_id);;
        $query= $this->db->get();
        return $query->result();
    }
    public function get_all_employee_count() {
        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);

        $this->db->select('count(*) as employee_count');
        $this->db->from('xin_employees');
        $this->db->where('department_id', $user[0]->department_id);;
        $query= $this->db->get();
        return $query->result();
    }
    public function get_all_suppliers() {
        $this->db->select('*');
        $this->db->from('suppliers');
        return $this->db->get();
    }


    public function get_all_categories() {
        $this->db->select('*');
        $this->db->from('categories');
        return $this->db->get();
    }


    public function get_all_sub_categories() {
        $this->db->select('*');
        $this->db->from('sub_categories');
        return $this->db->get();
    }

    public function get_all_expenses() {
        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);
        $role_resources_ids = $this->user_role_resource();
        $this->db->select('*');
        $this->db->from('budget_expenses');
        if(!(in_array('35',$role_resources_ids))) {
            $this->db->where('added_by = '.$user[0]->user_id);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get();
    }
    public function get_tot_budget_amount_old(){

        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);
        $this->db->select('sum(amount) as total_amount');
        $this->db->from('budgeting');
        $this->db->where('department_id', $user[0]->department_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_tot_budget_amount(){

        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);
        $role_resources_ids = $this->user_role_resource();
        $this->db->select('*');
        $this->db->from('budgeting');
        $this->db->where('department_id', $user[0]->department_id);
        $this->db->where('status', 1);
        if(!(in_array('2',$role_resources_ids))) {
            $this->db->where('added_by = '.$user[0]->user_id);
        }
        $query = $this->db->get();
        $total_amount = 0;
        foreach($query->result() as $data){
            if($data->currency=='AED'){
                $total_amount = $total_amount+$data->amount;
            }else{
                $re_amount = $this->Xin_model->convert_to_current_currency($data->amount,$data->currency,'AED',0);
                $total_amount = $total_amount+$re_amount;
            }
        }

        if($total_amount==0){

            $query = $this->db->query("SELECT ac.amount, b.currency FROM budget_subcat_employee_assign ba, assigned_budget_sub_cats ac, budgeting b WHERE ba.sub_cat_id=ac.sub_category_id and b.id=ac.budget_id");
            $total_amount = 0;
            foreach($query->result() as $data){
                if($data->currency=='AED'){
                    $total_amount = $total_amount+$data->amount;
                }else{
                    $re_amount = $this->Xin_model->convert_to_current_currency($data->amount,$data->currency,'AED',0);
                    $total_amount = $total_amount+$re_amount;
                }
            }

        }

        return $total_amount;
    }

    public function get_all_expense_counts()
    {
        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);
        $role_resources_ids = $this->user_role_resource();
        $this->db->select('*');
        $this->db->from('budget_expenses');
        $this->db->where('department_id', $user[0]->department_id);
        if(!(in_array('35',$role_resources_ids))) {
            $this->db->where('added_by = '.$user[0]->user_id);
        }
        $query = $this->db->get();
        $total_amount = 0;
        $exp_count = 0;
        foreach($query->result() as $data){
            if($data->currency=='AED'){
                $total_amount = $total_amount+$data->initial_amount;
            }else{
                $re_amount = $this->Xin_model->convert_to_current_currency($data->initial_amount,$data->currency,'AED',0);
                $total_amount = $total_amount+$re_amount;
            }
            $exp_count++;
        }
        return array('amount'=>$total_amount,'count'=>$exp_count);
    }

    public function get_all_expense_counts_old()
    {
        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);
        $this->db->select('count(*) as all_expense_count,sum(amount) as total_amount');
        $this->db->from('budget_expenses');
        $this->db->where('department_id', $user[0]->department_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_budget_exp_count(){
        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);
        $role_resources_ids = $this->user_role_resource();
        $this->db->select('*');
        $this->db->from('budget_expenses');
        $this->db->where('department_id',$user[0]->department_id);
        $this->db->where('exp_type',0);
        if(!(in_array('35',$role_resources_ids))) {
            $this->db->where('added_by = '.$user[0]->user_id);
        }
        $query = $this->db->get();
        $total_amount = 0;
        $exp_count = 0;
        foreach($query->result() as $data){
            if($data->currency=='AED'){
                $total_amount = $total_amount+$data->initial_amount;
            }else{
                $re_amount = $this->Xin_model->convert_to_current_currency($data->initial_amount,$data->currency,'AED',0);
                $total_amount = $total_amount+$re_amount;
            }
            $exp_count++;
        }
        return array('amount'=>$total_amount,'count'=>$exp_count);
    }

    public function get_budget_exp_count_old(){
        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);
        $this->db->select('count(*) as budget_expense_count,sum(amount) as total_amount');
        $this->db->from('budget_expenses');
        $this->db->where('department_id',$user[0]->department_id);
        $this->db->where('exp_type',0);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_direct_exp_count(){
        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);
        $this->db->select('*');
        $this->db->from('budget_expenses');
        $this->db->where('department_id',$user[0]->department_id);
        $this->db->where('exp_type',1);
        $query = $this->db->get();
        $total_amount = 0;
        $exp_count = 0;
        foreach($query->result() as $data){
            if($data->currency=='AED'){
                $total_amount = $total_amount+$data->initial_amount;
            }else{
                $re_amount = $this->Xin_model->convert_to_current_currency($data->initial_amount,$data->currency,'AED',0);
                $total_amount = $total_amount+$re_amount;
            }
            $exp_count++;
        }
        return array('amount'=>$total_amount,'count'=>$exp_count);
    }

    public function get_direct_exp_count_old(){
        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);
        $this->db->select('count(*) as direct_expense_count,sum(amount) as total_amount');
        $this->db->from('budget_expenses');
        $this->db->where('department_id',$user[0]->department_id);
        $this->db->where('exp_type',1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_my_exp_count(){
        $session = $this->session->userdata('username');
        $user = $this->read_user_info($session['user_id']);
        $this->db->select('count(*) as my_expense_count,sum(amount) as total_amount');
        $this->db->from('budget_expenses');
        $this->db->where('department_id',$user[0]->department_id);
        $this->db->where('added_by',$user[0]->user_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_departments() {
        $this->db->select('*');
        $this->db->from('departments');
        return $this->db->get();
    }

    public function get_all_roles() {
        $this->db->select('*');
        $this->db->from('xin_user_roles');
        return $this->db->get();
    }

    public function check_budget_main_cat_exist($data,$department_id) {
        $query = $this->db->query("SELECT * from categories where department_id='".$department_id."' and LOWER(name)='".strtolower($data)."' ");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function check_period_exists($data) {
        $query = $this->db->query("SELECT * from allowance_period where category_id='".$data['category_id']."' and from_date='".$data['from_date']."' and to_date='".$data['to_date']."'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function check_allowance_exists($employee,$period) {
        $query = $this->db->query("SELECT * from allowances where employee_id='".$employee."' and period_id='".$period."'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function check_budget_sub_cat_exist($data,$department_id,$main_cat_id) {
        $query = $this->db->query("SELECT * from sub_categories where department_id='".$department_id."' and main_cat_id='".$main_cat_id."' and LOWER(name)='".strtolower($data)."' ");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function check_department_exist($department) {
        $query = $this->db->query("SELECT * from departments where LOWER(name)='".strtolower($department)."' ");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function check_currency_exist($currency) {
        $query = $this->db->query("SELECT * from xin_currencies where LOWER(name)='".strtolower($currency)."' ");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function check_company_exist($cost) {
        $query = $this->db->query("SELECT * from companies where LOWER(name)='".strtolower($cost)."' ");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function check_cost_center_exist($cost) {
        $query = $this->db->query("SELECT * from budget_cost_center where LOWER(name)='".strtolower($cost)."' ");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function check_doc_type_exist($cost) {
        $query = $this->db->query("SELECT * from doc_types where LOWER(name)='".strtolower($cost)."' ");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function check_store_exist($store) {
        $query = $this->db->query("SELECT * from stores where LOWER(name)='".strtolower($store)."' ");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function check_supplier_exist($suppliers) {
        $query = $this->db->query('SELECT * from suppliers where LOWER(name)="'.strtolower($suppliers).'"');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }


    // Function to add record in table
    public function add_departments($data){
        $this->db->insert('departments', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    } public function add_doc_type($data){
    $this->db->insert('doc_types', $data);
    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }
}
    public function add_period($data){
        $this->db->insert('allowance_period', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function add_store($data){
        $this->db->insert('stores', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    // Function to add record in table
    public function add_cost_center($data){
        $this->db->insert('budget_cost_center', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function add_company($data){
        $this->db->insert('companies', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add_currencies($data){
        $this->db->insert('xin_currencies', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Function to add record in table
    public function add_supplier($data){
        $this->db->insert('suppliers', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    // Function to add record in table
    public function add_budget_main_cat($data){
        $this->db->insert('categories', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Function to add record in table
    public function add_budget_sub_cat($data){
        $this->db->insert('sub_categories', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Function to add record in table
    public function add_user_activity_log($data){
        $this->db->insert('user_activity_log', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_password_reset_data($data)
    {
        $this->db->insert('password_reset', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function update_new_password($data, $id){
        $condition = "user_id =" . "'" . $id . "'";
        $this->db->where($condition);
        $query =$this->db->update('xin_employees',$data);
        if($query=true ) {
            return 1;
        } else {
            return false;
        }
    }
    // Function to update record in table
    public function update_category($data, $id){
        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        if( $this->db->update('categories',$data)) {
            return true;
        } else {
            return false;
        }
    }
    public function update_allowance($data, $id){
        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        if( $this->db->update('allowances',$data)) {
            return true;
        } else {
            return false;
        }
    }
    public function update_currency($data, $id){
        $condition = "currency_id =" . "'" . $id . "' ";
        $this->db->where($condition);
        if( $this->db->update('xin_currencies',$data)) {
            return true;
        } else {
            return false;
        }
    }



    // Function to update record in table
    public function update_sub_category($data, $id){
        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        if( $this->db->update('sub_categories',$data)) {
            return true;
        } else {
            return false;
        }
    }


    // Function to update record in table
    public function update_department($data, $id){
        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        if( $this->db->update('departments',$data)) {
            return true;
        } else {
            return false;
        }
    }


    // Function to update record in table
    public function update_cost_center($data, $id){
        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        if( $this->db->update('budget_cost_center',$data)) {
            return true;
        } else {
            return false;
        }
    }
    public function update_doc_type($data, $id){
        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        if( $this->db->update('doc_types',$data)) {
            return true;
        } else {
            return false;
        }
    }
    public function update_period($data, $id){
        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        if( $this->db->update('allowance_period',$data)) {
            return true;
        } else {
            return false;
        }
    }
    public function update_store($data, $id){
        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        if( $this->db->update('stores',$data)) {
            return true;
        } else {
            return false;
        }
    }


    // Function to update record in table
    public function update_supplier($data, $id){
        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        if( $this->db->update('suppliers',$data)) {
            return true;
        } else {
            return false;
        }
    }


    /*  DELETE CONSTANTS */
    // Function to Delete selected record from table
    public function delete_category($id){

        $query = $this->db->query("SELECT * from assigned_budget_cats where category_id='".$id."' ");
        if ($query->num_rows() >= 1) {
            return 0;
        }
        else
        {
            $condition = "id =" . "'" . $id . "' ";
            $this->db->where($condition);
            $this->db->delete('categories');
            return 1;
        }
    }
    public function delete_doc_type($id){


        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        $this->db->delete('doc_types');
        return 1;

    }


    public function delete_sub_category($id){

        $query = $this->db->query("SELECT * from assigned_budget_sub_cats where sub_category_id='".$id."' ");
        if ($query->num_rows() >= 1) {
            return 0;
        }
        else
        {
            $condition = "id =" . "'" . $id . "' ";
            $this->db->where($condition);
            $this->db->delete('sub_categories');
            return 1;
        }
    }



    public function delete_department($id){

        $query = $this->db->query("SELECT * from budgeting where department_id='".$id."' ");
        if ($query->num_rows() >= 1) {
            return 0;
        }
        else
        {
            $condition = "id =" . "'" . $id . "' ";
            $this->db->where($condition);
            $this->db->delete('departments');
            return 1;
        }
    }

    public function delete_currency($id){

        if($this->db->delete('xin_currencies', array('currency_id' => $id))==true)
        {
            return 1;
        }else{
            return  0;
        }

    }

    public function delete_cost_center($id){

        $query = $this->db->query("SELECT * from budget_expenses where cost_center='".$id."' ");
        if ($query->num_rows() >= 1) {
            return 0;
        }
        else
        {
            $condition = "id =" . "'" . $id . "' ";
            $this->db->where($condition);
            $this->db->delete('budget_cost_center');
            return 1;
        }
    }
    public function delete_company($id){

        $query = $this->db->query("SELECT * from budget_expenses where company_id='".$id."' ");
        if ($query->num_rows() >= 1) {
            return 0;
        }
        else
        {
            $condition = "id =" . "'" . $id . "' ";
            $this->db->where($condition);
            $this->db->delete('companies');
            return 1;
        }
    }
    public function delete_store($id){


        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        $this->db->delete('stores');
        return 1;

    }


    public function delete_supplier($id){

        $query = $this->db->query("SELECT * from budget_expenses where supplier_id='".$id."' ");
        if ($query->num_rows() >= 1) {
            return 0;
        }
        else
        {
            $condition = "id =" . "'" . $id . "' ";
            $this->db->where($condition);
            $this->db->delete('suppliers');
            return 1;
        }
    }
    public function delete_period($id){

        $query = $this->db->query("SELECT * from allowances where period_id='".$id."' ");
        if ($query->num_rows() >= 1) {
            return 0;
        }
        else
        {
            $condition = "id =" . "'" . $id . "' ";
            $this->db->where($condition);
            $this->db->delete('allowance_period');
            return 1;
        }
    }
    public function get_employees_by_id($id) {
        $condition = "user_id='".$id."'";
        $this->db->select('*');
        $this->db->from('xin_employees');
        $this->db->where($condition);
        return $this->db->get();
    }
}
?>