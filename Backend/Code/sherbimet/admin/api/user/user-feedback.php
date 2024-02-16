<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    //required field condition check
    if ((isset($_POST["user_id"])) && (isset($_POST["booking_id"])) && (isset($_POST["worker_id"])) && (isset($_POST["feedback_message"])) && (isset($_POST["feedback_rating"]))) { 
        //blank field condition check
   
        if ($_POST["user_id"] != '' && $_POST["booking_id"] != '' && $_POST["worker_id"] != '' && $_POST["feedback_message"] != '' && $_POST["feedback_rating"] != '') { 

            $is_booking = 0;

            $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
            $booking_id = mysqli_real_escape_string($conn, $_POST["booking_id"]);
            $worker_id = mysqli_real_escape_string($conn, $_POST["worker_id"]);
            $feedback_message = mysqli_real_escape_string($conn, $_POST["feedback_message"]);
            $feedback_rating = mysqli_real_escape_string($conn, $_POST["feedback_rating"]);
            $feedback_date = date("Y-m-d");


            if($is_booking == "1")
            {
                $query_feedback = mysqli_query($conn,"SELECT * FROM `tbl_feedback` WHERE `is_active`='1' and `is_delete`='0' and `is_booking`='1' and user_id='{$user_id}'")or die(mysqli_error($conn));

                $count = mysqli_num_rows($query_feedback);
                if($count >0 )
                {
                    $response["flag"] = '0';
                    $response["message"] = "You Booking Feedback Already Exist ";
                }
               
                else{
                $query_booking = mysqli_query($conn,"INSERT INTO `tbl_feedback`(`feedback_date`, `feedback_message`, `feedback_rating`, `user_id`, `worker_id`, `booking_id`, `is_booking`,`insert_datetime`) VALUES ('{$feedback_date}','{$feedback_message}','{$feedback_rating}','{$user_id}','{$worker_id}','{$booking_id}','1','{$datetime}')")or die(mysqli_error($conn));

                if($query_booking)
                {
                    $response["flag"] = '1';
                    $response["message"] = "You Booking Feedback Added Succesfully";
                }
                else{
                    $response["flag"] = '0';
                    $response["message"] = "Error In Query";
                }
            }

            }
            else{


                $query_feedback = mysqli_query($conn,"SELECT * FROM `tbl_feedback` WHERE `is_active`='1' and `is_delete`='0' and `is_booking`='0' and user_id='{$user_id}'")or die(mysqli_error($conn));
                  
                $count = mysqli_num_rows($query_feedback);
                if($count >0 )
                {
                    $response["flag"] = '0';
                    $response["message"] = "You Request Feedback Already Exist ";
                }
               
                else{
                $query_booking = mysqli_query($conn,"INSERT INTO `tbl_feedback`(`feedback_date`, `feedback_message`, `feedback_rating`, `user_id`, `worker_id`, `booking_id`, `is_booking`,`insert_datetime`) VALUES ('{$feedback_date}','{$feedback_message}','{$feedback_rating}','{$user_id}','{$worker_id}','{$booking_id}','0','{$datetime}')")or die(mysqli_error($conn));

                if($query_booking)
                {
                    $response["flag"] = '1';
                    $response["message"] = "You Request Feedback Added Succesfully";
                }
                else{
                    $response["flag"] = '0';
                    $response["message"] = "Error In Query";
                }
            }


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

