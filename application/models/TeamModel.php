<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class TeamModel extends CI_Model
{
        
        function __construct()
        {
                parent::__construct();
        }            

        public function insertData($data){
        	$this->db->insert('team', $data);
        }
        public function checkIn($data){
        	if (!isset($data)) return ;
        	if (!isset($data['teamID']) || 
        		!isset($data['password'])) return;
                
			$query = $this->db->get_where('team', $data);			
            return $query->num_rows() == 1;
        }
        public function get($id){
            $query = $this->db->get_where('team', array('teamID' => $id));
            if ($query->num_rows() == 0) return null;
            return $query->result_array()[0];
        }        
        public function update($id, $data){            
            $this->db->where('teamID', $id);
            $this->db->update('team', $data); 
        }
        public function del_one($id)
        {
            $this->db->delete('team', array('teamID' => $id));
        }
}
