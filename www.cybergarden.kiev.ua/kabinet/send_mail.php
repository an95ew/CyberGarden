<?php
  session_start();

  $message = $_POST['editor'];
  $from = $_POST['from'];
  $to = $_POST['to'];

  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= "From: {$from}";
  $headers .= "Reply-To: {$from}\r\n";

  $result = mail($to, "Вам письмо", $message, $headers);
  if ($result){
    echo "SUCCESS";
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: {$_SERVER[HTTP_REFERER]}");
  }
  else {
    echo "FAIL";
  }


?>
