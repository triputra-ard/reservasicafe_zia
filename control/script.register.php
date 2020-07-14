<?php
include '../database/connection.php';
include '../function/function-by-tri.php';
include '../function/function-mail-tri.php';
$setFrom = "smile.trie@gmail.com";
session_start();
$code = randomcode("6");
if (isset($_POST['register'])) {

  $id = $_POST['id'];
  $fullname = $_POST['fullname'];
  $phone = $_POST['phones'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $timestamp = date("Y-m-d H:i:s");

  if ($email != "") {
    $_SESSION["email_temp"] = $_POST['email'];
    $_SESSION["id_temp"] = $_POST['id'];
    $checked = "SELECT * FROM `pengguna` Where email = '$email'";
    $checkquery = mysqli_query($db,$checked);
    if (mysqli_num_rows($checkquery) > 0) {
      $sql = "INSERT INTO `pengguna` (id_user,nama_pengguna,nomor_telepon,password,kode_aktivasi,status_aktivasi,tanggal_daftar)
      VALUES('$id','$fullname','$phone','$password','$code',DEFAULT,'$timestamp')";
      $mysql = mysqli_query($db, $sql);
      header('location:../page?section=equal');
    }else {
      $mail->addAddress($email, $email);
      $mail->Subject = "Verifikasi Email";
      $mail->setFrom($setFrom);
      $mail->addReplyTo($setFrom);
      $mail->AddCC($setFrom,"noreply");
      $message = "Hai,Terima kasih sudah bergabung <br> Mohon Masukkan kode berikut : $code . EMAIL INI DIKIRIMKAN OTOMATIS, JANGAN MEMBALAS EMAIL INI";
      $mail->Body = $message;
      $mail->isHTML(true);
      $mail->send(); //Email send
      $sql = "INSERT INTO `pengguna` (id_user,nama_pengguna,nomor_telepon,email,password,kode_aktivasi,status_aktivasi,tanggal_daftar)
      VALUES('$id','$fullname','$phone','$email','$password','$code',DEFAULT,'$timestamp')";
      $mysql = mysqli_query($db, $sql);
      if($mysql){
        header('location:../status?status=sendmail&u='.encrypt($email));
      }else {
        echo "<script>alert('Terjadi kesalahan');
        window.history.back();</script>";
      }
    }
  }

}elseif (isset($_POST['equal'])) {
  $id = $_POST['id'];
  $email = $_POST['email'];

  if ($email != "") {
    $checked = "SELECT * FROM `pengguna` Where email = '$email'";
    $checkquery = mysqli_query($db,$checked);
    if (mysqli_num_rows($checkquery) > 0) {
      echo "<script>alert('Email sudah digunakan');
      window.history.back();</script>";
    }else {
      $mail->addAddress($email,$email);
      $mail->Subject = "Verifikasi Email";
      $mail->setFrom($setFrom);
      $mail->addReplyTo($setFrom);
      $mail->AddCC($setFrom,"noreply");
      $message = "Hai,Terima kasih sudah bergabung <br> Mohon Masukkan kode berikut : $code . EMAIL INI DIKIRIMKAN OTOMATIS, JANGAN MEMBALAS EMAIL INI";
      $mail->Body = $message;
      $mail->isHTML(true);
      $mail->send(); //Email send
      $sql = "UPDATE pengguna SET email = '$email', kode_aktivasi = '$code' WHERE id_user='$id'";
      $mysql = mysqli_query($db, $sql);
      if($mysql){
        header('location:../status?status=sendmail&u='.encrypt($email));
      }else {
        echo "<script>alert('Terjadi kesalahan');
        window.location.back();</script>";
      }
    }
  }
}elseif (isset($_GET['resendmail'])) {
  $email = decrypt($_GET['u']);
  echo $email;
  $sqlsend = "SELECT * FROM pengguna WHERE email = '$email'";
  $myqlemail = mysqli_query($db,$sqlsend);
  $detect = mysqli_fetch_assoc($myqlemail);
  $kode = $detect['kode_aktivasi'];

  $mail->addAddress($email, $email);
  $mail->Subject = "Verifikasi Email";
  $mail->setFrom($setFrom);
  $mail->addReplyTo($setFrom);
  $mail->AddCC($setFrom,"noreply");
  $message = "Hai,Terima kasih sudah bergabung <br> Mohon Masukkan kode berikut : $kode . EMAIL INI DIKIRIMKAN OTOMATIS, JANGAN MEMBALAS EMAIL INI";
  $mail->Body = $message;
  $mail->isHTML(true);
  $mail->send(); //Email send

/*  if (!$mail->send()) {
    echo 'Mailer Error: '. $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}*/

  echo "<script>alert('Dikirim');
  window.history.back();</script>";

}
 ?>
