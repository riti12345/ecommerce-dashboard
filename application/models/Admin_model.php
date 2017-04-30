<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login($data) {
        if(!$data['email'] && !$data['password']) return FALSE;
        $sql = "SELECT id, username, mobile, designation, permissions FROM os_team WHERE email = ? AND password = ?";
        $query = $this->db->query($sql, $data);
        $result = $query->row_array();
        $result['status'] = ($query->num_rows() > 0) ? TRUE : FALSE;
        
        return $result;
    }
    
    public function contact_form($data) {
        $query = $this->db->insert('os_contact_form', $data);
        $result = $query ? TRUE : FALSE;
        
        return $result;
    }
}