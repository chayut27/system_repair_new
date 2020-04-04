<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "brand";
  $value = " WHERE `is_delete` = 'N' ";
  $brand = fetch_all($fields, $table, $value);

  $fields = "*";
  $table = "type";
  $conditions = " WHERE `is_active` = 'Y' AND `is_delete` = 'N' ";
  $types = fetch_all($fields, $table, $conditions);
  $type_txt = array();
  foreach($types as $type){
    $type_txt[$type["id"]] = $type["name"];
  }
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php lang("Brand");?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./"><?php lang("Home");?></a></li>
            <li class="breadcrumb-item active"><?php lang("Brand");?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card">
                 
            <!-- </div> -->
            <div class="card-body">
            <div class="border border-secondary p-3 mb-4 ">
              <form id="forminfo" action="apps/brand/do_brand.php?action=save_brand" method="POST">
                <div class="row d-flex justify-content-center">
                  <div class="col-md-3 text-left text-md-center mt-0 mt-md-1">
                  <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="Y" checked>
                      <label class="custom-control-label" for="is_active"><?php lang("Enabled");?>/<?php lang("Disabled");?></label>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <select name="type" id="type" class="form-control form-control-sm" required>
                      <option value="">-- <?php lang("Please Select Type");?> --</option>
                      <?php foreach($types as $v){?>
                        <option value="<?php echo $v["id"];?>"><?php echo $v["name"];?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="text" name="brand_name" id="brand_name" class="form-control form-control-sm" placeholder="<?php lang("Brand");?> *">
                      <input type="hidden" name="brand_id" id="brand_id">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block btn-sm font-weight-bold"><i class="fas fa-save mr-1"></i> <?php lang("Save");?></button>
                    </div>
                  </div>
                </div>
            </form>
            </div>

     
              <form action="apps/brand/do_brand.php?action=delete_all" id="frm" method="POST">
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th></th>
                        <th><?php lang("Type");?></th>
                        <th><?php lang("Brand");?></th>
                        <th><?php lang("Status");?></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                $i = 1;
                  foreach($brand as $value){
                    if($value["is_active"] == "Y"){
                      $status = lang("Enabled", false);
                      $bg = "success";
                    }else{
                      $status = lang("Disabled", false);
                      $bg = "danger";
                    }
                ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td class="text-center">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checK_<?php echo $i;?>" name="ch[]"
                              value="<?php echo $value["id"];?>">
                            <label for="checK_<?php echo $i;?>">
                            </label>
                          </div>
                        </td>
                        <td><?php echo isset($type_txt[$value["type"]]) ? $type_txt[$value["type"]] : "";?></td>
                        <td><?php echo $value["name"];?></td>
                        <td><span class="badge badge-<?php echo $bg;?> badge-pill"><?php echo $status;?></span></td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <small><a class="dropdown-item brand-edit"
                                  href="javascript:void(0);" data-brand-id="<?php echo $value["id"];?>" data-brand-is-active="<?php echo $value["is_active"];?>" data-brand-name="<?php echo $value["name"];?>" data-brand-type="<?php echo $value["type"];?>"><i class="fas fa-edit" ></i>
                                  <?php lang("Edit");?></a></small>
                              <small><a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                  data-target="#modalDelete" data-brand-id="<?php echo $value["id"];?>" data-brand-name="<?php echo $value["name"];?>"><i class="fas fa-minus-circle"></i>
                                  <?php lang("Delete");?></a></small>
                        
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  
                    </tbody>
                  </table>
                </div>

                <!-- <input type="text" id="hdcount" name="hdcount" value="1"> -->


                <div class="row">
                  <div class="col-md-12">
                    <div class="btn-group">
                      <button type="button" class="btn-sm btn">
                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkall">
                          <label for="checkall"> <?php lang("Select All");?>
                          </label>
                        </div>
                      </button>
                      <button type="button" class="btn-sm btn btn-danger btn-delete-all" disabled data-toggle="modal"
                        data-target="#modalDeleteAll"><i class="fas fa-minus-circle"></i> <?php lang("Delete");?>
                        </button>
                        <a href="?page=brand/delete" class="btn-sm btn btn-info"><i class="fas fa-trash"></i>
                        <?php lang("Trash");?></a>
                    </div>
                  </div>
                </div>

          
                <form>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- /.content -->
</div>


<div class="modal" id="modalDeleteAll" role="dialog" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <i class="fas fa-exclamation-circle"></i> <?php lang("Are you want to delete all?");?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php lang("No");?></button>
        <button type="button" class="btn btn-primary btn-continue"><?php lang("Yes");?></button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modalDelete" role="dialog" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <i class="fas fa-exclamation-circle"></i>
        <span></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php lang("No");?></button>
        <button type="button" class="btn btn-primary btn-continue" onClick=""><?php lang("Yes");?></button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";
  var position = "<?php echo $_SESSION["POSITION"] ?>";

  var language = "<?php echo isset($_SESSION["LANGUAGE"]) ? $_SESSION["LANGUAGE"] : "en" ?>";

  var alert_delete_modal = "<?php lang("Do you want to delete this information?");?>";
  var required_name = "<?php lang("Please Enter Brand");?>";
  var required_type = "<?php lang("Please Select Type");?>";
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
