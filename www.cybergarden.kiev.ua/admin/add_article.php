
<!doctype html>
<htmml>

  <head>
    <meta charset="utf-8">
    <title> Добавление записи </title>
  </head>

  <body style="background: #eef;">
    <a href="index.php"> <b><p> Вернуться </p></b> </a>
    <form method="post" action="create_article.php">

      Название новости <br />
      <input type="text" name="title" /><br />
      Описание новости <br />
      <textarea cols="40" rows="5" name="desc"></textarea> <br />
	  Текст новости <br />
      <textarea cols="40" rows="10" name="text"></textarea> <br />
	  Автор новости <br />
      <input type="text" name="author" /> <br />

      <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>" />
      <input type="hidden" name="time" value="<?php echo date('H:i:s'); ?>" />

      <p><input type="submit" name ="add" value="Добавить"/>
        <input type="reset" value="Очистить"> </p>
    </form>

  </body>

</html>
