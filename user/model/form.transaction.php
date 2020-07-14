<div class="card-header">
  <h4 class="text-center">Kirim Bukti Transaksi</h4>
</div>
<div class="card-body">
  <?php
  $id = decrypt($_GET['id']);
  $sql = "SELECT * FROM `transaksi` Where id_reservasi = '$id'";
  $query = mysqli_query($db,$sql);
  while ($view = mysqli_fetch_assoc($query)) {
    $trx_time = strtotime($view['tanggal_transaksi']);
    $local = date("Y-m-d H:i:s");
    $localtime = strtotime($local);
    $diff = $localtime - $trx_time;
    $hour = floor($diff/(60*60));
    $minute = $diff - $hour*(60*60);
   ?>
  <div class="alert bg-info">
    <h3 class="text-white">Waktu Transaksi : <?php echo $hour; ?> Jam <?php echo floor($minute/60); ?> Menit yang lalu </h3>
  </div>
  <div class="alert bg-primary">
    <h4 class="text-white">Lakukan pembayaran via <?php echo $bank; ?> sejumlah Rp. <?php echo number_format($view['harga_transaksi'],0,',','.'); ?> (Biaya antar bank mungkin berlaku)</h4>
  </div>
    <?php } ?>
  <form class="" action="control/script.transaction" method="post" enctype="multipart/form-data">
    <input hidden type="text" name="id" value="<?php echo $_GET['id']; ?>">
    <div class="alert alert-info">
      <h4>File foto bukti pembayaran harus berekstensi : JPG/JPEG/BMP/PNG <br> Dengan maksimal ukuran file : 3mb <br>
        Kami akan melakukan Verifikasi pembayaran anda paling lambat 8 jam dari transaksi, cek konfirmasi dari kami di <b class="text-success">Menu Checkout</b>
       </h4>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label>Pilih file bukti transaksi</label>
      </div>
      <div class="col-xl-8">
        <input type="file" class="form-control" name="trxfile" onchange="previewImg1(event)">
        <img class="previewImage img-thumbnail" id="preview1">
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success btn-rounded btn-block" name="transaction"><i class="fas fa-check"></i> Verifikasi pembayaran</button>
    </div>
  </form>
</div>
