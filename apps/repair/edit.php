<?php
  Defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "repair";
  $req = array(
    "repair_id" => $_GET["repair_id"]
  );
  $value = " WHERE `id` = :repair_id ";
  $repair = fetch_all($fields,$table,$value,$req);
  if(!empty($repair)){
    $repair = $repair[0];
  }else{
    header("location:./?page=repair");
    exit();
  }


  $fields = "*";
  $table = "status";
  $status = fetch_all($fields, $table);
  $status_name = array();
  foreach($status as $v){
    $status_name[$v["id"]] = $v["name"]; 
  }

  $inventory = fetch_all("*","inventory");

  $fields = "*";
  $table = "problem";
  $conditions = "";
  $problem = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "repair_detail";
  $conditions = " WHERE `repair_id` = '".$repair["id"]."' ";
  $repair_details = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "users";
  $conditions = "WHERE  position = '3' ";
  $users = fetch_all($fields, $table, $conditions);

$disabled = "";
if($_SESSION["POSITION"] == "3"){
  $disabled = "disabled";
}

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
            <li class="breadcrumb-item"><a href="?page=repair"><?php lang("Repair List");?></a></li>
            <li class="breadcrumb-item active"><?php echo $repair["id"];?></li>
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
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="info">
                  <form id="forminfo" class="form-horizontal" action="apps/repair/do_repair.php?action=update_repair"
                    method="POST" autocomplete="off">
                    <input type="hidden" id="repair_id" name="repair_id" value="<?php echo $repair["id"];?>">
                   
                <div class="form-group row">
                  <label for="inven" class="col-sm-2 col-form-label"><?php lang("Inventory");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="inven" id="inven" class="form-control select2bs4 select2-hidden-accessible" <?php echo $disabled;?> style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="">-- <?php lang("Please Select Inventory");?> --</option>
                        <?php
                          foreach($inventory as $v){
                        ?>
                          <option value="<?php echo $v["id"];?>" <?php if($repair["inventory_id"] == $v["id"]){echo "selected";}?>><?php echo $v["name"];?></option>
                        <?php } ?>
                      </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="problem" class="col-sm-2 col-form-label"><?php lang("Problem");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="problem" id="problem" class="form-control select2bs4 select2-hidden-accessible" <?php echo $disabled;?> style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="">-- <?php lang("Problem");?> --</option>
                        <?php
                          foreach($problem as $v){
                        ?>
                          <option value="<?php echo $v["id"];?>" <?php if($repair["problem"] == $v["id"]){echo "selected";}?>><?php echo $v["name"];?></option>
                        <?php } ?>
                      </select>
                  </div>
                </div>
                   
                <div class="form-group row">
                  <label for="Description" class="col-sm-2 col-form-label"><?php lang("Description");?> <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <textarea name="description" id="Description"rows="5" class="form-control" <?php echo $disabled;?>><?php echo $repair["description"];?></textarea>
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
                          <option value="<?php echo $v["id"];?>" <?php if($v["id"] == $repair["technician"]){echo "selected";}?>><?php echo $v["first_name"]." ".$v["last_name"];?></option>
                        <?php } ?>
                      </select>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                  <label for="Description" class="col-sm-2 col-form-label"><?php lang("Detail");?></label>
                  <div class="col-sm-10 text-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal"><?php lang("Repair Update");?></button>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="Description" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <table class="table">
                      <thead>
                        <tr>
                          <th><?php lang("Status");?></th>
                          <th><?php lang("Note");?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach($repair_details as $v){?>
                        <tr>
                          <td><?php echo $status_name[$v["status_id"]];?></td>
                          <td><?php echo $v["note"];?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                

                <?php if(empty($disabled)){?>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> <?php lang("Save");?></button>
                      </div>
                    </div>
                  </form>
                </div>
                <?php } ?>
             
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
            <div class="card-footer">
              <?php echo $repair["updated_at"];?>
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


<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php lang("Detail");?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="apps/repair/do_repair.php?action=created_detail" method="POST">
      <div class="modal-body">
                          <input type="hidden" name="repair_id" value="<?php echo $repair["id"];?>">
          <div class="form-group">
            <label for="status" class="col-form-label"><?php lang("Status");?>:</label>
            <select name="status" id="status" class="form-control">
              <option value=""><?php lang("Status");?></option>
              <?php
              foreach($status as $v){
                ?>
              <option value="<?php echo $v["id"];?>"><?php echo $v["name"];?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="note" name="note" class="col-form-label"><?php lang("Note");?>:</label>
            <textarea class="form-control" id="note" name="note"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php lang("Close");?></button>
        <button type="submit" class="btn btn-primary"><?php lang("Add");?></button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";

  var language = "<?php echo isset($_SESSION["LANGUAGE"]) ? $_SESSION["LANGUAGE"] : "en" ?>";
  var no_result = "<?php lang("No results found");?>";

  var msg_invent =  "<?php lang("Please Select Inventory");?>";
        var msg_problem = "<?php lang("Please Select Problem");?>";
       var msg_description =  "<?php lang("Please Enter Description");?>";
        var msg_technician =  "<?php lang("Please Select Technician");?>";
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>