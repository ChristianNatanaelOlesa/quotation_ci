<style>
     .choosing{
          border-color: coral 1px;
     }
</style>
          <div class="card-body">
                    <div class="table-responsive">
                         <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">  
                              <thead>
                                   <tr>
                                   <th>No</th>
                                        <th>Status</th>
                                        <th>Customer</th>
                                        <th>No. Quotation</th>
                                        <th>Tgl Quotation</th>
                                        <th>Prospect</th>
                                        <th>Expired</th>
                                        <th>Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   </tbody>
                                   
                                   <tfoot>
                                        <tr>
                                        <th>No</th>
                                        <th>Status</th>
                                        <th>Customer</th>
                                        <th>No. Quotation</th>
                                        <th>Tgl Quotation</th>
                                        <th>Prospect</th>
                                        <th>Expired</th>
                                        <th>Aksi</th>
                                   </tr>
                              </tfoot>
                         </table>

                    </div>
          </div>

<script src="<?php echo base_url('vendor/jquery/jquery.min.js')?>"></script>
<script>var base_url = '<?php echo base_url() ?>';</script>
<script type="text/javascript" src="<?php echo base_url('js_script/trans/quotation.js?v=1')?>"></script>



<!-- Start Form Modal Edit Quotation -->
<div class="modal fade bd-example-modal-xl" id="DescModal" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
               
               <h5 id="ico_com"><i class="text-primary fas fa-envelope" onclick="openmsg();" title="Komunikasi" ></i></h5>
       
                    <div class="col-lg-12 text-right">
                         <div class="btn btn-success mr-3" onclick="simpandata();" id="tombolquo" Title="Update Quotation">Update</div>
                         <div class="btn btn-info mr-3 d-none" onclick="aksi(4,'');" id="tombolfinal" Title="Finalisasi Quotation">Finalisasi</div>
                         
                         <div class="btn btn-success mr-3" onclick="editdata(2);" id="tomboledit" Title="Edit Quotation">  <i class="fas fa-pen" ></i> Edit</div>
                         <!-- <div class="btn btn-info pull-right mr-3" onclick="view_on_form();" id="tombolview" Title="Preview Quotation">Preview Form</div> -->
                         <button type="button" id="canceled" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
            </div>
            <div class="modal-body">
               <div class="row d-flex" id="infoquo_v1">
              
                    <div class="col-lg-6">
                   
                         <div class="input-group col-lg-12">
                              <input id="acak" name="acak" type="text" class="form-control col-lg-8" placeholder="acak" aria-label="acak" aria-describedby="basic-addon1" hidden>
                              
                              <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1">Quotation</span>
                              </div>
                              <input id="noquotation" name="noquotation" type="text" class="form-control col-lg-8" placeholder="noquotation" aria-label="noquotation" aria-describedby="basic-addon1" readonly>
                              <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1">Tgl Quotation</span>
                              </div>
                              <input id="tglquotxt" name="tglquotxt" type="text" class="form-control col-lg-4" placeholder="TglQuotation" aria-label="TglQuotation" aria-describedby="basic-addon1" readonly>
                              <input id="revke" name="revke" type="text" class="form-control col-lg-2 d-none" placeholder="Revisi 1" aria-label="TglQuotation" aria-describedby="basic-addon1" readonly>
                         </div>
                         <div class="input-group col-lg-12  mt-2">
                              <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1">Prospect </span>
                              </div>
                              <input id="noprospect" name="noprospect" type="text" class="form-control col-lg-4" placeholder="Prospect" aria-label="Prospect" aria-describedby="basic-addon1">
                              <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1">Proyek </span>
                              </div>
                              <input id="proyektxt" name="proyektxt" type="text" class="form-control col-lg-8" placeholder="Proyek" aria-label="Proyek" aria-describedby="basic-addon1">
                         </div>
                         <div class="input-group col-lg-12  mt-2">
                              <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1">Customer</span>
                              </div>
                              <input id="nmcusttxt" name="nmcusttxt" type="text" class="form-control" placeholder="Customer Name" aria-label="customername" aria-describedby="basic-addon1">
                         </div>
                         <div class="input-group col-lg-12 mt-2 mb-2">
                            
                         <input id="lokasitxt" name="lokasitxt" type="text" class="form-control col-lg-7 " placeholder="Lokasi" aria-label="Lokasi" aria-describedby="basic-addon1">
                              
                              <input id="UPtxt" name="UPtxt" type="text" class="form-control col-lg-5" placeholder="Up" aria-label="Up" aria-describedby="basic-addon1">
                         </div>
                         <div class="input-group col-lg-12 mt-2 mb-2">
                             
                              <input id="telpnum" name="telpnum" type="number" class="form-control col-lg-6" placeholder="Telp" aria-label="Telp" aria-describedby="basic-addon1">
                              <input id="emailtxt" name="emailtxt" type="email" class="form-control col-lg-6" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                         </div>
                         
                        
                    </div>
                    
                    <div class="col-lg-6">
                         <div class="input-group  col-lg-12 mb-2">
                              <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1">Term Of Payment</span>
                              </div>
                             
                              <select onchange="popupterm(this)" style="font-size:12px;" class="custom-select" id="topdown">
                              </select>
                         </div>
                         <div class="input-group col-lg-12 mb-2">
                              <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1">Referensi</span>
                              </div>
                              <input id="reftxt" name="reftxt" type="text" class="form-control" placeholder="....." aria-label="Username" aria-describedby="basic-addon1">
                         </div>
                         <div class="input-group col-lg-12 ">
                         <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1">Waktu Pembuatan</span>
                              </div>
                              <input id="estimasitxt" name="estimasitxt" type="text" class="form-control" placeholder="..." aria-label="estimasi" aria-describedby="basic-addon1">
                         </div>
                         <div class="input-group col-lg-12  mt-2">
                              <!-- <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">PO Masuk</span>
                                   </div>
                                   <input id="poquot" name="poquot" type="date" data-date-format='yy-mm-dd' class="form-control" placeholder="PO" aria-label="PO" aria-describedby="basic-addon1"> -->
                              <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Batas Waktu Penawaran</span>
                                   </div>
                                   <input id="expquot" name="expquot" type="date" data-date-format='yy-mm-dd' class="form-control" placeholder="Exp" aria-label="Exp" aria-describedby="basic-addon1">
                         </div>
                         <div class="input-group  col-lg-12 mt-2 mb-2">
                                   <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Spesifikasi</span>
                                   </div>
                                   <input id="spektxt" name="spektxt" type="text" class="form-control col-lg-8" placeholder="...." aria-label="Spesifikasi" aria-describedby="basic-addon1">
                                   <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Garansi</span>
                                   </div>
                                   <input id="garansitxt" name="garansitxt" type="text" class="form-control col-lg-4" placeholder="0" aria-label="Garansi" aria-describedby="basic-addon1">
                                   <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Bulan</span>
                                   </div>
                         </div>
                        
                    </div>
               </div>
               <div class="row col-lg-12 d-none ml-1" id="infoquo_v2">
                    <div class="row col-lg-6">

                         <p id="quodetails"></p>
                    </div>
                    <div class="row col-lg-6"  id="realinfo">

                    </div>
               </div>
               

               <div class="col-lg-12">

                 
            <table id="table_d" class="table table-striped table-bordered" width="100%" cellspacing="0">  
                              <thead>
                                   <tr>
                                        <th>No</th>
                                        <th>Pracost</th>
                                        <th>Nama Barang</th>
                                        <th>Tipe</th>
                                        <th>Jumlah</th>
                                        <th>Harga Pracost</th>
                                        <th>Harga Awal</th>
                                        <th>Harga Dasar</th>
                                        <th width="25%" id="hajual">Harga Jual</th>
                                   </tr>
                              </thead>
                              <tbody>
                              </tbody>
                              <tfoot>
                                   <tr>
                                   <th colspan="6" rowspan="3"><textarea id="notes_produktxt" name="notes_produktxt" class="form-control" aria-label="With textarea" Placeholder="Catatan Tambahan Informasi Barang"></textarea></th>
                                   <th colspan="2" style="text-align:right;">Sub Total</th>
                                   <th><input id="subtotalnum" name="subtotalnum" type="text" class="form-control" placeholder="0" aria-label="subtotal" aria-describedby="basic-addon1"></th>
                                   </tr>
                                   <tr>
                                   
                                   <th colspan="2" style="text-align:right;"> PPN </th>
                                   <?php $linkto = "ReCalc(this)"; ?>
                                   <th class="d-flex"><input id="prsppn" name="prsppn" onkeyup="<?= $linkto ;?>" type="text" class="form-control col-lg-4 mr-1" placeholder="0" aria-label="PERSEN PPN" aria-describedby="basic-addon1"><i>%</i> <input id="ppnnum" name="ppnnum" type="text" class="form-control" placeholder="0" aria-label="NOMINAL PPN" aria-describedby="basic-addon1"></th>
                                   </tr>
                                   <tr>
                                   
                                   <th colspan="2" style="text-align:right;">Total</th>
                                   <th><input id="totalnum" name="totalnum" type="text" class="form-control" placeholder="0" aria-label="total" aria-describedby="basic-addon1"></th>
                                   </tr>
                              </tfoot>
                              
                         </table>
                        
                         </div>
            </div>        
               <div class="row ml-2 mr-2 mb-2">
                     <div class="input-group col-5 mb-2">
                              <div class="input-group-prepend">
                                   <small class="input-group-text" id="basic-addon1">Harga<br>tersebut<br>diatas</small>
                              </div>
                              <textarea id="notestxt" name="notestxt" class="form-control" aria-label="With textarea" Placeholder="Catatan" rows="5"></textarea>
                         </div>
                         <div class="input-group col-7 mb-2">
                              <div class="input-group-prepend">
                                   <small class="input-group-text" id="basic-addon1">Syarat<br>Pembayaran</small>
                              </div>
                              <textarea id="termstxt" name="termstxt" class="form-control" aria-label="With textarea" Placeholder="Syarat & ketentuan" rows="5"></textarea>
                         </div>
               </div>
        </div>
    </div>
</div>
<!-- End Form Modal Edit Quotation -->

<!-- Start Form Modal Term  -->
<div class="modal fade bd-example-modal-lg" id="TermModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
        <div class="col-lg-6 text-left">
          <h5 id="kodeterm"></h5>
</div>
                <div class="col-lg-6 text-right">
               <button type="button" id="canceled" class="btn btn-primary text-right" onclick="releasePopup();">X</button> 
               </div>
            </div>
            <div class="modal-body">
            <h5 id="kodeterm"></h5> 
                    <div class="col-lg-12" id="detail_term">

                    </div>             
            </div>
        </div>
    </div>
</div>
<!-- End Form Modal Edit Quotation -->

<!-- Preview Quotation Modal -->
<div class="modal fade bd-example-modal-xl previewModal" id="PreviewModal" name="PreviewModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
     <div class="col-lg-12">
          <table width="100%">
               <tr>
                    <td><img class="icon_quo" src="<?php echo base_url('img/TF_ICO.jpg')?>" alt=""></td>
                    <td>
                    <table>
                         <tr class="companys">
                              <td colspan="3">PT.TRAFINDO PRIMA PERKASA</td>
                         </tr>
                         <tr class="areas">
                              <td>Head Office</td>
                              <td> : </td>
                              <td> Jalan Hayam Wuruk 4 No. FX Jakarta Pusat 10120 – Indonesia Telp.: +62 21 3850703, 3517113, 3861865</td>
                         </tr>
                         <tr class="areas">
                              <td></td>
                              <td></td>
                              <td> Faks: +62 21 3850702, 3861869</td>
                         </tr>
                         <tr  class="areas">
                              <td>Factory I</td>
                              <td> : </td>
                              <td> Jalan Raya Siliwangi, RT004/RW005,
Kel. Alam Jaya, Kec. Jatiuwung,
Tangerang, Banten- Indonesia
Telp.: +62 21 5903801, 5903802</td>
                         </tr>
                         <tr  class="areas">
                              <td>Factory II</td>
                              <td> : </td>
                              <td>Jalan Raya Siliwangi, RT006/RW004,
Kel. Alam Jaya, Kec. Jatiuwung,
Tangerang, Banten- Indonesia
Telp.: +62 21 5903801, 5903802</td>
                         </tr>
                         <tr  class="areas">
                              <td>Factory III</td>
                              <td> : </td>
                              <td>Jalan Raya Siliwangi, RT004/RW001,
Kel. Pasir Jaya, Kec. Jatiuwung,
Tangerang, Banten- Indonesia
Telp.: +62 21 5903801, 5903802</td>
                         </tr>
                         <tr  class="areas">
                              <td>Factory IV</td>
                              <td> : </td>
                              <td>Jalan Raya Siliwangi, RT004/RW001,
Kel. Gembor, Kec. Periuk,
Tangerang, Banten- Indonesia
Telp.: +62 21 5903801, 5903802</td>
                         </tr>
                         
                    </table>     
                         

                    </td>
               </tr>
               <tr>
                    <td colspan="8" style="text-align:center;font-size:15px;font-weight:bold;">PENAWARAN</td>
               </tr>
          </table>
          <table border="1" width="100%" class="prequotation">             
               <tr>
                    <td colspan="4" width="50%" class="header">Kepada Yth.<br>
                    PT. XYZ<br>
                    JAKARTA<br>
                    Up. ALEX BAROS<br>
                    Telp. 021XXXX<br>
                    Email. xyz@gmail.com<br>
                    </td>
                    <td colspan="4" width="50%" class="header">
                         <table class="prequotation_a">
                              <tr>
                                   <td>Penawaran No</td>
                                   <td> : </td>
                                   <td> 2950/PEN/X/2022</td>
                              </tr>
                              <tr>
                                   <td>Tanggal</td>
                                   <td> : </td>
                                   <td> 02/10/2022</td>
                              </tr>
                              <tr>
                                   <td>Referensi</td>
                                   <td> : </td>
                                   <td> PLN</td>
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
               </tr>
               <tr>
                    <td class="furut">1</td>
                    <td colspan="3">TRANSFORMATOR DISTRIBUSI</td>
                    <td class="funit">1 Unit</td>
                    <td class="fharga">500000</td>
                    <td class="fharga">500000</td>
               </tr>
              
               <tr>
                    <td class="furut">2</td>
                    <td  colspan="3">TRANSFORMATOR KERING</td>
                    <td class="funit">2 Unit</td>
                    <td class="fharga">200000</td>
                    <td class="fharga">200000</td>
               </tr>

               <tr>
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
          </table>
     </div>
    </div>
  </div>
</div>
<!-- End Preview Quotation Modal -->


<!-- Start Form Modal Message -->
<div class="modal fade bd-example-modal-md mt-4" id="MsgModal" role="dialog">
    <div class="modal-dialog modal-md">
          <div class="modal-content">
           <!-- modal-header -->  
       
               <div class="modal-body" id="msgBody"></div>  
               
          </div>
    </div>
</div>

<!-- Start Form Modal Grid -->
<div class="modal fade bd-example-modal-xl mt-4" id="modalGrid" role="dialog">
    <div class="modal-dialog modal-xl">
         
             
        
          <div class="modal-content"> 
               <input id="urutandata" type="text" class="form-control mt-1 col-lg-6 urutandata" hidden>
               <input id="tipecari" type="text" class="form-control mt-1 col-lg-6 tipecari" hidden>

               <div class="row col-lg-12 ml-2 mr-2">
               <input type="text" class="form-control mt-1 col-lg-6" id="caribox" placeholder="input nama customer yang dibutuhkan"> <button class="btn-sm btn-primary ml-1 mt-1 " onclick="findesoft()">Find</button><button class="btn-sm btn-default ml-1 mt-1 text-right" onclick="closecustesoft()">close</button>
               </div>
               <div class="modal-body" id="Grids"> 
               <table id="table_cust" class="table table-striped table-bordered" width="100%" cellspacing="0">  
                              <thead>
                                   <tr>
                                        <th>Kode Customer</th>
                                        <th>Nama Customer</th>
                                        <th>Alamat</th>
                                        <th>Up </th>
                                        <th>NPWP</th>
                                        <th>kontak</th>
                                        <th>Valuasi</th>
                                        <th class="bg-primary text-white">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                              </tbody>

                              
                         </table>
               <table id="table_brg" class="table table-striped table-bordered d-none" width="100%" cellspacing="0">  
                              <thead>
                                   <tr>
          

                                        <th>Kode Barang</th>
                                        <th>Nama Brg I</th>
                                        <th>Nama Brg II</th>
                                        <th>Nama Brg III</th>
                                        <th>Kapasitas</th>
                                        <th>Satuan</th>
                                        <th>Type</th>
                                        <th class="bg-primary text-white">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                              </tbody>

                              
                         </table>
                         </div> 
          </div>
    </div>
</div>