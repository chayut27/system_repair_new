<div class="modal" id="logoutModal" role="dialog" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <i class="fas fa-sign-out-alt"></i> <?php lang("Do you want to Logout?");?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php lang("No");?></button>
        <button type="button" class="btn btn-primary" onClick="document.location='apps/login/do_logout.php'"><?php lang("Yes");?></button>
      </div>
    </div>
  </div>
</div>
