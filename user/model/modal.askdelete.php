<div  id="askdelete-<?php echo $view['id_reservasi']; ?>" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-sm animated--grow-in" role="document">
        <div class="modal-content">
          <div class="modal-body bg-danger">
            <h4 class="text-lg text-white text-center">Apa anda akan membatalkan reservasi ini ? Tindakan ini tidak dapat diurungkan</h4>
            <br>
            <center>
              <form class="" action="control/script.reservation" method="post">
                <input type="text" hidden name="reservation" value="<?php echo encrypt($view['id_reservasi']); ?>">
                <button type="submit" name="cancel" class="btn btn-default" title="Hapus checkout">Ya</button>
              </form>
            <button class="btn btn-dark btn-outline" type="button" data-dismiss="modal">Tutup </button>
          </center>
          </div>
        </div>
    </div>
</div>
