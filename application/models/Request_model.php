<?php

class request_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function add_request($data){
        $this->db->insert('requests', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function read_request_data_by_id($request_id)
    {
        $condition = "id ='".$request_id."'";
        $this->db->select('*');
        $this->db->from('requests');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result()[0];
    }
    public function update_request($data,$request_id){
        $condition = " id ='".$request_id."' ";
        $this->db->where($condition);
        $this->db->update('requests',$data);
        if($this->db->affected_rows() > 0 ) {

            return true;
        } else {
            return false;
        }
    }
}