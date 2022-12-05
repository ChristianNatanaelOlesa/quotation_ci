
<?php

class Utility extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');

        $this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('/');
		}

		$this->load->model('Pracost_Model','Mpracost');
		$this->load->model('Quotation_Model','MQuo');
		$this->load->model('Top_Model','Mtop');
		$this->load->model('Utility_Model','MUtility');
		
	}
    
	public function index()
	{
		show_404();
	}

    public function dataready(){
        $counting  = $this->Mpracost->getSummarydata();
        $summary  = $this->MQuo->getSummaryQuoMonthly();
    
        $data_info = array(
                'count_prospect' => $counting,
                'sum_quotation' => $summary,
    
        );
    
    echo json_encode($data_info);
    }
}