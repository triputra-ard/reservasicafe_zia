<?php
include '../../database/connection.php';
include '../../function/function-by-tri.php';
session_start();
if (isset($_POST['add'])) {
  $quantity = $_POST['quantity'];
  $menu_id = decrypt($_POST['menu']);

  // jika sudah ada produk itu dikeranjang, maka produk itu jadinya di +1
  if (isset($_SESSION["cart"][$menu_id]))
  {
  	$_SESSION["cart"][$menu_id]+=$quantity;
    echo "<script>alert('Ditambahkan ke troli');
    window.location.href='../menu?menu=buy';</script>";
  }
  //selain itu (belum ada di keranjang), maka produk itu dianggap dibeli 1
  else
  {
  	$_SESSION["cart"][$menu_id] = $quantity;
    echo "<script>alert('Ditambahkan ke troli');
    window.location.href='../menu?menu=buy';</script>";
  }
}elseif (isset($_POST['quickbuy'])) {
  $menu_id = decrypt($_POST['menu']);

  // jika sudah ada produk itu dikeranjang, maka produk itu jadinya di +1
  if (isset($_SESSION["cart"][$menu_id]))
  {
  	$_SESSION["cart"][$menu_id]+=1;
    echo "<script>alert('Ditambahkan ke troli');
    window.location.href='../menu?menu=buy';</script>";
  }
  //selain itu (belum ada di keranjang), maka produk itu dianggap dibeli 1
  else
  {
  	$_SESSION["cart"][$menu_id] = 1;
    echo "<script>alert('Ditambahkan ke troli');
    window.location.href='../menu?menu=buy';</script>";
  }

} elseif (isset($_POST['delete'])) {
  $menu_id = decrypt($_POST['cart']);
  unset($_SESSION["cart"][$menu_id]);
  echo "<script>alert('Item dihapus');
  window.location.href='../menu?menu=cart';</script>";
}

 ?>
