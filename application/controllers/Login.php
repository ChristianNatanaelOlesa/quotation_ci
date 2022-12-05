<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        // $this->load->model('login','mods');
    }

	public function index()
	{
		// $this->load->view('joko');

		$this->load->model('auth_model','MAuth');
	
		$this->load->library('form_validation');
		

		$rules = $this->MAuth->rules();
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == FALSE){
			if(count($_SESSION) > 2){
				redirect('dashboard');
			}
			else{

				return $this->load->view('login_form');
			}
		}

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if($this->MAuth->login($username, $password)){
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan passwrod benar!');
		}

		$this->load->view('login_form');
	}

	
	
}
