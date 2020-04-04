<?php
  defined('APPS') OR exit('No direct script access allowed');
  $position = fetch_all("`per_id`, `per_name`","position");
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
            <li class="breadcrumb-item active"><?php lang("New User");?></li>
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
                <img id="photo_profile" class="img-fluid img-circle img-thumbnail" src="dist/img/avatar04.png"
                  alt="User profile picture"
                  style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
              <form id="forminfo" class="form-horizontal" enctype="multipart/form-data" action="apps/users/do_users.php?action=create_users"
                method="POST" autocomplete="off">
                <?php if ($_SESSION["POSITION"] == "1"){?>
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label"><?php lang("Status");?></label>
                  <div class="col-6 col-lg-2">
                    <div class="custom-control custom-radio my-2">
                      <input type="radio" id="enabled" name="is_active" checked class="custom-control-input" value="Y">
                      <label class="custom-control-label" for="enabled"><?php lang("Enabled");?></label>
                    </div>
                  </div>
                  <div class="col-6 col-lg-2">
                    <div class="custom-control custom-radio my-2">
                      <input type="radio" id="disabled" name="is_active" class="custom-control-input" value="N">
                      <label class="custom-control-label" for="disabled"><?php lang("Disabled");?></label>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label"><?php lang("Profile");?></label>
                  <div class="col-sm-10">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="photo" name="photo" onChange="readURL(this);">
                      <label id="name-photo-main" class="custom-file-label text-truncate" for="photo"
                        data-browse="Browse"><?php lang("Choose File");?></label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label"><?php lang("Username");?> <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" value=""
                      placeholder="<?php lang("Username");?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label"><?php lang("Password");?> <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" value=""
                      placeholder="<?php lang("Password");?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label"><?php lang("Email");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value=""
                      placeholder="example@hotmail.com" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="firstname" class="col-sm-2 col-form-label"><?php lang("First Name");?> <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="first_name" name="first_name" value=""
                      placeholder="<?php lang("First Name");?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="lastname" class="col-sm-2 col-form-label"><?php lang("Last Name");?> <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="last_name" name="last_name" value=""
                      placeholder="<?php lang("Last Name");?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="lastname" class="col-sm-2 col-form-label"><?php lang("Gender");?></label>
                  <div class="col-sm-10">
                    <select name="gender" id="gender" class="form-control">
                        <option value="M"><?php lang("Male");?></option>
                        <option value="F"><?php lang("Female");?></option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="birthdate" class="col-sm-2 col-form-label"><?php lang("BirthDay");?></label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="birthdate" name="birthdate" value=""
                      placeholder="<?php lang("BirthDay");?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phone_number" class="col-sm-2 col-form-label"><?php lang("Phone Number");?></label>
                  <div class="col-sm-10">
                    <input type="tel" class="form-control" id="phone_number" name="phone_number" value=""
                      placeholder="<?php lang("Phone Number");?>">
                  </div>
                </div>
                <?php if ($_SESSION["POSITION"] == "1"){?>
                <div class="form-group row">
                  <label for="position" class="col-sm-2 col-form-label"><?php lang("Position");?></label>
                  <div class="col-sm-10">
                    <select name="position" id="position" class="form-control">
                      <?php
                          foreach($position as $p_value){
                            echo '<option value="'.$p_value["per_id"].'">'.$p_value["per_name"].'</option>';
                          }
                        ?>
                    </select>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-upload"><i class="fas fa-check-circle"></i>
                    <?php lang("Save");?></button>
                  </div>
                </div>
              </form>
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


<script type="text/javascript">
  var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";
  var position = "<?php echo $_SESSION["POSITION"] ?>";

  var language = "<?php echo isset($_SESSION["LANGUAGE"]) ? $_SESSION["LANGUAGE"] : "en" ?>";
  var alert_delete_modal = "<?php lang("Do you want to delete this information?");?>";
  
  var required_username = "<?php lang("Please Enter Username");?>";
  var required_email = "<?php lang("Please Enter Email");?>";
  var required_first_name = "<?php lang("Please Enter First Name");?>";
  var required_last_name = "<?php lang("Please Enter Last Name");?>";

  var es = "<?php lang("Extensions Support");?>";
  
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
