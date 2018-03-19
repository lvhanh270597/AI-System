<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Member extends CI_Model
{
        
        function __construct()
        {
                parent::__construct();
        }      
        public function insertData($data){
        	$this->db->insert('member', $data);
        }
        public function checkIn($data){
        	if (!isset($data)) return ;
        	if (!isset($data['memberID']) || 
        		!isset($data['password'])) return;
                
			$query = $this->db->get_where('member', $data);			
            return $query->num_rows() == 1;
        }
        public function get($id){
            $query = $this->db->get_where('member', array('memberID' => $id));
            if ($query->num_rows() == 0) return null;
            return $query->result()[0];
        }
        public function getName($memberID){            
            return Member::get($memberID)->name;
        }
        public function update($id, $data){            
            $this->db->where('memberID', $id);
            $this->db->update('member', $data); 
        }
}
