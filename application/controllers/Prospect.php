<?php

class Prospect extends CI_Controller
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

	public function index(){
        $count_notif = $this->MUtility->getNotif_count($_SESSION['kd_user']);
        $list_notif = $this->MUtility->getNotif($_SESSION['kd_user']);

		$data = [
			"load_page" => 'main/prospect',
            "title" => 'Prospect',
			"judul" => 'Prospect',
            "count_notif" => $count_notif,
            "list_notif" => $list_notif,
		];
		
		$this->load->view('admin/overview',$data);
	}

	public function ajax_list()
    {
        $list = $this->Mpracost->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $noprospectus = '';
        foreach ($list as $pracosts) {
           
            if($noprospectus != $pracosts->noprospect){
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $pracosts->noprospect;
                $row[] = $pracosts->nm_customer; 
                $row[] = $pracosts->nm_proyek;
                $row[] = $pracosts->tgl_prospect;
                $row[] = $pracosts->tgl_pracost;
                $row[] = $pracosts->tgl_formspec;
                $row[] = $pracosts->tgl_rilis;

                $onclik = "v_detail('$pracosts->noprospect')";
                $row[] = '<a href="#" onclick="'.$onclik.'" class="btn btn-primary btn-circle btn-sm" Title="Proses Quotation"><i class="fa fa-share"></i></a>';

                $data[] = $row;
            }
            $noprospectus = $pracosts->noprospect;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mpracost->count_all(),
                        "recordsFiltered" => $this->Mpracost->count_filtered(),
                        "data" => $data,
                );
        echo json_encode($output);
    }
    public function views(){
            $nomor_prospect =$this->input->post('noprospect');
            $list = $this->Mpracost->getInfoProspectus($nomor_prospect);
            $genset  =$this->MUtility->getDataGenset();
        
            $output = array(
                'noprospect' => $list->noprospect,
                'nmcustomer' => $list->nm_customer,
                'nmproyek' => $list->nm_proyek,
                'notes' => $genset->notes,
                'terms' => $genset->terms,
                'estimasi' => $genset->estimasi,

                );
            echo json_encode($output);
        }
        public function get_HargaDasar(){
            $nomor_pracost =$this->input->post('nopracost');
            $list = $this->Mpracost->getHargaDasar($nomor_pracost);
            
            $output = array(
                'harga_dasar' => (empty($list))?0:$list->harga_dasar,
            );
            
            echo json_encode($output);
    }

	public function ajax_list_d()
    {
        $nomor_prospect =$this->input->post('noprospect');
        $list = $this->Mpracost->get_datatables_byID($nomor_prospect);
        $data = array();
        $no = $_POST['start'];

     
        foreach ($list as $pracostsD) {
      
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $pracostsD->nopracost;
                $row[] = $pracostsD->tipeprospect; 
                $row[] = $pracostsD->qtty; 
                $row[] = $pracostsD->unit; 
                // $row[] = $pracostsD->unit; 
                $row[] = $this->MUtility->rupiah($pracostsD->harga_pracost); 
                $row[] = $this->MUtility->rupiah($pracostsD->harga_awal); 
                $row[] = $this->MUtility->rupiah($pracostsD->harga_dasar); 

                $linkto = "ReCalc(this)";
                $row[] = '<input id="row-jual'.$no.'" onkeyup="'.$linkto.'" name="'.$no.'" type="text" class="form-control text-right inputdetail" placeholder="0"  aria-label="subtotal" aria-describedby="basic-addon1" style="width="20%;">
                   '; 

                // $row[] = '<input class="input_hjual" type="number" id="row-jual'.$no.'" name="row-jual'.$no.'" placeholder="0">'; 
                $row[] = $pracostsD->harga_pracost; 
                $row[] = $pracostsD->harga_awal; 
                $row[] = $pracostsD->harga_dasar; 
                $row[] = $pracostsD->tgl_prospect;
                $row[] = $pracostsD->tgl_pracost;
                $row[] = $pracostsD->tgl_formspec;
                $row[] = $pracostsD->tgl_rilis;
        
                $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mpracost->count_filtered_byID($nomor_prospect),
                        "recordsFiltered" => $this->Mpracost->count_filtered_byID($nomor_prospect),
                        "data" => $data,
                );
        echo json_encode($output);
    }

    public function simpan_data(){
        $response= false;
        $acak = uniqid();
        $topcode = '';
        $list = json_decode($this->input->post('data'), true);
        $noprospect = '';
        if (is_array($list) || is_object($list))
        {
            foreach ($list as $pracostsD) {
                  $data_detail = array(
                  'acak'=>$acak,
                  'tgl_prospect'=>$pracostsD['tglprospect'],
                  'tgl_pracost'=>$pracostsD['tglpracost'],
                  'tgl_formspec'=>$pracostsD['tglformspec'],
                  'tgl_rilis'=>$pracostsD['tglrilis'],
                  'no_pracost'=>$pracostsD['nopracost'],
                  'nm_barang'=>$pracostsD['nopracost'],
                  'qtty'=>$pracostsD['qtty'],
                  'unit'=>$pracostsD['unit'],
                  'tipeprospect'=>$pracostsD['tipeprospect'],
                  'harga_pracost'=>$pracostsD['hrg_pracost'],
                  'harga_awal'=>$pracostsD['hrg_awal'],
                  'harga_dasar'=>$pracostsD['hrg_dasar'],
                  'harga_jual'=>$pracostsD['hrg_jual'],
                );            
                $response=$this->MQuo->saverecords($data_detail);                
            } 
    
            if($response){ //insert data header

                $list_H = json_decode($this->input->post('data_h'), true);
                foreach ($list_H as $pracostsH) {
                    $topcode = $pracostsH['top_code'];
                    $noprospect = $pracostsH['noprospect'];
                    $data_header = array(
                        'acak'=>$acak,
                        'no_prospect'=>$pracostsH['noprospect'],
                        'nm_customer' => $pracostsH['customer'],
                        'kd_sales' => $_SESSION['kd_user'],
                        'proyek' => $pracostsH['proyek'],
                        'lokasi' => $pracostsH['lokasi'],
                        'up' => $pracostsH['up'],
                        'telp' => $pracostsH['telp'],
                        'emails' => $pracostsH['emails'],
                        // 'npwp' => $pracostsH['npwp'],
                        'referensi' => $pracostsH['referensi'],
                        'top_code' => $pracostsH['top_code'],
                        'spec' => $pracostsH['spec'],
                        'estimasi' => $pracostsH['estimasi'],
                        'chstatus' => 0,
                        'revisi_ke' => 0,
                        'prs_ppn' => $pracostsH['prs_ppn'],
                        'ppn' => $pracostsH['ppnum'],
                        'hargajual' =>  $pracostsH['total'],
                        'total_hargajual' =>  $pracostsH['grandtotal'],
                        'notes' => $pracostsH['notes'],
                        'terms' => $pracostsH['terms'],
                        'referensi' => $pracostsH['referensi'],
                        'exp_quotation' => $pracostsH['expired'],
                        'nama_approval' => $_SESSION['manager'],
                        'masa_garansi' =>  $pracostsH['garansi'],
                    );
                }

                $response = $this->MQuo->saverecords_H($data_header);
            }
            if($response){
                $response = $this->Mpracost->UpdateProspect($noprospect);
                // if($response){
                //     $response = $this->Mtop->generate_sch($acak,$topcode,$tgl_np);
                //     var_dump($response);die;
                // }
            }

        }
        echo $response;
      }

public function getTerms(){
    $selected  = $this->input->post('top_code');
    $list = $this->MTop->getDetailSch($selected);
    $html = '<ul>';
    $count = 0;
    foreach($list as $row){
        $count++;
        $periodik_term = $row->periodik;
        switch ($periodik_term) {
            case 'H':
                $jenis = ' Hari ';
                    break;
            case 'M':
                     $jenis = ' Minggu ';
                    break;
            case 'B':
                    $jenis = ' Bulan ';
                    break;
            default:
               
        }

        $html_input = ' <input class="injarak" name="inputjarak" type="number" id="jarak'.$count.'"  placeholder="...." aria-label="Input Jarak Hari" aria-describedby="basic-addon1">. '.$jenis.''   ;
        $html_input_2 = ' <input class="injarak" name="inputjarak" type="number" id="jarak'.$count.'A'.'"  placeholder="...." aria-label="Input Jarak Hari" aria-describedby="basic-addon1">. '.$jenis.''   ;
        $butir_term = $row->deskripsi;
        $terms = str_replace('_',$html_input,$butir_term);
        $terms = str_replace('#',$html_input_2,$terms);
     

        $html .= '<li>'.$row->prs_top.'% '.$terms.'<input type="text" id="periodik'.$count.'" value="'.$periodik_term.'" hidden><input type="text" id="topdet'.$count.'" value="'.$row->prs_top.'" hidden><input type="text" id="topcode" value="'.$row->top_cd.'" hidden><textarea id="deskripsi'.$count.'" hidden>'.$butir_term.'</textarea>';
    }
    $html = str_replace('"','',$html);

    echo $html;
}
public function setupTerms(){
    $selected  = $this->input->post('top_code');
    $list = $this->MTop->getDetailSch($selected);
    // var_dump(count($list));die;

    echo count($list);
}
    
}