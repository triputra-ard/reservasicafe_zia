<div class="table-responsive">
  <table id="Admin_table" class="table table-bordered">
    <thead>
      <th>NO</th>
      <th>Nama Pengguna</th>
      <th>Reservasi</th>
      <th>Biaya Reservasi</th>
      <th>Foto transaksi</th>
      <th>Waktu transaksi</th>
      <th>Divalidasi</th>
    </thead>
    <tbody>
      <?php
      $nomor = 1;
      $sql = "SELECT * From `transaksi` a
      JOIN `reservasi` b On a.id_reservasi = b.id_reservasi
      JOIN `pengguna` c On a.id_user = c.id_user
      LEFT JOIN `admin` d On a.id_admin = d.id_admin
      Where a.status_transaksi = 'LUNAS' And b.status_reservasi = 'SELESAI' ";
      $query = mysqli_query($db,$sql);

      while ($view = mysqli_fetch_assoc($query)) {
        $current_time = $view['tanggal_transaksi'];
        $replace_time = strtotime($current_time);
        $timestamp = date("D, d-M-Y", $replace_time);
       ?>
       <tr>
         <td><?php echo $nomor++; ?></td>
         <td><?php echo $view['nama_pengguna']; ?></td>
         <td><?php echo $view['id_reservasi']; ?></td>
         <td>Rp. <?php echo number_format($view['harga_transaksi'],0,'.','.'); ?></td>
         <td><img class="img-thumbnail" src="<?php echo $pictLink."/".$view['foto_transaksi']; ?>"> </td>
         <td><?php echo $timestamp; ?></td>
         <td><?php echo $view['nama_admin']; ?> <br>
           <a href="?view=detail&id=<?php echo encrypt($view['id_reservasi']); ?>&status=<?php echo $view['status_reservasi']; ?>" class="btn btn-primary btn-rounded"> <i class="fas fa-info-circle"></i> Lihat informasi lengkap</a>
        </td>
       </tr>
     <?php } ?>
    </tbody>
  </table>
</div>
