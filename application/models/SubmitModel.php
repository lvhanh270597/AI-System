<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 

*/
class SubmitModel extends CI_Model
{
        
        function __construct()
        {
                parent::__construct();
        }      

        public function insertData($data){            
            $this->db->insert('submit', $data);
        }
        public function checkIn($data){                                                   
            $query = $this->db->get_where('submit', $data);         
            return $query->num_rows() == 1;
        }
        public function get($id){
            $query = $this->db->get_where('submit', array('codeID' => $id));
            if ($query->num_rows() == 0) return null;
            return $query->result()[0];
        }
        public function getName($id){            
            return get($id)->name;
        }
        public function update($id, $data){            
            $this->db->where('codeID', $id);
            $this->db->update('submit', $data); 
        }
        public function getAllCode($contest, $team){            
            $this->db->order_by("time", "desc");
            $query = $this->db->get_where('submit', array('contestID' => $contest, 'teamID' => $team));
            return $query->result_array();
        }   
}   
