<?php
    
class Users_model extends CI_Model {

    public $table = 'users';

    public function __construct() {
        parent::__construct();
    }
    
    public function find_by_token($token){
        $this->db->where('token',$token);
        $result =  $this->db->get($this->table)->result_array();
        if($result){
            return $result[0];
        }
        return $result;
    }
    

}
