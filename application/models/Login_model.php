<?php
	
	class login_model extends CI_Model
	{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

	// Read data using username and password
	public function login($data) {
	
		$username = $this->db->escape($data['username']);
	    $sec_pass = $this->db->escape($data['sec_pass']);
		$condition = "(username =".$username." OR email=".$username.") AND sec_pass = ".$sec_pass." and is_active='1' and deleted=0";
		$this->db->select('*');
		$this->db->from('xin_employees');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		$return_val = $query->result();
       
		foreach($return_val as $return_vals){
          $user_id = $return_vals->user_id;
		}
		
		if(isset($user_id))
		{
		   $_SESSION['user_id'] = $user_id;
		}
	
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	

	// Read data from database to show data in admin page
	public function read_user_information($username) {
		$condition = "username =" . "'" . $username . "'";
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
	
	// Read data from database to show data in admin page
	public function read_user_information_login($username,$sec_pass) {
		$condition = "(username ='".$username."' OR email='".$username."') AND sec_pass = '".$sec_pass."' and deleted=0";
		$this->db->select('xin_employees.user_id,xin_employees.first_name,xin_employees.last_name,xin_employees.username,xin_employees.contact_no,xin_employees.department_id,,xin_employees.profile_picture,xin_employees.email,departments.name');
		$this->db->from('xin_employees');
        $this->db->join('departments','departments.id=xin_employees.department_id');
       $this->db->join('xin_designations','xin_designations.designation_id=xin_employees.designation_id','left');
        $this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();

		} else {
			return false;
		}
	}

}
?>