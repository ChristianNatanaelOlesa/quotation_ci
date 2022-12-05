<?php

class Overview extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('/');
		}
	}

	public function index()
	{
        // load view admin/overview.php
        
        $this->load->view("admin/overview");

	}
}