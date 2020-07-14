<?php if (empty($_GET['filter'])): ?>
  <h3 class="text-center">Hmm.. menunya belum ada nih, coba lagi nanti ya...</h3>
<?php else: ?>
    <?php
    $search = isset($_GET['filter'])  ? (string)$_GET['filter'] : '';
    $currentpage = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $paging = 3;
    $pages = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $number = 1;
    $start = ($pages>1) ? ($pages * $paging) - $paging : 0;
    $previous = $pages - 1;
    $next = $pages + 1;
    $sqlresult = "SELECT * From `menu` Where kategori_menu Like '%$search%'";
    $queryresult = mysqli_query($db, $sqlresult);
    $totalpage = mysqli_num_rows($queryresult);
    $pagination = ceil($totalpage/$paging);
    $sqlfetch = "SELECT * From `menu` Where kategori_menu Like '%$search%'
    LIMIT $start,$paging";
    $query = mysqli_query($db, $sqlfetch);
    ?>
    <?php if (mysqli_num_rows($query) === 0): ?>
      <h3 class="text-center">Hmm.. menunya belum ada nih, coba lagi nanti ya...</h3>
    <?php else: ?>
      <div class="row">
        <?php while ($menu = mysqli_fetch_assoc($query)) { ?>
          <div class="col-xl-4 col-sm-12 col-12">
              <div class="product-thumbnail transparent">
                  <div class="product-img-head">
                      <div class="product-img">
                          <img src="<?php echo $pictLink."/".$menu['foto_menu']; ?>" alt="" class="img-responsive img-fluid"></div>
                  </div>
                  <div class="product-content">
                      <div class="product-content-head">
                          <h3 class="product-title text-white"><?php echo $menu['nama_menu']; ?></h3>
                          <div class="product-price text-white">Rp. <?php echo number_format($menu['harga_menu'],0,',','.'); ?></div>
                      </div>
                      <div class="d-flex d-row product-btn">
                          <div class="p-2">
                            <?php if ($menu['ketersediaan_menu'] == "KOSONG"): ?>
                              <button name="test" class="btn btn-primary" type="button" onclick="isempty()">Tambah Troli</button>
                              <?php else: ?>
                            <form class="" action="control/script.cart" method="post">
                              <input type="text" hidden name="menu" value="<?php echo encrypt($menu['id_menu']); ?>">
                              <button name="quickbuy" class="btn btn-primary" type="submit">Tambah Troli</button>
                            </form>
                            <?php endif; ?>
                          </div>
                          <div class="p-2">
                              <a href="menu?menu=detail&id=<?php echo encrypt($menu['id_menu']) ?>" class="btn btn-info">Lihat detail</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        <?php } ?>
      </div>
      <?php include '../function/pagination.php'; ?>
    <?php endif; ?>
<?php endif; ?>
