var table;
var table_d;
var noprospect;
var noquotation;
var acak_quo;
var pricecek = 0;
var param;
var catagory = 0;

$(document).ready(function() {
 
    //autogetdata untuk refresh datatables
    // setInterval(function() {    
    //     reload_table();
    //   }, 60000);

    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
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

function v_detail(param1,param2){
    acak_quo = param1;
    collectdata(acak_quo,param2);
}
function editdata(param){
    acak_quo = $('#acak').val();
    collectdata(acak_quo,param);
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
   
    catagory = param2;
console.log(catagory);
    $.ajax({
        url : base_url+'Quotation/collect',
        type: "POST",
        data: {
            'acak_quotation': param1
            },
        datatype: 'JSON',
        success: function(data) {
        
            var NewObj = JSON.parse(data).datalist;
            console.log(NewObj.no_prospect);
            $('#DescModal').modal("show");  
            if(catagory==1){ //view
                $('#tombolquo').addClass( "d-none" );
                if(NewObj.chstatus > 0){
                    $('#tomboledit').addClass( "d-none" );
                }else{
                    $('#tomboledit').removeClass( "d-none" );
                }
                $('#tombolview').removeClass( "d-none" );
                readonlyObject(true);      
            }
            else{ //editable
                $('#tombolview').addClass( "d-none" );
                $('#tomboledit').addClass( "d-none" );
                $('#tombolquo').removeClass( "d-none" );
                readonlyObject(false);
            
            }

            acak_quo = NewObj.acak;
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
            $('#reftxt').val(NewObj.referensi);
            $('#expquot').val(NewObj.exp_quotation);
            $('#garansitxt').val(NewObj.masa_garansi);
            $('#spektxt').val(NewObj.spec);
            $('#prsppn').val(NewObj.prs_ppn);
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
            
            reload_table_d();                  
        },
        error: function(xhr, status, error) {
         $('#DescModal').modal('hide');
         attention('Proses Quotation Gagal');
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

                total += parseInt(h_jual);
                var myObject = {};

                myObject = {"acak":acak,
                            "nopracost":nopcost,
                            "new_hrg_jual":h_jual,
                            "new_nmbarang":nmbarang,
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
                        "note_produk":notes_produk
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

function attention($info){
    $('.flash-info').css("display", "block");
    $('#flashing').html($info);
    $('.flash-info').delay(4000).fadeOut();
}

function reload_table_d(){
    table_d.ajax.reload(null,false);
}
function reload_table(){
    table.ajax.reload(null,false);
}
function readonlyObject(values){
    $('#proyektxt').attr("disabled", values);
                $('#nmcusttxt').attr("disabled", values);
                $('#lokasitxt').attr("disabled", values);
                $('#UPtxt').attr("disabled", values);
                $('#telpnum').attr("disabled", values);
                $('#emailtxt').attr("disabled", values);
                $('#reftxt').attr("disabled", values);
                $('#estimasitxt').attr("disabled", values);
                $('#expquot').attr("disabled", values);
                $('#garansitxt').attr("disabled", values);
                $('#spektxt').attr("disabled", values);
                $('#prsppn').attr("disabled", values);
                $('#notestxt').attr("disabled", values);
                $('#termstxt').attr("disabled", values);
                $('#notes_produktxt').attr("disabled", values);
                $('#DescModal').attr("disabled", values);
}
