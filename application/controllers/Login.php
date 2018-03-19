<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
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
				'memberID' => $this->input->post('username'),
				'password' => $this->input->post('password'),
			);
			if ($this->member->checkIn($data)){
				echo "Login success";
				$newdata = array(
					'memberID' => $data['memberID'],					
					'contestID' => null,					
					'logged' => true,
				);
				$this->session->sess_expiration = '300';
				$this->session->set_userdata($newdata);
				redirect('home');
			}			
		}

		$this->load->view('login_view');		

	}
}
?>