<?php

class budgeting_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Function to add record in table
    public function add_budget($data){
        $this->db->insert('budgeting', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_budget($data,$budget_id){
        $condition = " id ='".$budget_id."' ";
        $this->db->where($condition);
        if( $this->db->update('budgeting',$data)) {
            return true;
        } else {
            return false;
        }
    }
    public function get_all_budgeting_alloc($dep_id)
    {
        $this->db->select('sum(amount) as total_amount');
        $this->db->from('budgeting');
        $this->db->where('department_id',$dep_id);
        $this->db->where('status',1);
        $query=$this->db->get();
        return $query->result();

    }
    public function get_all_user_exp($user_id)
    {
        $this->db->select('sum(amount) as total_amount');
        $this->db->from('budget_expenses');
        $this->db->where('added_by',$user_id);
        $this->db->where('exp_type',1);
        $query=$this->db->get();
        return $query->result();

    }
    public function get_exp_list($exp_id)
    {
        $q="SELECT e.*, s.name as supplier_name,s.ref_no as card_code,u.first_name as added_by_name, cc.name as cost_center_name, cc.cost_center_code as cost_center_code,t.percentage as tax_percent FROM budget_expenses e  left join suppliers s on s.id=e.supplier_id left join  budget_cost_center cc on cc.id=e.cost_center left join xin_employees u on u.user_id=e.added_by left join tax t on t.tax_code=e.tax_code WHERE  e.id = ".$exp_id." and e.api_status=0";
        $exp_query = $this->db->query($q);

        return $exp_query->result();

    }
    public function add_expense($data){
        $this->db->insert('budget_expenses', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_expense($data,$expense_id){
        $condition = " id ='".$expense_id."' ";
        $this->db->where($condition);
        if( $this->db->update('budget_expenses',$data)) {
            return true;
        } else {
            return false;
        }
    }

    public function read_expense_data_by_id($id) {
        $condition = "id ='".$id."'";
        $this->db->select('*');
        $this->db->from('budget_expenses');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    public function read_expense_data_by_empid($id) {
        $condition = "emp_id ='".$id."'";
        $this->db->select('*');
        $this->db->from('budget_expenses');
        $this->db->where($condition);

        $query = $this->db->get();
        return $query->result();
    }
    public function delete_expense($id){
        $condition = "id =" . "'" . $id . "' ";
        $this->db->where($condition);
        $this->db->delete('budget_expenses');
        return 1;
    }

    public function add_budget_category_assign($data){
        $this->db->insert('assigned_budget_cats', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add_budget_sub_category_assign($data){
        $this->db->insert('assigned_budget_sub_cats', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_budget_categories($budget_id){
        $condition = "budget_id='".$budget_id."'";
        $this->db->select('*');
        $this->db->from('assigned_budget_cats');
        $this->db->where($condition);
        $this->db->order_by('id', 'ASC');
        return $this->db->get();
    }
    public function get_budget_categories_withname($budget_id){
        $condition = "budget_id='".$budget_id."'";
        $this->db->select('assigned_budget_cats.id,assigned_budget_cats.category_id,assigned_budget_cats.budget_id,assigned_budget_cats.amount,categories.name');
        $this->db->from('assigned_budget_cats');
        $this->db->join('categories','categories.id=assigned_budget_cats.category_id');

        $this->db->where($condition);
        $this->db->order_by('id', 'ASC');
        return $this->db->get();
    }


    public function get_budget_assigned_employees($budget_id,$sub_cat_id){
        $condition = "budget_id='".$budget_id."' and sub_cat_id='".$sub_cat_id."'";
        $this->db->select('*');
        $this->db->from('budget_subcat_employee_assign');
        $this->db->where($condition);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_budget_allocations($budget_id){
        $condition = "budget_id='".$budget_id."'";
        $this->db->select('*');
        $this->db->from('budget_subcat_employee_assign');
        $this->db->where($condition);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_budget_sub_categories($budget_id,$main_cat_id){
        $condition = "budget_id='".$budget_id."' and main_category_id='".$main_cat_id."'";
        $this->db->select('*');
        $this->db->from('assigned_budget_sub_cats');
        $this->db->where($condition);
        $this->db->order_by('id', 'ASC');
        return $this->db->get();
    }

    public function get_all_budgeting($dep_id){
        $session = $this->session->userdata('username');
        $user = $this->Xin_model->read_user_info($session['user_id']);
        $role_resources_ids = $this->Xin_model->user_role_resource();
        
        $this->db->select('*');
        $this->db->from('budgeting');
        $this->db->where('department_id',$dep_id);
        if(!(in_array('2',$role_resources_ids))) {
            $this->db->where('added_by = '.$user[0]->user_id);
        }
        return $this->db->get();
    }

    public function read_budget_data_by_id($id) {
        $condition = "id ='".$id."'";
        $this->db->select('*');
        $this->db->from('budgeting');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    public function read_budgets_by_id($budget_ids){
        $this->db->select('*');
        $this->db->from('budgeting');
        $this->db->where_in('id',$budget_ids);
        $query = $this->db->get();
        return $query->result();
    }
    public function read_budget_dept($id)
    {
        $this->db->select('*');
        $this->db->from('departments');
        $this->db->where('id',$id);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }
    public function get_all_budget_data($dep_id){
        $result =array();
        $result['budget_data'] = $this->db->select('id,budget_name,budget_name,date_from,date_to,amount')
            ->from('budgeting')
            ->where('department_id',$dep_id)
            ->where('status',1)
            ->get()->result();
        $result['budget_count'] =$this->db->select('count(id) as budget_count')
            ->from('budgeting')
            ->where('department_id',$dep_id)
            ->where('status',1)
            ->get()->result();
        if(!empty($result['budget_data'])){
            foreach($result['budget_data'] as $key=>$budget)
            {
                $result['expense_data'][$budget->id]= $this->db->select('budget_id,sum(amount) as total_expenses')
                    ->from('budget_expenses')
                    ->where('budget_id',$budget->id)
                    ->get()->result();
            }
        }
        return $result;
    }
    public function get_all_expense_data($dep_id){
        return $this->db->select('e.id,e.exp_title,e.exp_type,e.date,e.amount,bc.name as cost_center')
                    ->from('budget_expenses e')
                    ->join('budget_cost_center bc','bc.id=e.cost_center','left')
                    ->where('department_id',$dep_id)
                    ->get()->result();

    }
    public function get_user_profile($user_id)
    {
        return $this->db->select('e.user_id,e.first_name,e.last_name,e.email,e.profile_picture,e.contact_no,d.name as department')
        ->from('xin_employees e')
        ->join('departments d','d.id=e.department_id','left')
        ->where('user_id',$user_id)
        ->get()->result();


    }
    public function add_budget_subcat_employee_assign($data){
        $this->db->insert('budget_subcat_employee_assign', $data);
        if ($this->db->affected_rows() > 0) {

            return true;
        } else {
            return false;
        }
    }

}