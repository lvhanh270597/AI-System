<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends CI_Controller {
	
	public $static_contest;

	function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('ContestModel', 'TeamModel', 'ContestModel', 'CTContest', 'SubmitModel', 'Code', 'QueueModel', 'Result'));  
        if (!$this->session->userdata('logged')) {
        	redirect('login');
        }           
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


	public function index()
	{				
		$data['contest'] = $this->ContestModel->all();
		$this->load->view('contest_view', $data);
	}

	public function enter($contest){						
		$member = $this->session->userdata('memberID');				
		$newdata = array(
			'memberID' => $member,
			'contestID' => $contest,			
			'logged' => true,
		);		
		$this->session->set_userdata($newdata);

		$ctcontest = $this->CTContest->getOne($member, $contest);		

		$data['myTeam'] = 'none';
		$data['myTeamID'] = 'none';
		if ($ctcontest != null){
			$data['myTeamID'] = $ctcontest['teamID'];
			$static_team = $ctcontest['teamID'];
			$data['myTeam'] = $this->TeamModel->get($ctcontest['teamID'])['name'];
		}

		$data['title'] = $this->ContestModel->getName($contest);			
		$data['contestID'] = $contest;
		$teams = $this->CTContest->getAllTeamID($contest);			
		$temp = array();		
		foreach ($teams as $id) {			
			$team = $this->TeamModel->get($id['teamID']);			
			array_push($temp, $team);
		}
		$data['teams'] = $temp;
		
		if ($this->input->post('button') == 'create'){
			redirect('contest/create_team/' . $contest);
		}
		if ($this->input->post('button') == 'submit'){
			redirect('contest/submit/' . $contest);
		}		
		if ($this->input->post('button') == 'simulate'){
			redirect('contest/simulation/' . $contest);
		}	
		$this->load->view('enter_contest_view', $data);
	}

	public function create_contest()
	{
		if ($this->input->post('submit')){
			$contestID = Contest::generateRandomString();

			$data = array(
				'contestID' => $contestID,
				'name' => $this->input->post('Name'),	
				'start' => $this->input->post('start'),
				'end' => $this->input->post('end'),
			);			
			$now = new DateTime($data['start']);
			$timestring = $now->format('Y-m-d h:i:s');
			$data['start'] = $timestring;
			$now = new DateTime($data['end']);
			$timestring = $now->format('Y-m-d h:i:s');
			$data['end'] = $timestring;
			$this->ContestModel->insertData($data);							
			//$this->load->view('success_create_contest');	
			redirect('contest');
		}

		$this->load->view('create_new_contest');
	}

	public function create_team($contest){		

		// check for having any team		

		// check for the same name team

		$memberID = $this->session->userdata('memberID');
		$contestID = $this->session->userdata('contestID');
		if ($this->input->post('submit')){
			$teamID = Contest::generateRandomString(8);
			$data = array(
				'teamID' => $teamID,
				'name' => $this->input->post('Name'),
				'password' => $this->input->post('password')				
			);			
			$data_ctcontest = array(
				'contestID' => $contest,
				'teamID' => $teamID,
				'memberID' => $memberID
			);
			$this->TeamModel->insertData($data);					
			$this->CTContest->insertData($data_ctcontest);
			redirect('contest/enter/'.$contest);
		}

		$data = $this->CTContest->getOne($memberID, $contestID);
		if ($data != null){			
			$data = array();
			$data['errors'] = 'You can not create new team when you are in another team';
			//$this->load->view('error_page', $data);
			echo $data['errors'];
		}
		else{
			$this->load->view('create_new_team');
		}
	}

	public function join_team($team){
		$memberID = $this->session->userdata('memberID');
		$contestID = $this->session->userdata('contestID');
		$data = $this->CTContest->getOne($memberID, $contestID);
		if ($data != null){					
			echo "You must leave your current team before you will join this team.";
		}
		else{
			$data = array(
				'memberID' => $memberID,
				'contestID' => $contestID,
				'teamID' => $team,
			);
			$this->CTContest->insertData($data);
			redirect('contest/enter/'.$contestID);
		}
	}
	public function leave_team($team){			
		$memberID = $this->session->userdata('memberID');
		$contestID = $this->session->userdata('contestID');
		$data = $this->CTContest->getOne($memberID, $contestID);
		if ($data == null){					
			return;
		}		

		if ($this->CTContest->getAllPeople($team) == 1){						
			$this->TeamModel->del_one($team);			
		}

		$this->CTContest->del_one($team, $memberID);		
		redirect('contest/enter/'.$contestID);				
	}

	public function Simulation($contest){
        //get all of the codes which you are owner        
        $data = array(

        );

        $member = $this->session->userdata('memberID');
        if (!$this->ContestModel->checkIn(array('contestID' => $contest))){
        	return ;
        }
        
        $team = $this->CTContest->getOne($member, $contest)['teamID'];

        $sql = $this->SubmitModel->getAllCode($contest, $team);    

        $data['codes'] = array();
        foreach ($sql as $value) {
        	$code = $this->Code->get($value['codeID']);
        	array_push($data['codes'], $code);
        }

        if ($this->input->post('submit') == 'Run'){
        	$code1 = $_POST['a'];        	
        	$code2 = $_POST['b'];
        	// dua vao queue

        	date_default_timezone_set("Asia/Bangkok");
	        $dt = new DateTime();
	        $dt = $dt->format('Y-m-d H:i:s');

	        $queueID = Contest::generateRandomString();

        	$data_queue = array(
        		'queueID' => $queueID,
        		'codeID1' => $code1, 
        		'codeID2' => $code2,
        		'time' => $dt,
        	);       

        	$this->QueueModel->insertData($data_queue);       

        	$data_result = array(
        		'resultID' => $queueID,
        		'codeID1' => $code1,
        		'codeID2' => $code2,
        		'winCode' => $code1, 
        		'status' => 'pending',        		
        	); 	
        	$this->Result->insertData($data_result);
        	/*
			Goi 1 ham trong helper de lam nhiem vu chay va luu ket qua.
			Ham nay goi ham trong Queueprocess de thuc hien cac thao tac.
			Trong queueprocess, khi no lam xong, thi se ghi ket qua ra:
			contest/view_result...			
        	*/
        	redirect('contest/view_result/'.$contest.'/'.$queueID);
        }	

		$this->load->view('simulation', $data);	
	}

	public function Submit($contest)
	{		
		$this->load->view('submit', array('error' => ' ', 'contest' => $contest));	
	}
	public function do_upload($contest)
    {    	

        $codeID = Contest::generateRandomString();
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
                $this->Code->insertData($sql);

                $sql = array(
                    'contestID' => $contest,
                    'teamID' => $team['teamID'],
                    'codeID' => $codeID,
                    'time' => $dt
                );
                $this->SubmitModel->insertData($sql);                
                redirect('contest/simulation/'.$contest);
        }
    }

    public function view_result($contest, $queueID){
    	$result_item = $this->Result->get($queueID);
    	$code1_name = $this->Code->get($result_item['codeID1'])['name'];
    	$code2_name = $this->Code->get($result_item['codeID2'])['name'];
    	$status = $result_item['status'];
    	$winner = 'unknown';
    	if ($status == 'OK'){
    		$winner = $this->Code->get($result_item['winCode'])['name'];
    	}
    	$data = array(
    		'code1' => $code1_name,
    		'code2' => $code2_name,
    		'status' => $status,
    		'winner' => $winner,
    	);
		$this->load->view('view_result', $data);
    }
}
?>