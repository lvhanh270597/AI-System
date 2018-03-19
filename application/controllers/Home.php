<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

	public function index()
	{				
		
		if ($this->input->post('acknowledgement')){			
			redirect('acknowledgement');
			return;
		}
		if ($this->input->post('scoreboard')){
			redirect('scoreboard');
			return;
		}
		if ($this->input->post('simulation')){
			redirect('simulation');
			return;
		}

		$this->load->view('welcome_message');		

	}
}
