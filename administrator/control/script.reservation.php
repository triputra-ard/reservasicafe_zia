<?php
include '../../database/connection.php';
include '../../function/function-by-tri.php';

if (isset($_POST['active'])) {

  $id_admin = decrypt($_POST['admin']);
  $reservation = decrypt($_POST['reservation']);

  // code...
  $sql = "UPDATE `reservasi` SET
  status_reservasi = 'AKTIF', id_admin = '$id_admin' Where id_reservasi= '$reservation'
  ";
  $query = mysqli_query($db,$sql) or die (mysqli_error($db));
  if ($query) {

    echo "<script>alert('Berhasil diperbarui');
    window.location.href='../table?view=new_reservation';</script>";
  }else {
    echo "<script>alert('Gagal');
    window.history.back();</script>";
  }
}elseif (isset($_POST['finish'])) {

  $id_admin = decrypt($_POST['admin']);
  $reservation = decrypt($_POST['reservation']);

  // code...
  $sql = "UPDATE `reservasi` SET
  status_reservasi = 'SELESAI', id_admin = '$id_admin' Where id_reservasi = '$reservation'
  ";
  $query = mysqli_query($db,$sql) or die (mysqli_error($db));
  if ($query) {

    echo "<script>alert('Berhasil diperbarui');
    window.location.href='../table?view=reservation';</script>";
  }else {
    echo "<script>alert('Gagal');
    window.history.back();</script>";
  }
}

 ?>
