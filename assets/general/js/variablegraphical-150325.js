$(function () {
  function padDigits(number, digits) {
    // return (
    //   Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number
    // );
    return number
    ;
  }

  function NamaMeterku(meterku) {
    document.getElementById("namameter").innerHTML = meterku;
  }

  function IDMeterku(idmeterku) {
    document.getElementById("meterid").value = idmeterku;
  }

  function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
      var pair = vars[i].split("=");
      if (pair[0] == variable) {
        return pair[1];
      }
    }
    return false;
  }

  // Set paths
  // ------------------------------

  require.config({
    paths: {
      echarts: "assets/vendor/echarts",
    },
  });

  // Configuration
  // ------------------------------

  require(// Add necessary charts
    ["echarts", "echarts/theme/limitless", "echarts/chart/gauge"], // Charts setup
    function (ec, limitless) {
      // Initialize charts
      // ------------------------------

      var gauge_v1 = ec.init(document.getElementById("gauge_v1"), limitless);
      var gauge_v2 = ec.init(document.getElementById("gauge_v2"), limitless);
      var gauge_v3 = ec.init(document.getElementById("gauge_v3"), limitless);
      var gauge_v12 = ec.init(document.getElementById("gauge_v12"), limitless);
      var gauge_v23 = ec.init(document.getElementById("gauge_v23"), limitless);
      var gauge_v31 = ec.init(document.getElementById("gauge_v31"), limitless);
      var gauge_i1 = ec.init(document.getElementById("gauge_i1"), limitless);
      var gauge_i2 = ec.init(document.getElementById("gauge_i2"), limitless);
      var gauge_i3 = ec.init(document.getElementById("gauge_i3"), limitless);
      var gauge_kw = ec.init(document.getElementById("gauge_kw"), limitless);
      var gauge_kva = ec.init(document.getElementById("gauge_kva"), limitless);

      // Charts options
      // ------------------------------

      $("#panelpilih").hide();
      $("#btDashboard").hide();

      clearInterval(timeTicketkva);
      var timeTicketkva = setInterval(function () {
        var currentLocation = window.location;
        var path = currentLocation.pathname;
        var param = currentLocation.params;
        var path_array = path.split("/");
        var path01 = path_array[0];
        var path02 = path_array[1];
        var path03 = path_array[2];
        var path04 = path_array[4];
        if (path04 == null) {
          var path05 = "KOSONG";
        } else {
          var path05 = "ADAAAA";
        }

        var idbaruku = getQueryVariable("id");
        var idbaruku_name = getQueryVariable("idname");

        if (idbaruku == false) {
          var meterid = $("#meterid").val();
          var metername = $("#meterid option:selected").text();
          $("#panelpilih").show();
          $("#btDashboard").hide();
        } else {
          var meterid = unescape(idbaruku);
          if (idbaruku_name == false) {
            var metername = unescape(idbaruku);
          } else {
            var metername = unescape(idbaruku_name);
          }

          $("#panelpilih").hide();
          $("#btDashboard").show();
        }

        var linkku = "variablegraphical/datameter";
        var dataposku = "id=" + escape(meterid);
        // document.getElementById("demourl").innerHTML = path01+'-'+path02+'-'+path03+'-'+path04+'-'+path05+'-'+param+'-METERID='+meterid;

        NamaMeterku(metername);
        Meter_V1(linkku, dataposku);
        setTimeout(Meter_V2(linkku, dataposku), 2000);
        setTimeout(Meter_V3(linkku, dataposku), 2000);
        setTimeout(Meter_V12(linkku, dataposku), 2000);
        setTimeout(Meter_V23(linkku, dataposku), 2000);
        setTimeout(Meter_V31(linkku, dataposku), 2000);
        setTimeout(Meter_I1(linkku, dataposku), 2000);
        setTimeout(Meter_I2(linkku, dataposku), 2000);
        setTimeout(Meter_I3(linkku, dataposku), 2000);
        setTimeout(Meter_kWh(linkku, dataposku), 2000);
        setTimeout(Meter_kVARh(linkku, dataposku), 2000);
        setTimeout(Meter_Lain(linkku, dataposku), 2000);
      }, 5000);   //set query update interval

      $("#meterid").change(function (e) {
        clearInterval(timeTicketkva);
        var timeTicketkva = setInterval(function () {
          var meterid2 = $("#meterid").val();
          var metername2 = $("#meterid option:selected").text();
          var linkku2 = "variablegraphical/datameter";
          var dataposku2 = "id=" + escape(meterid2);
          //NamaMeterku(meterid2);
          NamaMeterku(metername2);
          Meter_V1(linkku2, dataposku2);
          Meter_V2(linkku2, dataposku2);
          Meter_V3(linkku2, dataposku2);
          Meter_V12(linkku2, dataposku2);
          Meter_V23(linkku2, dataposku2);
          Meter_V31(linkku2, dataposku2);
          Meter_I1(linkku2, dataposku2);
          Meter_I2(linkku2, dataposku2);
          Meter_I3(linkku2, dataposku2);
          Meter_kWh(linkku2, dataposku2);
          Meter_kVARh(linkku2, dataposku2);
          Meter_Lain(linkku2, dataposku2);
        }, 30000);
      });

      function Meter_V1(link, datapost) {
        var data_V1 = [];
        var obj = [];
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            var data_V1 = JSON.parse(data);
            var obj = data_V1[0];
            var v_nom = parseFloat(obj.v_nominal);
            //  IF(H2>25000,35000,IF(H2>10000,25000,IF(H2>5000,8000,500))) LL
            //  IF(H2>25000,22000,IF(H2>10000,18000,IF(H2>5000,5000,250))) LN
            var set_max = 250;
            if (v_nom > 25000) {
              set_max = 23000;
            } else if (v_nom > 10000) {
              set_max = 16000;
            } else if (v_nom > 5000) {
              set_max = 5000;
            }

            var al_c_0 = 0.6;
            var al_c_1 = 0.7;
            var al_c_2 = 0.9;
            //  var set_max = parseFloat(obj.v_nominal) <= 150 ? 150 : 300;
            //  var al_c_0 = set_max == 150 ? 0.65 : 0.58;
            //  var al_c_1 = set_max == 150 ? 0.78 : 0.69;
            //  var al_c_2 = set_max == 150 ? 0.95 : 0.84;

            //97.50   117.00  130.00  143.00
            //172.50  207.00  230.00  253.00
            //
            //0.65    0.78    150.00  0.95
            //0.58    0.69    300.00  0.84

            //
            // Basic V1
            //

            // Setup chart
            gauge_v1_options = {
              backgroundColor: "#FFFFFF",
              tooltip: {
                formatter: "{c} V",
                // formatter: "{a} <br/>{b} : {c} V",
              },
              series: [
                {
                  name: "V1",
                  type: "gauge",
                  startAngle: 170,
                  endAngle: 10,
                  center: ["50%", "90%"],
                  min: 0,
                  max: set_max,
                  splitNumber: 5,
                  //axisLine: {
                  //		 lineStyle: {
                  //		 		width: -20
                  //		 }
                  //},

                  // Axis line
                  axisLine: {
                    lineStyle: {
                      color: [
                        [al_c_0, "#ff0000"],
                        [al_c_1, "orange"],
                        [al_c_2, "#00b300"],
                        [1, "orange"],
                      ],
                      width: -20,
                    },
                  },

                  axisTick: {
                    splitNumber: 5,
                    length: -30,
                  },
                  axisLabel: {
                    textStyle: {
                      color: "#b40000",
                      fontSize: 10,
                      fontWeight: "bolder",
                    },
                  },
                  splitLine: {
                    length: -55,
                    lineStyle: {
                      color: "#fff",
                    },
                  },

                  pointer: {
                    width: 5,
                    length: "160%",
                    color: "rgba(51, 51, 155, 0.8)",
                  },

                  title: {
                    show: true,
                    offsetCenter: [0, "-50%"],
                    textStyle: {
                      color: "#B40000",
                      fontSize: 20,
                    },
                  },
                  detail: {
                    show: false,
                    backgroundColor: "rgba(0,0,0,0)",
                    borderWidth: 5,
                    borderColor: "rgba(0,0,0,0)",
                    width: 200,
                    height: 50,
                    offsetCenter: [50, -25],
                    formatter: "{value} V",
                    textStyle: {
                      fontSize: 18,
                    },
                  },
                  data: [{ value: 50, name: "V1" }],
                },
              ],
            };

            gauge_v1_options.series[0].data[0].value = obj.v1;
            gauge_v1.setOption(gauge_v1_options, true);
            gauge_v1.setOption(gauge_v1_options);
            document.getElementById("gauge_v1_back").innerHTML =
              obj.v1_formatted + " V";

            // selesai grafik
          },

          error: function (errmsg) {
            //alert("Ajax??????????!"+ errmsg);
          },
        });
      }

      function Meter_V2(link, datapost) {
        var data_V2 = [];
        var obj = [];
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            var data_V2 = JSON.parse(data);
            var obj = data_V2[0];
            var v_nom = parseFloat(obj.v_nominal);
            //  IF(H2>25000,35000,IF(H2>10000,25000,IF(H2>5000,8000,500))) LL
            //  IF(H2>25000,22000,IF(H2>10000,18000,IF(H2>5000,5000,250))) LN
            var set_max = 250;
            if (v_nom > 25000) {
              set_max = 23000;
            } else if (v_nom > 10000) {
              set_max = 16000;
            } else if (v_nom > 5000) {
              set_max = 5000;
            }

            var al_c_0 = 0.6;
            var al_c_1 = 0.7;
            var al_c_2 = 0.9;

            //
            // Basic V1
            //

            // Setup chart
            gauge_v2_options = {
              backgroundColor: "#FFFFFF",
              tooltip: {
                formatter: "{c} V",
                // formatter"{a} <br/>{b} : {c}V",
              },
              series: [
                {
                  name: "V2",
                  type: "gauge",
                  startAngle: 170,
                  endAngle: 10,
                  center: ["50%", "90%"],
                  min: 0,
                  max: set_max,
                  splitNumber: 5,
                  //axisLine: {
                  //       lineStyle: {
                  //              width: -20
                  //       }
                  //},

                  // Axis line
                  axisLine: {
                    lineStyle: {
                      color: [
                        [al_c_0, "#ff0000"],
                        [al_c_1, "orange"],
                        [al_c_2, "#00b300"],
                        [1, "orange"],
                      ],
                      width: -20,
                    },
                  },

                  axisTick: {
                    splitNumber: 5,
                    length: -30,
                  },
                  axisLabel: {
                    textStyle: {
                      color: "#b40000",
                      fontSize: 10,
                      fontWeight: "bolder",
                    },
                  },
                  splitLine: {
                    length: -55,
                    lineStyle: {
                      color: "#fff",
                    },
                  },
                  pointer: {
                    width: 5,
                    length: "160%",
                    color: "rgba(51, 51, 155, 0.8)",
                  },
                  title: {
                    show: true,
                    offsetCenter: [0, "-50%"],
                    textStyle: {
                      color: "#B40000",
                      fontSize: 20,
                    },
                  },
                  detail: {
                    show: false,
                    backgroundColor: "rgba(0,0,0,0)",
                    borderWidth: 5,
                    borderColor: "rgba(0,0,0,0)",
                    width: 200,
                    height: 50,
                    offsetCenter: [50, -25],
                    formatter: "{value} V",
                    textStyle: {
                      fontSize: 18,
                    },
                  },
                  data: [{ value: 50, name: "V2" }],
                },
              ],
            };

            gauge_v2_options.series[0].data[0].value = obj.v2;
            gauge_v2.setOption(gauge_v2_options, true);
            gauge_v2.setOption(gauge_v2_options);
            document.getElementById("gauge_v2_back").innerHTML =
              obj.v2_formatted + " V";

            // selesai grafik
          },

          error: function (errmsg) {
            //alert("Ajax??????????!"+ errmsg);
          },
        });
      }

      function Meter_V3(link, datapost) {
        var data_V3 = [];
        var obj = [];
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            var data_V3 = JSON.parse(data);
            var obj = data_V3[0];
            var v_nom = parseFloat(obj.v_nominal);
            //  IF(H2>25000,35000,IF(H2>10000,25000,IF(H2>5000,8000,500))) LL
            //  IF(H2>25000,22000,IF(H2>10000,18000,IF(H2>5000,5000,250))) LN
            var set_max = 250;
            if (v_nom > 25000) {
              set_max = 23000;
            } else if (v_nom > 10000) {
              set_max = 16000;
            } else if (v_nom > 5000) {
              set_max = 5000;
            }

            var al_c_0 = 0.6;
            var al_c_1 = 0.7;
            var al_c_2 = 0.9;
            //
            // Basic V1
            //

            // Setup chart
            gauge_v3_options = {
              backgroundColor: "#FFFFFF",
              tooltip: {
                formatter: "{c} V",
                // formatter"{a} <br/>{b} : {c}V",
              },
              series: [
                {
                  name: "V3",
                  type: "gauge",
                  startAngle: 170,
                  endAngle: 10,
                  center: ["50%", "90%"],
                  min: 0,
                  max: set_max,
                  splitNumber: 5,
                  //axisLine: {
                  //       lineStyle: {
                  //              width: -20
                  //       }
                  //},

                  // Axis line
                  axisLine: {
                    lineStyle: {
                      color: [
                        [al_c_0, "#ff0000"],
                        [al_c_1, "orange"],
                        [al_c_2, "#00b300"],
                        [1, "orange"],
                      ],
                      width: -20,
                    },
                  },

                  axisTick: {
                    splitNumber: 5,
                    length: -30,
                  },
                  axisLabel: {
                    textStyle: {
                      color: "#b40000",
                      fontSize: 10,
                      fontWeight: "bolder",
                    },
                  },
                  splitLine: {
                    length: -55,
                    lineStyle: {
                      color: "#fff",
                    },
                  },
                  pointer: {
                    width: 5,
                    length: "160%",
                    color: "rgba(51, 51, 155, 0.8)",
                  },
                  title: {
                    show: true,
                    offsetCenter: [0, "-50%"],
                    textStyle: {
                      color: "#B40000",
                      fontSize: 20,
                    },
                  },
                  detail: {
                    show: false,
                    backgroundColor: "rgba(0,0,0,0)",
                    borderWidth: 5,
                    borderColor: "rgba(0,0,0,0)",
                    width: 200,
                    height: 50,
                    offsetCenter: [50, -25],
                    formatter: "{value} V",
                    textStyle: {
                      fontSize: 18,
                    },
                  },
                  data: [{ value: 50, name: "V3" }],
                },
              ],
            };

            gauge_v3_options.series[0].data[0].value = obj.v3;
            gauge_v3.setOption(gauge_v3_options, true);
            gauge_v3.setOption(gauge_v3_options);
            document.getElementById("gauge_v3_back").innerHTML =
              obj.v3_formatted + " V";

            // selesai grafik
          },

          error: function (errmsg) {
            //alert("Ajax??????????!"+ errmsg);
          },
        });
      }

      function Meter_V12(link, datapost) {
        var data_V12 = [];
        var obj = [];
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            var data_V12 = JSON.parse(data);
            var obj = data_V12[0];
            var v_nom = parseFloat(obj.v_nominal);
            //  IF(H2>25000,40000,IF(H2>10000,25000,IF(H2>5000,8000,500))) LL
            //  IF(H2>25000,22000,IF(H2>10000,18000,IF(H2>5000,5000,250))) LN
            var set_max = 500;
            if (v_nom > 25000) {
              set_max = 40000;
            } else if (v_nom > 10000) {
              set_max = 25000;
            } else if (v_nom > 5000) {
              set_max = 8000;
            }

            var al_c_0 = 0.6;
            var al_c_1 = 0.7;
            var al_c_2 = 0.9;
            //
            // Basic V1
            //

            // Setup chart
            gauge_v12_options = {
              backgroundColor: "#FFFFFF",
              tooltip: {
                formatter: "{c} V",
                // formatter"{a} <br/>{b} : {c}V",
              },
              series: [
                {
                  name: "V12",
                  type: "gauge",
                  startAngle: 170,
                  endAngle: 10,
                  center: ["50%", "90%"],
                  min: 0,
                  max: set_max,
                  splitNumber: 5,
                  //axisLine: {
                  //       lineStyle: {
                  //              width: -20
                  //       }
                  //},

                  // Axis line
                  axisLine: {
                    lineStyle: {
                      color: [
                        [al_c_0, "#ff0000"],
                        [al_c_1, "orange"],
                        [al_c_2, "#00b300"],
                        [1, "orange"],
                      ],
                      width: -20,
                    },
                  },

                  axisTick: {
                    splitNumber: 5,
                    length: -30,
                  },
                  axisLabel: {
                    textStyle: {
                      color: "#b40000",
                      fontSize: 10,
                      fontWeight: "bolder",
                    },
                  },
                  splitLine: {
                    length: -55,
                    lineStyle: {
                      color: "#fff",
                    },
                  },
                  pointer: {
                    width: 5,
                    length: "160%",
                    color: "rgba(51, 51, 155, 0.8)",
                  },
                  title: {
                    show: true,
                    offsetCenter: [0, "-50%"],
                    textStyle: {
                      color: "#B40000",
                      fontSize: 20,
                    },
                  },
                  detail: {
                    show: false,
                    backgroundColor: "rgba(0,0,0,0)",
                    borderWidth: 5,
                    borderColor: "rgba(0,0,0,0)",
                    width: 200,
                    height: 50,
                    offsetCenter: [50, -25],
                    formatter: "{value} V",
                    textStyle: {
                      fontSize: 18,
                    },
                  },
                  data: [{ value: 50, name: "V12" }],
                },
              ],
            };

            gauge_v12_options.series[0].data[0].value = obj.v12;
            gauge_v12.setOption(gauge_v12_options, true);
            gauge_v12.setOption(gauge_v12_options);
            document.getElementById("gauge_v12_back").innerHTML =
              obj.v12_formatted + " V";

            // selesai grafik
          },

          error: function (errmsg) {
            //alert("Ajax??????????!"+ errmsg);
          },
        });
      }

      function Meter_V23(link, datapost) {
        var data_V23 = [];
        var obj = [];
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            var data_V23 = JSON.parse(data);
            var obj = data_V23[0];
            var v_nom = parseFloat(obj.v_nominal);
            //  IF(H2>25000,40000,IF(H2>10000,25000,IF(H2>5000,8000,500))) LL
            //  IF(H2>25000,22000,IF(H2>10000,18000,IF(H2>5000,5000,250))) LN
            var set_max = 500;
            if (v_nom > 25000) {
              set_max = 40000;
            } else if (v_nom > 10000) {
              set_max = 25000;
            } else if (v_nom > 5000) {
              set_max = 8000;
            }

            var al_c_0 = 0.6;
            var al_c_1 = 0.7;
            var al_c_2 = 0.9;
            // Basic V1
            //

            // Setup chart
            gauge_v23_options = {
              backgroundColor: "#FFFFFF",
              tooltip: {
                formatter: "{c} V",
                // formatter"{a} <br/>{b} : {c}V",
              },
              series: [
                {
                  name: "V12",
                  type: "gauge",
                  startAngle: 170,
                  endAngle: 10,
                  center: ["50%", "90%"],
                  min: 0,
                  max: set_max,
                  splitNumber: 5,
                  //axisLine: {
                  //       lineStyle: {
                  //              width: -20
                  //       }
                  //},

                  // Axis line
                  axisLine: {
                    lineStyle: {
                      color: [
                        [al_c_0, "#ff0000"],
                        [al_c_1, "orange"],
                        [al_c_2, "#00b300"],
                        [1, "orange"],
                      ],
                      width: -20,
                    },
                  },

                  axisTick: {
                    splitNumber: 5,
                    length: -30,
                  },
                  axisLabel: {
                    textStyle: {
                      color: "#b40000",
                      fontSize: 10,
                      fontWeight: "bolder",
                    },
                  },
                  splitLine: {
                    length: -55,
                    lineStyle: {
                      color: "#fff",
                    },
                  },
                  pointer: {
                    width: 5,
                    length: "160%",
                    color: "rgba(51, 51, 155, 0.8)",
                  },
                  title: {
                    show: true,
                    offsetCenter: [0, "-50%"],
                    textStyle: {
                      color: "#B40000",
                      fontSize: 20,
                    },
                  },
                  detail: {
                    show: false,
                    backgroundColor: "rgba(0,0,0,0)",
                    borderWidth: 5,
                    borderColor: "rgba(0,0,0,0)",
                    width: 200,
                    height: 50,
                    offsetCenter: [50, -25],
                    formatter: "{value} V",
                    textStyle: {
                      fontSize: 18,
                    },
                  },
                  data: [{ value: 50, name: "V23" }],
                },
              ],
            };

            gauge_v23_options.series[0].data[0].value = obj.v23;
            gauge_v23.setOption(gauge_v23_options, true);
            gauge_v23.setOption(gauge_v23_options);
            document.getElementById("gauge_v23_back").innerHTML =
              obj.v23_formatted + " V";

            // selesai grafik
          },

          error: function (errmsg) {
            //alert("Ajax??????????!"+ errmsg);
          },
        });
      }

      function Meter_V31(link, datapost) {
        var data_V31 = [];
        var obj = [];
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            var data_V31 = JSON.parse(data);
            var obj = data_V31[0];
            var v_nom = parseFloat(obj.v_nominal);
            //  IF(H2>25000,40000,IF(H2>10000,25000,IF(H2>5000,8000,500))) LL
            //  IF(H2>25000,22000,IF(H2>10000,18000,IF(H2>5000,5000,250))) LN
            var set_max = 500;
            if (v_nom > 25000) {
              set_max = 40000;
            } else if (v_nom > 10000) {
              set_max = 25000;
            } else if (v_nom > 5000) {
              set_max = 8000;
            }

            var al_c_0 = 0.6;
            var al_c_1 = 0.7;
            var al_c_2 = 0.9;
            // Basic V1
            //

            // Setup chart
            gauge_v31_options = {
              backgroundColor: "#FFFFFF",
              tooltip: {
                formatter: "{c} V",
                // formatter"{a} <br/>{b} : {c}V",
              },
              series: [
                {
                  name: "V31",
                  type: "gauge",
                  startAngle: 170,
                  endAngle: 10,
                  center: ["50%", "90%"],
                  min: 0,
                  max: set_max,
                  splitNumber: 5,
                  //axisLine: {
                  //       lineStyle: {
                  //              width: -20
                  //       }
                  //},

                  // Axis line
                  axisLine: {
                    lineStyle: {
                      color: [
                        [al_c_0, "#ff0000"],
                        [al_c_1, "orange"],
                        [al_c_2, "#00b300"],
                        [1, "orange"],
                      ],
                      width: -20,
                    },
                  },

                  axisTick: {
                    splitNumber: 5,
                    length: -30,
                  },
                  axisLabel: {
                    textStyle: {
                      color: "#b40000",
                      fontSize: 10,
                      fontWeight: "bolder",
                    },
                  },
                  splitLine: {
                    length: -55,
                    lineStyle: {
                      color: "#fff",
                    },
                  },
                  pointer: {
                    width: 5,
                    length: "160%",
                    color: "rgba(51, 51, 155, 0.8)",
                  },
                  title: {
                    show: true,
                    offsetCenter: [0, "-50%"],
                    textStyle: {
                      color: "#B40000",
                      fontSize: 20,
                    },
                  },
                  detail: {
                    show: false,
                    backgroundColor: "rgba(0,0,0,0)",
                    borderWidth: 5,
                    borderColor: "rgba(0,0,0,0)",
                    width: 200,
                    height: 50,
                    offsetCenter: [50, -25],
                    formatter: "{value} V",
                    textStyle: {
                      fontSize: 18,
                    },
                  },
                  data: [{ value: 50, name: "V31" }],
                },
              ],
            };

            gauge_v31_options.series[0].data[0].value = obj.v31;
            gauge_v31.setOption(gauge_v31_options, true);
            gauge_v31.setOption(gauge_v31_options);
            document.getElementById("gauge_v31_back").innerHTML =
              obj.v31_formatted + " V";

            // selesai grafik
          },

          error: function (errmsg) {
            //alert("Ajax??????????!"+ errmsg);
          },
        });
      }

      function Meter_I1(link, datapost) {
        var data_I1 = [];
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            var data_I1 = JSON.parse(data);
            var obj = data_I1[0];

            //
            // Basic I1
            //

            // Setup chart
            gauge_i1_options = {
              backgroundColor: "#FFFFFF",
              tooltip: {
                formatter: "{c} A",
                // formatter"{a} <br/>{b} : {c}%",
              },
              series: [
                {
                  name: "I1",
                  type: "gauge",
                  startAngle: 160,
                  endAngle: 20,
                  center: ["50%", "90%"],
                  min: 0,
                  max: parseFloat(obj.i_nominal),
                  splitNumber: 5,
                  axisLine: {
                    lineStyle: {
                      color: [
                        [0.3, "#65e765"],
                        [0.8, "#00b300"],
                        [0.9, "orange"],
                        [1, "#ff0000"],
                      ],
                      width: -20,
                    },
                  },
                  axisTick: {
                    splitNumber: 5,
                    length: -30,
                  },
                  axisLabel: {
                    textStyle: {
                      color: "#b40000",
                      fontSize: 10,
                      fontWeight: "bolder",
                    },
                  },
                  splitLine: {
                    length: -60,
                    lineStyle: {
                      color: "#fff",
                    },
                  },

                  pointer: {
                    width: 5,
                    length: "160%",
                    color: "rgba(51, 51, 155, 0.8)",
                  },

                  title: {
                    show: true,
                    offsetCenter: [0, "-50%"],
                    textStyle: {
                      color: "#B40000",
                      fontSize: 20,
                    },
                  },
                  detail: {
                    show: false,
                    backgroundColor: "rgba(0,0,0,0)",
                    borderWidth: 5,
                    borderColor: "rgba(0,0,0,0)",
                    width: 200,
                    height: 50,
                    offsetCenter: [50, -25],
                    formatter: "{value} A",
                    textStyle: {
                      fontSize: 18,
                    },
                  },
                  data: [{ value: 0, name: "I1" }],
                },
              ],
            };

            // I1
            gauge_i1_options.series[0].data[0].value = obj.i1;
            gauge_i1.setOption(gauge_i1_options, true);
            gauge_i1.setOption(gauge_i1_options);
            document.getElementById("gauge_i1_back").innerHTML =
              obj.i1_formatted + " A";

            // selesai grafik
          },

          error: function (errmsg) {
            //alert("Ajax??????????!"+ errmsg);
          },
        });
      }

      function Meter_I2(link, datapost) {
        var data_I1 = [];
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            var data_I2 = JSON.parse(data);
            var obj = data_I2[0];

            //
            // Basic I1
            //

            // Setup chart
            gauge_i2_options = {
              backgroundColor: "#FFFFFF",
              tooltip: {
                formatter: "{c} A",
                // formatter"{a} <br/>{b} : {c}%",
              },
              series: [
                {
                  name: "I2",
                  type: "gauge",
                  startAngle: 160,
                  endAngle: 20,
                  center: ["50%", "90%"],
                  min: 0,
                  max: parseFloat(obj.i_nominal),
                  splitNumber: 5,
                  axisLine: {
                    lineStyle: {
                      color: [
                        [0.3, "#65e765"],
                        [0.8, "#00b300"],
                        [0.9, "orange"],
                        [1, "#ff0000"],
                      ],
                      width: -20,
                    },
                  },
                  axisTick: {
                    splitNumber: 5,
                    length: -30,
                  },
                  axisLabel: {
                    textStyle: {
                      color: "#b40000",
                      fontSize: 10,
                      fontWeight: "bolder",
                    },
                  },
                  splitLine: {
                    length: -60,
                    lineStyle: {
                      color: "#fff",
                    },
                  },
                  pointer: {
                    width: 5,
                    length: "160%",
                    color: "rgba(51, 51, 155, 0.8)",
                  },
                  title: {
                    show: true,
                    offsetCenter: [0, "-50%"],
                    textStyle: {
                      color: "#B40000",
                      fontSize: 20,
                    },
                  },
                  detail: {
                    show: false,
                    backgroundColor: "rgba(0,0,0,0)",
                    borderWidth: 5,
                    borderColor: "rgba(0,0,0,0)",
                    width: 200,
                    height: 50,
                    offsetCenter: [50, -25],
                    formatter: "{value} A",
                    textStyle: {
                      fontSize: 18,
                    },
                  },
                  data: [{ value: 0, name: "I2" }],
                },
              ],
            };

            // I1
            gauge_i2_options.series[0].data[0].value = obj.i2;
            gauge_i2.setOption(gauge_i2_options, true);
            gauge_i2.setOption(gauge_i2_options);
            document.getElementById("gauge_i2_back").innerHTML =
              obj.i2_formatted + " A";

            // selesai grafik
          },

          error: function (errmsg) {
            //alert("Ajax??????????!"+ errmsg);
          },
        });
      }

      function Meter_I3(link, datapost) {
        var data_I3 = [];
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            var data_I3 = JSON.parse(data);
            var obj = data_I3[0];

            //
            // Basic I3
            //

            // Setup chart
            gauge_i3_options = {
              backgroundColor: "#FFFFFF",
              tooltip: {
                formatter: "{c} A",
                // formatter"{a} <br/>{b} : {c}%",
              },
              series: [
                {
                  name: "I3",
                  type: "gauge",
                  startAngle: 160,
                  endAngle: 20,
                  center: ["50%", "90%"],
                  min: 0,
                  max: parseFloat(obj.i_nominal),
                  splitNumber: 5,
                  axisLine: {
                    lineStyle: {
                      color: [
                        [0.3, "#65e765"],
                        [0.8, "#00b300"],
                        [0.9, "orange"],
                        [1, "#ff0000"],
                      ],
                      width: -20,
                    },
                  },
                  axisTick: {
                    splitNumber: 5,
                    length: -30,
                  },
                  axisLabel: {
                    textStyle: {
                      color: "#b40000",
                      fontSize: 10,
                      fontWeight: "bolder",
                    },
                  },
                  splitLine: {
                    length: -60,
                    lineStyle: {
                      color: "#fff",
                    },
                  },
                  pointer: {
                    width: 5,
                    length: "160%",
                    color: "rgba(51, 51, 155, 0.8)",
                  },
                  title: {
                    show: true,
                    offsetCenter: [0, "-50%"],
                    textStyle: {
                      color: "#B40000",
                      fontSize: 20,
                    },
                  },
                  detail: {
                    show: false,
                    backgroundColor: "rgba(0,0,0,0)",
                    borderWidth: 5,
                    borderColor: "rgba(0,0,0,0)",
                    width: 200,
                    height: 50,
                    offsetCenter: [50, -25],
                    formatter: "{value} A",
                    textStyle: {
                      fontSize: 18,
                    },
                  },
                  data: [{ value: 0, name: "I3" }],
                },
              ],
            };

            // i3
            gauge_i3_options.series[0].data[0].value = obj.i3;
            gauge_i3.setOption(gauge_i3_options, true);
            gauge_i3.setOption(gauge_i3_options);
            document.getElementById("gauge_i3_back").innerHTML =
              obj.i3_formatted + " A";

            // selesai grafik
          },

          error: function (errmsg) {
            //alert("Ajax??????????!"+ errmsg);
          },
        });
      }

      function Meter_kWh(link, datapost) {
        var data_kWh = [];
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            var data_kWh = JSON.parse(data);
            var obj = data_kWh[0];

            //
            // Gauge kW
            //

            // Setup chart
            gauge_kw_options = {
              backgroundColor: "#FFFFFF",
              // Add tooltip
              tooltip: {
                formatter: "{c} kW",
                // formatter"{a} <br/>{b} : {c}%",
              },

              // Add series
              series: [
                {
                  name: "kW",
                  type: "gauge",
                  min: 0,
                  max: parseFloat(obj.power) / 1000,
                  splitNumber: 5,
                  radius: 80,
                  center: ["50%", "55%"],

                  // Axis line
                  axisLine: {
                    lineStyle: {
                      color: [
                        [0.3, "#65e765"],
                        [0.7, "#00b300"],
                        [0.9, "orange"],
                        [1, "#ff0000"],
                      ],
                      width: 20,
                      shadowColor: "#fff", //默认透明
                      shadowBlur: 10,
                    },
                  },

                  // Axis tick
                  axisTick: {
                    splitNumber: 5,
                    length: -8,
                  },

                  // Split line
                  splitLine: {
                    length: -40,
                    lineStyle: {
                      color: "#fff",
                      width: 20,
                      //shadowColor : '#fff', //默认透明
                      shadowBlur: 5,
                    },
                  },

                  // Display title

                  title: {
                    show: true,
                    offsetCenter: [0, "50%"],
                    textStyle: {
                      color: "#B40000",
                      fontWeight: "bolder",
                      fontSize: 26,
                    },
                  },
                  pointer: {
                    width: 5,
                    length: "100%",
                    color: "#666666",
                    //color: 'rgba(255, 55, 25, 0.8)'
                  },

                  // Display details info
                  detail: {
                    show: false,
                    offsetCenter: [0, "70%"],
                    formatter: "{value} kW",
                    textStyle: {
                      color: "rgba(180, 0, 0, 0.9)",
                      fontSize: 20,
                    },
                  },

                  // Add data
                  data: [{ value: 50, name: "kW" }],
                },
              ],
            };

            // kWh
            gauge_kw_options.series[0].data[0].value = obj.watt;
            gauge_kw.setOption(gauge_kw_options, true);
            gauge_kw.setOption(gauge_kw_options);
            // gauge_styling.setOption(gauge_kw_options);
            document.getElementById("gauge_kw_back").innerHTML =
              obj.watt_formatted + " kW";

            // selesai grafik
          },

          error: function (errmsg) {
            //alert("Ajax??????????!"+ errmsg);
          },
        });
      }

      function Meter_kVARh(link, datapost) {
        var data_kVARh = [];
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            var data_kVARh = JSON.parse(data);
            var obj = data_kVARh[0];

            //
            // Gauge kVA
            //

            // Setup chart
            gauge_kva_options = {
              backgroundColor: "#FFFFFF",
              // Add tooltip
              tooltip: {
                formatter: "{c} kVA",
                // formatter"{a} <br/>{b} : {c}%",
              },

              // Add series
              series: [
                {
                  name: "kVA",
                  type: "gauge",
                  min: 0,
                  max: parseFloat(obj.power) / 1000,
                  splitNumber: 5,
                  radius: 80,
                  center: ["50%", "55%"],

                  // Axis line
                  axisLine: {
                    lineStyle: {
                      color: [
                        [0.3, "#65e765"],
                        [0.7, "#00b300"],
                        [0.9, "orange"],
                        [1, "#ff0000"],
                      ],
                      width: 20,
                      shadowColor: "#fff", //默认透明
                      shadowBlur: 10,
                    },
                  },

                  // Axis tick
                  axisTick: {
                    splitNumber: 5,
                    length: -8,
                  },

                  // Split line
                  splitLine: {
                    length: -40,
                    lineStyle: {
                      color: "#fff",
                      width: 20,
                      //shadowColor : '#fff', //默认透明
                      shadowBlur: 5,
                    },
                  },

                  // Display title

                  title: {
                    show: true,
                    offsetCenter: [0, "50%"],
                    textStyle: {
                      color: "#B40000",
                      fontWeight: "bolder",
                      fontSize: 26,
                    },
                  },
                  pointer: {
                    width: 5,
                    length: "100%",
                    color: "#666666",
                    //color: 'rgba(255, 55, 25, 0.8)'
                  },

                  // Display details info
                  detail: {
                    show: false,
                    offsetCenter: [0, "70%"],
                    formatter: "{value} kVA",
                    textStyle: {
                      color: "rgba(180, 0, 0, 0.9)",
                      fontSize: 20,
                    },
                  },

                  // Add data
                  data: [{ value: 50, name: "kVA" }],
                },
              ],
            };

            // kVA

            //var kvaku = (obj.va/1000).toFixed() ;
            //gauge_kva_options.series[0].data[0].value = kvaku ;
            gauge_kva_options.series[0].data[0].value = obj.va;
            gauge_kva.setOption(gauge_kva_options, true);
            gauge_kva.setOption(gauge_kva_options);
            // gauge_styling.setOption(gauge_kva_options);
            document.getElementById("gauge_kva_back").innerHTML =
              obj.va_formatted + " kVA";

            // selesai grafik
          },

          error: function (errmsg) {
            //alert("Ajax??????????!"+ errmsg);
          },
        });
      }

      function Meter_Lain(link, datapost) {
        $.ajax({
          url: link,
          type: "post",
          data: datapost,
          success: function (data) {
            dataku = JSON.parse(data);
            var obj = dataku[0];

            // Exp kWh
            var var_kwh_exp = obj.kwh_exp;
            var var_kwh_exp_satuan = obj.kwh_exp_satuan;

            document.getElementById("gauge_kwhe").innerHTML = padDigits(
              var_kwh_exp,
              13
            );
            document.getElementById("gauge_kwhe_back").innerHTML = padDigits(
              var_kwh_exp,
              13
            );

            document.getElementById("satuan_gauge_kwhe").innerHTML =
              var_kwh_exp_satuan;

            // Imp kWh
            var var_kwh_imp = obj.kwh_imp;
            var var_kwh_imp_satuan = obj.kwh_imp_satuan;

            document.getElementById("gauge_kwhi").innerHTML = padDigits(
              var_kwh_imp,
              13
            );
            document.getElementById("gauge_kwhi_back").innerHTML = padDigits(
              var_kwh_imp,
              13
            );

            document.getElementById("satuan_gauge_kwhi").innerHTML =
              var_kwh_imp_satuan;

            // Exp kVARh
            var var_kvarh_exp = obj.kvarh_exp;
            var var_kvarh_exp_satuan = obj.kvarh_exp_satuan;

            document.getElementById("gauge_kvare").innerHTML = padDigits(
              var_kvarh_exp,
              13
            );
            document.getElementById("gauge_kvare_back").innerHTML = padDigits(
              var_kvarh_exp,
              13
            );

            document.getElementById("satuan_gauge_kvare").innerHTML =
              var_kvarh_exp_satuan;

            // Imp kVARh
            var kvari = obj.kvarh_imp;
            var kvari_satuan = obj.kvarh_imp_satuan;

            if (kvari < 0) {
              document.getElementById("gauge_kvari").innerHTML =
                "-" + padDigits(-1 * kvari, 13);
              document.getElementById("gauge_kvari_back").innerHTML =
                "-" + padDigits(-1 * kvari, 13);

              document.getElementById("satuan_gauge_kvari").innerHTML =
                kvari_satuan;
            } else {
              document.getElementById("gauge_kvari").innerHTML = padDigits(
                kvari,
                13
              );
              document.getElementById("gauge_kvari_back").innerHTML = padDigits(
                kvari,
                13
              );

              document.getElementById("satuan_gauge_kvari").innerHTML =
                kvari_satuan;
            }

            // PF1
            document.getElementById("gauge_pf1").innerHTML = padDigits(
              obj.pf1_formatted,
              5
            );
            document.getElementById("gauge_pf1_back").innerHTML = padDigits(
              obj.pf1_formatted,
              5
            );

            // PF2
            document.getElementById("gauge_pf2").innerHTML = padDigits(
              obj.pf2_formatted,
              5
            );
            document.getElementById("gauge_pf2_back").innerHTML = padDigits(
              obj.pf2_formatted,
              5
            );

            // PF3
            document.getElementById("gauge_pf3").innerHTML = padDigits(
              obj.pf3_formatted,
              5
            );
            document.getElementById("gauge_pf3_back").innerHTML = padDigits(
              obj.pf3_formatted,
              5
            );

            // THD V1
            document.getElementById("gauge_thdv1").innerHTML = padDigits(
              obj.thd_v1_formatted,
              5
            );
            document.getElementById("gauge_thdv1_back").innerHTML = padDigits(
              obj.thd_v1_formatted,
              5
            );

            // THD V2
            document.getElementById("gauge_thdv2").innerHTML = padDigits(
              obj.thd_v2_formatted,
              5
            );
            document.getElementById("gauge_thdv2_back").innerHTML = padDigits(
              obj.thd_v2_formatted,
              5
            );

            // THD V3
            document.getElementById("gauge_thdv3").innerHTML = padDigits(
              obj.thd_v3_formatted,
              5
            );
            document.getElementById("gauge_thdv3_back").innerHTML = padDigits(
              obj.thd_v3_formatted,
              5
            );

            // THD I1
            document.getElementById("gauge_thdi1").innerHTML = padDigits(
              obj.thd_i1_formatted,
              5
            );
            document.getElementById("gauge_thdi1_back").innerHTML = padDigits(
              obj.thd_i1_formatted,
              5
            );

            // THD I2
            document.getElementById("gauge_thdi2").innerHTML = padDigits(
              obj.thd_i2_formatted,
              5
            );
            document.getElementById("gauge_thdi2_back").innerHTML = padDigits(
              obj.thd_i2_formatted,
              5
            );

            // THD I3
            document.getElementById("gauge_thdi3").innerHTML = padDigits(
              obj.thd_i3_formatted,
              5
            );
            document.getElementById("gauge_thdi3_back").innerHTML = padDigits(
              obj.thd_i3_formatted,
              5
            );

            // FREQ
            var freq = obj.freq;
            document.getElementById("gauge_freq").innerHTML = obj.freq_formatted;


            document.getElementById("date_time").innerHTML = obj.date_time;

            //document.getElementById("gauge_kw_back").innerHTML  = obj.watt+' kW';

            //var kvaku2 = (obj.va/1000).toFixed() ;
            //document.getElementById("gauge_kva_back").innerHTML  = kvaku2+' kVA';
            //document.getElementById("gauge_kva_back").innerHTML  = obj.va_formatted+' kVA';
          },

          error: function (errmsg) {
            //alert("Ajax"+ errmsg);
          },
        });
      }

      // Apply options
      // ------------------------------

      // Resize charts
      // ------------------------------

      window.onresize = function () {
        setTimeout(function () {
          gauge_v1.resize();
          gauge_v2.resize();
          gauge_v3.resize();
          gauge_v12.resize();
          gauge_v23.resize();
          gauge_v31.resize();
          gauge_i1.resize();
          gauge_i2.resize();
          gauge_i3.resize();
          gauge_kw.resize();
          gauge_kva.resize();
        }, 200);
      };
    });
});
