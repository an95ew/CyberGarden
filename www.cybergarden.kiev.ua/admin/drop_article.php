<?php
	include __DIR__.'/include/db.php';
	if (isset($_POST['id'])) {$id = $_POST['id'];}
	?>

<!doctype html>
<htmml>

  <head>
	<meta charset="utf-8">
    <title> Обработчик изменения записи </title>
  </head>

  <body>
   <?php

   if (isset($_POST['del']))
    {

	  echo "<a href='index.php'> <b><p> Вернуться </p></b> </a>";

      $delete_result = mysql_query ("DELETE FROM news WHERE id='$id'");

	  if ($delete_result==true) {
        echo "<p> Статья успешно удалена! </p>";
		    mysql_close();
		  }
	else
  {
		    echo "Ошибка при изменении новости!";
		    exit(mysql_error());
	}

   }
   ?>

  </body>

</html>
