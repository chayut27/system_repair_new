<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "`username`, `email`, `first_name`, `last_name`, `gender`, `birthdate`, `phone_number`, `profile`, `position`, `is_active`, `updated_at`";
  $table = "users";
  $req = array(
    "id" => $_SESSION["USER_ID"]
  );
  $value = " WHERE `id` = :id ";
  $profile_info = fetch_all($fields,$table,$value,$req);
  $profile_info = $profile_info[0];
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
          <h1 class="m-0 text-dark"><?php lang("Profile");?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./"><?php lang("Home");?></a></li>
            <li class="breadcrumb-item active"><?php echo $profile_info["first_name"] ." ". $profile_info["last_name"];?></li>
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
                <!-- <img class="profile-user-img img-fluid img-circle" src="dist/img/user4-128x128.jpg" alt="User profile picture"> -->
                <!-- <img id="photo_profile" class="img-fluid img-circle img-thumbnail" src="dist/img/avatar04.png" alt="User profile picture" style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;"> -->
                <?php if($profile_info["profile"]){ ?>
                <?php if(file_exists("uploads/users/".$profile_info["profile"])){ ?>
                <img id="photo_profile" class="img-fluid img-circle img-thumbnail"
                  src="uploads/users/<?php echo $profile_info["profile"];?>" alt="User profile picture"
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
                <?php echo $profile_info["first_name"] ." ". $profile_info["last_name"];?></h3>
              <form id="upload-profile" action="apps/profile/do_profile.php?action=upload_profile" method="POST"
                enctype="multipart/form-data">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="photo" name="photo" onChange="readURL(this);">
                  <input type="hidden" id="old_profile" name="old_profile"
                    value="<?php echo $profile_info["profile"];?>">
                  <label id="name-photo-main" class="custom-file-label text-truncate" for="photo"
                    data-browse="Browse"><?php lang("Choose File");?></label>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-upload" disabled><b><?php lang("Uoload");?></b></button>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab"><i
                      class="fas fa-info-circle"></i> <?php lang("Info");?></a></li>
                <li class="nav-item"><a class="nav-link" href="#changepassword" data-toggle="tab"><i
                      class="fas fa-key"></i> <?php lang("Change Password");?></a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="info">
                  <form id="forminfo" class="form-horizontal" action="apps/profile/do_profile.php?action=upload_info"
                    method="POST" autocomplete="off">
                    <?php if ($profile_info["position"] == "1"){?>
                    <div class="form-group row">
                      <label for="username" class="col-sm-2 col-form-label"><?php lang("Status");?></label>
                      <div class="col-6 col-lg-2">
                        <div class="custom-control custom-radio my-2">
                          <input type="radio" id="enabled" name="is_active"
                            <?php if ($profile_info["is_active"] == "Y") echo "checked"; ?> class="custom-control-input"
                            value="Y">
                          <label class="custom-control-label" for="enabled"><?php lang("Enabled");?></label>
                        </div>
                      </div>
                      <div class="col-6 col-lg-2">
                        <div class="custom-control custom-radio my-2">
                          <input type="radio" id="disabled" name="is_active"
                            <?php if ($profile_info["is_active"] == "N") echo "checked"; ?> class="custom-control-input"
                            value="N">
                          <label class="custom-control-label" for="disabled"><?php lang("Disabled");?></label>
                        </div>
                      </div>
                    </div>
                    <?php }else{ ?>
                    <div class="form-group row">
                      <label for="username" class="col-sm-2"><?php lang("Status");?></label>
                      <div class="col-sm-10">
                        <?php
                    if($profile_info["is_active"] == "Y"){
                      $status = lang("Enabled",false);
                      $bg = "success";
                    }else{
                      $status = lang("Disabled",false);
                      $bg = "danger";
                    }
                    echo "<span class='badge badge-$bg'>".$status."</span>";
                    ?>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="form-group row">
                      <label for="username" class="col-sm-2 col-form-label"><?php lang("Username");?> <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username"
                          value="<?php echo $profile_info["username"];?>" placeholder="<?php lang("Username");?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label"><?php lang("Email");?> <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email"
                          value="<?php echo $profile_info["email"];?>" placeholder="example@hotmail.com" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="firstname" class="col-sm-2 col-form-label"><?php lang("First Name");?> <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="first_name" name="first_name"
                          value="<?php echo $profile_info["first_name"];?>" placeholder="<?php lang("First Name");?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="lastname" class="col-sm-2 col-form-label"><?php lang("Last Namee");?> <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="last_name" name="last_name"
                          value="<?php echo $profile_info["last_name"];?>" placeholder="<?php lang("Last Name");?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="lastname" class="col-sm-2 col-form-label"><?php lang("Gender");?></label>
                      <div class="col-sm-10">
                        <select name="gender" id="gender" class="form-control">
                          <option value="M" <?php if ($profile_info["gender"] == "M") echo "selected"; ?>><?php lang("Male");?></option>
                          <option value="F" <?php if ($profile_info["gender"] == "F") echo "selected"; ?>><?php lang("Female");?></option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="birthdate" class="col-sm-2 col-form-label"><?php lang("BirthDay");?></label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="birthdate" name="birthdate"
                          value="<?php echo $profile_info["birthdate"];?>" placeholder="<?php lang("BirthDay");?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="phone_number" class="col-sm-2 col-form-label"><?php lang("Phone Number");?></label>
                      <div class="col-sm-10">
                        <input type="tel" class="form-control" id="phone_number" name="phone_number"
                          value="<?php echo $profile_info["phone_number"];?>" placeholder="<?php lang("Phone Number");?>">
                      </div>
                    </div>
                    <?php if ($profile_info["position"] == "1"){?>
                    <div class="form-group row">
                      <label for="position" class="col-sm-2 col-form-label"><?php lang("Position");?></label>
                      <div class="col-sm-10">
                        <select name="position" id="position" class="form-control">
                          <?php
                          foreach($position as $p_value){
                            $selected = "";
                            if($p_value["per_id"] == $profile_info["position"]){ $selected = "selected"; }
                            echo '<option value="'.$p_value["per_id"].'" '.$selected.'>'.$p_value["per_name"].'</option>';
                          }
                        ?>
                        </select>
                      </div>
                    </div>
                    <?php }else{ ?>
                    <div class="form-group row">
                      <label for="phone_number" class="col-sm-2 col-form-label"><?php lang("Position");?></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control"
                          value="<?php echo $position_txt[$profile_info["position"]];?>" placeholder="Phone Number"
                          disabled>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> <?php lang("Save");?></button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="tab-pane" id="changepassword">
                  <form id="formpassword" class="form-horizontal"
                    action="apps/profile/do_profile.php?action=change_password" method="POST" autocomplete="off">
                    <div class="form-group row">
                      <label for="current_password" class="col-sm-2 col-form-label"><?php lang("Current Password");?> <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="current_password" name="current_password"
                          placeholder="<?php lang("Current Password");?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="new_password" class="col-sm-2 col-form-label"><?php lang("New Password");?> <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="new_password" name="new_password"
                          placeholder="<?php lang("New Password");?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="confirm_password" class="col-sm-2 col-form-label"><?php lang("Confirm Password");?> <span
                          class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="confirm_password" name="confirm_password"
                          placeholder="<?php lang("Confirm Password");?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> <?php lang("Save");?></button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
            <div class="card-footer">
              <?php echo $profile_info["updated_at"];?>
            </div>
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


<script type="text/javascript">
var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";

var language = "<?php echo isset($_SESSION["LANGUAGE"]) ? $_SESSION["LANGUAGE"] : "en" ?>";
var alert_delete_modal = "<?php lang("Do you want to delete this information?");?>";

var required_username = "<?php lang("Please Enter Username");?>";
var required_email = "<?php lang("Please Enter Email");?>";
var required_first_name = "<?php lang("Please Enter First Name");?>";
var required_last_name = "<?php lang("Please Enter Last Name");?>";

var required_current_password = "<?php lang("Please Enter Current Password");?>";

var required_new_password = "<?php lang("Please Enter New Password");?>";

var required_password_len = "<?php lang("Your password must be at least 6 characters long.");?>";

var required_confirm_password = "<?php lang("Please Enter Confirm Password");?>";

var required_equalto_password = "<?php lang("Please enter the same password as above.");?>";

var es = "<?php lang("Extensions Support");?>";
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>