<?php
include 'header.php';
$iduser = @$_SESSION["id"];
 ?>
 <!-- navigation bar start -->
 <body class="fully-background" style="font-family:'Segoe UI';">
  <!-- navigation bar start -->
  <nav class="navbar navbar-dark navbar-expand-sm fixed-top navbar-transparent-grey-noborder">
    <div class="container">
      <button class="navbar-toggler toggler-default collapsed" data-toggle="collapse" data-target="#navcol-1">
        <span class="icon-bar-top top-bar"></span>
        <span class="icon-bar-middle middle-bar"></span>
        <span class="icon-bar-bottom bottom-bar"></span>
      </button>
     <h3 class="navbar-brand"><a href="#"><img src="<?php echo $logoLink; ?>" style="width:120px;height:100px;" alt="logo"></a></h3>
    <div class="collapse navbar-collapse" id="navcol-1">
          <ul class="nav navbar-nav mr-auto">
            <li class="nav-item">
              <a href="index" class="btn text-white <?php if($currentpage == "home") echo "btn-primary active"; else echo "btn-outline-primary"; ?>"><strong><i class="fas fa-home"></i> Beranda</strong></a>
          </li>
          <li class="nav-item">
            <a href="menu?menu=buy" class="btn text-white <?php if($currentpage == "menu") echo "btn-primary active"; else echo "btn-outline-primary"; ?>"><strong><i class="fas fa-coffee"></i> Menu</strong></a>
          </li>
            <li class="nav-item"><a href="menu?menu=cart" class="btn text-white <?php if($currentpage == "cart") echo "btn-primary active"; else echo "btn-outline-primary";?>"> <i class="fas fa-shopping-cart"></i> Troli
              <?php
              /*$cartview = mysqli_query($db, "SELECT Count(*) From `keranjang` where id_user='$iduser'")*/;
              if (!empty($_SESSION["cart"])) {
                $resultcart = count($_SESSION["cart"]);
              }else {
                $resultcart = "0";
              }
               ?>
              <span class="badge badge-danger"><?php echo $resultcart; ?></span> </a></li>
            <li class="nav-item"><a href="menu?menu=reservation" class="btn text-white <?php if($currentpage == "reservation") echo "btn-primary active"; else echo "btn-outline-primary";?>"> <i class="fas fa-calendar"></i> Reservasi
              <?php
              $reservationview = mysqli_query($db, "SELECT Count(*) From `reservasi` where id_user='$iduser' and status_reservasi != 'SELESAI'");
              $resultreservation = mysqli_result($reservationview,0);
               ?>
              <span class="badge badge-danger"><?php echo $resultreservation; ?></span> </a></li>
          </ul>
          <span class="navbar-text">
            <li class="navbar-nav ml-auto navbar-top-right">
                <a class="nav-link" href="#" id="navbar-dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Info akun"><h3 class="text-white">[<?php echo @$_SESSION["name"]; ?>] <i class="fas fa-angle-down"></i> </h3></a>
                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown animated slideInDown" aria-labelledby="#navbar-dropdown2">
                    <div class="nav-user-info bg-info">
                        <h5 class="mb-0 text-white nav-user-name"><?php echo @$_SESSION["name"]; ?> </h5>
                        <span class="ml-2 text-dark"><i class="fas fa-envelope"></i> <?php echo @$_SESSION["email"]; ?></span>
                    </div>
                    <a class="dropdown-item onfocus <?php if($currentpage=="information") echo "actives"; ?>" href="information?info=aboutme"><i class="fas fa-info-circle mr-2"></i>Informasi Anda</a>
                    <a class="dropdown-item onfocus" href="" data-toggle="modal" data-target="#logout"><i class="fas fa-power-off mr-2"></i>Keluar</a>
                </div>
            </li>
          </span>
        </div>

     </div>
  </nav>
 <br><br><br><br><br><br><br><br>
<?php require_once 'model/modal.logout.php'; ?>
