<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {


    public function channel($channel)
	{
		$this->load->helper('string');
		$this->load->view('chat', ['channel' => $channel]);
	}
}
