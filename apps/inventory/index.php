<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "inventory";
  $conditions = " WHERE `is_delete` = 'N' ";
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
            <li class="breadcrumb-item"><a href="./"><?php lang("Home");?></a></li>
            <li class="breadcrumb-item active"><?php lang("Inventory");?></li>
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
            <div class="card-header">
              <a href="?page=inventory/add" class="btn btn-success btn-sm float-right"><i class="fas fa-plus-circle"></i>
              <?php lang("New Inventory");?></a>
            </div>
            <div class="card-body">
              <form action="apps/inventory/do_inventory.php?action=delete_all" id="frm" method="POST">
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
                            <!-- <input type="checkbox" id="checK_<?php echo $i;?>" name="ch[]" value="<?php echo $row["id"].",".$row["photo"];?>"> -->
                            <input type="checkbox" id="checK_<?php echo $i;?>" name="ch[]" value="<?php echo $row["id"];?>">
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
                          <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <small><a class="dropdown-item"
                                  href="?page=inventory/edit&inventory_id=<?php echo $row["id"];?>"><i class="fas fa-edit"></i>
                                  <?php lang("Edit");?></a></small>
                              
                              <small><a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                  data-target="#modalDelete" data-id="<?php echo $row["id"];?>"
                                  data-name="<?php echo $row["name"];?>" data-photo="<?php echo $row["photo"];?>"><i class="fas fa-minus-circle"></i>
                                  <?php lang("Delete");?></a></small>
                             
                            </div>
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>

            
                <div class="row">
                  <div class="col-md-12">
                    <div class="btn-group">
                      <button type="button" class="btn-sm btn">
                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkall">
                          <label for="checkall"><?php lang("Select All");?>
                          </label>
                        </div>
                      </button>
                      <button type="button" class="btn-sm btn btn-danger btn-delete-all" disabled data-toggle="modal"
                        data-target="#modalDeleteAll"><i class="fas fa-minus-circle"></i> <?php lang("Delete");?>
                      </button>
                      <a href="?page=inventory/delete" class="btn-sm btn btn-info"><i class="fas fa-trash"></i>
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
</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
