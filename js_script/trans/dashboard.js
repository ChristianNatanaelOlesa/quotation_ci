
$(document).ready(function() {

  setInterval(function() {    
        collectData();
        }, 5000);


});

function collectData(){
    $.ajax({
        url : base_url+'Utility/dataready',
        type: "POST",
        datatype: 'JSON',
        success: function(data) {
          
          // console.log($.trim(data.sum_quotation.totalQ));
          // if($.trim(data.sum_quotation)){
            var quomontly = parseInt(JSON.parse(data).sum_quotation.totalQ);
            $('#prospectready').html(JSON.parse(data).count_prospect);
            $('#quomonthly').html(rupiahFormating(quomontly));
            // }
                             
        },
        error: function(xhr, status, error) {
        alert('Problem Connection to Server');
        }
   });
}


function rupiahFormating(num){
    var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
      parts = str.split(".");
      str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
      if(str[j] != ",") {
        output.push(str[j]);
        if(i%3 == 0 && j < (len - 1)) {
          output.push(",");
        }
        i++;
      }
    }
    formatted = output.reverse().join("");
    return("Rp. " + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
  };
