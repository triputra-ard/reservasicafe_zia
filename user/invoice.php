<?php
$titlePage = "E-INVOICE";
include 'header.php'; ?>
<body>
  <div class="page-wrapper">
    <div class="container-fluid">

      <div class="row">
        <?php
        $id = decrypt($_GET["id"]);
        $sql = "SELECT * FROM `transaksi` a
        JOIN reservasi b On a.id_reservasi = b.id_reservasi
        WHERE a.id_reservasi = '$id'
        ";
        $query = mysqli_query($db,$sql);
        $nomor = 1;
        ?>
          <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <?php while ($view = mysqli_fetch_assoc($query)) {
              $current_time = $view['tanggal_reservasi'];
              $replace_time = strtotime($current_time);
              $timestamp = date("D, d-M-Y", $replace_time);
              ?>
              <div class="card">
                  <div class="card-header p-4">
                       <p class="pt-2 d-inline-block"><img src="<?php echo $logoLink; ?>" class="img-thumbnail" alt="Logo" width="120px" height="120px"></p>

                      <div class="float-right"> <h3 class="mb-0"><?php echo $view['id_transaksi']; ?></h3>
                      <h5 class="mb-0">Reservasi : <?php echo $id; ?></h5>
                      Tanggal Cetak : <?php echo date("D, d-M-Y"); ?><br>
                      Tanggal Pemesanan : <?php echo $timestamp; ?> </div>
                  </div>
                  <div class="card-body">
                      <div class="row mb-4">
                          <div class="col-sm-6">
                              <h5 class="mb-3">Dari:</h5>
                              <h3 class="text-dark mb-1"><?php echo $companyInfo; ?></h3>

                              <div><?php echo $companyAddress ?></div>
                              <div>Email: <?php echo $companyEmail; ?></div>
                              <div>Telepon: <?php echo $companyPhones; ?></div>
                          </div>
                          <div class="col-sm-6">
                              <h5 class="mb-3">Untuk:</h5>
                              <h3 class="text-dark mb-1"><?php echo $_SESSION["name"]; ?></h3>
                              <div>Email: <?php echo $_SESSION["email"]; ?></div>
                              <div>Telepon: <?php echo $_SESSION["phone"]; ?></div>
                          </div>
                      </div>
                      <?php } ?>
                      <div class="table-responsive-sm">
                          <table class="table table-striped">
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
                                $itemprice=array();
                                $id = decrypt($_GET["id"]);
                                $sql2 = "SELECT * FROM `reservasi_menu` a
                                JOIN `reservasi` b On a.id_reservasi = b.id_reservasi
                                JOIN `menu` d On a.id_menu = d.id_menu
                                WHERE a.id_reservasi = '$id'
                                ";
                                $query2 = mysqli_query($db,$sql2); ?>
                                <?php while ($view2 = mysqli_fetch_assoc($query2)) {
                                  $totalitem = $view2['harga_menu']*$view2['kuantitas_menu'];
                                  $itemprice[] = $totalitem;
                                  ?>
                                  <tr>
                                      <td class="center"><?php echo $nomor++; ?></td>
                                      <td class="left strong"><?php echo $view2['nama_menu']; ?></td>
                                      <td class="left">
                                    <?php if ($view2['kategori_menu'] == "snack") {
                                        echo "Makanan Ringan";
                                      }elseif ($view2['kategori_menu'] == "meal") {
                                        echo "Makanan Berat";
                                      }elseif ($view2['kategori_menu'] == "drinks") {
                                        echo "Minuman";
                                      }?></td>
                                      <td class="right">Rp. <?php echo number_format($view2['harga_menu'],0,',','.'); ?></td>
                                      <td class="center"><?php echo $view2['kuantitas_menu']; ?></td>
                                      <td class="right">Rp. <?php echo number_format($totalitem,0,'.',','); ?></td>
                                  </tr>
                                <?php } ?>
                                <?php
                                $reservationprice = array();
                                $id = decrypt($_GET["id"]);
                                $sql3 = "SELECT * FROM `transaksi` a
                                JOIN `reservasi` b On a.id_reservasi = b.id_reservasi
                                WHERE a.id_reservasi = '$id'
                                ";
                                $query3 = mysqli_query($db,$sql3); ?>
                                <?php while ($view3 = mysqli_fetch_assoc($query3)) {
                                  $reservationprice[] = $view3['harga_transaksi'];
                                ?>
                                <tr>
                                  <td class="center"><?php echo $nomor++; ?></td>
                                  <td class="left strong">Reservasi</td>
                                  <td class="left">
                                    <?php if ($view3['waktu_reservasi'] == "pagi"): ?>
                                           Pagi (11:00 - 12:00)
                                   <?php elseif ($view3['waktu_reservasi'] == "siang-a"): ?>
                                           Siang (12:00 - 14:00)
                                   <?php elseif ($view3['waktu_reservasi'] == "siang-b"): ?>
                                           Siang (14:00 - 16:00)
                                   <?php elseif ($view3['waktu_reservasi'] == "sore-a"): ?>
                                           Sore (16:00 - 18:00)
                                   <?php elseif ($view3['waktu_reservasi'] == "sore-b"): ?>
                                           Sore (18:00 - 20:00)
                                   <?php elseif ($view3['waktu_reservasi'] == "malam"): ?>
                                           Malam (20:00 - 23:00)
                                    <?php endif; ?> &nbsp;
                                    <?php if ($view3['reservasi_meja'] == "1.1"): ?>
                                       1.1 Meja TV (6 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "1.2"): ?>
                                       1.2 Meja Meeting (10 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "2.1"): ?>
                                       2.1 Meja Jahit (2 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "2.2"): ?>
                                       2.2 Meja Jahit (2 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "3"): ?>
                                       3 Meja Kaca (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "4.1"): ?>
                                       4.1 Sofa (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "4.2"): ?>
                                       4.2 Sofa (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "5.1"): ?>
                                       5.1 Meja Halaman Belakang (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "5.2"): ?>
                                       5.2 Meja Halaman Belakang (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "5.3"): ?>
                                       5.3 Meja Halaman Belakang (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "5.4"): ?>
                                       5.4 Meja Halaman Belakang (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "5.5"): ?>
                                       5.5 Meja Halaman Belakang (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "6.1"): ?>
                                       6.1 Meja Jati (5 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "6.2"): ?>
                                       6.2 Meja Jati (5 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "7.1"): ?>
                                       7.1 Meja Jahit (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "7.2"): ?>
                                       7.2 Meja Jahit (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "8"): ?>
                                       8 Meja Kursi Tinggi (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "9.1"): ?>
                                       9.1 Meja Taman Atas (4 Orang)
                                     <?php elseif ($view3['reservasi_meja'] == "9.2"): ?>
                                       9.2 Meja Taman Atas (4 Orang)
                                    <?php endif; ?>
                                  </td>
                                  <td class="right">Rp. <?php echo number_format($view3['harga_transaksi'],0,',','.'); ?></td>
                                  <td class="center">1</td>
                                  <td class="right">Rp. <?php echo number_format($view3['harga_transaksi'],0,',','.'); ?></td>
                                </tr>
                              <?php } ?>
                              </tbody>
                          </table>
                      </div>
                      <div class="row">
                          <div class="col-lg-4 col-sm-5">
                          </div>
                          <div class="col-lg-4 col-sm-5 ml-auto">
                              <table class="table table-clear">
                                  <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Subtotal</strong>
                                        </td>
                                        <td class="right">
                                            <strong class="text-dark">Rp. <?php echo number_format(array_sum($itemprice),0,'.',','); ?></strong>
                                        </td>
                                    </tr>
                                      <tr>
                                          <td class="left">
                                              <strong class="text-dark">Total</strong>
                                          </td>
                                          <td class="right">
                                              <strong class="text-dark">
                                                <?php
                                                $countreservation = array_sum($reservationprice);
                                                $countitem = array_sum($itemprice);
                                                $totalprice = $countreservation + $countitem;
                                                 ?>
                                                Rp. <?php echo number_format($totalprice,0,'.',','); ?>
                                              </strong>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
                  <div class="card-footer bg-white">
                      <p class="mb-0">Harga total diatas tidak termasuk PPN | <b>*Harap tunjukkan faktur ini kepada kasir untuk mengkonfirmasi pemesanan</b></p>
                  </div>
              </div>
          </div>
      </div>

    </div>
  </div>
  <script>
    /*window.print();*/
  </script>
</body>
<?php include 'footer.php'; ?>
