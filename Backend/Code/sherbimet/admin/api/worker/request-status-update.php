<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    //required field condition check
    if (isset($_POST["request_id"]) && isset($_POST["status_id"]) && isset($_POST["worker_id"])) {      
        
//blank field condition check

        if ($_POST["request_id"] != '' && $_POST["status_id"] != '' && $_POST["worker_id"] != '') { 

            $request_id = mysqli_real_escape_string($conn, $_POST["request_id"]);
            $status_id = mysqli_real_escape_string($conn, $_POST["status_id"]);
            $worker_id = mysqli_real_escape_string($conn, $_POST["worker_id"]);

            $query_status_2 = mysqli_query($conn, "SELECT * FROM `tbl_status` where status_id='{$status_id}'") or die(mysqli_error($conn));
            $row_status_2= mysqli_fetch_array($query_status_2);
            
            $status_name=$row_status_2["status_name"];


           

            $query_request = mysqli_query($conn, "SELECT * FROM `tbl_request` where is_active='1' and is_delete='0' and  request_id='{$request_id}'") or die(mysqli_error($conn));
            $count = mysqli_num_rows($query_request);


            if($count>0)
            {
                $row_request = mysqli_fetch_array($query_request);
                $query_user = mysqli_query($conn, "SELECT * FROM `tbl_user` where user_id='{$row_request['user_id']}'") or die(mysqli_error($conn));
                $row_user = mysqli_fetch_array($query_user);
                $device_token = $row_user["device_token"];

                $query_worker = mysqli_query($conn, "SELECT * FROM `tbl_worker` where worker_id='{$worker_id}'") or die(mysqli_error($conn));
               $row_worker= mysqli_fetch_array($query_worker);
                  
                if($status_id == "2")
                {
                $query_Request = mysqli_query($conn, "SELECT * FROM `tbl_request` where can_accept='0' and request_id='{$request_id}'") or die(mysqli_error($conn));
                   $count_Request = mysqli_num_rows($query_Request);
                   if($count_Request >0)
            {
                $response["flag"] = '0';
                $response["message"] = "Your Request Already Accepted By Other Worker";        
                   $response["can_message"] = "You cant'accept this Request already accpeted";
            }
            else{
                
                
                
                
                $query_update = mysqli_query($conn,"UPDATE `tbl_request` SET `worker_id`='{$worker_id}',`booking_status`='Accepted',`status_id`='2',`can_accept`='0' WHERE `request_id`='{$request_id}'")or die(mysqli_error($conn));
                if($query_update)
                {

                    $worker_name = $row_worker["worker_name"];
                      
                    // $device_token  = "c71vxQzSNAM:APA91bG0MxchuV_5aD9oOTto74Ew9Q4KBBXNtc2itpcPRDX81GjRiZEwhQw1FkSIj0PnNGFbHkGyK9taTSWFEI5zSTCQUHVo4eZ0D6mCY5BhbupFzOrezfwRLoKIzjxQKe75tDE45BGZ";
                        // $message = "Request ID $request_id Status $status_name Has Been Came To By Worker Name $worker_name ";
                         $message = "Request Has Been $status_name For Request ID $request_id By $worker_name";
                        // $message = "Request Status Has been changed to $status_name For Request ID $request_id";
                        
                        firebase_send_user($device_token, $message,$status_id);


                $response["flag"] = '1';
                $response["message"] = "Your Request Accepted";        
                }
                else{
                $response["flag"] = '0';
                $response["message"] = "Your Request Not Accepted";    
                }
            }
         }
         elseif($status_id == "3"){

            $query_request_3 = mysqli_query($conn, "SELECT * FROM `tbl_request` where `status_id`='3' and request_id='{$request_id}'") or die(mysqli_error($conn));
            $count_request_3 = mysqli_num_rows($query_request_3);
            if($count_request_3 >0)
            {
                $response["flag"] = '0';
                $response["message"] = "Your Request Status Already Started";        
                   $response["can_message"] = "You cant' again start this Request already started";
            }
            else{
                $query_update = mysqli_query($conn,"UPDATE `tbl_request` SET `status_id`='{$status_id}'  WHERE `request_id`='{$request_id}'")or die(mysqli_error($conn));
                if ($query_update) {

                    $message = "Request Status Has been changed to $status_name For Request ID $request_id";
                    firebase_send_user($device_token, $message,$status_id);

                    $response["flag"] = '1';
                    $response["message"] = "Your Request Status Updated Successfully ";
                    
                } else {
                    $response["flag"] = '0';
                    $response["message"] = "Error In Query";
                }
            }
            }
            elseif($status_id == "4")
            {
                $query_request_4 = mysqli_query($conn, "SELECT * FROM `tbl_request` where `status_id`='4' and request_id='{$request_id}'") or die(mysqli_error($conn));
                $count_request_4 = mysqli_num_rows($query_request_4);
                if($count_request_4 >0)
                {
                    $response["flag"] = '0';
                    $response["message"] = "Your Request Status Already Started";        
                       $response["can_message"] = "You cant' again complete this Request already Completed";
                }
                else{
                    $query_update = mysqli_query($conn,"UPDATE `tbl_request` SET `status_id`='{$status_id}'  WHERE `request_id`='{$request_id}'")or die(mysqli_error($conn));
                    if ($query_update) {
                        $message = "Request Status Has been changed to $status_name For Request ID $request_id";
                        firebase_send_user($device_token, $message,$status_id);
                        $response["flag"] = '1';
                        $response["message"] = "Your Request Status Updated Successfully ";
                        
                    } else {
                        $response["flag"] = '0';
                        $response["message"] = "Error In Query";
                    }
                }   
            }
            else{
                $response["flag"] = '0';
                $response["message"] = "Your Status Id Not Found";
            }
            }
            else{
                $response["flag"] = '0';
                $response["message"] = "No Record Found";
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