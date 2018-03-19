<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submit extends CI_Controller {

	function __construct(){
		parent::__construct();		
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('code', 'CTContest', 'SubmitModel'));

        if (!$this->session->userdata('logged')){
            redirect('login');
        }
	}
	public function index($contest)
	{		
		$this->load->view('submit', array('error' => ' ' ));	
	}

    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

	public function do_upload()
    {

        $codeID = Submit::generateRandomString();
        $owner = $this->session->userdata('memberID');
        $contest = $this->session->userdata('contestID');
        $team = $this->CTContest->getOne($owner, $contest);

        date_default_timezone_set("Asia/Bangkok");
        $dt = new DateTime();
        $dt = $dt->format('Y-m-d H:i:s');

        $config['upload_path']          = './codes/';                
        $config['allowed_types']        = 'cpp';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $config['file_name'] = $codeID;
		
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('submit', $error);
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());                

                $sql = array(
                    'codeID' => $codeID,
                    'owner' => $owner,                    
                    'name' => $this->input->post('botname'),
                    'time' => $dt,
                );
                $this->code->insertData($sql);

                $sql = array(
                    'contestID' => $contest,
                    'teamID' => $team['teamID'],
                    'codeID' => $codeID,
                    'time' => $dt
                );
                $this->SubmitModel->insertData($sql);
                redirect('simulation/view_result');
        }
    }

    public function view_result(){    			
        echo "this function have not finished yet. But we have save your code";
    }
}
