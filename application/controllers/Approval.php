<?php

class Approval extends CI_Controller
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
		$this->load->model('Utility_Model','MUtility');
		
	}

	public function index(){	
        $count_notif = $this->MUtility->getNotif_count($_SESSION['kd_user']);
        $list_notif = $this->MUtility->getNotif($_SESSION['kd_user']);

		$data = [
			"load_page" => 'main/approval',
			"title" => 'Approval',
			"judul" => 'Approval',
			"count_notif" => $count_notif,
			"list_notif" => $list_notif,
		];
		
		$this->load->view('admin/overview',$data);
	}

	public function ajax_list()
    {
        $list = $this->Mquo->get_datatables_byApproval();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $quo) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $quo->no_quotation;
            $row[] = $quo->tgl_quotation;
            $row[] = $quo->no_prospect;
            $row[] = $quo->nm_customer;
            $row[] = $quo->exp_quotation;

            $onclikA = "view_on_form('$quo->acak')"; //DETAIL
            $onclikB = "aksi(2,'$quo->acak')"; //REVISI
            $onclikC = "aksi(3,'$quo->acak')"; // APPROVE

            $btn = '<a href="#" onclick="'.$onclikB.'" class="btn btn-warning btn-circle btn-sm btnaksi" Title="Revisi"><i class="fas fa-undo"></i></a> <a href="#" onclick="'.$onclikC.'" class="btn btn-success btn-circle btn-sm btnaksi" Title="Approve"><i class="fa fa-check"></i></a> ';

            $row[] = '<a href="#" onclick="'.$onclikA.'" class="btn btn-primary btn-circle btn-sm btnaksi" Title="Preview"><i class="fa fa-eye"></i></a> '.$btn.'';
            

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

    public function aksi(){
        $acak = $this->input->post('acak');
        $parameters = $this->input->post('param');
        $type_reason = $this->input->post('reason');
        $reason = '';

        $info_quotation = $this->Mquo->getInfoQuotation($acak);
        //define variable, cegah error inserted data
        $manager = '';
        $msg = '';
        $tipe_notif = 0;
        
        if($type_reason = 'confirm'){
            $get_reason = $this->Mquo->getReasonbyID($acak);
            if(!empty($get_reason)){
                $last_komunikasi = $get_reason->komunikasi;
                $reason .= $last_komunikasi.'<br>';
                $reason .= '['.$_SESSION['nama'].'<small>'.date('d-m-Y h:i').'</small>] : '.$this->input->post('reason');
            }
            else{
                $reason .= '['.$_SESSION['nama'].'<small>'.date('d-m-Y h:i').'</small>] : '.$this->input->post('reason');
            }
            
            // status quotation
            // 0 : Create / Draft
            // 1 : Submit
            // 2 : Revisi Quotation
            // 3 : Approve Quotation
            // 4 : Finalisasi
            // 5 : Sales Order
    
            //update status approve 
            $data_update = array(
                    'chstatus' => 3,
                    'acak' => $acak,
            );

            // type notif 
            // 1.request qpproval masuk(notif untuk atasan)
            // 2.revisi 
            // 3.doc approve(notif untuk creator doc)
            if($parameters == 3){ //approve
                $manager = $this->MUtility->getHead($_SESSION['manager']);
                $msg = 'Quotation Approve';
                $kduser = $info_quotation->user_create;
                $tipe_notif = 3;
            }
    
            if(!empty($msg) || $msg != ''){
                $data_notif = array(
                    'acak'=> $acak,
                    'messages'=> $msg,
                    'type_notif'=> $tipe_notif,
                    'kd_user'=> $kduser,
                    'acak'=> $acak,
                );
                $this->MUtility->append_notif($data_notif);
            }

            $response = $this->Mquo->updateStatus($data_update);
        }
        else{
            $get_reason = $this->Mquo->getReasonbyID($acak);
            if(!empty($get_reason)){
                $last_komunikasi = $get_reason->komunikasi;
                $reason .= $last_komunikasi.'<br>';
                $reason .= '['.$_SESSION['nama'].'<small>'.date('d-m-Y h:i').'</small>] : '.$this->input->post('reason');
            }
            else{
                $reason .= '['.$_SESSION['nama'].'<small>'.date('d-m-Y h:i').'</small>] : '.$this->input->post('reason');
            }
    
            //set ulang data yang telah di merge ke variable reason.
            $data_update = array(
                    'chstatus' => $parameters,
                    'acak' => $acak,
                    'komunikasi' => $reason,
            );

            // type notif 
            // 1.request qpproval masuk(notif untuk atasan)
            // 2.info revisi(notif untuk creator doc)
            // 3.doc approve(notif untuk creator doc)

            if($parameters == 2){ //revisi
                $manager = $this->MUtility->getHead($_SESSION['manager']);
                $msg = 'Revisi Quotation';
                $acak = $acak;
                $kdspv = $info_quotation->user_create;
                $tipe_notif = 2;
            }

            if(!empty($msg) || $msg != ''){
                $data_notif = array(
                    'acak'=> $QuoH['acak'],
                    'messages'=> $msg,
                    'type_notif'=> $tipe_notif,
                    'kd_user'=> $kdspv,
                    'acak'=> $acak,
                );
                $this->MUtility->append_notif($data_notif);
            }
    
            $response = $this->Mquo->updateStatus($data_update);
        }

       
        echo $response;
    }

    public function getPreview(){
        $company_info = $this->MUtility->getDataGenset();
        $acak = $this->input->post('acak_quo');
        $quo_detail = $this->Mquo->getDetailQuotation($acak);
        $html = '';
        $imgcompany = base_url('img/TF_ICO.jpg');

        $data = array();
        $temp = array();
        $detail = array();

        //prepare data
        foreach($quo_detail as $row){

            //masukkan data header 
            if(empty($data)){
                $data = [
                    'custname' => $row->nm_customer,
                    'lokasi' => $row->lokasi,
                    'up_name' => $row->up,
                    'telp' => $row->telp,
                    'mail' => $row->emails,
                    'mail' => $row->emails,
                    'no_quotation' => $row->no_quotation,
                    'tgl_quotation' => $row->tgl_quotation,
                    'referensi' => $row->referensi,
                    'notes' => $row->notes,
                    'terms' => $row->terms,
                    'notes_product' => $row->notes_product,
                    'hargajual' => $row->hargajual,
                    'prs_ppn' => $row->prs_ppn,
                    'ppn' => $row->ppn,
                    'total_hargajual' => $row->total_hargajual,
            ];
            }

                $temp = [
                            'no_prospect' => $row->no_prospect,
                            'no_pracost' => $row->no_pracost,
                            'nm_barang' => $row->nm_barang,
                            'tipeprospect' => $row->tipeprospect,
                            'qtty' => $row->qtty,
                            'harga_pracost' => $row->harga_pracost,
                            'harga_awal' => $row->harga_awal,
                            'harga_dasar' => $row->harga_dasar,
                            'harga_jual' => $row->harga_jual,

                ];
                array_push($detail,$temp);
        }
        //end prepare data

        //set html preview
            $html = '<table width="100%">
            <tr>
                 <td><img class="icon_quo" src="'.$imgcompany.'" alt=""></td>
                 <td id="companyinfo">
                  <table>
                      <tr class="companys">
                           <td colspan="3">'.$company_info->company_name.'</td>
                      </tr>';

            //loop untuk cek data lokasi yang valuenya tidak kosong
           $var = '';
            for($i = 1;$i < 6; $i++){
                $lokasi = 'loka'.$i;
                $kolom_loka = $company_info->$lokasi;
                if($kolom_loka != ''){
                    $NLine = str_replace('#','<br>',$kolom_loka);
                    $html .= '<tr>
                                <td class="alamat">'.$NLine.'</td>
                                </tr>';
                }
                
            }
            $html .=  '</table></td></tr>';
            // var_dump($data);die;

            $html .= '<tr>
                            <td colspan="8" style="text-align:center;font-size:15px;font-weight:bold;">PENAWARAN</td>
                        </tr>
                </table>
                <table border="1" width="100%" class="prequotation">             
                    <tr>
                     <td colspan="4" width="50%" class="header" id="customerinfo">';
                        $html .= 'Kepada Yth.<br>'.
                        $data['custname'] .'<br>'.
                        $data['lokasi'].'<br>'.
                            $data['up_name'].'<br>'.
                            'Telp. '.$data['telp'].'<br>'.
                            'Email. '.$data['mail'].'<br>';                            
            $html .= '</td>
                            <td colspan="4" width="50%" class="header">
                                <table class="prequotation_a">
                                    <tr>
                                            <td>Penawaran No</td>
                                            <td> : </td>
                                            <td>'. $data['no_quotation'].'</td>
                                    </tr>
                                    <tr>
                                            <td>Tanggal</td>
                                            <td> : </td>
                                            <td>'. $data['tgl_quotation'].'</td>
                                    </tr>
                                    <tr>
                                            <td>Referensi</td>
                                            <td> : </td>
                                            <td>'. $data['referensi'].'</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="head_col">
                            <td>NO</td>
                            <td colspan="3">NAMA BARANG</td>
                            <td>JUMLAH</td>
                            <td>HARGA SATUAN</td>
                            <td>JUMLAH</td>
                        </tr>';
                        $no = 1;
                        foreach($detail as $rows)
                        echo '<pre>';
                        var_dump($rows);die;
                        echo '</pre>';
            $html .=  '<tr>
                    <td class="furut">'.$no.'</td>
                    <td colspan="3">'.$rows['nm_barang'].'</td>
                    <td class="funit">'.$rows['nm_barang'].'</td>
                    <td class="fharga">500000</td>
                    <td class="fharga">500000</td>
                </tr>';
                $no++;
            // }
                
                    
                        
        $html .= '<tr>
                            <td colspan="6" style="text-align:right;"><span style="padding-right:5px;">Sub Total. </span></td>
                            <td class="fharga">700000</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:right;"><span style="padding-right:5px;">(10 %) PPN. </span></td>
                            <td class="fharga">70000</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:right;"><span style="padding-right:5px;">Total. </span></td>
                            <td class="fharga">770000</td>
                        </tr>            
                </table>
                <table border="1" width="100%">
                <tr>
                            <td class="header">Harga Termasuk. </span></td>
                            <td colspan="6">- Loco pabrik PT Trafindo Tangerang<br>
            - Tidak termasuk jasa pemasangan & Transportasi<br>
            - Sudah termasuk sertifikat uji pabrik<br>
            - Sudah termasuk commisioning u/ jabodetabek max 1 hari<br>
            - Tidak termasuk tambahan copper link untuk terminasi.</td>
                        </tr>
                        <tr>
                            <td class="header">Syarat Ketentuan </span></td>
                            <td colspan="6">30.00 % Uang muka paling lambat 1 minggu setelah invoice diterima<br>
            70.00 % Sebelum penyerahan barang</td>

                        </tr>
                        <tr>
                            <td class="header">Waktu Pengerjaan</span></td>
                            <td colspan="4">2 bulan sejak PO, DP dan Approval Drawing diterima</td>
                            <td class="header">Batas Penawaran</td>
                            <td>1 Minggu</td>
                        </tr>
                        <tr>
                            <td class="header">Spesifikasi</span></td>
                            <td colspan="4">XHAS-213</td>
                            <td class="header">Garansi</td>
                            <td>24 Bulan</td>
                        </tr>     
                </table>';
        //End html preview

        echo $html;

    }

}