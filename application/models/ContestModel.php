<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class ContestModel extends CI_Model
{        

        function __construct()
        {
                parent::__construct();
        }  

        public function getFirst(){
            $query = $this->db->get_where('contest', array());
            if ($query->num_rows() == 0) return null;
            return $query->result()[0];
        }
        public function insertData($data){            
            $this->db->insert('contest', $data);
        }
        public function checkIn($data){                                                   
            $query = $this->db->get_where('contest', $data);         
            return $query->num_rows() == 1;
        }
        public function get($id){
            $query = $this->db->get_where('contest', array('contestID' => $id));
            if ($query->num_rows() == 0) return null;
            return $query->result()[0];
        }
        
        public function all(){
            $query = $this->db->get_where('contest', array());
            return $query->result_array();            
        }
        public function getName($id){            
            return ContestModel::get($id)->name;
        }
        public function update($id, $data){            
            $this->db->where('contestID', $id);
            $this->db->update('contest', $data); 
        }
}
