<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('m','mods');
    }

	public function index()
	{
		$data['last'] =  $this->mods->get_last();
		// return print_r(json_encode($data));
		$this->load->view('joko',$data);
	}
}
