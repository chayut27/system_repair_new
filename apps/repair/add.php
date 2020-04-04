<?php
  defined('APPS') OR exit('No direct script access allowed');

  $fields = "*";
  $table = "inventory";
  $conditions = "";
  $inventorys = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "problem";
  $conditions = "";
  $problem = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "users";
  $conditions = "WHERE  position = '3' ";
  $users = fetch_all($fields, $table, $conditions);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php lang("Repair");?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./"><?php lang("Home");?></a></li>
            <?php if($_SESSION["POSITION"] != 2){?>
            <li class="breadcrumb-item"><a href="?page=repair"><?php lang("Repair List");?></a></li>
            <?php } ?>
            <li class="breadcrumb-item active"><?php lang("Repair");?></li>
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
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form id="forminfo" class="form-horizontal" enctype="multipart/form-data" action="apps/repair/do_repair.php?action=create_repair"
                method="POST" autocomplete="off">

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"><?php lang("Inventory");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                  <select class="form-control select2bs4 select2-hidden-accessible" name="inven" id="inven" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <!-- <option selected="selected" data-select2-id="19">Alabama</option> -->
                    <option value="">-- <?php lang("Please Select Inventory");?> --</option>
                    <?php
                      foreach($inventorys as $v){
                    ?>
                    <option value="<?php echo $v["id"];?>"><?php echo $v["name"];?></option>
                    <?php } ?>
                  </select>
                </div>
                </div>

                <div class="form-group row">
                  <label for="problem" class="col-sm-2 col-form-label"><?php lang("Problem");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="problem" id="problem" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;">
                        <option value="">-- <?php lang("Please Select Problem");?> --</option>
                        <?php
                          foreach($problem as $v){
                        ?>
                          <option value="<?php echo $v["id"];?>"><?php echo $v["name"];?></option>
                        <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="Description" class="col-sm-2 col-form-label"><?php lang("Description");?> <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <textarea name="description" id="Description"rows="5" class="form-control"></textarea>
                  </div>
                </div>

                <?php if($_SESSION["POSITION"] == "1" || $_SESSION["POSITION"] == "4"){ ?>
                <div class="form-group row">
                  <label for="technician" class="col-sm-2 col-form-label"><?php lang("Techician");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="technician" id="technician" class="form-control">
                        <option value="">-- <?php lang("Please Select Technician");?> --</option>
                        <?php
                          foreach($users as $v){
                        ?>
                          <option value="<?php echo $v["id"];?>"><?php echo $v["first_name"]." ".$v["last_name"];?></option>
                        <?php } ?>
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



<script>
var arr_inven = <?php echo json_encode($inventorys);?>;
var language = "<?php echo isset($_SESSION["LANGUAGE"]) ? $_SESSION["LANGUAGE"] : "en" ?>";
  var no_result = "<?php lang("No results found");?>";

  var msg_invent =  "<?php lang("Please Select Inventory");?>";
        var msg_problem = "<?php lang("Please Select Problem");?>";
       var msg_description =  "<?php lang("Please Enter Description");?>";
        var msg_technician =  "<?php lang("Please Select Technician");?>";
</script>