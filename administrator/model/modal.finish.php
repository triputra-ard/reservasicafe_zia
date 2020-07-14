<div  id="finish-<?php echo $view['id_reservasi']; ?>" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg animated--grow-in" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h4>Reservasi telah selesai ? <?php echo $view['nama_pengguna']; ?> - <?php echo $view['id_reservasi']; ?> </h4>
          </div>
          <div class="modal-footer bg-info">
            <form class="" action="control/script.reservation" method="post">
              <input type="text" hidden name="admin" required value="<?php echo encrypt($_SESSION["id_admin"]); ?>">
              <input type="text" hidden name="reservation" value="<?php echo encrypt($view['id_reservasi']); ?>">
              <button type="submit" name="finish" class="btn btn-success btn-outline btn-block"> Ya</button>
            </form>
            <button class="btn btn-dark btn-outline" type="button" data-dismiss="modal">Batal </button>
          </div>
        </div>
    </div>
</div>
