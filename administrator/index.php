<?php
$titlePage = "Dasbor";
$currentpage = "dashboard";
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
                        <h2 class="pageheader-title text-white">Dasbor Administrator :  <small><?php echo $_SESSION["admin_name"]; ?></small> </h2>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <a href="add?new=menu">
                          <div class="card py-4">
                              <div class="card-body">
                                  <div class="metric-value d-inline-block">
                                      <h3 class="mb-1">Tambah menu baru</h3>
                                  </div>
                                  <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                      <span class="badge badge-success"><i class="fas fa-plus"></i></span>
                                  </div>
                              </div>
                          </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                      <a href="table?view=new_reservation">
                        <div class="card py-1">
                            <div class="card-body">
                                <h5 class="text-muted">Reservasi Baru</h5>
                                <div class="metric-value d-inline-block">

                                    <h3 class="mb-1"><?php echo $reservation; ?></h3>
                                </div>
                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                    <span class="badge badge-info"><i class="fa fa-fw fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <a href="table?view=transaction">
                          <div class="card py-1">
                              <div class="card-body">
                                  <h5 class="text-muted">Transaksi baru</h5>
                                  <div class="metric-value d-inline-block">

                                      <h3 class="mb-1"><?php echo $transaction; ?></h3>
                                  </div>
                                  <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                      <span class="badge badge-info"><i class="fa fa-fw fa-money-bill-wave"></i></span>
                                  </div>
                              </div>
                          </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <a href="table?view=transaction_success">
                          <div class="card py-1">
                              <div class="card-body">
                                  <h5 class="text-muted">Transaksi sukses</h5>
                                  <div class="metric-value d-inline-block">
                                    <?php $trx_sum = mysqli_query($db,"SELECT SUM(harga_transaksi) as total From `transaksi` a
                                    JOIN `reservasi` b On a.id_reservasi = b.id_reservasi
                                    Where a.status_transaksi ='LUNAS' And b.status_reservasi='SELESAI'");
                                    $result_sum = mysqli_result($trx_sum,0);
                                     ?>
                                      <h2 class="mb-1">Rp. <?php echo number_format($result_sum,0,'.',','); ?></h2>
                                  </div>
                              </div>
                          </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- end wrapper  -->
<!-- ============================================================== -->
<?php include 'footer.php'; ?>
