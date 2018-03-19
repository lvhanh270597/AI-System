<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('member');

        if ($this->session->userdata('logged')) {
        	redirect('home');
        }
    }

	public function index()
	{						

		if ($this->input->post('submit')){
			$data = array(
				'memberID' => $this->input->post('SID'),
				'name' => $this->input->post('Name'),
				'password' => $this->input->post('password'),
			 );
			$this->member->insertData($data);
			redirect('login');
		}

		$this->load->view('signup_view');		

	}
}
?>