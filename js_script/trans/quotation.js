var table;
var table_d;
var noprospect;
var noquotation;
var acak_quo;
var pricecek = 0;
var param;
var catagory = 0;
var kdcust_esoft = '';
var items_esoft = '';

$(document).ready(function() {
 
    
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "aoColumns" : [
            { sWidth: '3%' },
            { sWidth: '7%' },
            { sWidth: '25%' },
            { sWidth: '15%' },
            { sWidth: '15%' },
            { sWidth: '10%' },
            { sWidth: '10%' },
            { sWidth: '15%' }
          ],
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url" : base_url+'Quotation/ajax_list',
            // "url": "<?php echo site_url('Prospect/ajax_list')?>",
            "type": "POST"
            
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
    table_d = $('#table_d').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "searching": false, "paging": false, "info": false,"bSort": false,
        "bAutoWidth" : false,
        "aoColumns" : [
            { sWidth: '3%' },
            { sWidth: '7%' },
            { sWidth: '23%' },
            { sWidth: '5%' },
            { sWidth: '5%' },
            { sWidth: '10%' },
            { sWidth: '10%' },
            { sWidth: '10%' },
            { sWidth: '20%' }
          ],
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url" : base_url+'Quotation/ajax_list_d',
            "type": "POST",
            "data": function(x){
                x.acak_quo=acak_quo,
                x.catagory=catagory
            }
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

    table_cust = $('#table_cust').DataTable({ 

        "processing": true,
        "serverSide": true, 
        "order": [], 
        "searching": false, "paging": false, "info": false,"bSort": false,
        "bAutoWidth" : false,
        "ajax": {
            "url" : base_url+'Esoft/getCust',
            "type": "POST",
            "data": function(x){
                x.kdcust=kdcust_esoft
            }
        },
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false,
        },
        ],
 
    });

    table_brg = $('#table_brg').DataTable({ 

        "processing": true,
        "serverSide": true, 
        "order": [], 
        "searching": false, "paging": false, "info": false,"bSort": false,
        "bAutoWidth" : false,
        "ajax": {
            "url" : base_url+'Esoft/getItem',
            "type": "POST",
            "data": function(x){
                x.items=items_esoft
            }
        },
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false,
        },
        ],
 
    });

    $('#lokasitxt').keyup(function(){
        this.value = this.value.toUpperCase();
    });
    $('#UPtxt').keyup(function(){
        this.value = this.value.toUpperCase();
    });
    $('#reftxt').keyup(function(){
        this.value = this.value.toUpperCase();
    });
    $('#spektxt').keyup(function(){
        this.value = this.value.toUpperCase();
    });
    $('#garansitxt').keyup(function(){
        var intRegex = /^\d+$/;
        if(!intRegex.test(this.value)) {
            $('#garansitxt').val('');
        }

    });
    var oldTelp;
    $('#telpnum').keydown(function(){
        oldTelp = this.value;
    });

    $('#telpnum').keyup(function(){
        console.log(oldVal)
        var intRegex = /^\d+$/;
        if(!intRegex.test(this.value)) {
            $('#telpnum').val(oldTelp);
        }

    });
    $('#prsppn').keyup(function(){
        var intRegex = /^\d+$/;
        if(!intRegex.test(this.value)) {
            $('#prsppn').val('');
        }
    });

});

function findesoft(){
    var cari = $('#caribox').val();
    var tipecari = $('#tipecari').val();
console.log(tipecari);
    // 1.cust 2.barang
    if(tipecari==2){
        items_esoft = cari;
        reload_table_brg();
        $('#caribox').val('');
    }
    else{
        kdcust_esoft = cari;
        reload_table_cust();
        $('#caribox').val('');
    }
}

function closecustesoft(){
    reload_table_cust();
    $('#modalGrid').modal('hide');
}

function choosecustesoft(param){
    var kodecust = param;
    $('#kdcustreal').val(kodecust); 
    getdetailcust(kodecust);   
    $('#modalGrid').modal('hide');
    $('#DescModal').css('overflow-y', 'auto');
}
function chooseitemesoft(param){
    var items = param; //kode barang
    var urutdata = $('#urutandata').val(); //urutan data barang di listing
    getdetailitem(items,urutdata);   
    $('#modalGrid').modal('hide');
    $('#DescModal').css('overflow-y', 'auto');
}

function getdetailcust(param){
    $.ajax({
        url : base_url+'Esoft/getInfoCust',
        type: "POST",
        data: {
            kdcust : param
        },
        datatype: 'JSON',
        success: function(data) {
            $('#kdcustreal').val(param); 
            $('#custreal').val(JSON.parse(data).NAMA); 
            $('#alamatreal').val(JSON.parse(data).AL); 
            $('#kontakreal').val(JSON.parse(data).TLP); 
            $('#upreal').val(JSON.parse(data).PERSO); 
            $('#npwpreal').val(JSON.parse(data).NPWP); 
            $('#DescModal').css('overflow-y', 'auto');
        },
        error: function(xhr, status, error) {
        $('#DescModal').modal('hide');
        attention('Proses Quotation Gagal');
        }
});
}
function getdetailitem(param,param2){
    var urutdata = param2;
    $.ajax({
        url : base_url+'Esoft/getInfoItem',
        type: "POST",
        data: {
            items : param
        },
        datatype: 'JSON',
        success: function(data) {
            $('#esoft_barang'+urutdata).val(JSON.parse(data).NAMA); 
            $('#esoft_kdbarang'+urutdata).val(JSON.parse(data).BRG); 
            $('#esoft_jenis'+urutdata).val(JSON.parse(data).KLINK); 
        },
        error: function(xhr, status, error) {
        $('#DescModal').modal('hide');
        attention('Proses Quotation Gagal');
        }
});
}

function getTOP(){
    $('#topdown').empty(); //reset option term of payment
    $.ajax({
        url : base_url+'Top/getTop',
        type: "POST",
        datatype: 'JSON',
        success: function(data) {
            console.log(data);
            // var x = [{"vendor_name":"scscss"},{"vendor_name":"xzcdsfdx"}]
            var x = JSON.parse(data);
            // var _options ="";
            $.each(x, function (i, item) {
                $('#topdown').append($('<option>', { 
                    value: item.top_cd,
                    text : item.deskripsi 
                }));
            });
        },
        error: function(xhr, status, error) {
         $('#DescModal').modal('hide');
         attention('Proses Quotation Gagal');
        }
   });
}

function v_detail(param1,param2){
    acak_quo = param1;
    collectdata(acak_quo,param2);
    $('#infoquo_v1').removeClass('d-none');
    $('#infoquo_v1').addClass('d-flex');
    $('#infoquo_v2').removeClass('d-flex');
    $('#infoquo_v2').addClass('d-none');
    $('#canceled').html('Close');

}
function editdata(param){
    acak_quo = $('#acak').val();
    collectdata(acak_quo,param);
    $('#canceled').html('Cancel');

}

function view_on_form(params){
        acak_quo = params;
        $.ajax({
            url : base_url+'Quotation/views',
            type: "POST",
            data: {
                'acak_quo': acak_quo
                },
            datatype: 'JSON',
            success: function(data) {
                $('#DescModal').modal("hide");               
                $('#PreviewModal').modal("show");               
            },
            error: function(xhr, status, error) {
             $('#DescModal').modal('hide');
             attention('Proses Quotation Gagal');
            }
       });
}


function collectdata(param1,param2){
//  param2 : 1=>view 2=>edit 3=>finalisasi
    catagory = param2;
    $.ajax({
        url : base_url+'Quotation/collect',
        type: "POST",
        data: {
            'acak_quotation': param1
            },
        datatype: 'JSON',
        success: function(data) {
        
            var NewObj = JSON.parse(data).datalist;
            $('#DescModal').modal("show");  
            if(catagory==1){ //view
                $('#tombolfinal').addClass( "d-none" );
                $('#tombolquo').addClass( "d-none" );
                $('#tomboledit').addClass( "d-none" );

                if(NewObj.chstatus == 1  || NewObj.chstatus > 2  ){
                    $('#tomboledit').addClass( "d-none" );
                }
                if(NewObj.chstatus == 0 || NewObj.chstatus == 2  ){
                    $('#tomboledit').removeClass( "d-none" );
                }
                
                $('#tombolview').removeClass( "d-none" );
                readonlyObject(true);    
                $('#ico_com').css('display','block');  
            }
            else if(catagory==3){ //finalisasi
                
                $('#tombolview').addClass( "d-none" );
                $('#tomboledit').addClass( "d-none" );
                $('#tombolquo').removeClass( "d-none" );
                $('#tombolfinal').removeClass( "d-none" );
                
                var data_quotation = '<h5>'+NewObj.no_quotation+' | '+NewObj.tgl_quotation+'</h5><ul class="list-group"><li class="list-group-item"><b>Customer Info</b><br>'+NewObj.nm_customer+'( Up.'+NewObj.up+' )'+'<br>'+NewObj.proyek+','+NewObj.lokasi+'<br>Telp. '+NewObj.telp+', Email. '+NewObj.emails+'<br>Referensi. '+NewObj.referensi+'</li><li class="list-group-item"><b>Info Lainnya</b><br>'+NewObj.deskripsi+'<br>Batas waktu Penawaran. '+NewObj.exp_quotation+'<br>Garansi. '+NewObj.masa_garansi+' Bulan<br>Spesifikasi. '+NewObj.spec+'<br>Masa Pembuatan. '+NewObj.estimasi+'<br></li></ul>';
                var real_input = '<h5>Customer Final</h5><input class="form-control"  title="kdc" id="kdcustreal" name="kdcustreal" placeholder="kode" onchange="getdetailcust(this.value)" hidden><input class="form-control col-lg-12 mt-1 border border-success text-success" title="Klik Untuk Mencari Nama Customer" placeholder="Klik Untuk Mencari Nama Customer" id="custreal" name="custreal" onclick="showgrid(1,0);" readonly><input class="form-control mt-1" title="Alamat" id="alamatreal" name="alamatreal" placeholder="Alamat" readonly><input class="form-control mt-1" title="kontak"  id="kontakreal" name="kontakreal"  placeholder="Kontak"  readonly><input class="form-control mt-1" title="UP"  id="upreal" name="upreal"  placeholder="Up"  readonly><input class="form-control mt-1" title="npwp"  id="npwpreal" name="npwpreal"  placeholder="NPWP"  readonly><input class="form-control mt-1" title="Budget Biaya Pengiriman"  id="beakirim" name="beakirim" placeholder="Input budget Biaya Pengiriman">';
                $('#quodetails').html(data_quotation);
                $('#realinfo').html(real_input);
                $('#ico_com').css('display','none');
                readonlyObject(true);
                            
            }
            else{ //editable
                $('#tombolfinal').addClass( "d-none" );
                $('#tombolview').addClass( "d-none" );
                $('#tomboledit').addClass( "d-none" );
                $('#tombolquo').removeClass( "d-none" );
                readonlyObject(false);
                $('#ico_com').css('display','block');
            
            }

            // acak_quo = NewObj.acak;
            $('#acak').val(NewObj.acak);
            $('#noquotation').val(NewObj.no_quotation);
            $('#tglquotxt').val(NewObj.tgl_quotation);
            $('#noprospect').val(NewObj.no_prospect);
            $('#proyektxt').val(NewObj.proyek);
            $('#nmcusttxt').val(NewObj.nm_customer);
            $('#lokasitxt').val(NewObj.lokasi);
            $('#UPtxt').val(NewObj.up);
            $('#telpnum').val(NewObj.telp);
            $('#emailtxt').val(NewObj.emails);
            $('#estimasitxt').val(NewObj.estimasi);
            
            getTOP(); //call data top header append to dropdown

            $('#topdown').append($('<option>', { 
                value: NewObj.top_code,
                text : NewObj.deskripsi, 
            }));
            //untuk bataskan data exist saat edit data
            $('#topdown').append($('<option>', { 
                value: 'XX',
                text : '------------------------', 
                disabled : 'disabled',
            }));

            $('#reftxt').val(NewObj.referensi);
            $('#expquot').val(NewObj.exp_quotation);
            $('#garansitxt').val(NewObj.masa_garansi);
            $('#spektxt').val(NewObj.spec);
            $('#prsppn').val(NewObj.prs_ppn);
            $('#topdown').val(NewObj.top_cd);
            $('#noprospect').attr("disabled", true);
            $('#subtotalnum').val(NewObj.hargajual);
            $('#subtotalnum').addClass( "text-right" );
            $('#subtotalnum').attr("disabled", true);
            
            var ppn_rp = parseInt(NewObj.hargajual) * (parseInt(NewObj.prs_ppn) / 100);
            // console.log(NewObj.harga_jual);

            $('#ppnnum').val(ppn_rp.toFixed(2));
            $('#ppnnum').addClass( "text-right" );
            $('#ppnnum').attr("disabled", true);
            
            $('#totalnum').val(NewObj.total_hargajual);
            $('#totalnum').addClass( "text-right" );
            $('#totalnum').attr("disabled", true);

            $('#notestxt').val(NewObj.notes);
            $('#termstxt').val(NewObj.terms);
            $('#notes_produktxt').val(NewObj.notes_product);

            //view untuk customer finalisasi
            $('#custreal').val(NewObj.nmcust_final);
            $('#alamatreal').val(NewObj.alamat_final);
            $('#kontakreal').val(NewObj.tlpcust_final);
            $('#upreal').val(NewObj.up_final);
            $('#npwpreal').val(NewObj.npwp_final);

            
            reload_table_d();                  
        },
        error: function(xhr, status, error) {
         $('#DescModal').modal('hide');
         attention('Proses Quotation Gagal');
        }
   });
}


function generateSchedule(param){

    $.ajax({
            url : base_url+'Top/generate_sch',
            type : "POST",
            data : {
                'top_code':param
            },
            datatype : "JSON",
            success: function(data){
                console.log(data);
            },
            error: function(xhr,status,error){

            }
    });
}
function ReCalc(param){
    
    var data = table_d.rows().data();
    var indexing = param.name;
    var NewVals = param.value;
    var lop = 0;
    var total = 0;
    var oldHJual = 0;

    data.each(function (value, index) {
        lop = lop+1;
  
        oldHJual = parseInt(value[17]);
        dtables_hjual = $('#row-jual'+lop).val();

         // protect input selain angka, 
         // setiap user salah tekan selain angka akan di kembalikan ke value sebelumnya
         var intRegex = /^\d+$/;
         if(!intRegex.test(dtables_hjual)) {
             $('#row-jual'+lop).val(oldHJual);
         }
         // protect input selain angka
    
        if(indexing == lop){
            total += parseInt(NewVals);
        }
        else{
            total += parseInt(dtables_hjual);
        }
    });
    $('#subtotalnum').val(total.toFixed(2));
    var ppnum = total * parseInt($('#prsppn').val()) / 100;
    $('#ppnnum').val(ppnum.toFixed(2));
    var grand_total = total + ppnum;
    $('#totalnum').val(grand_total.toFixed(2));

}

function showgrid(param,param2){
    // 1. customer 2. barang
    var urutdata = param2;
    var typedata = param;
    console.log('show. '+typedata);
    if(typedata == 1){
        reload_table_cust();
        $('#table_cust').removeClass('d-none');
        $('#table_brg').addClass('d-none');
        $('#tipecari').val(1);
        $('#caribox').attr("placeholder", "input nama Customer yang dibutuhkan");
    }
    else{
        reload_table_brg();
        $('#table_cust').removeClass('d-none');
         $('#table_cust').addClass('d-none');
        $('#table_brg').removeClass('d-none');
        $('.urutandata').val(urutdata);
        $('#tipecari').val(2);
        $('#caribox').attr("placeholder", "input nama Item yang dibutuhkan");

        // console.log(urutdata);
        // $('#table_brg').addClass('d-flex');
    }
    $('#modalGrid').modal('show');
}

function simpandata() { 
    noquotation =   $('#noquotation').val();
     var data = table_d.rows().data();
     var i = '';
     var lop = 0;
     var verify = true;
     var dataArr = [];
     var dataArr_H = [];
     var tglexp = $("#expquot").val();  
     var total = 0;
     var ppnum = 0;
     var grand_total = 0;
     var myObject_H = {};
     var acak;
     var Hrg_dasar = 0;
     var cek = true;
    //  console.log(data);

     data.each(function (value, index) {
          lop = lop+1;
          nopcost = value[1];
          acak = value[16];
          Hrg_dasar = value[11];

          h_jual = $('#row-jual'+lop).val();
          nmbarang = $('#barang'+lop).val();
            if(nmbarang==''){
                nmbarang = '';
            }
        if(Hrg_dasar >= h_jual){
            delete myObject;
            cek = false;
            alert('Ditemukan Harga Item lebih rendah / sama dengan dari Harga Dasar\nSilahkan cek pada Item. '+nmbarang);
        }
        else{
                customer = $('#nmcusttxt').val();
                proyek = $('#proyektxt').val();
                lokasi = $('#lokasitxt').val();
                up = $('#UPtxt').val();
                telp = $('#telpnum').val();
                emails = $('#emailtxt').val();
                referensi = $('#reftxt').val();
                spec   = $('#spektxt').val();
                estimasi  = $('#estimasitxt').val();
                expired = $('#expquot').val();
                prs_ppn = $('#prsppn').val();
                notes = $('#notestxt').val();
                notes_produk = $('#notes_produktxt').val();
                terms = $('#termstxt').val();
                garansi = $('#garansitxt').val();
                term_of_pay = $('#topdown').val();
                // finalisasi data customer
                kdcust_f = $('#kdcustreal').val();
                nmcust_f = $('#custreal').val();
                almtcust_f = $('#alamatreal').val();
                tlpcust_f = $('#kontakreal').val();
                upcust_f = $('#upreal').val();
                npwpcust_f = $('#npwpreal').val();
                //finalisasi data barang dari erasoft
                nmbarang_f = $('#esoft_barang'+lop).val();
                kdbarang_f = $('#esoft_kdbarang'+lop).val();
                jenis_f = $('#esoft_jenis'+lop).val();

                console.log(nmbarang);



                total += parseInt(h_jual);
                var myObject = {};

                myObject = {"acak":acak,
                            "nopracost":nopcost,
                            "new_hrg_jual":h_jual,
                            "new_nmbarang":nmbarang,
                            "final_kdbarang":kdbarang_f,
                            "final_nmbarang":nmbarang_f,
                            "final_jenis":jenis_f,
                            };
                
                dataArr.push(myObject);
        }
     });
    if(cek){
            ppnum = total * (prs_ppn / 100);
            grand_total = total + ppnum;

            myObject_H = {"acak":acak,
                        "noprospect":noprospect,
                        "customer":customer,
                        "proyek":proyek,
                        "lokasi":lokasi,
                        "telp":telp,
                        "up":up,
                        "emails":emails,
                        "referensi":referensi,
                        "spec":spec,
                        "estimasi":estimasi,
                        "total":total,
                        "expired":tglexp,
                        "nmproyek":proyek,
                        "prs_ppn":prs_ppn,
                        "ppnum":ppnum,
                        "grandtotal":grand_total,
                        "notes":notes,
                        "terms":terms,
                        "expired":expired,
                        "garansi":garansi,
                        "note_product":notes_produk,
                        "top_cd":term_of_pay,
                        "kdcust_final":kdcust_f,
                        "nmcust_final":nmcust_f,
                        "alamat_final":almtcust_f,
                        "tlpcust_final":tlpcust_f,
                        "up_final":upcust_f,
                        "npwp_final":npwpcust_f,
                         };
                dataArr_H.push(myObject_H);
                
                $.ajax({
                    url : base_url+'Quotation/simpan_data',
                    type: "POST",
                    data:{
                            'data': JSON.stringify(dataArr),
                            'data_h': JSON.stringify(dataArr_H)
                            },
                    datatype: 'JSON',
                    // cache: false,
                    success: function(data) {
                            $('#DescModal').modal('hide');
                            reload_table(); 
                            // $( "#table" ).load();
                            attention('Update Quotation Berhasil');  
                                            
                    },
                    error: function(xhr, status, error) {
                        $('#DescModal').modal('hide');
                        attention('Update Quotation Gagal');
                    }
                });
    }
}

function aksi(param1,param2){
    var acak = $('#acak').val();

    if(param1 == 41){
        v_detail(param2,3);
        $('#infoquo_v1').removeClass('d-flex');
        $('#infoquo_v1').addClass('d-none');
        $('#infoquo_v2').removeClass('d-none');
        $('#infoquo_v2').addClass('d-flex');
    }
    else if(param1 == 4){
        reason = 'Apakah anda yakin proses Finalisasi untuk data ini ?';
        var cek = true;
        //cek inputan, finalisasi (customer dan nama barang final wajib terisi)
            //cek customer final dari erasoft
            if($('#kdcustreal').val() == ''){
                cek = false;
            }   

            //cek detail barang ploting dari master barang erasoft
            var data = table_d.rows().data();
            var lop = 0;
            console.log(data);
            data.each(function (value, index) {
                if($('#esoft_kdbarang'+lop).val() == ''){
                    cek = false;
                    return cek;
                }
            });

            if(cek == true){
                simpandata();
                aksi_process(reason,param2,param1);
            }
            else{
                alert('Customer Final / Data Barang ditemukan masih kosong, silahkan lengkapi data tersebut !');
            }

    }
    else if(param1 == 5){
        reason = 'Apakah anda yakin proses Sales Order untuk data ini ?';
        aksi_process(reason,param2,param1);
    }
    else if(param1 == 6){
        reason = 'Apakah anda yakin proses Rollback untuk data ini ?';
        aksi_process(reason,param2,param1);
    }
    else{
        reason = 'Apakah anda yakin untuk melakukan Submit Quotation untuk data ini ?';
        aksi_process(reason,param2,param1);
    }

}

function aksi_process(param,param1,param2,){
    var reason = param;
    var acak = param1;
    var type_aksi = param2;

    if (confirm(reason)) {
        $.ajax({
        url : base_url+'Quotation/aksi',
        type : "POST",
        data : { 'acak':acak,
                'param':type_aksi,
        },
        datatype : 'JSON',
        success: function(data){
                console.log(data);
                reload_table();
                $('#DescModal').modal('hide');
        },
        error: function(xhr,status,error){
            console.log('Error Prosess Approval !!');
        }
    });

    } else {
        console.log('No');
    }
}


function popupterm(param){
    var selected = param.value;
    var selected_info = $("#topdown option:selected").text();
    $.ajax({
        url : base_url+'Quotation/getTerms',
        type : "POST",
        data : { 'top_code':selected
        },
        datatype : 'HTML',
        success: function(data){
            $('#kodeterm').html(selected_info);
            $('#DescModal').modal('hide');
            $('#TermModal').modal('show');
            $('#detail_term').html(data);
        },
        error: function(xhr,status,error){
            console.log('Error Prosess Approval !!');
        }
    });
}

function releasePopup(){
    var selected =  $('#topcode').val();
    var Arr_term = [];
    var merge_deskripsi = '';
    $.ajax({
        url : base_url+'Quotation/setupTerms',
        type : "POST",
        data : { 'top_code':selected
        },
        datatype : 'integer',
        success: function(data){
          var tdata = data;
          
          var myObj = {};
          var i;
          var acak = $('#acak').val();
          for (i = 1; i <= tdata; ++i) {
            var jarak =  $('#jarak'+i).val();
            var jarakA = $('#jarak'+i+'A').val();
            var prs =  $('#topdet'+i).val();
            var periodik =  $('#periodik'+i).val();
            var deskripsi =  $('#deskripsi'+i).val();
            deskripsi = UpperFirst(deskripsi);
            var jarak_prio = jarak+' '+ UpperFirst(infoPeriod(periodik));
            var jarak_prioA = jarakA+' '+ UpperFirst(infoPeriod(periodik));
                
            //merge deskripsi jarak periode
            deskripsi = prs+'% '+deskripsi.replace("_", " "+jarak_prio+" ");

            if(jarakA > 0){//kondisi jika ada 1 statement > input jarak hari
                var deskripsia = deskripsi.replace("#", " "+jarak_prioA+" ");
                deskripsi = deskripsia;
            }
      
           if(merge_deskripsi != ''){
               merge_deskripsi = merge_deskripsi + '\r\n' + deskripsi;
            }
            else{
                merge_deskripsi = deskripsi;
            }

            myObj = {"acak":acak,
                    "deskripsi":deskripsi,
                    "prs_top":prs,
                    "jarak":jarak,
                    "periodik":periodik,
            };
            Arr_term.push(myObj);
          }
          $('#termstxt').val(merge_deskripsi);
        //   console.log(Arr_term);
          $('#TermModal').modal('hide');
          $('#DescModal').modal('show');
          $('#DescModal').css('overflow-y', 'auto');
                    
        },
        error: function(xhr,status,error){
            console.log('Error Prosess Approval !!');
        }
    });

}

function simpanterm(data){
    $.ajax({
        url : base_url+'Quotation/simpan_term',
        type: "POST",
        data:{
                'data': JSON.stringify(dataArr),
                'data_h': JSON.stringify(dataArr_H)
                },
        datatype: 'JSON',
        // cache: false,
        success: function(data) {
                $('#DescModal').modal('hide');
                reload_table(); 
                attention('Update Quotation Berhasil');  
                                
        },
        error: function(xhr, status, error) {
            $('#DescModal').modal('hide');
            attention('Update Quotation Gagal');
        }
    });
}

function attention(info){
    $('.flash-info').css("display", "block");
    $('#flashing').html(info);
    $('.flash-info').delay(4000).fadeOut();
}

function openmsg(){
    var acak = $('#acak').val();
    $.ajax({
        url : base_url+'Quotation/getKomunikasi',
        type: "POST",
        data:{
                'acak': acak
                },
        datatype: 'JSON',
        // cache: false,
        success: function(data) {
            var Datax = JSON.parse(data).komunikasi;         
            $('#msgBody').html('<div class="container">'+Datax+'</div>');  

            $('#MsgModal').modal('show');
                                
        },
        error: function(xhr, status, error) {
            $('#DescModal').modal('hide');
            attention('Update Quotation Gagal');
        }
    });

   

}

function reload_table_d(){
    table_d.ajax.reload(null,false);
}
function reload_table(){
    table.ajax.reload(null,false);
}
function reload_table_cust(){
    table_cust.ajax.reload(null,false);
}
function reload_table_brg(){
    table_brg.ajax.reload(null,false);
}
function readonlyObject(values){
    $('#proyektxt').attr("disabled", values);
                $('#nmcusttxt').attr("disabled", values);
                $('#lokasitxt').attr("disabled", values);
                $('#UPtxt').attr("disabled", values);
                $('#telpnum').attr("disabled", values);
                $('#emailtxt').attr("disabled", values);
                $('#topdown').attr("disabled", values);
                $('#reftxt').attr("disabled", values);
                $('#estimasitxt').attr("disabled", values);
                $('#poquot').attr("disabled", values);
                $('#expquot').attr("disabled", values);
                $('#garansitxt').attr("disabled", values);
                $('#spektxt').attr("disabled", values);
                $('#prsppn').attr("disabled", values);
                $('#notestxt').attr("disabled", values);
                $('#termstxt').attr("disabled", true);
                $('#notes_produktxt').attr("disabled", values);
                $('#DescModal').attr("disabled", values);
}

function infoPeriod(n){
    switch(n) {
        case 'H':
            return 'Hari';
         break;
        case 'M':
            return 'Minggu';
         break;
        case 'B':
            return 'Bulan';
         break;
        default:
        // default value
       }  
}


function UpperFirst(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
  }