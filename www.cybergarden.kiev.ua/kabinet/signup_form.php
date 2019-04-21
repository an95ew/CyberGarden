<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style_Androsh.css">
    <title> Rgistration </title>
  </head>
  <body>
    <div class="container">
      <img src="img/Anonymous_registration.png" >
      <form method="POST" action="view_room.php" style="" id="adduser_block">
        <input type="hidden" name="act"  value="insert">
        <input type="text" name="room[name]" placeholder="Имя" value="" size="16">
        <input type="password" name="room[pass]" placeholder="Пароль" value="" size="16">
        <input type="text" name="room[title]" placeholder="Название комнаты" value="" size="25">
        <input type="text" name="room[url_to]" placeholder="Ссылка (без www, https://, https://)" value="" size="25">
        <input type="text" name="room[email]" placeholder="e-mail" value="" size="30">
        <input class="auth_submit" name="insert" type="submit" value="Создать комнату" style="width:160px;">
      </form>
    </div>


  </body>
</html>
