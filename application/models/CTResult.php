<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class CTResult extends CI_Model
{
        
        function __construct()
        {
                parent::__construct();
        }      

        public function insertData($data){            
        	$this->db->insert('CTResult', $data);
        }
        public function checkIn($data){        	
			$query = $this->db->get_where('CTResult', $data);			
            return $query->num_rows() == 1;
        }        
}
