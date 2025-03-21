$(function () {

  function padDigits(number, digits) {
    return numberWithCommas(number);
  }

  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function fetchdata() {
    var_url = window.location.pathname;

    var_pageno = var_url.substring(var_url.lastIndexOf("/") + 1);
    if (var_pageno == "index") {
      var_pageno = 0;
    }

    $.ajax({
      url: "../../dashboardall/datameter/" + var_pageno,
      type: "post",
      success: function (data) {
        dataku = JSON.parse(data);
        for (var i = 0; i < dataku.length; i++) {
          var obj = dataku[i];

          var c = obj.id_meter;

          var val_variable0 = obj.variable0; // active energy	// tkh
          var val_variable1 = obj.variable1; // maximum demand
          var val_variable2 = obj.variable2; // average demand
          var val_variable3 = obj.variable3; // apparent power
          var val_variable4 = obj.variable4; // reactive
          var val_dt0 = obj.date_time;

          var dt_color = '#f9636b';

					var now = new Date();
					var dt_test = new Date();

					dt_test.setTime(now.getTime() + (30 * 60 * 1000));

					var diffMs = (now - new Date(val_dt0)); // milliseconds between now & dt
					var diffMins = Math.round(diffMs / 60000); // minutes

          if (diffMins < 60) {
						dt_color = 'orange';
					}
					if (diffMins < 30) {
						dt_color = 'lightgreen';
					}

          var id_variable0 = "id_val_variable0_" + c; // tkh
          var id_variable1 = "id_val_variable1_" + c;
          var id_variable2 = "id_val_variable2_" + c;
          var id_variable3 = "id_val_variable3_" + c;
          var id_variable4 = "id_val_variable4_" + c;
          var id_dt0 = "id_val_dt0_" + c;

          var val_satuan0 = "KWH"; // tkh
          var val_satuan1 = "V";
          var val_satuan2 = "A";
          var val_satuan3 = "KVA";
          var val_satuan4 = "W";

          var id_satuan0 = "id_val_satuan0_" + c; // tkh
          var id_satuan1 = "id_val_satuan1_" + c;
          var id_satuan2 = "id_val_satuan2_" + c;
          var id_satuan3 = "id_val_satuan3_" + c;
          var id_satuan4 = "id_val_satuan4_" + c;

          if (Math.abs(val_variable0) > 99999999) {
            val_variable0 = val_variable0 / 1000;
            val_satuan0 = "MWh";
          }
          if (Math.abs(val_variable1) > 99999999) {
            val_variable1 = val_variable1 / 1000;
            val_satuan1 = "KV";
          }
          if (Math.abs(val_variable2) > 99999999) {
            val_variable2 = val_variable2 / 1000;
            val_satuan2 = "KA";
          }
          if (Math.abs(val_variable3) > 99999999) {
            val_variable3 = val_variable3 / 1000;
            val_satuan3 = "MVA";
          }
          if (Math.abs(val_variable4) > 99999999) {
            val_variable4 = val_variable4 / 1000;
            val_satuan4 = "KW";
          }

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
          
          // # If elemnet id not found in html page (even only 1), all datas will failed/not updated
          document.getElementById(id_variable0).innerHTML = numberWithCommas(val_variable0); //  tkh
          document.getElementById(id_variable1).innerHTML = numberWithCommas(val_variable1); //  tkh
          document.getElementById(id_variable2).innerHTML = numberWithCommas(val_variable2); //  tkh
          document.getElementById(id_variable3).innerHTML = numberWithCommas(val_variable3); //  tkh
          document.getElementById(id_variable4).innerHTML = numberWithCommas(val_variable4); //  tkh
          document.getElementById(id_dt0).innerHTML = val_dt0;
          document.getElementById(id_dt0).style.color = dt_color;

          document.getElementById(id_satuan0).innerHTML = val_satuan0; //    tkh
          document.getElementById(id_satuan1).innerHTML = val_satuan1; //    tkh
          document.getElementById(id_satuan2).innerHTML = val_satuan2; //    tkh
          document.getElementById(id_satuan3).innerHTML = val_satuan3; //    tkh
          document.getElementById(id_satuan4).innerHTML = val_satuan4; //    tkh
        }
      },

    });
  }
  const socket = io("http://localhost:3001");

  socket.on("update_data", (data) => {
    // console.log("Data updated:", data);
    fetchdata();
  });

  $(document).ready(function () {
    setTimeout(fetchdata, 1000);
  });
});
