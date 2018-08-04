<?php
  header('location: http://data-keuangan.000webhostapp.com');
  session_start();
  unset($_SESSION);
  session_destroy();
  session_write_close();

  die;
?>
