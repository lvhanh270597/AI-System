<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class CTContest extends CI_Model
{
        
        function __construct()
        {
                parent::__construct();
        }      

        public function insertData($data){            
        	$this->db->insert('CTContest', $data);
        }
        public function checkIn($data){        	                
			$query = $this->db->get_where('CTContest', $data);			
            return $query->num_rows() == 1;
        }                     
        public function getAllTeamID($id){
            $this->db->distinct();
            $this->db->select('teamID');
            $this->db->where('contestID', $id);            
            $query = $this->db->get('CTContest');                    
            return $query->result_array();
        }   
        public function getContest($id){
            $query = $this->db->get_where('CTContest', array('teamID' => $id));
            return $query->result_array()[0];
        }
        public function getOne($memberID, $contestID)
        {
            $query = $this->db->get_where('CTContest', array('contestID' => $contestID, 'memberID' => $memberID));
            if ($query->num_rows() != 1) return null;
            return $query->result_array()[0];
        }
        public function getAllPeople($id){
            $query = $this->db->get_where('CTContest', array('teamID' => $id));
            return $query->result_array();
        }
        public function del_one($id, $member)
        {
            $this->db->delete('CTContest', array('teamID' => $id, 'memberID' => $member));
        }
}
