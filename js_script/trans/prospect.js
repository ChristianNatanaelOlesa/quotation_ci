var table;
var table_d;
var noprospect;
var noprospectus;
var pricecek = 0;

$(document).ready(function() {
 
    //autogetdata untuk refresh datatables
    // setInterval(function() {    
    //     reload_table();
    //     }, 60000);
        
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url" : base_url+'Prospect/ajax_list',
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
 
        "processing": true, 
        "serverSide": true, 
        "searching": false, "paging": false, "info": false,"bSort": false,
        "bAutoWidth" : false,
        "aoColumns" : [
            { sWidth: '5%' },
            { sWidth: '10%' },
            { sWidth: '10%' },
            { sWidth: '5%' },
            { sWidth: '5%' },
            { sWidth: '15%' },
            { sWidth: '15%' },
            { sWidth: '15%' },
            { sWidth: '20%' }
          ],
        "ajax": {
            "url" : base_url+'Prospect/ajax_list_d',
            "type": "POST",
            "data": function(x){
                x.noprospect=noprospectus
            }
        },

        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false, 
        },
        ],
    });

    $('#proyektxt').keyup(function(){
        this.value = this.value.toUpperCase();
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
    $('#telpnum').keyup(function(){
        var intRegex = /^\d+$/;
        if(!intRegex.test(this.value)) {
            $('#telpnum').val('');
        }

    });
    $('#prsppn').keyup(function(){
        var intRegex = /^\d+$/;
        if(!intRegex.test(this.value)) {
            $('#prsppn').val('');
        }

    });

 
});


function getTOP(){

    $.ajax({
        url : base_url+'Top/getTop',
        type: "POST",
        datatype: 'JSON',
        success: function(data) {
            var x = JSON.parse(data);
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

function v_detail(params){
        noprospectus = params;
        $.ajax({
            url : base_url+'Prospect/views',
            type: "POST",
            data: {
                'noprospect': noprospectus
                },
            datatype: 'JSON',
            success: function(data) {
                $('#DescModal').modal("show");
                $('#noprospectus').val(JSON.parse(data).noprospect);
                $('#nmcusttxt').val(JSON.parse(data).nmcustomer.toUpperCase());
                $('#proyektxt').val(JSON.parse(data).nmproyek.toUpperCase());
                $('#prsppn').val(10);
                $('#notestxt').val(JSON.parse(data).notes);
                $('#termstxt').val(JSON.parse(data).terms);
                $('#estimasitxt').val(JSON.parse(data).estimasi);
                $('#subtotalnum').addClass( "text-right" );
                $('#ppnnum').addClass( "text-right" );
                $('#totalnum').addClass( "text-right" );
                $('#subtotalnum').attr("disabled", true);
                $('#ppnnum').attr("disabled", true);
                $('#totalnum').attr("disabled", true);
                $('#totalnum').attr("disabled", true);
                reload_table_d();  
                
                getTOP();
                
            },
            error: function(xhr, status, error) {
             $('#DescModal').modal('hide');
             attention('Proses Quotation Gagal');
            }
       });
}

// function generateSchedule(param){

//     $.ajax({
//            url : base_url+'Top/generate_sch',
//            type : "POST",
//            data : {
//                'top_code':param
//            },
//            datatype : "JSON",
//            success: function(data){
//                console.log(data);
//            },
//            error: function(xhr,status,error){
   
//            }
//     });
//    }
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
   
    var lop = 0;
    var data = table_d.rows().data();
    var total = 0;

    data.each(function (value, index) {
        lop = lop+1;

        var h_jual = $('#row-jual'+lop).val();
        h_jual = h_jual.replace(/^0+/, '');
        $('#row-jual'+lop).val(h_jual);
        
        // protect input selain angka
        var intRegex = /^\d+$/;
        if(!intRegex.test(h_jual)) {
            $('#row-jual'+lop).val('');
        }
        // protect input selain angka

        if(h_jual == ''){
            h_jual = 0;
        }
            total += parseInt(h_jual);
        });
        
    $('#subtotalnum').val(total.toFixed(2));
    var ppnum = total * parseInt($('#prsppn').val()) / 100;
    $('#ppnnum').val(ppnum.toFixed(2));
    var grand_total = total + ppnum;
    $('#totalnum').val(grand_total.toFixed(2));

}

function cek_Quotation(params){
    noprospectus = params;
    $.ajax({
        url : base_url+'Prospect/getInfo_Quotaion',
        type: "POST",
        data: {
            'noprospect': noprospectus
            },
        datatype: 'JSON',
        success: function(data) {

            alert('Data sudah Proses Quotation');            
        },
        error: function(xhr, status, error) {
         $('#DescModal').modal('hide');
         attention('Proses Quotation Gagal');
        }
   });
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
            // console.log(merge_deskripsi);

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



function simpandata() { 
    noprospect =   $('#noprospectus').val();
     var data = table_d.rows().data();
     var i = '';
     var lop = 0;
     var verify = true;
     var dataArr = [];
     var dataArr_H = [];
     var tglexp = $("#expquot").val();  
     var total = 0;
     var ppnnum = 0;
     var grand_total = 0;
     var myObject_H = {};
     var cek  = true;
     var qtty = 0;
     var unit = 0;
     
     data.each(function (value, index) {
         //  console.log(`For index ${index}, data value is ${value}`);
         lop = lop+1;
         nopcost = value[1];
         tipe_prospect = value[2];
         qtty = value[3];
        //  console.log(qtty);
          unit = value[4];
          tgl_prospect = value[12];
          tgl_pcost = value[13];
          tgl_fspec = value[14];
          tgl_rilis = value[15];
          h_pcost = value[9];
          h_awal = value[10];
          h_dasar = value[11];
          h_jual = $('#row-jual'+lop).val();
          console.log($('#proyektxt').val());
          if(h_dasar >= h_jual){
                delete myObject;
                cek = false;
                alert('Ditemukan Harga Item lebih rendah / sama dengan dari Harga Dasar\nSilahkan cek pada Item. '+nopcost);
            }
            else{
                customer = ($('#nmcusttxt').val()=='')? cek = cekvalidasi($('#nmcusttxt').val(),$('#nmcusttxt').attr("aria-label")):$('#nmcusttxt').val();
                proyek = ($('#proyektxt').val()=='')? cek = cekvalidasi($('#proyektxt').val(),$('#proyektxt').attr("aria-label")):$('#proyektxt').val();
                lokasi = ($('#lokasitxt').val()=='')? cek = cekvalidasi($('#lokasitxt').val(),$('#lokasitxt').attr("aria-label")):$('#lokasitxt').val();

                if(!cek){
                    return false;
                }

                up = $('#UPtxt').val();
                telp = $('#telpnum').val();
                emails = $('#emailtxt').val();
                npwp = $('#npwpnum').val();
                referensi = $('#reftxt').val();
                spec   = $('#spektxt').val();
                estimasi  = $('#estimasitxt').val();
                prs_ppn = $('#prsppn').val();
                notes = $('#notestxt').val();
                terms = $('#termstxt').val();
                garansi = $('#garansitxt').val();
                term_of_pay = $('#topdown').val();

                total += parseInt($('#row-jual'+lop).val());

                if(h_jual == 0){
                    verify  = false;
                    return false;
                }else{
                    var myObject = {};
                    myObject = {
                                "nopracost":nopcost,
                                "tipeprospect":tipe_prospect,
                                "qtty":qtty,
                                "unit":unit,
                                "tglprospect":tgl_prospect,
                                "tglpracost":tgl_pcost,
                                "tglformspec":tgl_fspec,
                                "tglrilis":tgl_rilis,
                                "hrg_pracost":h_pcost,
                                "hrg_awal":h_awal,
                                "hrg_dasar":h_dasar,
                                "hrg_jual":h_jual,
                            };
                    dataArr.push(myObject);
                }
            }
        });
        if(cek){
            ppnnum = total * (prs_ppn / 100);
            grand_total = total + ppnnum;

            myObject_H = {"noprospect":noprospect,"customer":customer,
                            "proyek":proyek,
                            "lokasi":lokasi,
                            "telp":telp,
                            "up":up,
                            "emails":emails,
                            "npwp":npwp,
                            "referensi":referensi,
                            "spec":spec,
                            "estimasi":estimasi,
                            "top_code":term_of_pay,
                            "total":total,
                            "prs_ppn":prs_ppn,
                            "ppnum":ppnnum,
                            "grandtotal":grand_total,
                            "expired":tglexp,
                            "notes":notes,
                            "terms":terms,
                            "garansi":garansi
                        };
                dataArr_H.push(myObject_H);

                if(!verify){
                            $('#DescModal').modal('hide');
                            attention('Gagal Proses, Harga Jual masih ada yang kosong')
                            dataArr = [];
                }
                else{
                    $.ajax({
                        url : base_url+'Prospect/simpan_data',
                        type: "POST",
                        properties: {
                            "hrg_jual": {
                            "type": "integer"
                            }},
                        data:{
                                'data': JSON.stringify(dataArr),
                                'data_h': JSON.stringify(dataArr_H)
                                },
                        datatype: 'JSON',
                        // cache: false,
                        success: function(data) {
                            console.log(data);
                                $('#DescModal').modal('hide');
                                reload_table();    

                                attention('Proses Quotation Berhasil');  

                        },
                        error: function(xhr, status, error) {
                            $('#DescModal').modal('hide');
                            attention('Proses Quotation Gagal');
                        }
                    });
                
                }
        }
}

function cekvalidasi(vals,objt){
    if(vals==''){
        alert('Kolom Input '+ objt +' masih kosong.\nMohon cek kembali inputan anda.');
        return false;
    }
    else{
        return vals;
    }
}

function attention($info){
    $('.flash-info').css("display", "block");
    $('#flashing').html($info);
    $('.flash-info').delay(4000).fadeOut();
}

function reload_table(){
    table.ajax.reload(null,false);
}
function reload_table_d(){
    table_d.ajax.reload(null,false);
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