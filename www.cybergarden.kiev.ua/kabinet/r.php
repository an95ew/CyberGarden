<?php
include("blocks/bd.php");
if ($_GET ['pass']!=="671a6267827cea16ad54674bbbda0932")
{
/*header("HTTP/1.1 301 Moved Permanently");
header("Location: http://vk.com"); */
}

include("blocks/header.php");
?>
<body>
<a href="authorisation_form.php">TEST </a>
<div id="page">
	<div id="page-bgtop">
			<form method="POST" action="view_room.php" style="" id="adduser_block">
			 <fieldset style="background:#e6e6e6; border-radius:5px;  ;border: 1px dashed #333">
				<!-- <legend align="center">&nbsp;&nbsp;Добавление нового пользователя&nbsp;&nbsp;</legend> -->
					<table border="0">
						<tr>
							<td width="90%">
								<input type="hidden" name="act"  value="insert">
								<input type="text" name="room[name]" placeholder="Имя" value="" size="16">
								<input type="text" name="room[pass]" placeholder="Пароль" value="" size="16">
								<input type="text" name="room[title]" placeholder="Название комнаты" value="" size="25">
								<input type="text" name="room[url_to]" placeholder="Ссылка (без www, https://, https://)" value="" size="25">
								<input type="text" name="room[email]" placeholder="e-mail" value="" size="30">
							</td>
							<td width="10%">
								<input class="inputsubmit" name="insert" type="submit" value="Создать комнату" style="width:160px;">
							</td>
						</tr>
					</table>
			</fieldset>
		</form>

		<div id="content">
		<table
			border="0" bordercolor="#900"
			style=" border: 1px none #333"
			width="100%"
		 >
			<tr>
				<td width="2">Номер</td>
				<td width="130">Автор</td>
				<td width="380">Название комнаты</td>
				<td>Перенаправить</td>
				<td width="30">Введите пароль для входа</td>
			</tr>
		<?
			$result = mysqli_query($db," select * from rooms ORDER BY id DESC");
			//$myrow = mysqli_fetch_array($result);
				while($myrow = mysqli_fetch_array($result))
				{
					//var_dump($myrow);
					echo "
							<tr>
								<td>{$myrow['id']}</td>
								<td>{$myrow['name']}</td>
								<td>{$myrow['title']}</td>
								<td>
									{$myrow['url_to']}
								</td>
								<td>
									<form method=\"GET\" action=\"/kabinet/view_room.php\" style=\"\" id=\"vhod\">
										<table border=\"0\">
											<tr>
												<td width=\"90%\">
													<input type=\"hidden\" name=\"act\" value=\"auth\">
													<input type=\"hidden\" name=\"room[id]\" value=\"{$myrow['id']}\">
													<input type=\"password\" name=\"room[pass]\" placeholder=\"Пароль\" value=\"\" size=\"25\">
												</td>
												<td width=\"10%\">
													<input class=\"inputsubmit\" name=\"auth\" type=\"submit\" value=\"Войти\" style=\"width:160px;\">
												</td>
												<td><a href='/kabinet/drop_r.php?id={$myrow['id']}'> УДАЛИТЬ </a></td>
											</tr>
										</table>
									</form>
								</td>
							</tr>
						";
				}
		?>
		</table>

			<?php echo "<div class='page_text'>"; ?>
			<?php echo $myrow_p["text"]; ?>
			<?php echo "</div>"; ?>


		</div>
		<!-- end #content -->
<?php // include("blocks/right.php"); ?>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->
</div>
<?php //include("blocks/footer.php"); ?>
</body>
</html>
