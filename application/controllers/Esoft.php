
<?php

class Esoft extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');

        $this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('/');
		}
		$this->load->model('Esoft_model','Mesoft');
		
	}

	public function index()
	{
		show_404();
	}

	public function getCust()
	{
		$cari = $this->input->post('kdcust');

		$ci = &get_instance();
  		$db = $ci->load->database('db2',true);
		// var_dump($db->username);die;
	
		$query = $db->select('*')->limit(10)->get_where('ARF01',"NAMA like '%$cari%'"); 
		$list = $query->result_array();
		
		
		     $no = $_POST['start'];

		$data = array();
		foreach ($list as $rows) {
			// var_dump($rows);die;
				$no++;
				$row = array();
				// $row[] = $no;
				$row[] = $rows['CUST'];
				$row[] = $rows['NAMA'];
				$row[] = $rows['AL'];
				$row[] = $rows['PERSO'];
				$row[] = $rows['NPWP'];
				$row[] = $rows['TLP'];
				$row[] = $rows['VLT'];

				$Ncode = str_replace('.','_', $rows['CUST']);
				$kode = "'".$Ncode."'";
				$row[] = '<a href="#" onclick="choosecustesoft('.$kode.')"  class="btn btn-warning btn-circle btn-sm btnaksi" Title="Pilih"><i class="fas fa-check"></i></a> ';
				$data[] = $row;
			
		}

	
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => 1,
                        "recordsFiltered" => 1,
                        "data" => $data,
                );
        echo json_encode($output);
	}
	public function getItem()
	{
		$cari = $this->input->post('items');

		$ci = &get_instance();
  		$db = $ci->load->database('db3',true);
	
		$query = $db->select('*')->limit(10)->get_where('STF02',"TYPE = 3 AND BRG like '%$cari%' OR NAMA like '$cari%' OR NAMA2 like '$cari%' OR NAMA3 like '$cari%'"); 
		$list = $query->result_array();
		// var_dump($list);die;
		
		     $no = $_POST['start'];

		$data = array();
		foreach ($list as $rows) {
			// var_dump($rows);die;
				$no++;
				$row = array();
				// $row[] = $no;
				$row[] = $rows['BRG'];
				$row[] = $rows['NAMA'];
				$row[] = $rows['NAMA2'];
				$row[] = $rows['NAMA3'];
				$row[] = $rows['ISI'];
				$row[] = strtoupper($rows['STN2']);
				$row[] = $rows['KLINK'];

				$Ncode = str_replace('.','_', $rows['BRG']);
				$kode = "'".$Ncode."'";
				$row[] = '<a href="#" onclick="chooseitemesoft('.$kode.')"  class="btn btn-warning btn-circle btn-sm btnaksi" Title="Pilih"><i class="fas fa-check"></i></a> ';
				$data[] = $row;
			
		}

	
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => 1,
                        "recordsFiltered" => 1,
                        "data" => $data,
                );
        echo json_encode($output);
	}
	public function getInfocust(){
		$ci = &get_instance();
  		$db = $ci->load->database('db2',true);

		$param = str_replace('_','.', $this->input->post('kdcust'));

		  $query = $db->select('*')->limit(10)->get_where('ARF01',array('CUST' => $param)); 
		  $data = $query->row();
		 echo json_encode($data);
	}
	public function getInfoItem(){
		$ci = &get_instance();
  		$db = $ci->load->database('db3',true);

		$param = str_replace('_','.', $this->input->post('items'));

		  $query = $db->select('*')->limit(10)->get_where('STF02',array('BRG' => $param)); 
		  $data = $query->row();
		 echo json_encode($data);
	}
}