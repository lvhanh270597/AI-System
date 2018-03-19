<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class QueueModel extends CI_Model
{        

        public function insertData($data){            
            $this->db->insert('queue', $data);
        }
        public function checkIn($data){                                                   
            $query = $this->db->get_where('queue', $data);         
            return $query->num_rows() == 1;
        }
        public function get($id){
            $query = $this->db->get_where('queue', array('queueID' => $id));
            if ($query->num_rows() == 0) return null;
            return $query->result_array()[0];
        }
        public function getFirst(){            
            $this->db->order_by("time", "asc");
            $query = $this->db->get_where('queue', array());
            if ($query->num_rows() == 0) return null;
            return $query->result_array()[0];
        }   
        public function update($id, $data){            
            $this->db->where('queueID', $id);
            $this->db->update('queue', $data); 
        }

        public function delete($item)
        {
            $this->db->delete('queue', $item);            
        }
}
