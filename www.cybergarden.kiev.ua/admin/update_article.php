<?php
	include __DIR__.'/include/db.php';
	if (isset($_POST['id'])) {$id = $_POST['id'];}
	if (isset($_POST['title'])) {$title = $_POST['title']; if ($title =='') {unset ($title);}}
	if (isset($_POST['text'])) {$text = $_POST['text']; if ($text =='') {unset ($text);}}
	if (isset($_POST['author'])) {$author = $_POST['author']; if ($author =='') {unset ($author);}}
	if (isset($_POST['desc'])) {$description = $_POST['desc']; if ($description =='') {unset ($description);}}
	if (isset($_POST['date'])) {$date = $_POST['date']; if ($date =='') {unset ($date);}}
	if (isset($_POST['time'])) {$time = $_POST['time']; if ($time=='') {unset ($time);}}
	?>

<!doctype html>
<htmml>

  <head>


	<meta charset="utf-8">
    <title> Обработчик изменения записи </title>
  </head>
  <body>
   <?php

    if (isset($_POST['update']))  {
		$description = strip_tags(trim($_POST['desc']));
      $title = strip_tags(trim($_POST['title']));
      $text = strip_tags(trim($_POST['text']));
      $author = strip_tags(trim($_POST['author']));
      $date = $_POST['date'];
      $time = $_POST['time'];
	echo "<a href='index.php'> <b><p> Вернуться </p></b> </a>";

      $update_result = mysql_query ("UPDATE news SET title='$title', description='$description',
	  text='$text', author='$author', date='$date', time='$time' WHERE id='$id'");

	  if ($update_result==true) {
        echo "<p> Статья успешно изменена! </p>";
		mysql_close();
		  }
	else {
		echo "Ошибка при изменении новости!";
		exit (mysql_error());
	}

   }
   ?>

  </body>

</html>
