<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    //required field condition check
    if (isset($_POST["worker_id"])) {      
        
//blank field condition check

        if ($_POST["worker_id"] != '') {

            $worker_id = mysqli_real_escape_string($conn, $_POST["worker_id"]);
            

            
            
            if(isset($_POST["status_id"]))
            {
                $status_id = mysqli_real_escape_string($conn, $_POST["status_id"]);
            }
          else{
            $status_id = "1";
          }
            
if($status_id == "1")
{
$search = "and status_id='{$status_id}' and can_accept='1'";
}
else{
$search = "and status_id='{$status_id}' and worker_id='{$worker_id}'";
}
        //   $query = mysqli_query($conn, "SELECT * FROM `tbl_request` where is_active='1' and is_delete='0' and status_id='{$status_id}' and  worker_id='{$worker_id}' order by request_id desc") or die(mysqli_error($conn));
        $query = mysqli_query($conn, "SELECT * FROM `tbl_request` where is_active='1' and is_delete='0' $search order by request_id desc") or die(mysqli_error($conn));
           //pagination start

    $numrows = mysqli_num_rows($query);

    $rowsperpage = 10;
    $totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
    if (isset($_POST['currentpage']) && is_numeric($_POST['currentpage'])) {
        $currentpage = $_POST['currentpage'];
    } else {
        $currentpage = 1;  // default page number
    }
// if current page is less than first page
    if ($currentpage <= 1) {
// set current page to first page
        $currentpage = 1;
    }
    // the offset of the list, based on current page
    $offset = ($currentpage - 1) * $rowsperpage;


    //this condition check current page less then qual total page or totalpage qual to 0
    if ($currentpage <= $totalpages || $totalpages == 0) {

            // $query_request = mysqli_query($conn, "SELECT * FROM `tbl_request` where is_active='1' and is_delete='0' and status_id='{$status_id}' and  worker_id='{$worker_id}' order by request_id desc limit $offset, $rowsperpage") or die(mysqli_error($conn));
            $query_request = mysqli_query($conn, "SELECT * FROM `tbl_request` where is_active='1' and is_delete='0' $search order by request_id desc limit $offset, $rowsperpage") or die(mysqli_error($conn));
            $count = mysqli_num_rows($query_request);

            
          
            if($count>0)
            {
                $response["flag"] = '1';
                $response["message"] = "$count Record Found";
                $response["request"] = array();
                $temparray = array();

                while ($row = mysqli_fetch_array($query_request)) {
     

                    $temparray["request_id"] = $row["request_id"];
                    $temparray["booking_date"] = date('d-m-Y',strtotime($row["booking_date"]));
                     $temparray["booking_time"] = date('G:i a',strtotime($row["booking_time"]));
                     
                     
                     $booking_date = date('d M, Y',strtotime($row["booking_date"]));
                     $booking_time = date('G:i a',strtotime($row["booking_time"]));
                     
                     $temparray["booking_date_time"] =$booking_date." ".$booking_time;
                    $temparray["user_id"] = $row["user_id"];
                    // $temparray["worker_id"] = $row["worker_id"];
                    $temparray["booking_totalamount"] = "₹ ".$row["booking_totalamount"];
                    $temparray["booking_message"] = $row["booking_message"];
                    $temparray["booking_address"] = $row["booking_address"];
                    $temparray["payment_method"] = $row["payment_method"];
                    
                    $status_id = $row["status_id"];
                    $temparray["status_id"] = $row["status_id"];
                    $query_status = mysqli_query($conn,"SELECT * FROM `tbl_status` where status_id='{$status_id}'")or die(mysqli_error($conn));
                    $row_status= mysqli_fetch_array($query_status);
                    $temparray["status_name"] = $row_status["status_name"];


                    $user_id = $row["user_id"];
                    $query_user = mysqli_query($conn,"SELECT * FROM `tbl_user` where user_id='{$user_id}'")or die(mysqli_error($conn));
                    $row_user= mysqli_fetch_array($query_user);
                    $temparray["user_name"] = $row_user["user_name"];
                    $temparray["user_mobileno"] = $row_user["user_mobileno"];
                    $temparray["user_email"] = $row_user["user_email"];
                    $user_image =$row_user["user_image"];
                    $temparray["user_image"] = $imageupload_path."user/".$user_image;
                    
                    $temparray["can_accept"] = $row["can_accept"];
                    if($status_id == "4")
                    {
                      
                    $query_feedback = mysqli_query($conn,"SELECT * FROM `tbl_feedback` where user_id='{$user_id}' and is_booking='0' and worker_id='{$worker_id}' and booking_id='{$row["request_id"]}'")or die(mysqli_error($conn));
                    $coount_feedback =mysqli_num_rows($query_feedback);
                    if($coount_feedback>0)
                    {
                    $row_feedback=mysqli_fetch_array($query_feedback);

                    $temparray["feedback_message"] =$row_feedback["feedback_message"];
                    $temparray["feedback_rating"] =$row_feedback["feedback_rating"];
                    $temparray["can_feedback"] ="1";
                    }
                    else{
                       $temparray["feedback_message"] ="";
                       $temparray["feedback_rating"] ="";
                       $temparray["can_feedback"] ="0";
                    }
                }

                    array_push($response["request"], $temparray);
                }
            }
            else{
                $response["flag"] = '0';
                $response["message"] = "No Record Found";
            }

        } else {
            $response["flag"] = "3";
            $response["message"] = "Page End";
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