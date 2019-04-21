<?php
// if ($_POST ['pass']!=="221188")
// {
// /* header("HTTP/1.1 301 Moved Permanently");
// header("Location: http://evento.in.ua?id=Запретный вход&url=www.zhitomir.info/news_142225.html");  */
// } ;
session_start();
include("../blocks/bd.php");
if(isset($_POST["settings"]["id"])){$id = $_POST["settings"]["id"];}
if(isset($_POST["settings"]["title"]) && $_POST["settings"]["title"]!=''){$title = $_POST["settings"]["title"];}
if(isset($_POST["settings"]["name"]) && $_POST["settings"]["name"]!=''){$name = $_POST["settings"]["name"];}
if(isset($_POST["settings"]["pass"]) && $_POST["settings"]["pass"]!=''){$pass = $_POST["settings"]["pass"];}
if(isset($_POST["settings"]["email"]) && $_POST["settings"]["email"]!=''){$email = $_POST["settings"]["email"];}
if(isset($_POST["settings"]["url_to"]) && $_POST["settings"]["url_to"]!=''){$url_to = $_POST["settings"]["url_to"];}
if(isset($_POST["settings"]["domen"]) && $_POST["settings"]["domen"]!=''){$domen = $_POST["settings"]["domen"];}
if(isset($_POST["settings"]["way"]) && $_POST["settings"]["way"]!=''){$way = $_POST["settings"]["way"];}

// if(isset($_POST["settings"]["domen"]) && isset($_POST["settings"]["way"]) && $_POST["settings"]["domen"]!='' && $_POST["settings"]["way"] != '') {
//   $url_to = "{$_POST['settings']['domen']}/{$_POST['settings']['way']}";
// }

  //Начало блока шапки
  include("../blocks/header.php");
?>
<div id="page">
	<div id="page-bgtop">
		<div id="content">
		<div class="page_text">
        <p>
        <?php
		//var_dump($_POST);
		if(isset($id))
		{
			/*Заноосим данные в базу*/
			$result = mysqli_query($db, "UPDATE rooms SET title='$title', name='$name', pass='$pass', email='$email', url_to='$url_to', domen='$domen', way='$way' WHERE id='$id'");
			if($result == 'true')
			{
				//echo "<p>Информация успешно обновлена!</p>";
			}
			else
			{
				echo "<p>Информация не обновлена!</p>";
			}
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
