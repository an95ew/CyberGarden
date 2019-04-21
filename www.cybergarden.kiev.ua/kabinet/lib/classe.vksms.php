<?php
class VkFriends
{
	//работаем с веденными данными

    public function clean_var($var) {
    
         $var = strip_tags($var);
         $var = preg_replace('~\D+~', '', $var);        
         $var = trim($var);
         
		 /* var_dump($var); */
		 
         return $var;
    }
    
    public function get_friends($u_id) {
	
	//var_dump ($u_id);
    
         $friends = file_get_contents('https://api.vk.com/method/friends.get?user_id='.$u_id);
		 $friends = json_decode($friends);
         

		// var_dump($friends);

         if(!isset($friends->error)){
		/*  var_dump($friends->response); */
	         return $friends;
         }else{
	         return '';
         }
         
    }    
    
    public function mutual_friends($friends) {
	
		if ($friends[2]->response == "") 
		{
			$mutual = array_intersect($friends[0]->response, $friends[1]->response);
		}
		else
		{
			$mutual = array_intersect($friends[0]->response, $friends[1]->response, $friends[2]->response);
		}

         if(!empty($mutual)){
	         return $mutual;
         }else{
	         return '';
         }
         
    }
    
    public function get_users_info($users) {
    
	//var_dump($users);
	
         $u_ids = implode(",",$users);    
         $u_info = file_get_contents('https://api.vk.com/method/users.get?user_ids='.$u_ids.'&fields=photo_100');
         $u_info = json_decode($u_info);
         
         return $u_info;
    }     

    public function view_user_info($u_info) {
    
    	 $uid = $u_info->uid;
    	 $first_name = $u_info->first_name;
    	 $last_name = $u_info->last_name;
    	 $photo = $u_info->photo_100;
    	 
    	 print("
		 
    	 
    	 <div id='info'>
		 <span>id$uid</span>
		 <a href='http://vk.com/id$uid' target='_blank'>
    	 	<div id='ava'>
    	 		<img src='$photo'>
    	 	</div>
    	 	
    	 	<div id='name'>
	    	 	$first_name <br/>
	    	 	$last_name
    	 	</div>
		 </a>
    	 </div>
    	
    	 ");
    	
    }    
	
	
	public function view_user_info2($u_info) {
    
    	 $uid = $u_info->uid;
    	 $first_name = $u_info->first_name;
    	 $last_name = $u_info->last_name;
    	 $photo = $u_info->photo_100;
    	 
    	 print("
		 
    	 <div id='info2'>
		 <a href='http://vk.com/id$uid' target='_blank'>
    	 	<div id='ava'>
    	 		<img src='$photo'>
    	 	</div>
    	 	
    	 	<div id='name'>
	    	 	$first_name <br/>
	    	 	$last_name
    	 	</div>
		 </a>
    	 </div>
    	
    	 ");
    	
    }     

    public function view_users_info($users_info) {
    
    	for($i=0;$i<sizeof($users_info->response);$i++){
    	
    		$this->view_user_info($users_info->response[$i]);
    		
    	}
    
    }    
	
	public function view_users_info2($users_info) {
    
		echo '<div style=" height: 180px; margin: 0 auto;  padding: 0 10px 10px; width: 680px;">';
			for($i=0;$i<sizeof($users_info->response);$i++){
			
				$this->view_user_info2($users_info->response[$i]);
				
			}
		echo '</div>';
    }
    
}
?>