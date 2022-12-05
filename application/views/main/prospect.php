
          <div class="card-body">
                    <div class="table-responsive">
                         <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">  
                              <thead>
                                   <tr>
                                        <th>No</th>
                                        <th>Prospect</th>
                                        <th>Customer</th>
                                        <th>Proyek</th>
                                        <th>Tgl Prospect</th>
                                        <th>Tgl Pracost</th>
                                        <th>Tgl Form Spec</th>
                                        <th>Tgl Rilis</th>
                                        <th>Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                              </tbody>
               
                              <tfoot>
                                   <tr>
                                        <th>No</th>
                                        <th>Prospect</th>
                                        <th>Customer</th>
                                        <th>Proyek</th>
                                        <th>Tgl Prospect</th>
                                        <th>Tgl Pracost</th>
                                        <th>Tgl Form Spec</th>
                                        <th>Tgl Rilis</th>
                                        <th>Aksi</th>
                                   </tr>
                              </tfoot>
                         </table>

                    </div>
          </div>




          <script src="<?php echo base_url('vendor/jquery/jquery.min.js')?>"></script>
<script>var base_url = '<?php echo base_url() ?>';</script>
<script type="text/javascript" src="<?php echo base_url('js_script/trans/prospect.js?v=1')?>"></script>


<div class="modal fade bd-example-modal-xl" id="DescModal" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
                <div class="col-lg-12 text-right">

                <div class="btn btn-success" onclick="simpandata();" id="tombolquo" Title="Proses Quotation">Quotation</div>
                <button type="button" id="canceled" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
            </div>
            <div class="modal-body">
               <div class="row d-flex">
                     <div class="col-lg-6">
                   
                         <div class="input-group col-lg-12">
                              <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1">Prospect</span>
                              </div>
                              <input id="noprospectus" name="noprospectus" type="text" class="form-control col-lg-3" placeholder="prospectno" aria-label="prospectno" aria-describedby="basic-addon1" readonly>
                              <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1">Proyek</span>
                              </div>
                              <input id="proyektxt" name="proyektxt" type="text" class="form-control col-lg-6" placeholder="Proyek" aria-label="Proyek" aria-describedby="basic-addon1">
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
                             
                              <input id="telpnum" name="telpnum" type="text" class="form-control col-lg-6" placeholder="Telp" aria-label="Telp" aria-describedby="basic-addon1">
                              <input id="emailtxt" name="emailtxt" type="email" class="form-control col-lg-6" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                         </div>
                         <!-- <div class="input-group col-lg-12 mt-2 mb-2">
                              <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1">NPWP</span>
                              </div>
                              <input id="npwpnum" name="npwpnum" type="text" class="form-control" placeholder="....." aria-label="NPPWP" aria-describedby="basic-addon1">
                         </div>
                         -->
                        
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
            <table id="table_d" class="table table-striped table-bordered col-sm-12" width="100%" cellspacing="0">  
          <thead>
               <tr>
                    <th width="5%">No</th>
                    <th width="10%">Pracost</th>
                    <th width="10%">Tipe</th>
                    <th width="5%">Jumlah</th>
                    <th width="5%">Unit</th>
                    <th width="15%">Harga Pracost</th>
                    <th width="15%">Harga Awal</th>
                    <th width="15%">Harga Dasar</th>
                    <th width="20%">Harga Jual</th>
               </tr>
          </thead>
          <tbody>
          </tbody>

          <tfoot>
               <tr>
               <th colspan="8" style="text-align:right;">Sub Total</th>
               <th><input id="subtotalnum" name="subtotalnum" type="text" class="form-control" placeholder="0" aria-label="subtotal" aria-describedby="basic-addon1"></th>
               </tr>
               <tr>
               <th colspan="8" style="text-align:right;"> PPN </th>
               <?php $linkto = "ReCalc(this)"; ?>
               <th class="d-flex"><input id="prsppn" name="prsppn" onkeyup="<?= $linkto ;?>" type="text" class="form-control col-lg-4 mr-1" placeholder="0" aria-label="PERSEN PPN" aria-describedby="basic-addon1"> <input id="ppnnum" name="ppnnum" type="text" class="form-control" placeholder="0" aria-label="NOMINAL PPN" aria-describedby="basic-addon1"></th>
               </tr>
               <tr>
               <th colspan="8" style="text-align:right;">Total</th>
               <th><input id="totalnum" name="totalnum" type="text" class="form-control" placeholder="0" aria-label="total" aria-describedby="basic-addon1"></th>
               </tr>
          </tfoot>
     </table>
                        

            </div>
         
            <div class="row ml-2 mr-2 mb-2">
                 
                 <div class="input-group col-6 mb-2">
                          <div class="input-group-prepend">
                               <small class="input-group-text" id="basic-addon1">Harga<br>tersebut<br>diatas</small>
                          </div>
                          <textarea id="notestxt" name="notestxt" class="form-control" aria-label="With textarea" Placeholder="Catatan" rows="5"></textarea>
                     </div>
                     <div class="input-group col-6 mb-2">
                          <div class="input-group-prepend">
                               <small class="input-group-text" id="basic-addon1">Syarat<br>Pembayaran</small>
                          </div>
                          <textarea id="termstxt" name="termstxt" class="form-control" aria-label="With textarea" Placeholder="Syarat & ketentuan" rows="5"></textarea>
                     </div>
           </div>
                   
      
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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