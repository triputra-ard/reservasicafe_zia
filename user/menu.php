<?php
if (!empty($_GET['menu'])) {
  if ($_GET['menu'] == 'buy') {
    $titlePage = "Daftar Menu";
    $currentpage = "menu";
  }elseif ($_GET['menu'] == 'cart') {
    $titlePage = "Troli";
    $currentpage = "cart";
  }elseif ($_GET['menu'] == 'reservation') {
    $titlePage = "Reservasi";
    $currentpage = "reservation";
  }elseif ($_GET['menu'] == 'new_reservation') {
    $titlePage = "Reservasi";
    $currentpage = "reservation";
  }elseif ($_GET['menu'] == 'reserved_menu') {
    $titlePage = "Reservasi";
    $currentpage = "reservation";
  }elseif ($_GET['menu'] == 'transaction') {
    $titlePage = "Kirim Bukti Pembayaran";
    $currentpage = "reservation";
  }elseif ($_GET['menu'] == 'detail') {
    $titlePage = "Informasi Menu";
    $currentpage = "menu";
  }else {
    $titlePage = "UNKNOWN";
    $currentpage = "home";
    $headertitle = "UNKNOWN";
  }
}
include 'navigation.user.php'; ?>
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->

            <?php if (!empty($_GET['menu'])): ?>
              <?php if ($_GET['menu'] == 'buy'): ?>
                <div class="row">
                  <!-- Start Section -->
                  <div class="col-xl-3">
                   <?php include 'model/form.search.php'; ?>
                  </div>

                  <div class="col-xl-9">
                    <div class="card transparent-white">
                      <div class="card-body">
                        <?php if (!empty($_GET['sort'])): ?>

                          <?php if ($_GET['sort'] == "search"): ?>
                            <?php include 'view/view.product.search.php'; ?>
                         <?php elseif ($_GET['sort'] == "filter"): ?>
                            <?php include 'view/view.product.filter.php'; ?>
                         <?php endif; ?>

                        <?php else: ?>
                          <?php include 'view/view.product.php'; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <!--End section -->
                </div>
              <?php elseif ($_GET['menu'] == 'cart'): ?>
                <div class="card transparent-white">
                  <div class="card-header">
                    <h4 class="text-center">Troli : <?php echo $_SESSION["name"]; ?></h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <?php include 'view/view.cart.php'; ?>
                    </div>
                  </div>
                </div>
              <?php elseif ($_GET['menu'] == 'reservation'): ?>
                <div class="card">
                  <?php include 'view/view.reservation.php' ?>
                </div>
              <?php elseif ($_GET['menu'] == 'new_reservation'): ?>
                <div class="card transparent-white">
                  <?php include 'model/form.reservation.php' ?>
                </div>
              <?php elseif ($_GET['menu'] == 'reserved_menu'): ?>
                <div class="card">
                  <?php include 'view/view.reservedmenu.php'; ?>
                </div>
              <?php elseif ($_GET['menu'] == 'transaction'): ?>
                <div class="card transparent-white">
                  <?php include 'model/form.transaction.php' ?>
                </div>
              <?php elseif ($_GET['menu'] == 'detail'): ?>
                <?php include 'view/view.product.detail.php'; ?>


              <?php else: ?>
                <div class="col-xl-9 offset-xl-2">
                  <div class="card transparent-white">
                    <div class="card-body">
                      <h3 class="text-dark">Umm.. Ada kesalahan.. jangan khawatir, kami akan memperbaikinya segera !</h3>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            <?php endif; ?>
                <!-- ============================================================== -->
            </div>
        </div>
<?php include 'authors.footer.php'; ?>
