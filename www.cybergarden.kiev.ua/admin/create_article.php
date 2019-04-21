<?php
include_once("include/db.php");

?>
<!doctype html>
<htmml>

  <head>
    <meta charset="utf-8">
    <title> Обработчик добавления записи </title>
  </head>

  <body style="background: #eef;">
    <a href="index.php"> <b><p> Вернуться </p></b> </a>

    <?php

    if (isset($_POST['add']))  {
		$description = strip_tags(trim($_POST['desc']));
      $title = strip_tags(trim($_POST['title']));
      $text = strip_tags(trim($_POST['text']));
      $author = strip_tags(trim($_POST['author']));
      $date = $_POST['date'];
      $time = $_POST['time'];

      $add_result=mysql_query ("INSERT INTO news (title, text, description, date, time, author)
      VALUES ('$title', '$text', '$description', '$date', '$time', '$author')");
      if ($add_result==true) {
        echo "<p> Статья успешно добавлена </p>";
      }
      mysql_close();
   }
   ?>

  </body>

</html>
