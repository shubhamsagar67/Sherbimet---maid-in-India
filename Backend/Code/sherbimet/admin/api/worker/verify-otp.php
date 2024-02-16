<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {
    
    
    
  //required field condition check
    if (isset($_POST["worker_mobile"]) && isset($_POST["mobile_otp"]) ) {
        
        
          //blank field condition check
        if ($_POST["worker_mobile"] != '' && $_POST["mobile_otp"] != '') {
        
             $worker_mobile = mysqli_real_escape_string($conn, $_POST["worker_mobile"]);
              $mobile_otp = mysqli_real_escape_string($conn, $_POST["mobile_otp"]);
              
              $query = mysqli_query($conn,"SELECT * FROM `tbl_worker` where worker_mobile='{$worker_mobile}' and mobile_otp='{$mobile_otp}'")or die(mysqli_error($conn));
              
            $count = mysqli_num_rows($query);
            
            if($count>0)
            {
                
                    $row = mysqli_fetch_array($query);
                
                    $worker_id=$row["worker_id"];
                    $worker_name=$row["worker_name"];
                    $worker_email=$row["worker_email"];
                    $worker_image=$row["worker_image"];
                    
                   $query_update = mysqli_query($conn,"UPDATE `tbl_worker` SET is_login='1' WHERE `worker_id`='{$worker_id}' ")or die(mysqli_error($conn));
                 $response["flag"] = '1';
            $response["message"] = "You Have Successfully Logged In"; 
            
              $response["worker_id"] = $row["worker_id"];
              $response["worker_name"] = $row["worker_name"];
              $response["user_mobile"] = $row["worker_email"];
              $response["worker_image_url"] = $imageupload_path.$row["worker_image"];
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
