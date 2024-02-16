<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {
    
    
    
  //required field condition check
    if (isset($_POST["user_mobileno"]) && isset($_POST["mobile_otp"]) ) {
        
        
          //blank field condition check
        if ($_POST["user_mobileno"] != '' && $_POST["mobile_otp"] != '') {
        
             $user_mobileno = mysqli_real_escape_string($conn, $_POST["user_mobileno"]);
              $mobile_otp = mysqli_real_escape_string($conn, $_POST["mobile_otp"]);
              
              $query = mysqli_query($conn,"SELECT * FROM `tbl_user` where user_mobileno='{$user_mobileno}' and mobile_otp='{$mobile_otp}'")or die(mysqli_error($conn));
              
            $count = mysqli_num_rows($query);
            
            if($count>0)
            {
                  if (isset($_POST["device_token"])) {

                $device_token = mysqli_real_escape_string($conn, $_POST["device_token"]);

                $device = ",`device_token`='{$device_token}'";
            } else {
                $device = "";
            }
                
                
                    $row = mysqli_fetch_array($query);
                
                    $user_id=$row["user_id"];
                    $user_name=$row["user_name"];
                    $user_email=$row["user_email"];
                    $user_image=$row["user_image"];
                    
                   $query_update = mysqli_query($conn,"UPDATE `tbl_user` SET is_login='1',mobile_otp='0' $device WHERE `user_id`='{$user_id}' ")or die(mysqli_error($conn));
                   
                   
                 $response["flag"] = '1';
            $response["message"] = "You Have Successfully Logged In"; 
            
              $response["user_id"] = $row["user_id"];
              $response["user_name"] = $row["user_name"];
              $response["user_mobile"] = $row["user_email"];
              $response["user_image_url"] = $row["user_image"];

              $user_lat = $row['user_lat'];
              if($user_lat == "")
              {  
                  $latitude = "";
              }
              else{
                  $latitude = $user_lat;
              }
              $user_long = $row['user_long'];
              if($user_long == "")
              {  
                  $longitude = "";
              }
              else{
                  $longitude = $user_long;
              }

              $response["user_lat"] = $latitude;
              $response["user_long"] = $longitude;



            }
            else{
                  $response["flag"] = '0';
            $response["message"] = "You Have Entered Wrong OTP";
            }
              
              
              
         }
        //if any field is blank then this condition true
        else {
            $response["flag"] = '0';
            $response["message"] = "All Field Is Required";
        }
        
        
        
     }

    //if any field is missing then this condition true
    else {
        $response["flag"] = '0';
        $response["message"] = "Required Field Is Missing";
    }
}

//if authentication failed then this condition true
else {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    $response['flag'] = '0';
    $response['message'] = 'Sorry You Are not Allow to access';
}
echo json_encode($response);
?>
