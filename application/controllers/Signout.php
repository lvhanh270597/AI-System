<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signout extends CI_Controller {
	
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
		$this->session->sess_destroy();
        redirect('login');
	}
}
?>