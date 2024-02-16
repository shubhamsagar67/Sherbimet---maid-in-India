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


            $query = mysqli_query($conn, "SELECT * FROM `tbl_worker` where worker_id='{$worker_id}'") or die(mysqli_error($conn));
            $count = mysqli_num_rows($query);
            
            if($count>0){
                
                  $response["flag"] = '1';

                    $response["message"] = "1 Record Found";
                
                $row = mysqli_fetch_array($query);
                
                
                $year= $row["worker_experience"];

               if($year>1)
               {
                $years =  "Years";
               }
               else{
                $years = "Year";   
               }
               $query_rating = mysqli_query($conn,"SELECT avg(`feedback_rating`) as worker_average_rating FROM `tbl_feedback` WHERE `worker_id`='{$row["worker_id"]}'") or die(mysqli_error($conn));
               $row_rate = mysqli_fetch_array($query_rating);
               
               $worker_average_rating = $row_rate["worker_average_rating"];
               
               if($worker_average_rating == "")
               {
                   $worker_average_rating = "0";
               }
                
                
                $response["worker_id"] = $row["worker_id"];
                 $response["user_type_id"] = $row["user_type_id"];
                 $response["worker_name"] = $row["worker_name"];
                 $response["worker_gender"] = $row["worker_gender"];
                 $response["worker_email"] = $row["worker_email"];
                 $response["worker_mobile"] = $row["worker_mobile"];
                 $response["worker_experience"] = $row["worker_experience"]." ".$years;
                      $worker_image =$row["worker_image"];
                   $response["worker_image"] = $imageupload_path."worker/".$worker_image;
                 $response["worker_price"] = "₹ ".$row["worker_price"];
                 $response["package_id"] = $row["package_id"];
              
                 
                 $query_subcat = mysqli_query($conn,"SELECT * FROM `tbl_package` where package_id='{$row["package_id"]}'")or die(mysqli_error($conn));
                  $row_subcat= mysqli_fetch_array($query_subcat);
                   $response["package_name"] = $row_subcat["package_name"];
                 
                $response["worker_average_rating"] = $worker_average_rating;
                

                $response["worker_first_name"] = $row["worker_first_name"];
                $response["worker_middle_name"] = $row["worker_middle_name"];
                $response["worker_last_name"] = $row["worker_last_name"];
                $response["worker_address_line_1"] = $row["worker_address_line_1"];
                $response["worker_address_line_2"] = $row["worker_address_line_2"];
                
                $response["aadharcard_no"] = $row["aadharcard_no"];
                $response["worker_dob"] = date("d-m-Y",strtotime($row["worker_dob"]));
                


                $query_city = mysqli_query($conn,"SELECT * FROM `tbl_city` where city_id='{$row["city_id"]}'")or die(mysqli_error($conn));
                $row_city= mysqli_fetch_array($query_city);
                $response["city_id"] = $row["city_id"];
                $response["city_name"] = $row_city["city_name"];

          


                $query_pincode = mysqli_query($conn,"SELECT * FROM `tbl_pincode` where pincode_id='{$row["pincode_id"]}'")or die(mysqli_error($conn));
                $row_pincode= mysqli_fetch_array($query_pincode);
                $response["pincode_id"] = $row["pincode_id"];
                $response["pincode"] = $row_pincode["pincode"];

                $query_language = mysqli_query($conn,"SELECT * FROM `tbl_language` where language_id='{$row["language_id"]}'")or die(mysqli_error($conn));
                $row_language= mysqli_fetch_array($query_language);
                $response["language_id"] = $row["language_id"];
                $response["language_name"] = $row_language["language_name"];

                $query_cat = mysqli_query($conn,"select * from tbl_subservice where subservice_id='{$row_subcat["subservice_id"]}'")or die(mysqli_error($conn));
                $row_cat= mysqli_fetch_array($query_cat);
                
                $response["subservice_name"] = $row_cat['subservice_name'];
                $response["service_id"] = $row_cat['service_id'];
                
                $query_service = mysqli_query($conn,"SELECT * FROM `tbl_service` WHERE `service_id`='{$row_cat["service_id"]}'")or die(mysqli_error($conn));
                $row_service= mysqli_fetch_array($query_service);
                $area_id = $row_service['area_id'];
                
                $query_area = mysqli_query($conn,"SELECT * FROM `tbl_area` WHERE `area_id`='{$area_id}'")or die(mysqli_error($conn));
                             $row_area = mysqli_fetch_array($query_area);
                            
                             $response["area_id"] = $area_id;
                             $response["area_name"] = $row_area["area_name"]; 

                
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