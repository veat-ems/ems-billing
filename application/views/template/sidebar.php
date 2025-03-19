<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark- elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url(); ?>" class="brand-link">
    <img src="<?php echo base_url(); ?>images\EMS_Logo.png" alt="EMS Logo" class="brand-image img-square elevation-6" style="opacity:20">
    <span class="brand-text font-weight-bold">EMS</span>  
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url(); ?>assets/theme/theme01/dist/img/user_icon.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $this->session->userdata('nama')?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
 

			<?php
              $main = $this->db->where(array("parent"=>0, "aktif"=>"Y"))
                               ->like("level",$this->session->userdata("level"))
								->order_by("id_menu","asc")
                               ->get("tb_menu");
              foreach ($main->result() as $m) {
                  // chek ada submenu atau tidak
                  $sub = $this->db->where(array('parent' => $m->id_menu,'aktif' => 'Y'))
									->like("level",$this->session->userdata("level"))
		                            ->get("tb_menu");
                  if ($sub->num_rows() > 0) {
                      // buat menu + sub menu
                      $uri = $this->uri->segment(1);
                      if ($uri == 'dashboard') {
							$uri = 'dashboardgroup';
                      }					
                      $idclass = $this->db->get_where('tb_menu', array('link' => $uri))->row_array();

                      if ($m->id_menu == $idclass['parent']) {
						//if (1 == 1) {
							$class 			= ' nav-item menu-open';
							$class_link 	= ' nav-link active';
                      } else {
							$class 			= ' nav-item';
							$class_link 	= ' nav-link';
                      }
						echo '<li class="' . $class . '">
				          <a href="#" class="' . $class_link . '">
				            <i class="'.$m->icon.'"></i>
				            <p>
				              ' .$m->nama_menu . '
				              <i class="right fas fa-angle-left"></i>
				            </p>
				          </a>';
						
						echo '<ul class="nav nav-treeview">';
						
						
                      foreach ($sub->result() as $s) {
						                           
							$uri = $this->uri->segment(1);
                          	if ($s->link == $uri) {
                            	$class1 		= ' nav-item';
								$class1_link 	= ' nav-link active';
                          	} else {
                            	$class1 		= " nav-item";
								$class1_link 	= ' nav-link';
                          	}
							
							echo '<li class="' . $class1 . '" style="margin-left:20px;">
					              <a href="'.base_url($s->link).'" class="' . $class1_link . '" style="width:99%;">
					                <i class="' . $s->icon. '"></i>
					                <p>' . $s->nama_menu . '</p>
					              </a>
					            </li>';
									
                      }
                      echo "</ul>";
                      echo '</li>';
                  } else {
                      // single menu
                          $uri = $this->uri->segment(1);
                          if ($m->link == $uri) {
                              	$class2 		= ' nav-item';
								$class2_link 	= ' nav-link active';
                          } else {
                              	$class2 		= " nav-item";
								$class2_link 	= ' nav-link';
                          }
						
						if ($m->link =="dashboard") {
							echo '<li class="nav-item">
				              <a href="'.base_url($m->link).'/index/0" class="' . $class2_link . '">
				                <i class="' . $m->icon. '"></i>
				                <p>' . $m->nama_menu . 'xxx</p>
				              </a>
				            </li>';
						} else {
							echo '<li class="nav-item">
				              <a href="'.base_url($m->link).'" class="' . $class2_link . '">
				                <i class="' . $m->icon. '"></i>
				                <p>' . $m->nama_menu . '</p>
				              </a>
				            </li>';
						}
						
						
                  }                
              } 
          ?>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>