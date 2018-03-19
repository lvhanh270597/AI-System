<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Code extends CI_Model
{        

        public function insertData($data){            
            $this->db->insert('code', $data);
        }
        public function checkIn($data){                                                   
            $query = $this->db->get_where('code', $data);         
            return $query->num_rows() == 1;
        }
        public function get($id){
            $query = $this->db->get_where('code', array('codeID' => $id));
            if ($query->num_rows() == 0) return null;
            return $query->result_array()[0];
        }        
        public function update($id, $data){            
            $this->db->where('teamID', $id);
            $this->db->update('team', $data); 
        }
}
