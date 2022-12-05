
<?php

class Auth extends CI_Controller
{
	public function index()
	{
		show_404();
	}

	public function logout()
	{
		$this->load->model('auth_model');
		$this->auth_model->logout();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		  }
			redirect('/','refresh');


		// unset($_SESSION['current_user']);// $val1 is the key  of the element
        // redirect('/');
	}
}