<?php
  defined('APPS') OR exit('No direct script access allowed');
  $fields = "*";
  $table = "ui_language";
  $conditions = "";
  $languages = fetch_all($fields, $table, $conditions);
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php lang("Status");?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./"><?php lang("Home");?></a></li>
            <li class="breadcrumb-item active"><?php lang("Status");?></li>
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

              <form action="apps/language/do_language.php?action=update_language" id="frm" method="POST">
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th width="10%">#</th>
                        <th width="40%"><?php lang("EN");?></th>
                        <th width="40%"><?php lang("TH");?></th>
                        <th width="10%"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                $i = 1;
                foreach($languages as $row){
                ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td><input type="text" name="en[<?php echo $row["id"];?>][]" class="form-control" value="<?php echo $row["en"];?>"></td>
                        <td><input type="text" name="th[<?php echo $row["id"];?>][]" class="form-control" value="<?php echo $row["th"];?>"></td>
                        <td>
                          <a href="apps/language/do_language.php?action=delete&id=<?php echo $row["id"];?>" class="btn btn-danger" onClick="return confirm('Delete?');"><i class="fas fa-minus"></i></a>
                        </td>
                      </tr>
                <?php } ?>

                    </tbody>
                  </table>
                </div>

                <!-- <input type="text" id="hdcount" name="hdcount" value="1"> -->

                <div class="row">
                <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-primary"><?php lang("Save");?></button>
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


<script type="text/javascript">
  var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : ""  ?>";
  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : ""  ?>";
  var position = "<?php echo $_SESSION["POSITION"] ?>";
  var language = "<?php echo isset($_SESSION["LANGUAGE"]) ? $_SESSION["LANGUAGE"] : "en" ?>";

</script>

<?php unset($_SESSION["STATUS"],$_SESSION["MSG"]); ?>
