<style>
@font-face {
         font-family: "Font Digital";
         src: url('assets/general/fonts/digital-7.regular.ttf');
         }

.gambar > img {
  top: 0px;
  left:0px;
  z-index:-1;
}

.bgmeter {
  top: 0px;
  left:0px;
  background-image:url('assets/img/icon/bg4.png');
  background-color:#1F59A8;
}


.bgmeter2 {
  top: 0px;
  left:0px;
  background-image:url('assets/img/icon/bgmeter.png');
  background-repeat:repeat-x;
  background-color:#B40000;
}


.meter > ul {
  display:table;
  list-style: none;
  margin: 10px 0 50px 0;
  margin-left:300px;
  padding: 10px 0;
  position: relative;
  width: 100%;
  background: transparent;
}

.meter > ul li {
  display: table-cell;
  text-align: right;
  width: 1%;
}

.meter > ul li > a:before {
  border-top: 0px solid #c8c7cc;
  content: "";
  display: block;
  font-size: 0;
  height: 1px;
  overflow: hidden;
  top: 65px;
  width: 100%;
  z-index: 1;
}
.meter > ul li:last-child > a:before {
  max-width: 0%;
  width: 0%;
}

.meter > ul li > a.selected:before, .meter li > a.done:before {
  border-color: #007AFF;
}

.meter > ul .stepNumber {
  background-color: #ffffff;
  border: 3px solid #c8c7cc;
  border-radius: 10% 10% 10% 10%;
  color: #546474;
  display: inline-block;
  font-size: 15px;
  height: 100px;
  line-height: 30px;
  position: relative;
  text-align: center;
  width: 70px;
  z-index: 2;
}

.meter > ul li > a.selected .stepNumber {
  border-color: #007AFF;
}

.meter ul li > a.done .stepNumber, .meter > ul li:last-child > a.selected .stepNumber {
  border-color: #007AFF;
  background-color: #007AFF;
  color: #fff;
  text-indent: -9999px;
}

.meter ul li > a.done .stepNumber:before, .meter > ul li:last-child > a.selected .stepNumber:before {
  content: "\f00c";
  display: inline;
  float: right;
  font-family: FontAwesome;
  font-weight: 300;
  height: auto;
  text-shadow: none;
  margin-right: 7px;
  text-indent: 0;
}

.meter ul li > a.done.wait .stepNumber {
  background-color: #F6F6F6 !important;
  color: #1F59A8 !important;
  text-indent: -0px !important;
}

.meter ul li > a.done.wait .stepNumber:before {
  content: "" !important;
}

.meter > ul li .stepDesc {
  color: #FFFFFF;
  display: block;
  font-size: 14px;
  margin-top: 4px;
  max-width: 100%;
  table-layout: fixed;
  text-align: center;
  word-wrap: break-word;
  z-index: 104;
}

.meter > ul li > a.selected .stepDesc, .meter li > a.done .stepDesc {
  color: #E7E7E7;
}

.meter > ul li > a:hover {
  text-decoration: none;
}

.meter > ul li > a.disabled {
  cursor: default;
}

.meter .progress {
  margin-bottom: 30px;
}

.meter .stepContainer {
  height: auto !important;
}

.meter .loader {
  display: none;
}

.meter [class^="button"], .meter [class*=" button"] {
  display: none;
}

.meter .close {
  display: none;
}



</style>
<!-- <style>
@font-face {
         font-family: "Font Digital";
         src: url('assets/general/fonts/digital-7.regular.ttf');
         }

.meter > ul {
  display:table;
  list-style: none;
  margin: 0 0 40px 0;
  padding: 10px 0;
  position: relative;
  width: 100%;
  background: transparent;
}

.meter > ul li {
  display: table-cell;
  text-align: center;
  width: 1%;
}

.meter > ul li > a:before {
  border-top: 0px solid #c8c7cc;
  content: "";
  display: block;
  font-size: 0;
  height: 1px;
  overflow: hidden;
  position: relative;
  top: 21px;
  width: 100%;
  z-index: 1;
}

.meter > ul li:first-child > a:before {
  left: 50%;
  max-width: 51%;
}

.meter > ul li:last-child > a:before {
  max-width: 50%;
  width: 50%;
}

.meter > ul li > a.selected:before, .meter li > a.done:before {
  border-color: #007AFF;
}

.meter > ul .stepNumber {
  background-color: #ffffff;
  border-radius: 10% 10% 10% 10%;
  color: #546474;
  display: inline-block;
  font-size: 15px;
  height: 100px;
  line-height: 30px;
  position: relative;
  text-align: center;
  width: 70px;
  z-index: 2;
}

.meter > ul li > a.selected .stepNumber {
  border-color: #D5D5D5;
}

.meter ul li > a.done .stepNumber, .meter > ul li:last-child > a.selected .stepNumber {
  border-color: #007AFF;
  background-color: #007AFF;
  color: #fff;
  text-indent: -9999px;
}

.meter ul li > a.done .stepNumber:before, .meter > ul li:last-child > a.selected .stepNumber:before {
  content: "\f00c";
  display: inline;
  float: right;
  font-family: FontAwesome;
  font-weight: 300;
  height: auto;
  text-shadow: none;
  margin-right: 7px;
  text-indent: 0;
}

.meter ul li > a.done.wait .stepNumber {
  background-color: #F6F6F6 !important;
  color: #1F59A8 !important;
  text-indent: -0px !important;
}

.meter ul li > a.done.wait .stepNumber:before {
  content: "" !important;
}

.meter > ul li .stepDesc {
  color: #FFFFFF;
  display: block;
  font-size: 14px;
  margin-top: 4px;
  max-width: 100%;
  table-layout: fixed;
  text-align: center;
  word-wrap: break-word;
  z-index: 104;
}

.meter > ul li > a.selected .stepDesc, .meter li > a.done .stepDesc {
  color: #E7E7E7;
}

.meter > ul li > a:hover {
  text-decoration: none;
}

.meter > ul li > a.disabled {
  cursor: default;
}

.meter .progress {
  margin-bottom: 30px;
}

.meter .stepContainer {
  height: auto !important;
}

.meter .loader {
  display: none;
}

.meter [class^="button"], .meter [class*=" button"] {
  display: none;
}

.meter .close {
  display: none;
}



</style> -->
		
		
				<div class="main-content" style="background-color:#1F59A8;">
				
					<div class="bgmeter">
						<!-- start: WIZARD SEPS -->
						
						<div class="meter" style="width:65%; ">
				<?php
				$no = 1;
				while($no<=$com){
						
					$nilai = ($no%3);
					if($nilai==1){
							?>
							<ul style="background-image:url('assets/img/icon/bgmeter2.png'); background-repeat:repeat-x;">
								
					<?php	
						$data_dashboard = $this->model_dashboard->filter_dashboard('com',$no,'data_meter')->result();
						foreach($data_dashboard as $dash){	
								
								?>
								
								<li>
									<a class="">
									   <div class="stepNumber">
									   		<div >
									   			 <div style="margin-top:5px; margin-bottom:4px; ">
									   			 	  <img src="assets/img/icon/logopm_merah.png" width="80%" />
									   			 </div>
									   			 <div style="background:#B40000; ">
									   			 	  <span style="font-family:'Font Digital'; font-size:medium; color:#FFFFFF; margin-top:0px; margin-bottom:0px;" id="<?php echo $dash->id_meter;?>" >0000000</span>
									   			 </div>
									   		</div>
									   </div>
									</a>
								</li>
								
					<?php
						 
						 }
					
						 		?>
								
								
							</ul>
				<?php
					}
					elseif($nilai==2){
							
							?>
							
							<ul style="background-image:url('assets/img/icon/bgmeter2.png'); background-repeat:repeat-x; background-position:center; top:18px; ">
								
					<?php	
						$data_dashboard = $this->model_dashboard->filter_dashboard('com',$no,'data_meter')->result();
						foreach($data_dashboard as $dash){	
								
								?>
								
								
								<li>
									<a class="">
									   <div class="stepNumber">
									   		<div >
									   			 <div style="margin-top:5px; margin-bottom:4px; ">
									   			 	  <img src="assets/img/icon/logopm_merah.png" width="80%" />
									   			 </div>
									   			 <div style="background:#B40000; ">
									   			 	  <span style="font-family:'Font Digital'; font-size:medium; color:#FFFFFF; margin-top:0px; margin-bottom:0px;" id="<?php echo $dash->id_meter;?>" >0000000</span>
									   			 </div>
									   		</div>
									   </div>
									</a>
								</li>
								
					<?php
						 
						 }
					
						 		?>
								
								
							</ul>
				<?php
					}
					else{
							
							?>
							
							<ul style="background-image:url('assets/img/icon/bgmeter2.png'); background-repeat:repeat-x;  top:-1px;">
								
					<?php	
						$data_dashboard = $this->model_dashboard->filter_dashboard('com',$no,'data_meter')->result();
						foreach($data_dashboard as $dash){	
								
								?>
								
								
								<li>
									<a class="">
									   <div class="stepNumber">
									   		<div >
									   			 <div style="margin-top:5px; margin-bottom:4px; ">
									   			 	  <img src="assets/img/icon/logopm_merah.png" width="80%" />
									   			 </div>
									   			 <div style="background:#B40000; ">
									   			 	  <span style="font-family:'Font Digital'; font-size:medium; color:#FFFFFF; margin-top:0px; margin-bottom:0px;" id="<?php echo $dash->id_meter;?>" >0000000</span>
									   			 </div>
									   		</div>
									   </div>
									</a>
								</li>
								
					<?php
						 
						 }
					
						 		?>
								
								
							</ul>
				<?php
					}
							
				$no++;
				
			}
							
							?>
							
							
							
							
							
							
							
							
							
							
							<br />
							<br />
						</div>
					</div>
				
				</div>

				
		