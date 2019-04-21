<?php
  session_start();
  include __DIR__.'/include/db.php';
//require("www.cybergarden.kiev.ua/admin/include/db.php");


    $data = $_POST;
    $login = $data['login'];
    $password = $data['password']; //crypt($data['password'], CRYPT_STD_DES);
    $email = $data['email'];

    if (isset ($data['do_login']))
    {
      $errors = array();

      $find_login = mysql_query("SELECT * FROM authorisation WHERE login ='".$login."'");
      $admin = mysql_fetch_array($find_login);
      // Проверяем есть ли соответствие введённого логина с базой
      // Соответствие ЕСТЬ
      if (!empty($admin))
      {
        // Проверка введённого пароля
        // Введён ВЕРНО
        if ($password == $admin['password'])
        {
          // Всё ОК, логиним пользователя
          $_SESSION['logged_admin'] = $admin;
          // echo "<div style='color:green;' align='center'>Вы успешно авторизовались!<br/>
          // Можете перейти в <a href='index.php'>кабинет администратора:)</a></div>";
          header('Location: /admin/');

        }
        // Введён НЕВЕРНО
        else
        {
          $errors[] = "Пароль введён неверно";
        }
      }
      // Соответствия НЕТ
      else
      {
        $errors[] = "Пользователь или пароль введены неверно!";
      }

      if (!empty($errors)) // Если всё хорошо
      {
        echo "<div style='color: red;'>".array_shift($errors)."</div>";
      }
    }


?>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <meta charset="utf-8">
</head>

<head>
  <meta charset="utf-8">
</head>
