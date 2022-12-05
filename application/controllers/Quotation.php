<?php

class Quotation extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('/');
		}

		$this->load->model('Quotation_Model','Mquo');
		$this->load->model('Top_Model','MTop');
		$this->load->model('Utility_Model','MUtility');
	}

	public function index(){		
        $count_notif = $this->MUtility->getNotif_count($_SESSION['kd_user']);
		$list_notif = $this->MUtility->getNotif($_SESSION['kd_user']);
		$data = [
            "load_page" => 'main/quotation',
            "title" => 'Quotation',
			"judul" => 'Quotation',
            "count_notif" => $count_notif,
            "list_notif" => $list_notif,
		];

		$this->load->view('admin/overview',$data);
	}
	public function collect(){		
        $acak_quotation =$this->input->post('acak_quotation');
        $list = $this->Mquo->getInfoQuotation($acak_quotation);
       
        $output = array("datalist" => $list);
        echo json_encode($output);
	}

	public function ajax_list()
    {
        $list = $this->Mquo->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $onclik = '';
        $info_status = '';
        foreach ($list as $quo) {
            $no++;
            $row = array();
            $row[] = $no;
             $quotation = "'$quo->no_quotation'";
             switch ($quo->chstatus) {
                case 0:
                    $linkto = "aksi(1,'$quo->acak')"; //submit
                        $action = '<a href="#" onclick="'.$linkto.'" class="btn btn-primary btn-circle btn-sm" Title="Submit"><i class="fas fa-check" ></i></a>';
                        $info_status = '<span class="badge badge-primary infostatus" title="Silahkan submit untuk Approval Manager Sales">Draft<span>';
                        break;
                case 1:
                        $linkto = ""; 
                        $action = '';
                        $info_status = '<span class="badge badge-primary infostatus" title="Menunggu Approval Manager Sales">Submit</span>';
                        break;
                case 2:
                        $linkto = ""; 
                        $linkto = "aksi(1,'$quo->acak')"; //submit
                        $action = '<a href="#" onclick="'.$linkto.'" class="btn btn-primary btn-circle btn-sm" Title="Submit"><i class="fas fa-check" ></i></a>';
                        $info_status = '<span class="badge badge-warning infostatus" title="Manager Sales meminta untuk di Revisi">Revisi</span>';
                        break;
                case 3:
                        $linkto = "aksi(41,'$quo->acak')"; //finalisasi - inject mst barang mst cust
                        $action = '<a href="#" onclick="'.$linkto.'" class="btn btn-success btn-circle btn-sm"><i class="fas fa-check-square" Title="Finalisasi"></i></a>';
                        $info_status = '<span class="badge badge-success infostatus" title="Quotation telah di Approve oleh atasan">Disetujui</span>';
                        break;
                case 4:
                        $linkto = "aksi(5,'$quo->acak')"; //sales order - inject transaction so on erasoft
                        $linkto_2 = "aksi(6,'$quo->acak')"; //rollback, back status sebelum finalisasi
                        $action = '<a href="#" onclick="'.$linkto.'" class="btn btn-warning btn-circle btn-sm" Title="Sales Order"><i class="fas fa-clipboard-list"></i></a> <a href="#" onclick="'.$linkto_2.'" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-undo" Title="Rollback"></i></a>';
                        $info_status = '<span class="badge badge-success infostatus" title="Segera lakukan Sales Order">Siap SO</span>';
                        break;
                default:
                   
                }
            
            $row[] = $info_status;
            $row[] = $quo->nm_customer;
            $row[] = $quo->no_quotation;
            $row[] = $quo->tgl_quotation;
            $row[] = $quo->no_prospect;
            $row[] = $quo->exp_quotation;
            
           
            // $onclik = "v_detail('$quo->acak')";
            $onclik = "v_detail('$quo->acak',1)";

            $row[] = '<a href="#" onclick="'.$onclik.'" class="btn btn-primary btn-circle btn-sm" Title="Preview"><i class="fa fa-eye"></i></a> '.$action.'';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mquo->count_all(),
                        "recordsFiltered" => $this->Mquo->count_filtered(),
                        "data" => $data,
                );
        echo json_encode($output);
    }

    public function ajax_list_d()
    {
        $acak_quotation =$this->input->post('acak_quo');
        $catagory =$this->input->post('catagory');
        $list = $this->Mquo->get_datatables_byID($acak_quotation);
     
        $data = array();
        $no = $_POST['start'];
        $total = 0;
        $linkto = '';
        foreach ($list as $quoD) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $quoD->no_pracost;
                if($catagory==1){
                    $row[] = $quoD->nm_barang;
                }else{
                    if($catagory==3){
                        $row[] = '<input id="esoft_barang'.$no.'" onclick="showgrid(2,'.$no.')" name="'.$no.'" type="text" class="form-control text-left border border-success text-success" placeholder="Click, Nama Barang dari Erasoft" aria-label="Nama Barang dari Master Erasoft" aria-describedby="basic-addon1" Title="Click untuk mencari Nama Item dari Erasoft" readonly>
                        <input id="barang'.$no.'"  name="brg'.$no.'" value="'.$quoD->nm_barang.'" type="text" class="form-control text-left" hidden>
                        <input id="esoft_kdbarang'.$no.'"  name="kd'.$no.'" type="text" class="form-control text-left" hidden>
                        <input id="esoft_jenis'.$no.'"  name="jns'.$no.'" type="text" class="form-control text-left" hidden>
                        '; 
                    }
                    else{
                        $row[] = '<input id="barang'.$no.'" name="'.$no.'" type="text" class="form-control text-left" placeholder="Nama Barang" value="'.$quoD->nm_barang.'" aria-label="Nama Barang" aria-describedby="basic-addon1" >
                        ';
                    }
                }
                $row[] = $quoD->tipeprospect; 
                $row[] = $quoD->qtty.$quoD->unit; 
                $row[] = $this->MUtility->rupiah($quoD->harga_pracost); 
                $row[] = $this->MUtility->rupiah($quoD->harga_awal); 
                $row[] = $this->MUtility->rupiah($quoD->harga_dasar); 
                $h_jual = $quoD->harga_jual+0;
                $linkto = "ReCalc(this)";

                if($catagory==1 || $catagory==3){
                    $row[] = '<input id="row-jual'.$no.'" onkeyup="'.$linkto.'" name="'.$no.'" type="text" class="form-control text-right" placeholder="0" value="'.$quoD->harga_jual.'" aria-label="subtotal" aria-describedby="basic-addon1" style="width="80px;" readonly>
                   '; 
                }else{
                    $row[] = '<input id="row-jual'.$no.'" onkeyup="'.$linkto.'" name="'.$no.'" type="text" class="form-control text-right" placeholder="0" value="'.$h_jual.'" aria-label="subtotal" aria-describedby="basic-addon1" style="width="80px;">
                   '; 
                }
                $row[] = $quoD->harga_pracost; 
                $row[] = $quoD->harga_awal; 
                $row[] = $quoD->harga_dasar; 
                $row[] = $quoD->tgl_prospect;
                $row[] = $quoD->tgl_pracost;
                $row[] = $quoD->tgl_formspec;
                $row[] = $quoD->tgl_rilis;
                $row[] = $quoD->acak;
                $row[] = $quoD->harga_jual;
        
                $data[] = $row;
                $total += $quoD->harga_jual;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mquo->count_filtered_byID($acak_quotation),
                        "recordsFiltered" => $this->Mquo->count_filtered_byID($acak_quotation),
                        "data" => $data,
                        "total" => $total,
                );
        echo json_encode($output);
    }

    public function views(){
        $acak_quotation =$this->input->post('acak_quo');
        $list = $this->Mquo->getInfoQuotation($acak_quotation);

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

    public function getRevisiInfo($param){
        $data = $this->Mquo->get_Revisi($param);
        return $data;
    }

    public function simpan_data(){
        $response= false;
        $list = json_decode($this->input->post('data'), true); //getdatadetail
        // var_dump($list);die;
        if (is_array($list) || is_object($list))
        {
                foreach ($list as $Quodata) {
                  $data_detail = array(
                                        'acak'=>$Quodata['acak'],
                                        'no_pracost'=>$Quodata['nopracost'],
                                        'nm_barang'=>$Quodata['new_nmbarang'],
                                        'harga_jual'=>$Quodata['new_hrg_jual'],
                                        'kode_barang_final'=>$Quodata['final_kdbarang'],
                                        'nmbarang_final'=>$Quodata['final_nmbarang'],
                                        'jenis'=>$Quodata['final_jenis'],
                                        );            
                $response   = $this->Mquo->updaterecords($data_detail);                
            } 
          
            if($response){ //insert data header

                $list_H = json_decode($this->input->post('data_h'), true);
                // $revKe = $this->getRevisiInfo($QuoH['acak'])+1;
                // var_dump($list_H);die;

                foreach ($list_H as $QuoH) {
                    $data_header = array(
                        'acak'=> $QuoH['acak'],
                        'user_create'=> $_SESSION['kd_user'],
                        'nm_customer' => $QuoH['customer'],
                        'proyek' => $QuoH['proyek'],
                        'lokasi' => $QuoH['lokasi'],
                        'up' => $QuoH['up'],
                        'telp' => $QuoH['telp'],
                        'emails' => $QuoH['emails'],
                        'referensi' => $QuoH['referensi'],
                        'spec' => $QuoH['spec'],
                        'top_code' =>  $QuoH['top_cd'],
                        'estimasi' => $QuoH['estimasi'],
                        'prs_ppn' => $QuoH['prs_ppn'],
                        'ppn' => $QuoH['ppnum'],
                        'hargajual' =>  $QuoH['total'],
                        'total_hargajual' =>  $QuoH['grandtotal'],
                        'notes' => $QuoH['notes'],
                        'notes_product' => $QuoH['note_product'],
                        'terms' => $QuoH['terms'],
                        'referensi' => $QuoH['referensi'],
                        'exp_quotation' => $QuoH['expired'],
                        'nama_approval' => $_SESSION['manager'],
                        'masa_garansi' =>  $QuoH['garansi'],
                        // area final adding data customer final
                        'kdcust_final' =>  $QuoH['kdcust_final'],
                        'nmcust_final' =>  $QuoH['nmcust_final'],
                        'alamat_final' =>  $QuoH['alamat_final'],
                        'tlpcust_final' =>  $QuoH['tlpcust_final'],
                        'up_final' =>  $QuoH['up_final'],
                        'npwp_final' =>  $QuoH['npwp_final'],
                    );
                }

                $response = $this->Mquo->updaterecords_H($data_header);
            }
        }
        echo $response;
      }

    public function aksi(){
        $acak = $this->input->post('acak');
        $parameters = $this->input->post('param');

        //define variable, cegah error inserted data
        $manager = '';
        $msg = '';
        $kdspv = '';
        $tipe_notif = 0;

        if($parameters == 1){ //submit
            $manager = $this->MUtility->getHead($_SESSION['manager']);
            $msg = 'Request Approval';
            $kdspv = (int)$manager->kd_user;
            $tipe_notif = 1;
        }

        if($parameters == 6){ //jika ditemukan aksi rollback
            $parameters = 3; //kembali ke status sebelum finalisasi
        }

        $data_update = array(
                'chstatus' => $parameters,
                'acak' => $acak,
        );

        // type notif 
        // 1.request qpproval masuk(notif untuk atasan)
        // 2.doc approve(notif untuk creator doc)

        if(!empty($msg) || $msg != ''){
            $data_notif = array(
                'acak'=> $acak,
                'messages'=> $msg,
                'type_notif'=> $tipe_notif,
                'kd_user'=> $kdspv,
            );
            $this->MUtility->append_notif($data_notif);
        }

        $response = $this->Mquo->updateStatus($data_update);

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
    public function getKomunikasi(){
        $acak  = $this->input->post('acak');
        $list = $this->Mquo->getReasonbyID($acak);
        echo json_encode($list);
    }


}