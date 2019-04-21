<?php
if ($_POST ['pass']!=="221188") 
{
/* header("HTTP/1.1 301 Moved Permanently");
header("Location: http://evento.in.ua?id=Запретный вход&url=www.zhitomir.info/news_142225.html");  */
} ;
include("blocks/bd.php");
if(isset($_GET["id"])){$id = $_GET["id"];}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
<link href="ico.png" rel="shortcut icon">
<title>Обработчик</title>
</head>

<body>
<div id="page">
	<div id="page-bgtop">
		<div id="content">
		<div class="page_text">
        <p>
        <?php
		if(isset($id))
		{
			/* $result0 = mysqli_query($db, "select id from data where cat='$id'");
			if(mysqli_num_rows($result0) > 0)
			{
				echo "В категории которую вы хотите удалить есть заметки. Удаление запрещено";
			}
			else
			{ */
				$result = mysqli_query($db, "delete from visitor where id='$id'");
				if($result == 'true')
				{
					echo "<p>упешно удалено</p>";
				}
				else
				{
					"<p>Не удалено!</p>";
				}
			//}
		}	
		else
		{
			echo "<p>Вы запустили ваш файл без параметра id</p>";
		}
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: {$_SERVER[HTTP_REFERER]}");

		?>
        </p>
		</div>
		</div>
		<!-- end #content -->
<?php// include("blocks/right.php"); ?>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->
</div>
<?php //include("blocks/footer.php"); ?>
</body>
</html>