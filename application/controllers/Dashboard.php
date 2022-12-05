<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('Utility_Model','MUtility');
		if(!$this->auth_model->current_user()){
			redirect('/');
		}

	}

	public function index(){		
		$count_notif = $this->MUtility->getNotif_count($_SESSION['kd_user']);
		$list_notif = $this->MUtility->getNotif($_SESSION['kd_user']);

		$data = [
			"current_user" => $this->auth_model->current_user(),
			"load_page" => 'main/dashboard',
			"title" => 'Dashboard',
			"judul" => 'Dashboard',
			"count_notif" => $count_notif,
			"list_notif" => $list_notif,
		];

		$this->load->view('admin/overview',$data);
	}

}