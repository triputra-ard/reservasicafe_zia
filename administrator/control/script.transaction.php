<?php
include '../../database/connection.php';
include '../../function/function-by-tri.php';

if (isset($_POST['accept'])) {

  $id_admin = decrypt($_POST['admin']);
  $transaction = decrypt($_POST['transaction']);
  $reservation = decrypt($_POST['reservation']);

  $today = date("Y-m-d H:i:s");

  $sql = "UPDATE `reservasi` SET
  status_reservasi = 'DIPROSES',
  id_admin = '$id_admin' Where id_reservasi = '$reservation'";
  $query = mysqli_query($db,$sql);
  if ($query) {
    $payment = mysqli_query($db,"UPDATE `transaksi` SET status_transaksi = 'LUNAS',id_admin = '$id_admin' Where id_transaksi = '$transaction'");//Update status of payment

    echo "<script>alert('Berhasil diperbarui');
    window.location.href='../table?view=new_reservation';</script>";
  }else {
    echo "<script>alert('Gagal');
    window.history.back();</script>";
  }
}elseif (isset($_POST['decline'])) {
  $unlink = $_POST['photosremove'];

  $id_admin = decrypt($_POST['admin']);
  $transaction = decrypt($_POST['transaction']);
  $reservation = decrypt($_POST['reservation']);

  $sql = "UPDATE `reservasi` SET
  status_reservasi = 'MENUNGGU PEMBAYARAN',
  id_admin = '$id_admin' Where id_reservasi = '$reservation'";
  $query = mysqli_query($db,$sql);
  if ($query) {
    $payment = mysqli_query($db,"UPDATE `transaksi` SET status_transaksi = 'BELUM_LUNAS',id_admin = '$id_admin' Where id_transaksi = '$transaction'");//Update status of payment
    unlink($unlink);

    echo "<script>alert('Berhasil diperbarui');
    window.location.href='../table?view=transaction';</script>";
  }else {
    echo "<script>alert('Gagal');
    window.history.back();</script>";
  }
}elseif (isset($_POST['cancel'])) {

  $id_admin = decrypt($_POST['admin']);
  $reservation = decrypt($_POST['reservation']);

  $sql = "UPDATE `reservasi` SET
  status_reservasi = 'PENDING',
  id_admin = '$id_admin' Where id_reservasi = '$reservation'";
  $query = mysqli_query($db,$sql);
  if ($query) {
    
    $deletetransaction = mysqli_query($db,"DELETE from `transaksi` WHERE id_reservasi = '$reservation'");
    echo "<script>alert('Berhasil diperbarui');
    window.location.href='../table?view=transaction';</script>";
  }else {
    echo "<script>alert('Gagal');
    window.history.back();</script>";
  }
}


 ?>
