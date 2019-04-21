<?php
	include __DIR__.'/include/db.php';
	if (isset($_GET['id'])) { $id = $_GET['id']; }

?>

<!doctype html>
<htmml>

  <head>
    <meta charset="utf-8">
    <title> Удаление записи </title>
  </head>

  <body style="background: #eef;">
    <a href="index.php"> <b><p> Вернуться </p></b> </a>
		<form  action="drop_article.php" method="post">
			<h2>Выберите статъю, которую Вы хотите удалить</h2>
		<?php
		if(!isset($id))	{
			$query = mysql_query ("SELECT title, id FROM news ORDER BY id DESC");

			while($result = mysql_fetch_array($query))	{
				printf("<p><input type='radio' name='id' value='%s'><label> %s</label></p>", $result['id'], $result['title']);
			}
		}
	?>

		<p><input type="submit" name="del" value="Удалить статью!"></p>
	</form>
  </body>

</html>
