  <div class="card-body">
    <div class="table-responsive">
      <table id="Admin_table" class="table table-bordered table-hover">
        <thead>
          <th>Reservasi ID</th>
          <th>Tanggal</th>
          <th>Meja</th>
          <th>Status</th>
          <th>Opsi</th>
        </thead>
        <tbody class="text-dark">
          <?php
          $user = $_SESSION["id"];
          $sql = "SELECT * FROM `reservasi` a
           LEFT JOIN `admin` b On a.id_admin = b.id_admin
           Where a.id_user = '$user' AND a.status_reservasi != 'SELESAI'";
          $query = mysqli_query($db,$sql);
           ?>
          <?php while ($view = mysqli_fetch_assoc($query)) {
            $current_time = $view['tanggal_reservasi'];
            $replace_time = strtotime($current_time);
            $timestamp = date("D, d-M-Y", $replace_time);
            // code..?><tr>
              <td><?php echo $view['id_reservasi'] ?></td>
              <td><?php echo $view['tanggal_reservasi']; ?>
                <?php echo $timestamp; ?> &nbsp; [
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
                 <?php else: ?>
                     Anda belum memilih waktu
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
                 <?php else: ?>
                   Anda belum memesan meja
                <?php endif; ?>
              </td>
              <td><?php echo $view['status_reservasi']; ?>
                <?php if (!empty($view['id_admin'])): ?>
                  <br>Diverifikasi oleh : <?php echo $view['nama_admin']; ?> (Admin)
                <?php endif; ?>
              </td>
              <td>
                <?php if ($view['status_reservasi'] == "PENDING"): ?>
                  <?php if (!empty($view['id_admin'])): ?>
                    <b>*Reservasi anda dibatalkan karena melebihi waktu pembayaran.</b>
                  <?php endif; ?>
                  <a href="?menu=reserved_menu&id=<?php echo encrypt($view['id_reservasi']); ?>&status=<?php echo $view['status_reservasi']; ?>" class="btn btn-primary btn-rounded"> <i class="fas fa-info-circle"></i> Lihat informasi lengkap</a>
                  <a href="#" data-toggle="modal" data-target="#askdelete-<?php echo $view['id_reservasi']; ?>" class="btn btn-danger btn-rounded"> <i class="fas fa-times"></i> Hapus</a>
                  <a href="?menu=new_reservation&id=<?php echo encrypt($view['id_reservasi']); ?>" class="btn btn-success btn-rounded">Lanjutkan reservasi <i class="fas fa-arrow-right"></i></a>
                <?php elseif ($view['status_reservasi'] == "MENUNGGU PEMBAYARAN"): ?>
                  <a href="?menu=reserved_menu&id=<?php echo encrypt($view['id_reservasi']); ?>&status=<?php echo $view['status_reservasi']; ?>" class="btn btn-primary btn-rounded"> <i class="fas fa-info-circle"></i> Lihat informasi lengkap</a>
                  <a href="?menu=transaction&id=<?php echo encrypt($view['id_reservasi']); ?>" class="btn btn-success btn-rounded"> <i class="fas fa-file-invoice-dollar"></i> Kirim bukti pembayaran</a>
                <?php elseif ($view['status_reservasi'] == "DIPROSES"): ?>
                  <a href="?menu=reserved_menu&id=<?php echo encrypt($view['id_reservasi']); ?>&status=<?php echo $view['status_reservasi']; ?>" class="btn btn-primary btn-rounded"> <i class="fas fa-info-circle"></i> Lihat informasi lengkap</a>
                  <a href="invoice?id=<?php echo encrypt($view['id_reservasi']); ?>" target="_blank" class="btn btn-danger btn-rounded"> <i class="fas fa-file-pdf"></i> Cetak Faktur</a>
                <?php elseif ($view['status_reservasi'] == "AKTIF"): ?>
                  <a href="?menu=reserved_menu&id=<?php echo encrypt($view['id_reservasi']); ?>&status=<?php echo $view['status_reservasi']; ?>" class="btn btn-primary btn-rounded"> <i class="fas fa-info-circle"></i> Lihat informasi lengkap</a>
                <?php else: ?>
                  <h3 class="text-dark"><b>Tunggu ya.. kami sedang memverifikasi pembayaran kamu.. tenang engga bakal lama kok :)</b></h3>
                <?php endif; ?>
              </td>
            </tr>
            <?php include 'model/modal.askdelete.php'; ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
