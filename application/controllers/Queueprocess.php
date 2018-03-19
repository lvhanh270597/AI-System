<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Queueprocess extends CI_Controller {
	
	function __construct() {
		parent::__construct();
        $this->load->model(array('QueueModel', 'Result'));
    }

	public function run()
	{							
				
		$item = $this->QueueModel->getFirst();
		if ($item == null) {
			echo "Queue is empty";
			return ;
		}		

		$queueID = $item['queueID'];
		$this->Result->update($queueID, array('status' => 'running'));

		$current_dir = getcwd();				
		chdir($current_dir.'/test');
		
		$winner = shell_exec('./run.sh '.$current_dir.'/codes/'.$item['codeID1'].'.cpp '.$current_dir.'/codes/'.$item['codeID2'].'.cpp 2>&1');

		if ($winner == 1) $winner = $item['codeID2'];
		else $winner = $item['codeID1'];		

		$this->Result->update($queueID, array('status' => 'OK'));
		// xac dinh winCode, ghi vao result		
		$data = array(
			'resultID' => $queueID,
			'codeID1' => $item['codeID1'],
			'codeID2' => $item['codeID2'],
			'winCode' => $winner,
 		);		
		$this->QueueModel->delete($item);
	}
}
?>