<?php 
include("blocks/bd.php");
if ($_GET ['ip']) {$ip = $_GET ['ip'];} else {$ip = $_SERVER["REMOTE_ADDR"]; echo "Ваш провайдер: <br> ";}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $myrow_p["title"]; ?></title>
<LINK rel="stylesheet" type="text/css" href="css/style.css">
<meta name="description" content="<?php echo $myrow_p["meta_d"]; ?> " />
<meta name="keywords" content="<?php echo $myrow_p["meta_k"]; ?> " />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="ico.png" rel="shortcut icon">
</head>
<body>
     <!-- Начало блока шапки -->
<?php // include("blocks/header.php"); ?>
     <!-- Конец блока шапки -->
<div id="page">
	<div id="page-bgtop">
		<div id="content">
		
<?
// кодировка страницы
header('Content-Type: text/html;charset=UTF-8');
  
//$ip = '109.251.251.4'; // IP, который будем проверять
//$typeData = 'json'; // в каком виде мы получим данные. json или xml
$typeData = 'xml'; // в каком виде мы получим данные. json или xml
  
// формируем URL для запроса
$url = "http://api.2ip.com.ua/provider.$typeData?ip=$ip";
// делаем запрос к API
$data = @file_get_contents($url);
header("Location: {$url}");
// если получили данные
if($data){
    // декодируем полученные данные
    $dataDecode = json_decode($data);
     
    // выводим данные
    echo "Страна: " . $dataDecode->countryName . "<br/>";
    echo "Код страны: " . $dataDecode->countryCode . "<br/>";  
    echo "Город: " . $dataDecode->city . "<br/>";   
    echo "Область: " . $dataDecode->region . "<br/>";
    echo "Широта: " . $dataDecode->latitude . "<br/>";
    echo "Долгота: " . $dataDecode->longitude . "<br/>";
    echo "Часовой пояс: " . $dataDecode->timezone . "<br/>";
 
}else{
    echo "Сервер не доступен!";
}
?>
	
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