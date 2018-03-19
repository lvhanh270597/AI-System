<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acknowledgement extends CI_Controller {

	public function index()
	{		
		$out = file_get_contents( "test/inp/input.txt" ); // get the contents, and echo it out.
		echo "<pre>$out</pre>";
		$this->load->view('acknowledgement');
	}
}