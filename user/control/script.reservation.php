<?php
include '../../database/connection.php';
include '../../function/function-by-tri.php';
session_start();
if (isset($_POST['new'])) {

  $reservation = autokode("reservasi", "r-");
  $today = date("Y-m-d H:i:s");

  $user = decrypt($_POST['user']);

  $sql = "INSERT into `reservasi`(id_reservasi,id_user,status_reservasi,id_admin)
  Values('$reservation','$user', DEFAULT, NULL)";
  $query = mysqli_query($db,$sql);
  if ($query) {
    foreach (@$_SESSION["cart"] as $menu_id => $quantity) {
      $reservationmenu = autokode("reservasi_menu", "rm-");
      $detail = mysqli_query($db,"INSERT INTO `reservasi_menu` (id_reservasimenu,id_reservasi,id_menu,kuantitas_menu)
      VALUES ('$reservationmenu','$reservation','$menu_id','$quantity')
      ");
    }
    unset($_SESSION["cart"]);
    echo "<script>alert('Diproses');
    window.location.href='../menu?menu=new_reservation&id=".encrypt($reservation)."';</script>";
  }else {
    echo "<script>alert('Error');
    window.history.back();</script>";
  }
}elseif (isset($_POST['update'])) {
  $reservation = decrypt($_POST['reservation']);
  $tanggal = $_POST['tanggal'];
  $user = decrypt($_POST['user']);
  $waktu = $_POST['waktu'];
  $meja = $_POST['meja'];
  $harga = $_POST['harga'];
  $trx_id = autokode("transaksi","trx-");
  $today = date("Y-m-d H:i:s");

  $detect = mysqli_query($db,
  "SELECT * From `reservasi` Where tanggal_reservasi = '$tanggal' And waktu_reservasi = '$waktu' And reservasi_meja = '$meja' And status_reservasi != 'PENDING'");
  if (mysqli_num_rows($detect) > 0) {
    echo "<script>alert('Yah kamu telat.. tanggal, meja atau waktu ini sudah dipesan orang lain.. coba lagi ya');
    window.history.back();</script>";
  }else {
    $sql = "UPDATE `reservasi`
    SET tanggal_reservasi = '$tanggal', waktu_reservasi = '$waktu'
    ,reservasi_meja = '$meja', status_reservasi = 'MENUNGGU PEMBAYARAN'
    Where id_reservasi = '$reservation'";
    $query = mysqli_query($db,$sql);
    if ($query) {
      $addtrx = mysqli_query($db,"INSERT into `transaksi`(id_transaksi,id_reservasi,id_user,status_transaksi,harga_transaksi,tanggal_transaksi)
      VALUES('$trx_id','$reservation','$user',DEFAULT,'$harga','$today')");
      echo "<script>alert('Reservasi diproses');
      window.location.href='../information?info=waiting&pay=$harga';</script>";
    }else {
      echo "<script>alert('Gagal');
      window.history.back();</script>";
    }
  }
} elseif (isset($_POST['cancel'])) {
  $reservation = decrypt($_POST['reservation']);

  $delete  = "DELETE FROM `reservasi` WHERE id_reservasi = '$reservation'";
  $query = mysqli_query($db, $delete);
  if ($query) {
    $deletedetails = mysqli_query($db,"DELETE FROM `reservasi_menu` Where id_reservasi = '$reservation'");
    $deletetrx = mysqli_query($db,"DELETE FROM `transaksi` Where id_reservasi = '$reservation'"); //If available transaction will be deleted
    echo "<script>alert('Berhasil dihapus');
    window.location.href='../menu?menu=reservation';</script>";
  }else {
    echo "<script>alert('Gagal');
    window.history.back();</script>";
  }
}

 ?>
