<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    //required field condition check
    if (isset($_POST["booking_id"])  && isset($_POST["cancel_reason"]) ) {      
        
//blank field condition check

        if ($_POST["booking_id"] != '' && $_POST["cancel_reason"] != '') { 

            $request_id = mysqli_real_escape_string($conn, $_POST["booking_id"]);
            $cancel_reason = mysqli_real_escape_string($conn, $_POST["cancel_reason"]);

            $query_booking = mysqli_query($conn, "SELECT * FROM tbl_request where is_active='1' and is_delete='0' and request_id='{$request_id}'")or die(mysqli_error($conn));

            $count = mysqli_num_rows($query_booking);
            if($count>0)
            {
                
                $query_update = mysqli_query($conn,"UPDATE `tbl_request` SET `status_id`='5',cancel_reason='{$cancel_reason}',booking_status='Cancelled'  WHERE `request_id`='{$request_id}'")or die(mysqli_error($conn));
                if ($query_update) {
                    $response["flag"] = '1';
                $response["message"] = "Your Booking Successfully Cancelled";
                    
                } else {
                    $response["flag"] = '0';
                    $response["message"] = "Error In Query";
                }

                

            }
            else{
                $response["flag"] = '0';
            $response["message"] = "Booking Id Not Found";
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