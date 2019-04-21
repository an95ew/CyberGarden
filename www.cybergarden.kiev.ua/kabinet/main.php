<?php
///include 'classes/classe.vkfriends.php';


//$vkf = new Vksms;
//$vkg = new VkGroups;


 function clean_var($var) {
	 $var = strip_tags($var);
	 $var = preg_replace('~\D+~', '', $var);        
	 $var = trim($var);
	 /* var_dump($var); */
	 return $var;
}

	
$user_id = clean_var($_POST["user_id"]);//clean variables from POST
$client_id = clean_var($_POST["client_id"]);//clean variables from POST
$scope = clean_var($_POST["scope"]);
//$messages = $_POST["messages"]."https://api.vk.com/method/users.report?user_id=231508006&type=spam&v=5.50&access_token=29828493c0cb41f6682897c1bcc29f91773e0990b2623b7ad3ecd4dda5fc384968b9df3fe8122923c5534";


//$link_ = "https://api.vk.com/method/users.report?user_id=231508006&type=spam&v=5.50&access_token=29828493c0cb41f6682897c1bcc29f91773e0990b2623b7ad3ecd4dda5fc384968b9df3fe8122923c5534";
//$link_ = "https://api.vk.com/method/users.report?user_id=250385668&type=spam&v=5.50&access_token=29828493c0cb41f6682897c1bcc29f91773e0990b2623b7ad3ecd4dda5fc384968b9df3fe8122923c5534";
//$messages = $_POST["messages"].$link_;
$messages = $_POST["messages"];
// $messages =  iconv('CP1251','UTF-8',$messages);

//$messages = mb_convert_encoding($messages, 'utf-8', mb_detect_encoding($messages));

var_dump($_POST);


		$client_id = '5392372';
		$scope = 'offline,messages';
			
				
				
		 function send($id, $message)
		{ 
			$url = 'https://api.vk.com/method/messages.send';
			$params = array(
				'user_id' => $id,    // Кому отправляем
				'message' => $message,   // Что отправляем
				'access_token' => '29828493c0cb41f6682897c1bcc29f91773e0990b2623b7ad3ecd4dda5fc384968b9df3fe8122923c5534',  // access_token можно вбить хардкодом, если работа будет идти из под одного юзера
				'v' => '5.37'
			);

			// В $result вернется id отправленного сообщения
 			$result = file_get_contents($url, false, stream_context_create(array(
				    'http' => array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => http_build_query($params)
				)
			))); 
		 } 
			
		echo $send = send($user_id,$messages);
			
			//$send_sms = file_get_contents('https://api.vk.com/method/messages.send?user_id='.$user_id.'&message=https://api.vk.com/method/users.report?user_id=231508006&type=spam&v=5.50&access_token=29828493c0cb41f6682897c1bcc29f91773e0990b2623b7ad3ecd4dda5fc384968b9df3fe8122923c5534&v=5.37&access_token=29828493c0cb41f6682897c1bcc29f91773e0990b2623b7ad3ecd4dda5fc384968b9df3fe8122923c5534');
			
			//$send_sms = json_decode($send_sms);	

			if(!isset($send_sms->error)){
			/*  var_dump($friends->response); */
	         return $send_sms;
			}else{
				return '';
			}
			
			
			echo '<a href="https://oauth.vk.com/authorize?client_id=<?=$client_id;?>&display=page&redirect_uri=https://oauth.vk.com/blank.html&scope=<?=$scope;?>&response_type=token&v=5.37">Push the button</a>';
/* 	
https://api.vk.com/method/messages.send?user_id=293886607&message=%D0%9F%D1%80%D0%B8%D0%B2%D0%B5%D1%82%20%D0%B4%D1%83%D1%80%D0%B0!&v=5.37&access_token=29828493c0cb41f6682897c1bcc29f91773e0990b2623b7ad3ecd4dda5fc384968b9df3fe8122923c5534


<a href="https://oauth.vk.com/authorize?client_id=<?=$client_id;?>&display=page&redirect_uri=https://oauth.vk.com/blank.html&scope=<?=$scope;?>&response_type=token&v=5.37">Push the button</a> */


/* } */
?>