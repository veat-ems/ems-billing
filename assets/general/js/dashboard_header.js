/* ------------------------------------------------------------------------------
 *
 *  # Echarts - candlestick and other charts
 *
 *  Candlestick and other chart configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function () {
  function padDigits(number, digits) {
    //return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + numberWithCommas(number);
    return numberWithCommas(number);
  }

  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function fetchdata() {
    var_url = window.location.pathname;
    //  alert(window.location.pathname);

      /*
    var_pageno = var_url.substring(var_url.lastIndexOf('index/') + 6);
    */

    var_pageno = var_url.substring(var_url.lastIndexOf("/") + 1);
    if (var_pageno == "index") {
      var_pageno = 0;
    }

    var param_metergroupid = document.getElementById("param_metergroupid").value;
    // alert(param_metergroupid);

    $.ajax({
      url: "../../dashboard/datameter2/" + var_pageno,
      type: "post",
      success: function (data) {
        // alert(data);
        $data = "";
        dataku = JSON.parse(data);
        for (var i = 0; i < dataku.length; i++) {
          var obj = dataku[i];

          var c = obj.metergroupid;

          var val_variable0 = obj.active_energy; // active energy	// tkh
          var val_variable1 = obj.maximum_demand; // maximum demand
          var val_variable2 = obj.average_demand; // average demand
          var val_variable3 = obj.apparent_power; // apparent power
          var val_variable4 = obj.reactive_power; // reactive
          var val_dt0 = obj.date_time;

          var id_variable0 = "header_id_val_variable0_" + c; // tkh
          var id_variable1 = "header_id_val_variable1_" + c;
          var id_variable2 = "header_id_val_variable2_" + c;
          var id_variable3 = "header_id_val_variable3_" + c;
          var id_variable4 = "header_id_val_variable4_" + c;
          var id_dt0 = "header_id_val_dt0_" + c;

          var val_satuan0 = "kWh"; // tkh
          var val_satuan1 = "kW";
          var val_satuan2 = "kW";
          var val_satuan3 = "kVA";
          var val_satuan4 = "kVAR";

          var id_satuan0 = "header_id_val_satuan0_" + c; // tkh
          var id_satuan1 = "header_id_val_satuan1_" + c;
          var id_satuan2 = "header_id_val_satuan2_" + c;
          var id_satuan3 = "header_id_val_satuan3_" + c;
          var id_satuan4 = "header_id_val_satuan4_" + c;

        
          if (Math.abs(val_variable0) > 99999999) {
            val_variable0 = val_variable0 / 1000;
            val_satuan0 = "MWh";
          }
          if (Math.abs(val_variable1) > 99999999) {
            val_variable1 = val_variable1 / 1000;
            val_satuan1 = "MW";
          }
          if (Math.abs(val_variable2) > 99999999) {
            val_variable2 = val_variable2 / 1000;
            val_satuan2 = "MW";
          }
          if (Math.abs(val_variable3) > 99999999) {
            val_variable3 = val_variable3 / 1000;
            val_satuan3 = "MVA";
          }
          if (Math.abs(val_variable4) > 99999999) {
            val_variable4 = val_variable4 / 1000;
            val_satuan4 = "MVAR";
          }

          
          // format 1 decimal jika > 0, kl 0 di ignore
          if (Math.abs(val_variable0) > 0) {
          val_variable0 = val_variable0.toFixed(1);
          }
          if (Math.abs(val_variable1) > 0) {
            val_variable1 = val_variable1.toFixed(1);
          }
          if (Math.abs(val_variable2) > 0) {
            val_variable2 = val_variable2.toFixed(1);
          }
          if (Math.abs(val_variable3) > 0) {
            val_variable3 = val_variable3.toFixed(1);
          }
          if (Math.abs(val_variable4) > 0) {
            val_variable4 = val_variable4.toFixed(1);
          }
          
          // star if null / ''
          if (val_variable0 == null) {
            val_variable0 = "*";
          }
          if (val_variable1 == null) {
            val_variable1 = "*";
          }
          if (val_variable2 == null) {
            val_variable2 = "*";
          }
          if (val_variable3 == null) {
            val_variable3 = "*";
          }
          if (val_variable4 == null) {
            val_variable4 = "*";
          }
          if (val_dt0 == null) {
            val_dt0 = "*";
          }

                  // alert(c);
                  // alert(val_variable4);
                  // alert(id_variable4);
                  // alert(val_satuan4);
                  // alert(id_satuan4);
                 
                

                  if (param_metergroupid == c) {
                    // # If elemnet id not found in html page (even only 1), all datas will failed/not updated
                    document.getElementById(id_variable0).innerHTML = numberWithCommas(val_variable0); //  tkh
                    document.getElementById(id_variable1).innerHTML = numberWithCommas(val_variable1); //  tkh
                    document.getElementById(id_variable2).innerHTML = numberWithCommas(val_variable2); //  tkh
                    document.getElementById(id_variable3).innerHTML = numberWithCommas(val_variable3); //  tkh
                    document.getElementById(id_variable4).innerHTML = numberWithCommas(val_variable4); //  tkh
                    document.getElementById(id_dt0).innerHTML = val_dt0;

                    document.getElementById(id_satuan0).innerHTML = val_satuan0; //    tkh
                    document.getElementById(id_satuan1).innerHTML = val_satuan1; //    tkh
                    document.getElementById(id_satuan2).innerHTML = val_satuan2; //    tkh
                    document.getElementById(id_satuan3).innerHTML = val_satuan3; //    tkh
                    document.getElementById(id_satuan4).innerHTML = val_satuan4; //    tkh
                  }
        }

       
        // alert(json_encode($row)); 

      },
      complete: function (data) {
        setTimeout(fetchdata, 5000);
      },
    });
  }

  $(document).ready(function () {
    setTimeout(fetchdata, 5000);
  });
});
