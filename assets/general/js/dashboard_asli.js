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
     	return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
	 }
	 
	 
     clearInterval(timeTicket);
     var timeTicket = setInterval(function () {
                var a1 = (Math.random()*1500).toFixed(2) - 0;
				var b1 = a1.toFixed();
				var c  = 'satu';
				document.getElementById(c).innerHTML  = padDigits((((Math.random()*1500).toFixed(2) - 0).toFixed()),7);
				document.getElementById("empat").innerHTML  = padDigits((((Math.random()*1500).toFixed(2) - 0).toFixed()),7);
				
            }, 2000);
                    

           

      // Add random data
      clearInterval(timeTicket2);
      var timeTicket2 = setInterval(function () {
                var a2 = (Math.random()*1200).toFixed(2) - 0;
				var b2 = a2.toFixed();
                document.getElementById("dua").innerHTML  = padDigits(b2,7);
				document.getElementById("lima").innerHTML  = padDigits(b2,7);
            }, 2000)    

      // Add random data
      clearInterval(timeTicket3);
      var timeTicket3 = setInterval(function () {
                var a3 = (Math.random()*3000).toFixed(2) - 0;
				var b3 = a3.toFixed();
                document.getElementById("tiga").innerHTML  = padDigits(b3,7);
                document.getElementById("enam").innerHTML  = padDigits(b3,7);
            }, 2000)
	
	
     clearInterval(timeTicket4);
     var timeTicket4 = setInterval(function () {
                var a4 = (Math.random()*1500).toFixed(2) - 0;
				var b4 = a4.toFixed();
				document.getElementById("7").innerHTML  = padDigits(b4,7);
				document.getElementById("10").innerHTML  = padDigits(b4,7);
            }, 2000);
                    

           

      // Add random data
      clearInterval(timeTicket5);
      var timeTicket5 = setInterval(function () {
                var a5 = (Math.random()*1200).toFixed(2) - 0;
				var b5 = a5.toFixed();
                document.getElementById("8").innerHTML  = padDigits(b5,7);
				document.getElementById("11").innerHTML  = padDigits(b5,7);
            }, 2000)    

      // Add random data
      clearInterval(timeTicket6);
      var timeTicket6 = setInterval(function () {
                var a6 = (Math.random()*3000).toFixed(2) - 0;
				var b6 = a6.toFixed();
                document.getElementById("9").innerHTML  = padDigits(b6,7);
                document.getElementById("12").innerHTML  = padDigits(b6,7);
            }, 2000)
	
	

     clearInterval(timeTicket7);
     var timeTicket7 = setInterval(function () {
                var a7 = (Math.random()*1500).toFixed(2) - 0;
				var b7 = a7.toFixed();
				document.getElementById("13").innerHTML  = padDigits(b7,7);
				document.getElementById("16").innerHTML  = padDigits(b7,7);
            }, 2000);
                    

           

      // Add random data
      clearInterval(timeTicket8);
      var timeTicket8 = setInterval(function () {
                var a8 = (Math.random()*1200).toFixed(2) - 0;
				var b8 = a8.toFixed();
                document.getElementById("14").innerHTML  = padDigits(b8,7);
				document.getElementById("17").innerHTML  = padDigits(b8,7);
            }, 2000)    

      // Add random data
      clearInterval(timeTicket9);
      var timeTicket9 = setInterval(function () {
                var a9 = (Math.random()*3000).toFixed(2) - 0;
				var b9 = a9.toFixed();
                document.getElementById("15").innerHTML  = padDigits(b9,7);
                document.getElementById("18").innerHTML  = padDigits(b9,7);
            }, 2000)
	
	


});
