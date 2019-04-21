<?php
include("blocks/bd.php");
if ($_GET ['ip']) {
	$ip = $_GET ['ip'];
}
else {
	$ip = $_SERVER["REMOTE_ADDR"];
}
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
<script src="jquery-1.11.1.js"></script>
<style>
	#map {
		width: 100%;
		height: 500px;
	}
</style>
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


$typeData = 'xml'; // в каком виде мы получим данные. json или xml

// формируем URL для запроса
$url = "https://api.2ip.ua/geo.json?ip=$ip";
$data = @file_get_contents($url);


// если получили данные
if($data){
    // декодируем полученные данные
    $dataDecode = json_decode($data);
	    /*$dataDecode = json_decode('{
			"country_code":"US",
			"country":"United states",
			"country_rus":"\u0421\u0428\u0410\r",
			"region":"California",
			"region_rus":"\u041a\u0430\u043b\u0438\u0444\u043e\u0440\u043d\u0438\u044f",
			"city":"Mountain view",
			"city_rus":"\u041c\u0430\u0443\u043d\u0442\u0438\u043d-\u0412\u044c\u044e",
			"latitude":"37.405992","longitude":"-122.078515","zip_code":"94043","time_zone":"-08:00"
			}');*/


		$country = $dataDecode->country_rus;
		$country_code = $dataDecode->country_code;
		$region = $dataDecode->region_rus;
		$city = $dataDecode->city_rus;
		$latitude = $dataDecode->latitude;
		$longitude = $dataDecode->longitude;
}else{
    echo "Сервер не доступен!";
}
?>
<div id="map">

</div>
	<script>
		function initMap ()
		{
			var lati = +"<?=$latitude?>";
			var longi = +"<?=$longitude?>";
			var country = "<?=$country?>";
			var city = "<?=$city?>";

			var element = document.getElementById('map');
			var options = {
				zoom: 6,
				center: {lat: 50.431782, lng: 30.516382}
			};

			var myMap = new google.maps.Map (element,options);

			addMarker({
				coordinates: {lat: lati, lng: longi},
				info:
				'<table>'+
					'<tr> <td> Страна:</td> <td>' + country + '</td></tr>' +
					'<tr> <td> Город:</td> <td>' + city + '</td></tr>' +
					'<tr> <td> Ширина:</td> <td>' + lati + '</td></tr>' +
					'<tr> <td> Долгота:</td> <td>' + longi + '</td></tr>' +
				'</table>'
			});

			function addMarker (properties){
				var marker = new google.maps.Marker ({
					position: properties.coordinates,
					map: myMap
				});

				if (properties.image){
					marker.setIcon(properties.image);
				}

				if (properties.info)
				{
					var infoWindow = new google.maps.InfoWindow ({
						content: properties.info
					});

					marker.addListener('click', function(){
						infoWindow.open(myMap,marker);
					});
				}
			}
		}
	</script>
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB68zqyxd6L8fsiUPPoAR0h_jMsgFa0-Rc&callback=initMap">
	</script>



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
