<?php
  session_start();
  require __DIR__.'/include/db.php';
?>

<?php
  $data = $_POST;
  $login = $_SESSION['logged_admin']['login'];
  $password = $data['password'];
  $email = $data['email'];
  $phone_number = $data['phone_number'];

  if(isset($data['do_correction']))
  {
    // Здесь регистрируем
    $errors = array();

    if (trim($data['email'])=='')
    {
      $errors[] = "Заполните поле Email";
    }

    if ($data['password'] =='')
    {
      $errors[] = "Заполните поле Пароль";
    }

    if ($data['phone_number'] =='')
    {
      $errors[] = "Заполните поле Номер телефона";
    }

    if ($data['password_2'] =='')
    {
      $errors[] = "Заполните поле повторного ввода пароля";
    }

    if ($data['password_2'] != $data['password'] )
    {
      $errors[] = "Введённые пароли не совпадают";
    }


    $email_match = mysql_query ("SELECT email FROM authorisation WHERE email ='".$data['email']."'");
    $EM_result = mysql_fetch_array($email_match);
    if (!empty($EM_result))
    {
      $errors[] = "Пользователь с Email уже зарегистрирован";
    }

    if (empty($errors)) // Если всё хорошо
    {
      $query_auth = mysql_query("UPDATE authorisation SET password='$password', email='$email', phone_number='$phone_number' WHERE login='$login'");

      echo "<div style='color: green;'>Ваши данные были успешно изменены</div>";
      ?>
      <a href="/admin/index.php"> Вернуться на главную </a>
      <?php
    }
    else
    {
      echo "<div style='color: red;'>".array_shift($errors)."</div>";
    }
  }
?>
<head>
  <meta charset="utf-8">
</head>

<div>
  <form  action="account_change.php" method="post">
    Уважаемый, <?php echo ' '.$login; ?>


    <p>
      <p> <strong> Введите Ваш новый пароль: </strong> </p>
      <input type="password" name="password" value="<?php echo @$data['password']; ?>">
    </p>

    <p>
      <p> <strong> Повторите Ваш новый пароль: </strong> </p>
      <input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
    </p>

    <p>
      <p> <strong> Введите новый номер телефона: </strong> </p>
      <input type="text" name="phone_number" value="<?php echo @$data['phone_number']; ?>">
    </p>

	<p>
      <p> <strong> Введите новый email: </strong> </p>
      <input type="text" name="email" value="<?php echo @$data['email']; ?>">
    </p>

    <p>
      <button type="submit" name="do_correction">Внести изменения
      </button>
    </p>
  </form>
</div>
