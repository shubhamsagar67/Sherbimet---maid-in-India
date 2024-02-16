<?php
session_start();

 global $tokenname, $tokenvalue ;
 
 error_reporting(0);
 
//  $conn = mysqli_connect("localhost","root","","sherbimet_db") or die("error");
 $conn = mysqli_connect("localhost","apweb_sherbimet","oMEGxORvLVZ5","apweb_sherbimet_db") or die("error");
// define('BASE_URL', 'http://192.168.0.7/apweb_worker/');


// $imageupload_path = "http://localhost/sherbimet/admin/images/";
$imageupload_path = "http://apwebtester.in/test/sherbimet/admin/images/";

header('Access-Control-Allow-Origin: *');
$tokenname = 'sherbimet';
$tokenvalue = 'sherbimet@998';

function base_url() {
    return BASE_URL;
}

date_default_timezone_set('Asia/Calcutta');

function relative_time($data_in) {
    $start_date = new DateTime(date('Y-m-d h:i:s'));
    $since_start = $start_date->diff(new DateTime($data_in));
    $out = '';
    if (empty($out) && $since_start->y != 0)
        $out .= $since_start->y . ' years';
    else if (empty($out) && $since_start->m != 0)
        $out .= $since_start->m . ' months';
    else if (empty($out) && $since_start->d != 0)
        $out .= $since_start->d . ' days';
    else if (empty($out) && $since_start->h != 0)
        $out .= $since_start->h . ' hours';
    else if (empty($out) && $since_start->i != 0)
        $out .= $since_start->i . ' minutes';
    else if (empty($out) && $since_start->s != 0)
        $out .= $since_start->s . ' seconds';
    return $out . ' ago';
}

//this function will return todays date 
function today_date() {
    return date('Y-m-d');
}

//this function will return current time 
function today_time() {
    return date('h:i:s');
}

//this  function will return current time stamp
function today_datetime() {
    return date('Y-m-d h:i:s');
}

//this function will change the format of date and time 
//1st argument will be format
//2nd argument will be date 
function change_date_format($format, $date) {
    return date($format, strtotime($date));
}



$project_title="Sherbimet";
$home_page = "dashboard.php";
$user_home_page = "index.php";

$datetime = date("Y-m-d h:i:s");


function redirect($url) {
    echo "<script>window.location='$url';</script>";
}



function firebase($user_id,$message){
    
        $ids[]=$user_id;  
	$is_background = false;
    
    $messaage['data'] = array('notification_title'=>'Hirespace','notification_description'=>$message,'is_background'=>$is_background);
    // print_r($messaage);
 return   send($ids,$messaage);
            
    
}

function send($registration_ids,$message){
		$fields = array('registration_ids'=>$registration_ids,'data'=>$message);
		return  sendPushNotifi($fields);
	}
	
function sendPushNotifi($fields){    
        
		$url = 'https://fcm.googleapis.com/fcm/send';
		$headers = array('Authorization: key=AAAAEZB505w:APA91bHIhlfKFSWfeL9ozBBqAzYxGKufGg3FJcgmyjhZlYHS812he8Lbdd6BdRUaaBenvigJrRgQFaZxvIclrptlqaRbUK2KZ2b2M_zjghd9navD1J_EQ3OeIb-XXvm3xfRY-VFiH4_x','Content-Type:application/json');
   
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
		
		$result = curl_exec($ch);
		if($result===FALSE){
			die("Curl Failed : ".curl_error($ch));
		}
		curl_close($ch);
               
		return $result;
}



function mynew_dt() {
    return date('d-m-Y G:i:s');
}
//worker notication send form user side
function firebase_test($user_id,$message){
    
    
    $ids[]=$user_id;  
$is_background = false;
$currentime = mynew_dt();
// $messaage['data'] = array('notification_title'=>'HSParnters','notification_description'=>$message,'is_background'=>$is_background);
$messaage1['data'] = array('screen_title'=> '','notification_title'=>'Sherbimet Worker','notification_description'=>$message,'date_time'=>$currentime,'screen_type'=>'Requests','is_image'=>'','status_id' => '1');

return   send_test($ids,$messaage1);
        

}

function send_test($registration_ids,$message){
    $fields = array('registration_ids'=>$registration_ids,'data'=>$message);
    
    return  sendPushNotifi_test($fields);
}

function sendPushNotifi_test($fields){    
    // print_r(json_encode($fields));
    $url = 'https://fcm.googleapis.com/fcm/send';
    $headers = array('Authorization: key=AAAALTIBCoI:APA91bH7wy2ti4zVgnopr8QUpfC-af_cZ16vPJQ4JJgZzow-clRgVhIi8XOK6xVZH9pNcCjXqghQKqSExxe5X6YdoZEJ1d5R2k3rZ_eq3OzjLrQfPCb4YpOscgEcGI0_FjtZN_nlENJC','Content-Type:application/json');

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    
    $result = curl_exec($ch);
    if($result===FALSE){
        die("Curl Failed : ".curl_error($ch));
    }
    curl_close($ch);
    //   print_r($result);
    return $result;
}


//user side notification send form worker side
function firebase_send_user($user_id,$message,$status_id){
    
    
    $ids[]=$user_id;  
$is_background = false;
$currentime = mynew_dt();
// $messaage['data'] = array('notification_title'=>'HSParnters','notification_description'=>$message,'is_background'=>$is_background);
$messaage1['data'] = array('screen_title'=>'','notification_title'=>'Sherbimet User','notification_description'=>$message,'date_time'=>$currentime,'screen_type'=>'Bookings','is_image'=>'','status_id' =>$status_id);

return   send_user($ids,$messaage1);
        

}

function send_user($registration_ids,$message){
    $fields = array('registration_ids'=>$registration_ids,'data'=>$message);
    
    return  sendPushNotifi_user($fields);
}

function sendPushNotifi_user($fields){    
    // print_r(json_encode($fields));
    $url = 'https://fcm.googleapis.com/fcm/send';
    $headers = array('Authorization: key=AAAA5jgq1jU:APA91bHWk-TOe3i2-ciof86c52trAlRftpsgT-qIs5bwbLGsk1xN9HB-f8s4r3BmPlH4p0Qa8jCSrHGKIbUEB5UNs3UdLFzrRdv5JNGxNClF2J4k3YH1cDTD9hNKpCd91UKptNV80cyC','Content-Type:application/json');

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    
    $result = curl_exec($ch);
    if($result===FALSE){
        die("Curl Failed : ".curl_error($ch));
    }
    curl_close($ch);
    //   print_r($result);
    return $result;
}

$rupee_symbol = "₹ ";
?>