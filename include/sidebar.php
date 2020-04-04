<?php
$arr_users = array("users","users/add","users/edit", "users/delete");
$arr_repair = array("repair","repair/add","repair/edit");
$arr_dashboard = array("dashboard");
$arr_system = array("system");

$arr_settings = array("category","category/delete","type","type/delete","brand","brand/delete","inventory", "inventory/add","inventory/edit","inventory/delete","status","status/delete","problem", "problem/delete", "language");
$arr_category = array("category","category/delete");
$arr_type = array("type","type/delete");
$arr_status = array("status","status/delete");
$arr_brand = array("brand","brand/delete");
$arr_problem = array("problem","problem/delete");
$arr_inventory = array("inventory","inventory/add","inventory/edit","inventory/delete");
$arr_language = array("language");

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="./" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light"><?php echo $system["name"];?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if(!empty($_SESSION["PROFILE"])){ ?>
        <?php if(file_exists("uploads/users/".$_SESSION["PROFILE"])){ ?>
        <img src="uploads/users/<?php echo $_SESSION["PROFILE"];?>" class="img-circle elevation-2" alt="Profile-img"
          style="max-width:34px; max-height:34px; min-width:34px; min-height:34px;">
        <?php }else{ ?>
        <img src="dist/img/avatar04.png" class="img-circle elevation-2" alt="User Image">
        <?php } ?>
        <?php }else{ ?>
        <img src="dist/img/avatar04.png" class="img-circle elevation-2" alt="User Image">
        <?php } ?>


      </div>
      <div class="info">
        <a href="?page=profile" class="d-block"><?php echo $_SESSION["FIRST_NAME"] ." ". $_SESSION["LAST_NAME"];?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="?page=dashboard" class="nav-link <?php if(in_array($page, $arr_dashboard)){echo "active"; }?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              <?php lang("Dashboard");?>
            </p>
          </a>
        </li>
        <?php if($_SESSION["POSITION"] != "2"){?>
        <li class="nav-item">
          <a href="?page=repair" class="nav-link <?php if(in_array($page, $arr_repair)){echo "active"; }?>">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
            <?php lang("Repair");?>
            </p>
          </a>
        </li>
        <?php } ?>
        <?php if($_SESSION["POSITION"] == "1"){?>
        <li class="nav-item">
          <a href="?page=users" class="nav-link <?php if(in_array($page, $arr_users)){echo "active"; }?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
            <?php lang("Users");?>
            </p>
          </a>
        </li>
        <?php } ?>
        <?php if($_SESSION["POSITION"] == "1"){?>
        <li class="nav-item">
          <a href="?page=system" class="nav-link <?php if(in_array($page, $arr_system)){echo "active"; }?>">
            <i class="nav-icon fas fa-sliders-h"></i>
            <p>
            <?php lang("Systems");?>
            </p>
          </a>
        </li>
        <?php } ?>
        <?php if($_SESSION["POSITION"] == "1"){?>
        <li class="nav-item has-treeview <?php if(in_array($page, $arr_settings)){echo "menu-open"; }?>">
          <a href="#" class="nav-link <?php if(in_array($page, $arr_settings)){echo "active"; }?>">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              <?php lang("Settings");?>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?page=category" class="nav-link <?php if(in_array($page, $arr_category)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php lang("Category");?></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=type" class="nav-link <?php if(in_array($page, $arr_type)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php lang("Type");?></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=brand" class="nav-link <?php if(in_array($page, $arr_brand)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php lang("Brand");?></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=problem" class="nav-link <?php if(in_array($page, $arr_problem)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php lang("Problem");?></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=inventory" class="nav-link <?php if(in_array($page, $arr_inventory)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php lang("Inventory");?></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=status" class="nav-link <?php if(in_array($page, $arr_status)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php lang("Status");?></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=language" class="nav-link <?php if(in_array($page, $arr_language)){echo "active"; }?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php lang("Language");?></p>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a href="javascript:void(0);" class="nav-link" data-toggle="modal" data-target="#logoutModal">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
            <?php lang("Logout");?>
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
