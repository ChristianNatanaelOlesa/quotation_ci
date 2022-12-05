<style>
     .btnaksi{
          margin-left:8px;
     }
</style>
          <div class="card-body">
                    <div class="table-responsive">
                         <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">  
                              <thead>
                                   <tr>
                                        <th>No</th>
                                        <th>Quotation</th>
                                        <th>Tgl Quotation</th>
                                        <th>Prospect</th>
                                        <th>Customer</th>
                                        <th>Expired</th>
                                        <th>Aksi</th>
                                        
                                   </tr>
                              </thead>
                              <tbody>
                                   </tbody>
                                   
                                   <tfoot>
                                        <tr>
                                        <th>No</th>
                                        <th>Quotation</th>
                                        <th>Tgl Quotation</th>
                                        <th>Prospect</th>
                                        <th>Customer</th>
                                        <th>Expired</th>
                                        <th>Aksi</th>
                                        
                                   </tr>     
                              </tfoot>
                         </table>

                    </div>
          </div>

          <script src="<?php echo base_url('vendor/jquery/jquery.min.js')?>"></script>
          <script>var base_url = '<?php echo base_url() ?>';</script>
          <script type="text/javascript" src="<?php echo base_url('js_script/trans/approval.js?v=1')?>"></script>




<!-- Start Form Modal Edit Quotation -->
<div class="modal fade bd-example-modal-xl" id="DescModal" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
                <div class="col-lg-12 text-right">

                     <div class="btn btn-success mr-3" onclick="simpandata();" id="tombolquo" Title="Update Quotation">Update</div>
                     
                     <div class="btn btn-success mr-3" onclick="editdata(2);" id="tomboledit" Title="Edit Quotation">  <i class="fas fa-pen" ></i> Edit</div>
                     <div class="btn btn-info pull-right mr-3" onclick="view_on_form();" id="tombolview" Title="Preview Quotation">Preview Form</div>
                     <button type="button" id="canceled" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
            </div>
            <div class="modal-body">
               <div class="row d-flex">
              
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


<!-- Start Form Modal Edit Quotation -->
<div class="modal fade bd-example-modal-xl" id="QuestModal" role="dialog">
    <div class="modal-dialog modal-xl">
          <div class="modal-content">
           <!-- modal-header -->  
               <div class="modal-header" id="modal-head"></div>  
               <!-- modal-body -->  
               <div class="modal-body" id="modal-body"></div>  
               <!-- modal-footer -->  
               <div class="modal-footer" id="modal-footer"></div>  
          </div>
    </div>
</div>


<!-- End Form Modal Edit Quotation -->



<!-- Preview Quotation Modal -->
<div class="modal fade bd-example-modal-xl previewModal" id="PreviewModal" name="PreviewModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
     <div class="col-lg-12" id="quopreview">
          
     </div>
    </div>
  </div>
</div>
<!-- End Preview Quotation Modal -->