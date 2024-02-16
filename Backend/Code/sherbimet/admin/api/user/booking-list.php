
<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

//required field condition check
    if (isset($_POST["user_id"]) ) {

        //blank field condition check
        if ($_POST["user_id"] != '' ) {


            $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
            $is_booking = mysqli_real_escape_string($conn, $_POST["is_booking"]);
            
           
                $table = "tbl_request";
           $primary_key = "request_id";

            
            
            if(isset($_POST["status_id"]))
            {
                $status_id = mysqli_real_escape_string($conn, $_POST["status_id"]);
                $search_status = "and status_id='{$status_id}'";
            }
            else{
                $search_status = "";
            }
            
            
    $query = mysqli_query($conn, "SELECT * FROM $table where is_active='1' and is_delete='0' and user_id='{$user_id}' $search_status order by $primary_key desc") or die(mysqli_error($conn));

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

        
        $query_booking = mysqli_query($conn, "SELECT * FROM $table where is_active='1' and is_delete='0' and user_id='{$user_id}' $search_status order by $primary_key desc limit $offset, $rowsperpage")or die(mysqli_error($conn));

        $count = mysqli_num_rows($query_booking);
        if ($count > 0) {
            $response["flag"] = '1';
            $response["message"] = "$count Record Found";
            $query_user = mysqli_query($conn,"SELECT * FROM `tbl_user` where user_id='{$user_id}'")or die(mysqli_error($conn));
            $row_user =mysqli_fetch_array($query_user);
            $response["user_name"] = $row_user["user_name"];
            
                           $user_image =$row_user["user_image"];
                  $user_image_new = $imageupload_path."user/".$user_image;
            $response["user_image"] = $user_image_new;
            $response["booking"] = array();
            $temparray = array();
            while ($row = mysqli_fetch_array($query_booking)) {

               
                
                if($is_booking == "1")
                 {
                    $temparray["booking_id"] = $row["booking_id"];
                        $booking_id=$row["booking_id"];
                 }
                 else{
                     $booking_id=$row["request_id"];
                    $temparray["booking_id"] = $row["request_id"];
                    $temparray["area_id"] = $row["area_id"];
                    $temparray["can_accept"] = $row["can_accept"];
                 }
                    $booking_date = date('d M, Y',strtotime($row["booking_date"]));
                  $booking_time = date('G:i a',strtotime($row["booking_time"]));
                 $temparray["booking_date"] = date("d-m-Y",strtotime($row["booking_date"]));
                 $temparray["booking_time"] = date("G:i a",strtotime($row["booking_time"]));
                  $temparray["booking_date_time"] =$booking_date." ".$booking_time;
                 $temparray["user_id"] = $row["user_id"];
                //  $temparray["subcategory_id"] = $row["subcategory_id"];
                 
                 $temparray["status_id"] = $row["status_id"];
                 
                 
                     $temparray["booking_address"] = $row["booking_address"];
                         $temparray["booking_message"] = $row["booking_message"];
                         $temparray["payment_method"] = $row["payment_method"];
                             
//             

//               
                         
                         $query_status = mysqli_query($conn,"SELECT * FROM `tbl_status` where status_id='{$row["status_id"]}'")or die(mysqli_error($conn));
                  $row_status= mysqli_fetch_array($query_status);   
                   $temparray["status_name"] = $row_status["status_name"];
                         
                   $query_subcat = mysqli_query($conn,"SELECT * FROM `tbl_package` where package_id='{$row["package_id"]}'")or die(mysqli_error($conn));
                  $row_subcat= mysqli_fetch_array($query_subcat);
                   $temparray["package_id"] = $row_subcat["package_id"];
                    $temparray["package_name"] = $row_subcat["package_name"];
                     $temparray["package_price"] = $row_subcat["package_price"];
                      $temparray["package_details"] = $row_subcat["package_details"];
                       $temparray["package_image"] = $imageupload_path."subcategory/".$row_subcat["package_image"];
                 
//                 
//                 $query_cat = mysqli_query($conn,"SELECT * FROM `tbl_category` where category_id='{$row_subcat["category_id"]}'")or die(mysqli_error($conn));
//                  $row_cat= mysqli_fetch_array($query_cat);
//                  $temparray["category_name"] = $row_cat["category_name"];
//                  
//                  
                  $query_area = mysqli_query($conn,"SELECT * FROM `tbl_area` where area_id='{$row["area_id"]}'")or die(mysqli_error($conn));
                  $row_area= mysqli_fetch_array($query_area);
                  $temparray["area_name"] = $row_area["area_name"];
//                  $temparray["worker_average_rating"] = $worker_average_rating;
                  
                  if($row["worker_id"] !='0')
                  {
                                   $query_worker = mysqli_query($conn,"SELECT * FROM `tbl_worker` where worker_id='{$row["worker_id"]}'")or die(mysqli_error($conn));
                  $row_worker= mysqli_fetch_array($query_worker);
                  $temparray["worker_id"] = $row_worker["worker_id"];
                  $temparray["worker_name"] = $row_worker["worker_name"];
                  $temparray["worker_gender"] = $row_worker["worker_gender"];
                  $temparray["worker_mobile"] = $row_worker["worker_mobile"];
                  $temparray["worker_email"] = $row_worker["worker_email"];
                  $temparray["worker_price"] = "₹ ".$row_worker["worker_price"];

                  $temparray["booking_totalamount"] = "₹ ".$row["booking_totalamount"];
                                    $worker_image =$row_worker["worker_image"];
                  $temparray["worker_image"] = $imageupload_path."worker/".$worker_image;
                  
                  }
                         $status_id = $row["status_id"];
                  if($status_id == "1")
                  {
                    $temparray["can_cancel"] = "1";

                  }
                  else{
                    $temparray["can_cancel"] = "0";

                  }
                  
                  if($status_id == "5")
                  {
                   $temparray["cancel_reason"] = $row["cancel_reason"];
                   
                     }

                     if($status_id == "4")
                     {
                         if($is_booking =="1")
                         {
                             $query_feedback = mysqli_query($conn,"SELECT * FROM `tbl_feedback` where user_id='{$user_id}' and is_booking='1' and worker_id='{$row["worker_id"]}' and booking_id='{$booking_id}'")or die(mysqli_error($conn));
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
                         else{
                            $query_feedback = mysqli_query($conn,"SELECT * FROM `tbl_feedback` where user_id='{$user_id}' and is_booking='0' and worker_id='{$row["worker_id"]}' and booking_id='{$booking_id}'")or die(mysqli_error($conn));
                            
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

                     }
      

                array_push($response["booking"], $temparray);
            }
        } else {
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
