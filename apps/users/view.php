<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "`username`, `email`, `first_name`, `last_name`, `gender`, `birthdate`, `phone_number`, `profile`, `position`, `is_active`, `updated_at`";
  $table = "users";
  $req = array(
    "user_id" => $_GET["user_id"]
  );
  $value = " WHERE `id` = :user_id ";
  $user = fetch_all($fields,$table,$value,$req);
  if(!empty($user)){
    $user = $user[0];
  }else{
    header("location:./?page=users");
    exit();
  }

  $position = fetch_all("`per_id`, `per_name`","position");
  $position_txt = array();
  foreach($position as $per){
    $position_txt[$per["per_id"]] = $per["per_name"];
  }


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php lang("Users");?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./"><?php lang("Home");?></a></li>
            <li class="breadcrumb-item"><a href="?page=users"><?php lang("Users");?></a></li>
            <li class="breadcrumb-item active"><?php echo $user["first_name"] ." ". $user["last_name"];?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <?php if($user["profile"]){ ?>
                <?php if(file_exists("uploads/users/".$user["profile"])){ ?>
                <img id="photo_profile" class="img-fluid img-circle img-thumbnail"
                  src="uploads/users/<?php echo $user["profile"];?>" alt="User profile picture"
                  style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
                <?php }else{ ?>
                <img id="photo_profile" class="img-fluid img-circle img-thumbnail" src="dist/img/avatar04.png"
                  alt="User profile picture"
                  style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
                <?php } ?>
                <?php }else{ ?>
                <img id="photo_profile" class="img-fluid img-circle img-thumbnail" src="dist/img/avatar04.png"
                  alt="User profile picture"
                  style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
                <?php } ?>
              </div>
              <h3 class="profile-username text-center">
                <?php echo $user["first_name"] ." ". $user["last_name"];?></h3>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <label for="username" class="col-sm-2"><?php lang("Status");?></label>
                <div class="col-sm-10">
                  <?php
                    if($user["is_active"] == "Y"){
                      $status = lang("Enabled",false);
                      $bg = "success";
                    }else{
                      $status = lang("Disabled",false);
                      $bg = "danger";
                    }
                    echo "<p class='badge badge-$bg'>".$status."</p>";
                    ?>
                </div>
              </div>
              <hr>  
              <div class="row">
                <label for="username" class="col-sm-2"><?php lang("Username");?></label>
                <div class="col-sm-10">
                  <p><?php echo $user["username"];?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <label for="email" class="col-sm-2"><?php lang("Email");?></label>
                <div class="col-sm-10">
                  <p><?php echo $user["email"];?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <label for="lastname" class="col-sm-2"><?php lang("Gender");?></label>
                <div class="col-sm-10">
                <p>
                  <?php
                      if($user["gender"] == "M"){echo lang("Male");}else{echo "Female";}
                    ?>
                </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <label for="birthdate" class="col-sm-2"><?php lang("BirthDay");?></label>
                <div class="col-sm-10">
                  <p><?php echo $user["birthdate"];?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <label for="phone_number" class="col-sm-2"><?php lang("Phone Number");?></label>
                <div class="col-sm-10">
                  <p><?php echo $user["phone_number"];?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <label for="position" class="col-sm-2"><?php lang("Position");?></label>
                <div class="col-sm-10">
                  <p><?php echo $position_txt[$user["position"]];?></p>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
