<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Profile Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
        <?php
          if(isset($_SESSION["LANGUAGE"]) && $_SESSION["LANGUAGE"] == "th"){
        ?>
          <img src="assets/img/th.png" class="img-fluid" style="width:24px" alt="">
        <?php }elseif(isset($_SESSION["LANGUAGE"]) && $_SESSION["LANGUAGE"] == "en"  || !isset($_SESSION["LANGUAGE"])){ ?>
          <img src="assets/img/en.png" class="img-fluid" style="width:24px" alt="">
        <?php } ?>
        </a>
        <div class="dropdown-menu  dropdown-menu-right">
          <a href="lang.php?lang=th" class="dropdown-item">
            <img src="assets/img/th.png" class="img-fluid" style="width:24px" alt="">
            <span class=" text-muted text-sm"> <?php lang("Thailand");?></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="lang.php?lang=en" class="dropdown-item">
          <img src="assets/img/en.png" class="img-fluid" style="width:24px" alt="">
            <span class="text-muted text-sm"> <?php lang("English");?></span>
          </a>
        </div>
      </li>
    <li class="nav-item dropdown user-menu">
      <a class="nav-link" data-toggle="dropdown" href="#">
        
      <!-- <img src="dist/img/avatar04.png" class="user-image img-circle elevation-2" alt="Profile-img"> -->
      <?php if(!empty($_SESSION["PROFILE"])){ ?>
        <?php if(file_exists("uploads/users/".$_SESSION["PROFILE"])){ ?>
          <img src="uploads/users/<?php echo $_SESSION["PROFILE"];?>" class="user-image img-circle elevation-2" alt="Profile-img">
        <?php }else{ ?>
          <img src="dist/img/avatar04.png" class="user-image img-circle elevation-2" alt="Profile-img">
        <?php } ?>
      <?php }else{ ?>
          <img src="dist/img/avatar04.png" class="user-image img-circle elevation-2" alt="Profile-img">
      <?php } ?>
      <span class="d-none d-md-inline"><?php echo $_SESSION["FIRST_NAME"] ." ". $_SESSION["LAST_NAME"];?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="?page=profile" class="dropdown-item">
          <i class="fas fa-user mr-2"></i>
          <span class="text-muted text-sm"><?php lang("Profile");?></span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt mr-2"></i>
          <span class="text-muted text-sm"><?php lang("Logout");?></span>
        </a>
      </div>
    </li>
  </ul>

</nav>
