<!-- start: CLIP-TWO CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/styles.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/plugins.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/themes/iaspp.css');?>" id="skin_color" />
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/colors.css');?>">
		<!-- end: CLIP-TWO CSS -->

<style>

@font-face {
         font-family: "Font Digital";
         src: url("<?php echo base_url('assets/general/fonts/digital-7.regular.ttf');?>");
         }

	
</style>

<script type="text/javascript">
 window.onload = function() { jam(); }

 function jam() {
  var e = document.getElementById('jam'),
  d = new Date(), h, m, s;
  h = d.getHours();
  m = set(d.getMinutes());
  s = set(d.getSeconds());

  e.innerHTML = h +':'+ m +':'+ s;

  setTimeout('jam()', 1000);
 }

 function set(e) {
  e = e < 10 ? '0'+ e : e;
  return e;
 }
</script>

			<!-- sidebar -->
			<div class="sidebar app-aside" id="sidebar">
				<div class="sidebar-container perfect-scrollbar ">
					<nav>
						<!-- start: MAIN NAVIGATION MENU -->
						<div class="menuku hidden-md hidden-lg" id="menuku"  style="background-image:url('assets/general/images/background/<?php echo $background ;?>'); background-size:cover;">
							<div class="menu-header">
        						<img class="user-avatar round" src="assets/general/images/avatar/<?php echo $avatar ;?>" />
        						<div class="name"><?php echo $nama ;?></div>
        						<div class="e-mail"><?php echo $email ;?></div>
								<br />
      						</div>
						</div>
						<ul class="main-navigation-menu">
						          
            <?php
                $main = $this->db->where(array('parent' => 0,'aktif' => 'Y'))
                                 ->like('level',$this->session->userdata('level'))
                                 ->get('tb_menu');
                foreach ($main->result() as $m) {
                    // chek ada submenu atau tidak
                    $sub = $this->db->get_where('tb_menu', array('parent' => $m->id_menu,'aktif' => 'Y'));
                    if ($sub->num_rows() > 0) {
                        // buat menu + sub menu
						$uri = $this->uri->segment(1);
                        $idclass = $this->db->get_where('tb_menu', array('link' => $uri))->row_array();
                        if ($m->id_menu == $idclass['parent']) {
                            $class = ' active open';
                        } else {
                            $class = "";
                        }
						echo '<li class="' . $class . '">
								<a href="genera/javascript:void(0)">
									<div class="item-content">
										<div class="item-media">
											<i class="'.$m->icon.'"></i>
										</div>
										<div class="item-inner">
											<span class="title">' .$m->nama_menu . '</span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>';
                        
						echo '<ul class="sub-menu">';
						
						
                        foreach ($sub->result() as $s) {
						                           
							$uri = $this->uri->segment(1);
                            if ($s->link == $uri) {
                                $class1 = ' active';
                            } else {
                                $class1 = "";
                            }
							
							echo '<li class="' . $class1 . '">
										<a href="'.base_url($s->link).'">
											<i class="' . $s->icon. '"></i>&nbsp; <span class="title"> ' . $s->nama_menu . ' </span>
										</a>
									</li>';
									
                        }
                        echo "</ul>";
                        echo '</li>';
                    } else {
                        // single menu
						
                        
                            $uri = $this->uri->segment(1);
                            if ($m->link == $uri) {
                                $class2 = ' active open';
                            } else {
                                $class2 = "";
                            }
							
						echo '<li class="' . $class2 . '">
								<a href="'.base_url($m->link).'">
									<div class="item-content">
										<div class="item-media">
											<i class="' . $m->icon. '"></i>
										</div>
										<div class="item-inner">
											<span class="title"> ' . $m->nama_menu . ' </span>
										</div>
									</div>
								</a>
							</li>';
						
                    }                
                } 
            ?>
							
			
					 </ul><!-- start: CORE FEATURES -->

          						<div class="info-box-lower bg-dark-red" style="color:#ffffff;">
            						<span class="info-box-icon-lower" style="width:68px; font-style:italic; font-size:28px; font-weight:bold;"><i class="ti-alarm-clock"></i></span>
            						<div class="info-box-content-lower" style="margin-left: 68px;">
              							<span class="info-box-number-lower" style="font-size: 28px; font-family: 'Font Digital';color:#FFFFFF" id="jam" id="jam">00:00:00</span>
            						</div>
            					<!-- /.info-box-content -->
          						</div>

								<?
								$condition_alarm_onoff['username'] 	= $this->session->userdata('username');
								$condition_alarm_onoff['settingid'] = 'ALARM_ONOFF'; 
								$row_alarm_onoff = $this->mcrud->search($condition_alarm_onoff, 'settings');
								if ($row_alarm_onoff) {
									$is_alarm_onoff = $row_alarm_onoff->value_num;
								} else {
									$is_alarm_onoff = 1;
								}
								
								if ($is_alarm_onoff == 1) {
									$alarm_display = "block";
								} else {
									$alarm_display = "none";
								}
								
								?>
								<div class="container-fluid" style="background:#DDDDDD;">
									<form name="formalarmtoggle" id="formalarmtoggle" method="post" action="alarm/togglesave">
            						<div class="row">
										<div class="col-md-12" style="text-align:center;">ALARM &nbsp;<input type="checkbox" name="togglealarm" id="togglealarm"  <?php if ($is_alarm_onoff == 1) echo 'checked'?> data-toggle="toggle" data-on="On" data-off="Off" data-size="small" data-style="ios" data-onstyle="info" data-offstyle="default"></div>
									</div>
									</form>
          						</div>

								<div class="container-fluid" id="id_alarm_all" style="background:#FFFFFF; color:#666666; display:<?php echo $alarm_display?>;">
									<div class="row">
										<div class="col-md-12" id="_" style="height:200px;overflow-y: scroll;">

											<?php
											$var_date_from	= date('Y-m-1');
											$var_date_thru	= date('Y-m-t');
											$var_shownumber = 50;
											$var_active 	= 1;

											$list = $this->model_alarm->tampil($var_date_from, $var_date_thru, $var_shownumber, $var_active)->result();

											$no 				= 0;
											$alarm_description 	= '';

											foreach ($list as $alarm) {
												$no++;

												$alarm_description .= '<form method="post" >';
												$alarm_description .= '<div class="row" id="alarm_' . $alarm->id_alarm . '">';
												$alarm_description .= '<div class="col-md-12"><b>' . $alarm->id_name . '</b></div>';
												$alarm_description .= '<div class="col-md-12"><b>' . $alarm->date_time . '</b></div>';
												$alarm_description .= '<div class="col-md-12">' . $alarm->alarmlog . '</div>';
												$alarm_description .= '<div class="col-md-12" style="text-align:right;"><input type="checkbox" value="' . $alarm->id_alarm . '" name="toggleitemalarm" class="toggleitemalarm" id="toggleitemalarm" data-toggle="toggle" data-on="Show" data-off="Close" data-size="mini" data-style="ios" data-onstyle="info" data-offstyle="danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
												$alarm_description .= '</div>';
												$alarm_description .= '</form>';
											}

											echo $alarm_description;
											?>



										</div>
									</div>
									<div class="row">
										<div class="col-md-12" id="id_alarm_link" style="text-align:center; padding:8px;">
											<?php
											if ($no > 0) {
												echo "<a href='" . base_url() . "alarm'>Show All Alarm</a>";
											}
											?>
										</div>
									</div>
								</div>
								
								<!--
								<div class="container-fluid" id="id_alarm_all" style="background:#FFFFFF; color:#666666; display:<?php echo $alarm_display?>;">
									<div class="row">
										<div class="col-md-12" id="id_alarm_content" style="height:200px;overflow-y: scroll;">&nbsp;</div>
									</div>
									<div class="row">
										<div class="col-md-12" id="id_alarm_link" style="text-align:center; padding:8px;">&nbsp;</div>
									</div>
          						</div>
								-->
					
						<!-- end: MAIN NAVIGATION MENU -->
						<!-- end: DOCUMENTATION BUTTON -->
					</nav>
	
					
					
				</div>
			</div>
			<!-- / sidebar -->