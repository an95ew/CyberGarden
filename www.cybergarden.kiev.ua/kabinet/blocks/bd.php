<?php
	if(!($db = mysqli_connect('db21.freehost.com.ua', 'cybergard_vds', 'uUb8clVI1','cybergard_kabinet')))
	{
		echo "<p>Ошибка при подключении к базе данных. Оповестите пожалуйста администратора.</p>";
		exit();
	}
	mysqli_query($db,"SET NAMES utf8"); 
?>