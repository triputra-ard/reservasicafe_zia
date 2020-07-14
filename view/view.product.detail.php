<?php if (empty($_GET['id'])): ?>
  <div class="alert alert-danger">
    <h4>Umm.. sesuatu bermasalah, harap coba lagi nanti</h4>
  </div>
<?php else: ?>
  <div class="row">
      <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="row">
            <?php
            $getid = decrypt($_GET['id']);
            $sql = "SELECT * FROM `menu` WHERE id_menu = '$getid'";
            $query = mysqli_query($db,$sql);
            while ($product = mysqli_fetch_assoc($query)) {
            ?>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pr-xl-0 pr-lg-0 pr-md-0  m-b-30 bg-dark">
                  <div class="product-slider bg-dark">
                      <img class="img-thumbnail img-responsive" src="<?php echo $pictLink."/".$product['foto_menu'] ?>" alt="<?php echo $product['nama_menu'] ?>">
                  </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pl-xl-0 pl-lg-0 pl-md-0 border-left m-b-30">
                  <div class="product-details">
                      <div class="border-bottom pb-3 mb-3">
                          <h2 class="mb-3"><?php echo $product['nama_menu']; ?></h2>
                          <h3 class="mb-0 text-primary">IDR <?php echo number_format($product['harga_menu'],0,',','.'); ?></h3>
                      </div>
                      <div class="border-bottom pb-3 mb-3">
                          <h3 class="mb-3 text-secondary text-center">
                            <?php if ($product['kategori_menu'] == "snack") {
                              echo "Makanan Ringan";
                            }elseif ($product['kategori_menu'] == "meal") {
                              echo "Makanan Berat";
                            }elseif ($product['kategori_menu'] == "drinks") {
                              echo "Minuman";
                            }?></h3>
                      </div>
                      <div class="product-description pb-3 mb-3">
                          <h3 class="text-center">Ketersediaan : <?php echo $product['ketersediaan_menu']; ?></h3>
                          <h5 class="mb-1">Deskripsi menu</h5>
                          <p><?php echo $product['deskripsi_menu']; ?></p>

                          <form class="" action="" method="get">
                            <div class="d-flex flex-row justify-content-center">
                              <div class="p-2">
                                <input class="form-control mr-5" type="number" name="" value="" onkeypress="return OnlyNumber(event)" placeholder="Pilih kuantitas" min="1"
                                max="">
                              </div>
                              <div class="p-2">
                                <a href="#" data-target="#asklogin" data-toggle="modal" class="btn btn-block btn-primary"><i class="fas fa-shopping-cart"></i> Tambah troli</a>
                              </div>
                            </div>
                          </form>

                      </div>
                  </div>
              </div>
              <?php } ?>
          </div>
        </div>
      </div>
<?php endif; ?>
