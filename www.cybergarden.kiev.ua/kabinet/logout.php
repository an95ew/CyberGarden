<?php
  session_start();
  require("blocks/bd.php");
  unset($_SESSION['logged_user']);
  header('Location: http://cybergarden.kiev.ua/kabinet/authorisation_form.php');
?>
