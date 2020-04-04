<?php
  defined('APPS') OR exit('No direct script access allowed');
  $position = fetch_all("`per_id`, `per_name`","position");

  $fields = "*";
  $table = "type";
  $conditions = " WHERE `is_active` = 'Y' AND `is_delete` = 'N' ";
  $types = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "brand";
  $conditions = " WHERE `is_active` = 'Y' AND `is_delete` = 'N'  ";
  $brand = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "category";
  $conditions = " WHERE `is_active` = 'Y' AND `is_delete` = 'N'  ";
  $categorys = fetch_all($fields, $table, $conditions);

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php lang("Inventory");?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./"><?php lang("Home");?></a></li>
            <li class="breadcrumb-item"><a href="?page=inventory"><?php lang("Inventory");?></a></li>
            <li class="breadcrumb-item active"><?php lang("New Inventory");?></li>
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

        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form id="forminfo" class="form-horizontal" enctype="multipart/form-data"
                action="apps/inventory/do_inventory.php?action=create_inventory" method="POST" autocomplete="off">
                <div class="form-group row">
                  <label for="username" class="col-3 col-sm-2 col-form-label"><?php lang("Status");?></label>
                  <div class="col-9 col-lg-3">
                    <!-- <div class="custom-control custom-switch custom-switch-on-success my-2">
                      <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="Y" checked>
                      <label class="custom-control-label" for="is_active"><?php lang("Enabled");?>/<?php lang("Disabled");?></label>
                    </div> -->
                    <select name="is_active" id="is_active" class="form-control">
                      <option value="Y"><?php lang("Enabled");?></option>
                      <option value="N"><?php lang("Disabled");?></option>
                      <option value="RP"><?php lang("Send to Repair");?></option>
                      <option value="WO"><?php lang("Worn out");?></option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <img id="photo_profile" class="img-fluid img-thumbnail" src="dist/img/pic_empty.jpg"
                      alt="User profile picture"
                      style="max-width:225px; max-height:225px; min-width:225px; min-height:225px;">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label"><?php lang("Picture");?></label>
                  <div class="col-sm-10">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="photo" name="photo" onChange="readURL(this);">
                      <label id="name-photo-main" class="custom-file-label text-truncate" for="photo"
                        data-browse="Browse"><?php lang("Choose File");?></label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label"><?php lang("Name");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value=""
                      placeholder="<?php lang("Name");?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label"><?php lang("Serial Number");?> <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="serial_number" name="serial_number" value=""
                      placeholder="<?php lang("Serial Number");?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label"><?php lang("Category");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="category" id="category" class="form-control">
                      <option value="">-- <?php lang("Please Select Category");?> --</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="firstname" class="col-sm-2 col-form-label"><?php lang("Type");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="type" id="type" class="form-control">
                      <option value="">-- <?php lang("Please Select Type");?> --</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="lastname" class="col-sm-2 col-form-label"><?php lang("Brand");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="brand" id="brand" class="form-control">
                        <option value="">-- <?php lang("Please Select Brand");?> --</option>
                      </select>
                  </div>
                </div>
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


<script>
var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";

var required_name = "<?php lang("Please Enter Name");?>";
var required_serial_number = "<?php lang("Please Enter Serial Number");?>";
var required_category = "<?php lang("Please Select Category");?>";
var required_type = "<?php lang("Please Select Type");?>";
var required_brand = "<?php lang("Please Select Brand");?>";

var es = "<?php lang("Extensions Support");?>";
</script>

<script>
var arr_type = <?php echo json_encode($types);?>;
var arr_brand = <?php echo json_encode($brand);?>;
var arr_cate = <?php echo json_encode($categorys);?>;
</script>