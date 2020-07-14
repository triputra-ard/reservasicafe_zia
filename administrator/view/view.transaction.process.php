<div class="table-responsive">
  <table id="Admin_table" class="table table-bordered">
    <thead>
      <th>NO</th>
      <th>Nama Pengguna</th>
      <th>Harga</th>
      <th>Foto transaksi</th>
      <th>Waktu transaksi</th>
      <th>Opsi</th>
    </thead>
    <tbody>
      <?php
      $nomor = 1;
      $sql = "SELECT * From `reservasi` a
      JOIN `pengguna` b On a.id_user = b.id_user
      JOIN `transaksi` c On a.id_reservasi = c.id_reservasi
      LEFT JOIN `admin` d On a.id_admin = d.id_admin
      Where a.status_reservasi = 'MENUNGGU KONFIRMASI' OR a.status_reservasi = 'MENUNGGU PEMBAYARAN'";
      $query = mysqli_query($db,$sql) or die (mysqli_error($db));

      while ($view = mysqli_fetch_assoc($query)) {
        $current_time = $view['tanggal_transaksi'];
        $replace_time = strtotime($current_time);
        $timestamp = date("D, d-M-Y", $replace_time);
        $trx_time = strtotime($view['tanggal_transaksi']);
        $local = date("Y-m-d H:i:s");
        $localtime = strtotime($local);
        $diff = $localtime - $trx_time;
        $hour = floor($diff/(60*60));
        $minute = $diff - $hour*(60*60);
       ?>
       <tr>
         <td><?php echo $nomor++ ;?></td>
         <td><?php echo $view['nama_pengguna']; ?></td>
         <td>Rp.<?php echo number_format($view['harga_transaksi'],0,',','.'); ?></td>
         <td><img class="img-thumbnail" src="<?php echo $pictLink."/".$view['foto_transaksi']; ?>"> </td>
         <td><?php echo $timestamp; ?> <?php echo $hour; ?> Jam <?php echo floor($minute/60); ?> Menit yang lalu</td>
         <td>
           <?php if ($view['status_reservasi'] == "MENUNGGU PEMBAYARAN"): ?>
             <?php if (!empty($view['id_admin'])): ?>
                Belum dikonfirmasi/Tidak dapat diverifikasi : <?php echo $view['nama_admin']."(Admin)"; ?>
                <?php else: ?>
                Pengguna belum memverifikasi/melakukan pembayaran
             <?php endif; ?>
             &nbsp;
             <form class="" action="control/script.transaction" method="post">
               <input type="text" hidden name="admin" required value="<?php echo encrypt($_SESSION["id_admin"]); ?>">
               <input type="text" hidden name="reservation" value="<?php echo encrypt($view['id_reservasi']); ?>">
               <button type="submit" class="btn btn-rounded btn-danger" name="cancel" title="Batalkan reservasi"><i class="fas fa-trash"></i> Batalkan Reservasi</button>
             </form>
             <?php else: ?>
               <form class="" action="control/script.transaction" method="post">
                 <input type="text" hidden name="admin" required value="<?php echo encrypt($_SESSION["id_admin"]); ?>">
                 <input type="text" hidden name="reservation" value="<?php echo encrypt($view['id_reservasi']); ?>">
                 <input type="text" hidden name="transaction" value="<?php echo encrypt($view['id_transaksi']); ?>">
                 <button type="submit" class="btn btn-rounded btn-success" name="accept" title="Pembayaran sah"><i class="fas fa-check"></i> Terverifikasi</button>
               </form>
               <form class="" action="control/script.transaction" method="post">
                 <input type="text" hidden name="admin" required value="<?php echo encrypt($_SESSION["id_admin"]); ?>">
                 <input type="text" hidden name="reservation" value="<?php echo encrypt($view['id_reservasi']); ?>">
                 <input type="text" hidden name="transaction" value="<?php echo encrypt($view['id_transaksi']); ?>">
                 <input type="text" hidden name="photosremove" value="<?php echo "../../".$view['foto_transaksi']; ?>">
                 <button type="submit" class="btn btn-rounded btn-danger" name="decline" title="Pembayaran tidak sah"><i class="fas fa-times"></i> Tidak Sah</button>
               </form>
           <?php endif; ?>
         </td>
       </tr>
     <?php } ?>
    </tbody>
  </table>
</div>
