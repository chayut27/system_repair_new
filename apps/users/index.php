<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "users";
  $conditions = " WHERE `is_delete` = 'N' ";
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
          <h1 class="m-0 text-dark"><?php lang("Users");?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./"><?php lang("Home");?></a></li>
            <li class="breadcrumb-item active"><?php lang("Users");?></li>
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
              <a href="?page=users/add" class="btn btn-success btn-sm float-right"><i class="fas fa-plus-circle"></i>
              <?php lang("New User");?></a>
            </div>
            <div class="card-body">
              <form action="apps/users/do_users.php?action=delete_all" id="frm" method="POST">
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <?php if($_SESSION["POSITION"] == "1"){?>
                        <th class="text-center"></th>
                        <?php } ?>
                        <th><?php lang("Profile");?></th>
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
                  foreach($users as $user){
                    if($user["is_active"] == "Y"){
                      $status = lang("Enabled", false);
                      $bg = "success";
                    }else{
                      $status = lang("Disabled", false);
                      $bg = "danger";
                    }
                ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <?php if($_SESSION["POSITION"] == "1"){?>
                        <td class="text-center">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checK_<?php echo $i;?>" name="ch[]"
                              value="<?php echo $user["id"];?>">
                            <label for="checK_<?php echo $i;?>">
                            </label>
                          </div>
                        </td>
                        <?php } ?>
                        <td>
                          <?php if(!empty($user["profile"])){ ?>
                          <?php if(file_exists("uploads/users/".$user["profile"])){ ?>
                          <img src="uploads/users/<?php echo $user["profile"];?>" class="picture-show"
                            alt="Profile-img">
                          <?php }else{ ?>
                          <img src="dist/img/avatar04.png" class="picture-show" alt="User Image">
                          <?php } ?>
                          <?php }else{ ?>
                          <img src="dist/img/avatar04.png" class="picture-show" alt="User Image">
                          <?php } ?>
                        </td>
                        <td><?php echo $user["username"];?></td>
                        <!-- <td><?php echo htmlspecialchars($user["username"], ENT_QUOTES, 'UTF-8');?></td> -->
                        <td><?php echo $user["first_name"]." ".$user["last_name"];?></td>
                        <td><?php echo $position_txt[$user["position"]];?></td>
                        <td><span class="badge badge-<?php echo $bg;?> badge-pill"><?php echo $status;?></span></td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <small><a class="dropdown-item"
                                  href="?page=users/view&user_id=<?php echo $user["id"];?>"><i
                                    class="fas fa-search"></i> <?php lang("View");?></a></small>
                          
                              <small><a class="dropdown-item"
                                  href="?page=users/edit&user_id=<?php echo $user["id"];?>"><i class="fas fa-edit"></i>
                                  <?php lang("Edit");?></a></small>
                             
                                 
                              <small><a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                  data-target="#modalDelete" data-user-id="<?php echo $user["id"];?>"
                                  data-username="<?php echo $user["username"];?>"
                                  data-profile="<?php echo $user["profile"];?>"><i class="fas fa-minus-circle"></i>
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
                          <label for="checkall"> <?php lang("Select All");?>
                          </label>
                        </div>
                      </button>
                      <button type="button" class="btn-sm btn btn-danger btn-delete-all" disabled data-toggle="modal"
                        data-target="#modalDeleteAll"><i class="fas fa-minus-circle"></i> <?php lang("Delete");?>
                      </button>
                      <a href="?page=users/delete" class="btn-sm btn btn-info"><i class="fas fa-trash"></i>
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
