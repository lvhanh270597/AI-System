<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('member');
        if (!$this->session->userdata('logged')) {
        	redirect('login');
        }
    }

	public function index()
	{							
		$id = $this->session->userdata('memberID');
		$data = $this->member->get($id);

		if ($this->input->post('submit')){			
			$name = $this->input->post('Name');
			$this->member->update($data->memberID, array('name' => $name));			
			redirect("http://localhost/robotics/index.php/profile");
		}		
		$this->load->view('profile_view', $data);
	}
}
?>