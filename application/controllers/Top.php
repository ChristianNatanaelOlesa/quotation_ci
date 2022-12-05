
<?php

class Top extends CI_Controller
{
	public function index()
	{
		show_404();
	}

	public function getTop()
	{
		$this->load->model('Top_model','Mtop');

		$data = $this->Mtop->getTop();
		echo json_encode($data);

	}

	public function generate_sch(){
		$topcode = $this->input->post('top_code');
		$getdetail_schedule = $this->Mtop->getDetailSch($topcode);

		echo json_encode($getdetail_schedule);

	}
}