<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('TeamModel');
        $this->load->model('CTContest');
    }

	public function index($team)
	{
		
	}

	public function info($team)
	{
		$getTeam = $this->TeamModel->get($team);
		$data['info'] = $getTeam;
		$data['members'] = $this->CTContest->getAllPeople($team);
		$this->load->view('team_view', $data);
	}
}
?>