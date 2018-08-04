<?php
ob_start();
session_start();

$passwordPost = md5($_POST['pwd']);

if ($passwordPost == '4e4d6c332b6fe62a63afe56171fd3725'){
  $_SESSION['user']='true';
  header('location: /data-keuangan/home.php');
}
else{
  header('location: /data-keuangan/login-form.php?p='. $passwordPost);
}

?>
