<?php
include __DIR__.'/include/db.php';

if (isset($_GET['id'])) {$id = $_GET['id'];}
?>
<!doctype html>
<htmml>

  <head>

	<meta charset="utf-8">
    <title> Добавление записи </title>
  </head>
  <body>
  <?php
if (!isset($id))
{
  $articles_choose = mysql_query("SELECT title, id FROM news ORDER BY id DESC");

  while ($row = mysql_fetch_array($articles_choose)) {
    printf("<p><a href = 'edit_article.php?id=%s'> %s </a></p>", $row['id'], $row ['title']);
  }
}

else

{
$articles_show = mysql_query("SELECT * FROM news WHERE id = $id");
$row= mysql_fetch_array($articles_show);
$date = date('Y-m-d');
$time= date('H:i:s');
print <<<HERE
    <a href="index.php"> <b><p> Вернуться </p></b> </a>
    <form action="update_article.php" method="post">

      Название новости <br />
      <input value = "$row[title]" type="text" name="title" /><br />
      Описание новости <br />
	    <input  value = "$row[description]" name="desc" type="text" /> <br />
	    Текст новости <br />
      <input  value = "$row[text]" name="text" type="text" > <br />
      Автор новости <br />
      <input value = "$row[author]" type="text" name="author" /> <br />

      <input type="hidden" name="date" value="$date" />
	    <input type="hidden" name="id" value="$id" />
      <input type="hidden" name="time" value="$time" />

      <p><input type="submit" name ="update" value="Изменить"/>
        <input type="reset" value="Очистить"> </p>
    </form>
HERE;
}
?>
	</body>

</html>
