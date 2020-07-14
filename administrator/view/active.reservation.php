<?php
$nomor= 1;
$sql = "SELECT * FROM  `reservasi` a
JOIN `pengguna` b On a.id_user = b.id_user
JOIN `admin` c On a.id_admin = c.id_admin
Where a.status_reservasi = 'AKTIF';";
$query = mysqli_query($db,$sql) or die (mysqli_error($db));
while ($view = mysqli_fetch_assoc($query)) {
 ?>
<div class="card bg-primary">
    <div class="card-header bg-primary">
      <h5>
         <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#<?php echo $view['id_reservasi']; ?>" aria-controls="<?php echo $view['id_reservasi']; ?>">
           <span class="fas fa-angle-down"></span>
           <?php echo $view['id_reservasi'] ?> - <?php echo $view['nama_pengguna']; ?> (Diverifikasi = <?php echo $view['nama_admin']; ?>)
         </button>
     </h5>
    </div>
    <div class="collapse" id="<?php echo $view['id_reservasi']; ?>">
      <div class="card-body">
        <div class="table-responsive bg-white">
          <table class="table table-striped text-dark">
            <thead>
              <tr>
                  <th class="center">#</th>
                  <th>Item</th>
                  <th>Deskripsi</th>
                  <th class="right">Harga</th>
                  <th class="center">Kuantitas</th>
                  <th class="right">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $reservedmenu = $view['id_reservasi'];
              $sqlmenu = "SELECT * FROM  `reservasi_menu` a
              JOIN `menu` b On a.id_menu = b.id_menu
              Where a.id_reservasi = '$reservedmenu';";
              $querymenu= mysqli_query($db,$sqlmenu) or die (mysqli_error($db));
              while ($viewmenu = mysqli_fetch_assoc($querymenu)) {
                $total = $viewmenu['kuantitas_menu']*$viewmenu['harga_menu'];
               ?>
               <tr>
                 <td><?php echo $nomor++; ?></td>
                 <td><?php echo $viewmenu['nama_menu']; ?></td>
                 <td><?php if ($viewmenu['kategori_menu'] == "snack") {
                   echo "Makanan Ringan";
                 }elseif ($viewmenu['kategori_menu'] == "meal") {
                   echo "Makanan Berat";
                 }elseif ($viewmenu['kategori_menu'] == "drinks") {
                   echo "Minuman";
                 }?></td>
                 <td>Rp. <?php echo number_format($viewmenu['harga_menu'],0,'.',','); ?></td>
                 <td><?php echo $viewmenu['kuantitas_menu']; ?></td>
                 <td>Rp. <?php echo number_format($total,0,'.',','); ?></td>
               </tr>
             <?php } ?>

            </tbody>
          </table>
          <br>
          <table class="table table-striped text-dark">
            <tbody>
              <tr>
                <td>Meja :</td>
                <td> <?php if ($view['reservasi_meja'] == "1.1"): ?>
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
               <td>
                 <a href="#" data-toggle="modal" data-target="#finish-<?php echo $view['id_reservasi']; ?>" data class="btn btn-success btn-block"><i class="fas fa-check"></i> Selesai</a>
               </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
<?php include 'model/modal.finish.php'; ?>
<?php } ?>
