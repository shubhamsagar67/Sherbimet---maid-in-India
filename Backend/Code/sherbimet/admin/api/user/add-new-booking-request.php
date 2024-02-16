<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    //required field condition check 
    if (isset($_POST["booking_date"]) && isset($_POST["booking_time"]) && isset($_POST["user_id"]) && isset($_POST["booking_message"]) && isset($_POST["booking_address"]) && isset($_POST["payment_method"]) && isset($_POST["package_id"]) ) {      
        
//blank field condition check

        if ($_POST["booking_date"] != '' && $_POST["booking_time"] != '' && $_POST["user_id"] != '' && $_POST["booking_message"] != '' && $_POST["booking_address"] != '' && $_POST["payment_method"] != '' && $_POST["package_id"] != '') { 
            
            

            $booking_date = mysqli_real_escape_string($conn, $_POST["booking_date"]); 
         $booking_time = mysqli_real_escape_string($conn, $_POST["booking_time"]); 
         $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]); 
         $payment_method = mysqli_real_escape_string($conn, $_POST["payment_method"]); 
       //  $worker_id = mysqli_real_escape_string($conn, $_POST["worker_id"]); 
         //$booking_totalamount = mysqli_real_escape_string($conn, $_POST["booking_totalamount"]); 
         $booking_message = mysqli_real_escape_string($conn, $_POST["booking_message"]); 
         $booking_address = mysqli_real_escape_string($conn, $_POST["booking_address"]); 
       
         $insert_datetime = date('Y-m-d h:i:s');
                            $booking_date    = date('Y-m-d',strtotime($booking_date));
                            $booking_time    = date('G:i:s',strtotime($booking_time));
if(isset($_POST["worker_id"]))
{
    $worker_id = mysqli_real_escape_string($conn, $_POST["worker_id"]); 
}
else{
    $worker_id = "0";
}






if(isset($_POST["package_id"]))
{
    $package_id = mysqli_real_escape_string($conn, $_POST["package_id"]); 

    $query_package = mysqli_query($conn,"SELECT * FROM `tbl_package` WHERE `package_id`='{$package_id}'")or die(mysqli_error($conn));
    $row_package = mysqli_fetch_array($query_package);
    
    $booking_totalamount = $row_package["package_price"];
}
else{
    $package_id = "0";
    $booking_totalamount = "";
}


if(isset($_POST["area_id"]))
{
    $area_id = mysqli_real_escape_string($conn, $_POST["area_id"]); 
}
else{
    $area_id = "0";
}

        $query_worker  = mysqli_query($conn,"SELECT * FROM `tbl_worker` WHERE `package_id`='{$package_id}' and is_delete='0'")or die(mysqli_error($conn));
        $count=mysqli_num_rows($query_worker);
        if($count>0)
        {

        

         //is_booking 1 meanse insert data in booking table                            
         
                $query = mysqli_query($conn,"INSERT INTO `tbl_request`(`booking_date`, `booking_time`, `user_id`, `worker_id`, `package_id`, `booking_totalamount`, `booking_message`, `booking_address`, `booking_status`, `status_id`, `area_id`, `can_accept`,`payment_method`,`insert_datetime`) VALUES ('{$booking_date}','{$booking_time}','{$user_id}','0','{$package_id}','{$booking_totalamount}','{$booking_message}','{$booking_address}','Pending','1','{$area_id}','1','{$payment_method}','{$insert_datetime}')")or die(mysqli_error($conn));

                if($query){
                    $insert_id = mysqli_insert_id($conn);

                     //all worker get 
                     $query_worker = mysqli_query($conn,"SELECT * FROM `tbl_worker` where package_id='{$package_id}'")or die(mysqli_error($conn));
                     $count_worker=mysqli_num_rows($query_worker);
                    
                //send notification
              while($row_worker = mysqli_fetch_array($query_worker))
              {
             
                  $device_token = $row_worker['device_token'];
                
                if($device_token != '')
                {
                   
                      
                $message = "New User Request For Booking Request ID $insert_id ";
                firebase_test($device_token, $message);
                }
              }
                    $response["flag"] = '1';
                 $response["message"] = "Your Request has been Done Successfully";
              }
              else{
                    $response["flag"] = '0';
                 $response["message"] = "Error In Query";
              }

            }
            else{
                $response["flag"] = '0';
                     $response["message"] = "Your Booking Rejected, Because this pacakge for not any worker";
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