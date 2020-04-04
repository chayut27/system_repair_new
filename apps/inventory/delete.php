<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "inventory";
  $conditions = " WHERE `is_delete` = 'Y' ";
  $inventory = fetch_all($fields, $table, $conditions);

  $fields = "*";
  $table = "brand";
  $conditions = " WHERE `is_active` = 'Y' AND `is_delete` = 'N' ";
  $brands = fetch_all($fields, $table, $conditions);
  $brand_txt = array();
  foreach($brands as $brand){
    $brand_txt[$brand["id"]] = $brand["name"];
  }

  $fields = "*";
  $table = "category";
  $conditions = " WHERE `is_active` = 'Y' AND `is_delete` = 'N' ";
  $categorys = fetch_all($fields, $table, $conditions);
  $cate_txt = array();
  foreach($categorys as $category){
    $cate_txt[$category["id"]] = $category["name"];
  }


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
          <h1 class="m-0 text-dark"><?php lang("Inventory");?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./"><?php lang("Hone");?></a></li>
            <li class="breadcrumb-item"><a href="?page=inventory"><?php lang("Inventory");?></a></li>
            <li class="breadcrumb-item active"><?php lang("Trash");?></li>
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
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <?php if($_SESSION["POSITION"] == "1"){?>
                        <th class="text-center"></th>
                        <?php } ?>
                        <th><?php lang("Picture");?></th>
                        <th><?php lang("Name");?></th>
                        <th><?php lang("Category");?></th>
                        <th><?php lang("Type");?></th>
                        <th><?php lang("Brand");?></th>
                        <th><?php lang("Status");?></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                $i = 1;
                  foreach($inventory as $row){
                    if($row["is_active"] == "Y"){
                      $status = lang("Enabled", false);
                      $bg = "success";
                    }elseif($row["is_active"] == "N"){
                      $status = lang("Disabled", false);
                      $bg = "danger";
                    }elseif($row["is_active"] == "RP"){
                      $status = lang("Send to Repair", false);
                      $bg = "info";
                    }elseif($row["is_active"] == "WO"){
                      $status = lang("Worn out", false);
                      $bg = "warning";
                    }
                ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td class="text-center">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checK_<?php echo $i;?>" name="ch[]"
                              value="<?php echo $row["id"].",".$row["photo"];?>">
                            <label for="checK_<?php echo $i;?>">
                            </label>
                          </div>
                        </td>
                        <td>
                          <?php if(!empty($row["photo"])){ ?>
                          <?php if(file_exists("uploads/inventory/".$row["photo"])){ ?>
                          <img src="uploads/inventory/<?php echo $row["photo"];?>" class="picture-show"
                            alt="Profile-img">
                          <?php }else{ ?>
                          <img src="dist/img/pic_empty.jpg" class="picture-show" alt="Image">
                          <?php } ?>
                          <?php }else{ ?>
                          <img src="dist/img/pic_empty.jpg" class="picture-show" alt="Image">
                          <?php } ?>
                        </td>
                        <td><?php echo $row["name"];?></td>
                        <td><?php echo isset($cate_txt[$row["category"]]) ? $cate_txt[$row["category"]] : "";?></td>
                        <td><?php echo isset($type_txt[$row["type"]]) ? $type_txt[$row["type"]] : "";?></td>
                        <td><?php echo isset($brand_txt[$row["brand"]]) ? $brand_txt[$row["brand"]] : "";?></td>
                        <td><span class="badge badge-<?php echo $bg;?> badge-pill"><?php echo $status;?></span></td>
                        <td>
                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                  data-target="#modalDelete" data-id="<?php echo $row["id"];?>" data-photo="<?php echo $row["photo"];?>" data-name="<?php echo $row["name"];?>"><i class="fas fa-trash"></i></button>
                        <a href="apps/inventory/do_inventory.php?action=cancel_delete&inventory_id=<?php echo $row["id"];?>" class="btn btn-primary btn-sm" ><i class="fas fa-times"></i></a>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
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
  
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
