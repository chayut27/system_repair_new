<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "users";
  $conditions = " WHERE `is_delete` = 'Y' ";
  $users = fetch_all($fields, $table, $conditions);

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
          <h1 class="m-0 text-dark"><?php lang("User");?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./"><?php lang("Home");?></a></li>
            <li class="breadcrumb-item"><a href="?page=users"><?php lang("User");?></a></li>
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
                        <th><?php lang("Prolfile");?></th>
                        <th><?php lang("Username");?></th>
                        <th><?php lang("Full Name");?></th>
                        <th><?php lang("Position");?></th>
                        <th><?php lang("Status");?></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                $i = 1;
                  foreach($users as $row){
                    if($row["is_active"] == "Y"){
                      $status = lang("Enabled",false);
                      $bg = "success";
                    }else{
                      $status = lang("Disabled",false);
                      $bg = "danger";
                    }
                ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td>
                          <?php if(!empty($row["profile"])){ ?>
                          <?php if(file_exists("uploads/users/".$row["profile"])){ ?>
                          <img src="uploads/users/<?php echo $row["profile"];?>" class="picture-show"
                            alt="Profile-img">
                          <?php }else{ ?>
                          <img src="dist/img/avatar04.png" class="picture-show" alt="User Image">
                          <?php } ?>
                          <?php }else{ ?>
                          <img src="dist/img/avatar04.png" class="picture-show" alt="User Image">
                          <?php } ?>
                        </td>
                        <td><?php echo $row["username"];?></td>
                        <!-- <td><?php echo htmlspecialchars($row["username"], ENT_QUOTES, 'UTF-8');?></td> -->
                        <td><?php echo $row["first_name"]." ".$row["last_name"];?></td>
                        <td><?php echo $position_txt[$row["position"]];?></td>
                        <td><span class="badge badge-<?php echo $bg;?> badge-pill"><?php echo $status;?></span></td>
                        <td>
                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                  data-target="#modalDelete" data-user-id="<?php echo $row["id"];?>" data-profile="<?php echo $row["profile"];?>" data-username="<?php echo $row["username"];?>"><i class="fas fa-trash"></i></button>
                        <a href="apps/users/do_users.php?action=cancel_delete&user_id=<?php echo $row["id"];?>" class="btn btn-primary btn-sm" ><i class="fas fa-times"></i></a>
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
