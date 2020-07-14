<?php
if (!empty($_GET['data'])) {
  if ($_GET['data'] == 'productinfo') {
    $titlePage = "Perbarui Menu";
    $currentpage = "menu";
    $headertitle = "Menu";
  }elseif ($_GET['data'] == 'productimg') {
    $titlePage = "Perbarui Menu";
    $currentpage = "menu";
    $headertitle = "Menu";
  }else {
    $titlePage = "UNKNOWN";
    $currentpage = "dashboard";
    $headertitle = "UNKNOWN";
  }
}
/* Initial paging */
include 'navigation.admin.php'; ?>
<!-- ============================================================== -->
<!-- wrapper  -->
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title text-white">Master Data <?php echo $headertitle; ?> </h2>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">
              <?php if (!empty($_GET['data'])): ?>
                <?php if ($_GET['data'] == 'menuinfo'): ?>
                  <div class="card transparent">
                    <div class="card-header">
                      <h4>Form edit informasi Menu</h4>
                    </div>
                    <div class="card-body">
                      <?php include 'model/form.product.edit1.php'; ?>
                    </div>
                  </div>
                <?php elseif ($_GET['data'] == 'productimg'): ?>
                  <div class="card transparent">
                    <div class="card-header">
                      <h4>Form edit gambar Menu</h4>
                    </div>
                    <div class="card-body">
                      <?php include 'model/form.product.edit2.php'; ?>
                    </div>
                  </div>
                <?php else :?>
                  <div class="card">
                    <div class="card-body">
                      <h4 class="text-center">Umm.. terjadi kesalahan periksa url</h4>
                    </div>
                  </div>
                <?php endif; ?>
                <!-- Dynamical paging -->
              <?php endif; ?>
            </div>
        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- end wrapper  -->
<!-- ============================================================== -->
<?php include 'footer.php'; ?>
