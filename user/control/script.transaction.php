<?php
include '../../database/connection.php';
include '../../function/function-by-tri.php';

if (isset($_POST['transaction'])) {
  $trx_id = decrypt($_POST['id']);

  $moveditem = '../../transaction/'.$trx_id.'/';
  $directory = 'transaction/'.$trx_id;

  $allow_ext = array('png','jpg','bmp','jpeg');

  $filename1 = $trx_id.'-1-'.basename($_FILES['trxfile']['name']);

  $file_temp1 = $_FILES['trxfile']['tmp_name'];
  $file_size1 = $_FILES['trxfile']['size'];

  $x1 = explode('.', $filename1);
  // code...
  $extension1 = strtolower(end($x1));

  if (in_array($extension1 , $allow_ext) === true) {
    if ($file_size1 < 3500640) {
      if (!is_dir($moveditem)) {
        mkdir($moveditem);
        if (move_uploaded_file($file_temp1, $moveditem.$filename1)) {

          $sql = "UPDATE `transaksi` SET foto_transaksi = '$directory/$filename1'
          Where id_reservasi = '$trx_id'";

          $query = mysqli_query($db,$sql);
          if ($query) {
            $updateinfo = mysqli_query($db,"UPDATE `reservasi` SET status_reservasi = 'MENUNGGU KONFIRMASI' where id_reservasi = '$trx_id'");

            echo "<script>alert('Diproses');
            window.location.href='../menu?menu=reservation';</script>";
          }else {
            echo "<script>alert('Error');
            window.history.back();</script>";
          }
        }
      }else {
        if (move_uploaded_file($file_temp1, $moveditem.$filename1)) {

          $sql = "UPDATE `transaksi` SET foto_transaksi = '$directory/$filename1'
          Where id_reservasi = '$trx_id'";

          $query = mysqli_query($db,$sql);
          if ($query) {
            $updateinfo = mysqli_query($db,"UPDATE `reservasi` SET status_reservasi = 'MENUNGGU KONFIRMASI' where id_reservasi = '$trx_id'");

            echo "<script>alert('Diproses');
            window.location.href='../menu?menu=reservation';</script>";
          }else {
            echo "<script>alert('Error');
            window.history.back();</script>";
          }
        }
      }
    }else {
      echo "<script>alert('Melebihi ukuran');
      window.history.back();</script>";
    }
  }else {
    echo "<script>alert('Ekstensi tidak didukung');
    window.history.back();</script>";
  }
}
 ?>
