
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>MY form</title>

    <link rel="stylesheet" href="css/style_Androsh.css">
  </head>

  <body>

    <div class="container">
      <img src="img/Anonymous.png">

      <form class="" action="view_room.php" method="post">
        <div class="auth_inputs">
          <div class="auth_username">
            <input type="text" name="username" placeholder="Введите логин от кабинета">
          </div>

          <div class="auth_password">
            <input type="password" name="password" placeholder="Введите пароль от кабинета">
          </div>

          <input class="auth_submit" type="submit" name="auth" value="ВОЙТИ">
        </div>
      </form>

      <div class="signup_field">
        Нет учетной записи?<a href="signup_form.php"> Зарегистрируйтесь </a>

      </div>

    </div>

  </body>
</html>
