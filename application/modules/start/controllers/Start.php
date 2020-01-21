<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends MY_Controller {

	public function index()
	{
		$this->blade->render('start');
	}

	public function login()
	{
		$user   = $this->input->post('username');
		$pass   = $this->input->post('password');

		if($user=='admin' && $pass=='admin'){
			redirect('admin');
		}
		else if($user=='user' && $pass=='user'){
			redirect('user');
		}	
		else{
			redirect('start');
		}
	}
}