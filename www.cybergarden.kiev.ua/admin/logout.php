<?php
  session_start();
  include __DIR__.'/include/db.php';

  unset($_SESSION['logged_admin']);
  header('Location: ../index.php');
?>
