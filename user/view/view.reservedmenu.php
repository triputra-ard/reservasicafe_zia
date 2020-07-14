  <div class="card-body">
    <div class="table-responsive">
      <table id="Admin_table" class="table table-bordered table-hover">
        <?php if ($_GET['status'] == "PENDING"): ?>
          <thead>
            <th>ID reservasi</th>
            <th>Menu</th>
            <th>Kuantitas</th>
            <th>Total Harga</th>
            <th>Tanggal Reservasi</th>
            <th>Meja</th>
          </thead>
          <tbody>
            <?php
            $count = array();
            $id = decrypt($_GET['id']);
            $sql = "SELECT * FROM `reservasi_menu` a
            JOIN `reservasi` b ON a.id_reservasi = b.id_reservasi
            JOIN `menu` c ON a.id_menu = c.id_menu
            Where a.id_reservasi = '$id' AND b.status_reservasi != 'SELESAI'";
            $query = mysqli_query($db,$sql);
            while ($view = mysqli_fetch_assoc($query)) {
              $total = $view['kuantitas_menu']*$view['harga_menu'];
              $count[] = $total;
             ?>
             <tr>
               <td><?php echo $view['id_reservasi']; ?></td>
               <td><?php echo $view['nama_menu']; ?></td>
               <td><?php echo $view['kuantitas_menu']; ?> Item</td>
               <td><b>RP. <?php echo number_format($total,0,'.',','); ?></b></td>
               <td><?php echo $view['tanggal_reservasi']; ?> &nbsp; [
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
             </tr>
           <?php } ?>
           <tr>
             <td colspan="3">Total Pembayaran</td>
             <td colspan="4"><b><?php echo number_format(array_sum($count),0,'.',','); ?></b></td>
           </tr>
          </tbody>
          <tfoot>
            <th colspan="6">
              <a href="?menu=new_reservation&id=<?php echo encrypt($view['id_reservasi']); ?>" class="btn btn-success btn-block btn-rounded">Lanjutkan reservasi <i class="fas fa-arrow-right"></i></a>
            </th>
          </tfoot>
        <?php elseif ($_GET['status'] == "MENUNGGU PEMBAYARAN"): ?>
          <thead>
            <th>ID reservasi</th>
            <th>Menu</th>
            <th>Kuantitas</th>
            <th>Total Harga</th>
            <th>Tanggal Reservasi</th>
            <th>Meja</th>
          </thead>
          <tbody>
            <?php
            $count = array();
            $id = decrypt($_GET['id']);
            $sql = "SELECT * FROM `reservasi_menu` a
            JOIN `reservasi` b ON a.id_reservasi = b.id_reservasi
            JOIN `menu` c ON a.id_menu = c.id_menu
            Where a.id_reservasi = '$id' AND b.status_reservasi != 'SELESAI'";
            $query = mysqli_query($db,$sql);
            while ($view = mysqli_fetch_assoc($query)) {
              $total = $view['kuantitas_menu']*$view['harga_menu'];
              $count[] = $total;
             ?>
             <tr>
               <td><?php echo $view['id_reservasi']; ?></td>
               <td><?php echo $view['nama_menu']; ?></td>
               <td><?php echo $view['kuantitas_menu']; ?> Item</td>
               <td><b>RP. <?php echo number_format($total,0,'.',','); ?></b></td>
               <td><?php echo $view['tanggal_reservasi']; ?> &nbsp; [
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
             </tr>
           <?php } ?>
           <tr>
             <td colspan="3">Total Pembayaran</td>
             <td colspan="4"><b><?php echo number_format(array_sum($count),0,'.',','); ?></b></td>
           </tr>
          </tbody>
          <tfoot>
            <th colspan="6">
              <a href="?menu=transaction&id=<?php echo $_GET['id']; ?>" class="btn btn-success btn-rounded"> <i class="fas fa-file-invoice-dollar"></i> Kirim bukti pembayaran</a>
            </th>
          </tfoot>
        <?php elseif ($_GET['status'] == "DIPROSES"): ?>
          <thead>
            <th>ID reservasi</th>
            <th>Menu</th>
            <th>Kuantitas</th>
            <th>Total Harga</th>
            <th>Tanggal Reservasi</th>
            <th>Meja</th>
          </thead>
          <tbody>
            <?php
            $count = array();
            $id = decrypt($_GET['id']);
            $sql = "SELECT * FROM `reservasi_menu` a
            JOIN `reservasi` b ON a.id_reservasi = b.id_reservasi
            JOIN `menu` c ON a.id_menu = c.id_menu
            Where a.id_reservasi = '$id' AND b.status_reservasi != 'SELESAI'";
            $query = mysqli_query($db,$sql);
            while ($view = mysqli_fetch_assoc($query)) {
              $total = $view['kuantitas_menu']*$view['harga_menu'];
              $count[] = $total;
             ?>
             <tr>
               <td><?php echo $view['id_reservasi']; ?></td>
               <td><?php echo $view['nama_menu']; ?></td>
               <td><?php echo $view['kuantitas_menu']; ?> Item</td>
               <td><b>RP. <?php echo number_format($total,0,'.',','); ?></b></td>
               <td><?php echo $view['tanggal_reservasi']; ?> &nbsp; [
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
             </tr>
           <?php } ?>
           <tr>
             <td colspan="3">Total Pembayaran</td>
             <td colspan="4"><b><?php echo number_format(array_sum($count),0,'.',','); ?></b></td>
           </tr>
          </tbody>
          <tfoot>
            <th colspan="6">
              <a href="invoice?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-danger btn-rounded"> <i class="fas fa-file-pdf"></i> Cetak Faktur</a>
            </th>
          </tfoot>
        <?php elseif ($_GET['status'] == "AKTIF"): ?>
          <thead>
            <th>ID reservasi</th>
            <th>Menu</th>
            <th>Kuantitas</th>
            <th>Total Harga</th>
            <th>Tanggal Reservasi</th>
            <th>Meja</th>
          </thead>
          <tbody>
            <?php
            $count = array();
            $id = decrypt($_GET['id']);
            $sql = "SELECT * FROM `reservasi_menu` a
            JOIN `reservasi` b ON a.id_reservasi = b.id_reservasi
            JOIN `menu` c ON a.id_menu = c.id_menu
            Where a.id_reservasi = '$id' AND b.status_reservasi != 'SELESAI'";
            $query = mysqli_query($db,$sql);
            while ($view = mysqli_fetch_assoc($query)) {
              $total = $view['kuantitas_menu']*$view['harga_menu'];
              $count[] = $total;
             ?>
             <tr>
               <td><?php echo $view['id_reservasi']; ?></td>
               <td><?php echo $view['nama_menu']; ?></td>
               <td><?php echo $view['kuantitas_menu']; ?> Item</td>
               <td><b>RP. <?php echo number_format($total,0,'.',','); ?></b></td>
               <td><?php echo $view['tanggal_reservasi']; ?> &nbsp; [
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
             </tr>
           <?php } ?>
           <tr>
             <td colspan="3">Total Pembayaran</td>
             <td colspan="4"><b><?php echo number_format(array_sum($count),0,'.',','); ?></b></td>
           </tr>
          </tbody>
        <?php elseif ($_GET['status'] == "SELESAI"): ?>
          <thead>
            <th>ID reservasi</th>
            <th>Menu</th>
            <th>Kuantitas</th>
            <th>Total Harga</th>
            <th>Tanggal Reservasi</th>
            <th>Meja</th>
          </thead>
          <tbody>
            <?php
            $count = array();
            $id = decrypt($_GET['id']);
            $sql = "SELECT * FROM `reservasi_menu` a
            JOIN `reservasi` b ON a.id_reservasi = b.id_reservasi
            JOIN `menu` c ON a.id_menu = c.id_menu
            Where a.id_reservasi = '$id' AND b.status_reservasi = 'SELESAI'";
            $query = mysqli_query($db,$sql);
            while ($view = mysqli_fetch_assoc($query)) {
              $total = $view['kuantitas_menu']*$view['harga_menu'];
              $count[] = $total;
             ?>
             <tr>
               <td><?php echo $view['id_reservasi']; ?></td>
               <td><?php echo $view['nama_menu']; ?></td>
               <td><?php echo $view['kuantitas_menu']; ?> Item</td>
               <td><b>RP. <?php echo number_format($total,0,'.',','); ?></b></td>
               <td><?php echo $view['tanggal_reservasi']; ?> &nbsp; [
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
             </tr>
           <?php } ?>
           <tr>
             <td colspan="3">Total Pembayaran</td>
             <td colspan="4"><b><?php echo number_format(array_sum($count),0,'.',','); ?></b></td>
           </tr>
          </tbody>
        <?php endif; ?>
      </table>
    </div>
  </div>
