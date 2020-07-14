<?php
include '../../database/connection.php';
include '../../function/function-by-tri.php';

if (isset($_POST['new'])) {

  $id = $_POST['id'];
  $kategori = $_POST['kategori'];
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $ketersediaan = $_POST['ketersediaan'];
  $deskripsi = $_POST['deskripsi'];
  $currentdate = date("Y-m-d H:i:s");

  $moveditem = '../../menu_list/'.$kategori.'/';
  $directory = 'menu_list/'.$kategori;

  $allow_ext = array('png','jpg','bmp','jpeg');

  $filename1 = date("Ymd").'-'.$id.'-1-'.basename($_FILES['file1']['name']);

  $file_temp1 = $_FILES['file1']['tmp_name'];
  $file_size1 = $_FILES['file1']['size'];

  $x1 = explode('.', $filename1);
  // code...
  $extension1 = strtolower(end($x1));

  if (in_array($extension1 , $allow_ext) === true) {
    if ($file_size1 < 2000640) {
      if (!is_dir($moveditem)) {
        mkdir($moveditem);
        if (move_uploaded_file($file_temp1, $moveditem.$filename1)) {

          $sql = "INSERT Into `menu`(id_menu,nama_menu,foto_menu,
          kategori_menu,harga_menu,deskripsi_menu,ketersediaan_menu)
          VALUES ('$id','$nama','$directory/$filename1'
          ,'$kategori','$harga','$deskripsi',
          '$ketersediaan')";

          $query = mysqli_query($db,$sql);
          if ($query) {
            echo "<script>alert('Ditambahkan');
            window.location.href='../table?view=menu';</script>";
          }else {
            echo "<script>alert('Error');
            window.history.back();</script>";
          }
        }
      }else {
        if (move_uploaded_file($file_temp1, $moveditem.$filename1)) {

          $sql = "INSERT Into `menu`(id_menu,nama_menu,foto_menu,
          kategori_menu,harga_menu,deskripsi_menu,ketersediaan_menu)
          VALUES ('$id','$nama','$directory/$filename1'
          ,'$kategori','$harga','$deskripsi',
          '$ketersediaan')";

          $query = mysqli_query($db,$sql);
          if ($query) {
            echo "<script>alert('Ditambahkan');
            window.location.href='../table?view=menu';</script>";
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
}elseif (isset($_POST['editinfo'])) {
  $id = $_POST['id'];
  $kategori = $_POST['kategori'];
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $ketersediaan = $_POST['ketersediaan'];
  $deskripsi = $_POST['deskripsi'];

  $sql = "UPDATE `menu` SET
  kategori_menu = '$kategori',
  nama_menu = '$nama',
  harga_menu = '$harga',
  deskripsi_menu = '$deskripsi',
  ketersediaan_menu = '$ketersediaan'
  WHERE id_menu = '$id' ";
  $query = mysqli_query($db,$sql);
  if ($query) {
    echo "<script>alert('Diperbarui');
    window.location.href='../table?view=menu';</script>";
  }else {
    echo "<script>alert('Error');
    window.history.back();</script>";
  }

}elseif (isset($_POST['editphotos'])) {
  $id = $_POST['id'];
  $kategori = $_POST['kategori'];
  $moveditem = '../../menu_list/'.$kategori.'/';
  $directory = 'menu_list/'.$kategori;

  $allow_ext = array('png','jpg','bmp','jpeg');

  $filename1 = date("Ymd").'-'.$id.'-1-'.basename($_FILES['file1']['name']);

  $file_temp1 = $_FILES['file1']['tmp_name'];
  $file_size1 = $_FILES['file1']['size'];

  $x1 = explode('.', $filename1);
  // code...
  $extension1 = strtolower(end($x1));

  $unlink1 = $_POST['imgunlink1'];

  if (in_array($extension1 , $allow_ext) === true) {
    if ($file_size1 < 2000640) {
      if (!is_dir($moveditem)) {
        mkdir($moveditem);
        if (move_uploaded_file($file_temp1, $moveditem.$filename1)) {
          unlink($unlink1);

          $sql = "UPDATE `menu`
          SET
          foto_menu = '$directory/$filename1'
          WHERE id_menu = '$id'";

          $query = mysqli_query($db,$sql);
          if ($query) {
            echo "<script>alert('Diperbarui');
            window.location.href='../table?view=menu';</script>";;
          }else {
            echo "<script>alert('Error');
            window.history.back();</script>";
          }
        }
      }else {
        if (move_uploaded_file($file_temp1, $moveditem.$filename1)) {
          unlink($unlink1);

          $sql = "UPDATE `menu`
          SET
          foto_menu = '$directory/$filename1'
          WHERE id_menu = '$id'";

          $query = mysqli_query($db,$sql);
          if ($query) {
            echo "<script>alert('Diperbarui');
            window.location.href='../table?view=menu';</script>";
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
}elseif (isset($_GET['delete'])) {
  $id = decrypt($_GET['delete']);
  $detect = "SELECT foto_menu from `menu` WHERE id_menu='$id'";
  $querydetect = mysqli_query($db,$detect);
  if (mysqli_num_rows($querydetect) === 0) {
    echo "<script>alert('Error');
    window.history.back();</script>";
  }else {
    $unlink = mysqli_fetch_assoc($querydetect);
    $files = "../../".$unlink['foto_menu'];
    unlink($files);

    $sql = "DELETE from `menu` Where id_menu='$id'";
    $query = mysqli_query($db,$sql);
    if ($query) {
      echo "<script>alert('Dihapus');
      window.location.href='../table?view=menu';</script>";
    }else {
      echo "<script>alert('Error');
      window.history.back();</script>";
    }
  }
}
 ?>
