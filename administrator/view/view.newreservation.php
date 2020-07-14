<div class="table-responsive">
  <table id="Admin_table" class="table table-bordered">
    <thead>
      <th>#</th>
      <th>Reservasi</th>
      <th>Nama Pengguna</th>
      <th>Email</th>
      <th>Tanggal Reservasi</th>
      <th>Meja</th>
      <th>Opsi</th>
    </thead>
    <tbody>
      <?php
      $nomor = 1;
      $sql = "SELECT * From `reservasi` a
      JOIN `pengguna` b On a.id_user = b.id_user
      Where a.status_reservasi = 'DIPROSES'";
      $query = mysqli_query($db,$sql);

      while ($view = mysqli_fetch_assoc($query)) {
        $current_time = $view['tanggal_reservasi'];
        $replace_time = strtotime($current_time);
        $timestamp = date("D, d-M-Y", $replace_time);
       ?>
       <tr>
         <td><?php echo $nomor++; ?></td>
         <td><?php echo $view['id_reservasi']; ?></td>
         <td><?php echo $view['nama_pengguna']; ?></td>
         <td><?php echo $view['email']; ?></td>
         <td><?php echo $timestamp; ?>
           [
             <?php if ($view['waktu_reservasi'] == "pagi"): ?>
                    Pagi (11:00 - 12:00)
            <?php elseif ($view['waktu_reservasi'] == "siang-a"): ?>
                    Siang (12:00 - 14:00)
            <?php elseif ($view['waktu_reservasi'] == "siang-b"): ?>
                    Siang (14:00 - 16:00)
            <?php elseif ($view['waktu_reservasi'] == "sore-a"): ?>
                    Sore (16:00 - 18:00)
            <?php elseif ($view['waktu_reservasi'] == "sore-b"): ?>
                    Sore (18:00 - 20:00)
            <?php elseif ($view['waktu_reservasi'] == "malam"): ?>
                    Malam (20:00 - 23:00)
             <?php endif; ?>
             ]
         </td>
         <td>
           <?php if ($view['reservasi_meja'] == "1.1"): ?>
              1.1 Meja TV (6 Orang)
            <?php elseif ($view['reservasi_meja'] == "1.2"): ?>
              1.2 Meja Meeting (10 Orang)
            <?php elseif ($view['reservasi_meja'] == "2.1"): ?>
              2.1 Meja Jahit (2 Orang)
            <?php elseif ($view['reservasi_meja'] == "2.2"): ?>
              2.2 Meja Jahit (2 Orang)
            <?php elseif ($view['reservasi_meja'] == "3"): ?>
              3 Meja Kaca (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "4.1"): ?>
              4.1 Sofa (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "4.2"): ?>
              4.2 Sofa (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "5.1"): ?>
              5.1 Meja Halaman Belakang (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "5.2"): ?>
              5.2 Meja Halaman Belakang (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "5.3"): ?>
              5.3 Meja Halaman Belakang (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "5.4"): ?>
              5.4 Meja Halaman Belakang (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "5.5"): ?>
              5.5 Meja Halaman Belakang (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "6.1"): ?>
              6.1 Meja Jati (5 Orang)
            <?php elseif ($view['reservasi_meja'] == "6.2"): ?>
              6.2 Meja Jati (5 Orang)
            <?php elseif ($view['reservasi_meja'] == "7.1"): ?>
              7.1 Meja Jahit (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "7.2"): ?>
              7.2 Meja Jahit (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "8"): ?>
              8 Meja Kursi Tinggi (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "9.1"): ?>
              9.1 Meja Taman Atas (4 Orang)
            <?php elseif ($view['reservasi_meja'] == "9.2"): ?>
              9.2 Meja Taman Atas (4 Orang)
           <?php endif; ?>
         </td>
         <td><a href="#" data-toggle="modal" data-target="#active-<?php echo $view['id_reservasi'] ?>" class="btn btn-success" title="Aktifkan reservasi"><i class="fas fa-check"></i> Aktifkan</a></td>
       </tr>
       <?php include 'model/modal.active.php'; ?>
     <?php } ?>
    </tbody>
  </table>
</div>
