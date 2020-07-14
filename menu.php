<?php
if (!empty($_GET['menu'])) {
  if ($_GET['menu'] == "detail") {
    $titlePage = "Informasi menu";
    $currentpage = "menu";
  }elseif ($_GET['menu'] == "buy"){
    $titlePage = "Daftar Menu";
    $currentpage = "menu";
  }
}
include 'navigation.common.php'; ?>
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <?php if (!empty($_GET['menu'])): ?>
              <?php if ($_GET['menu'] == "detail"): ?>
                <?php include 'view/view.product.detail.php'; ?>
              <?php elseif ($_GET['menu'] == "buy"): ?>
                <div class="row">
                  <?php include 'model/form.search.php'; ?>

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
              <?php endif; ?>
            <?php endif; ?>

                <!-- ============================================================== -->
            </div>
        </div>
<?php include 'authors.footer.php'; ?>
