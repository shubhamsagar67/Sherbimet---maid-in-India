<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    //required field condition check
    if (isset($_POST["user_id"])) {      
        
//blank field condition check

        if ($_POST["user_id"] != '') { 
            
                $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);


            $query = mysqli_query($conn, "SELECT * FROM `tbl_user` where user_id='{$user_id}'") or die(mysqli_error($conn));
            $count = mysqli_num_rows($query);
            
            if($count>0){
                
                  $response["flag"] = '1';

                    $response["message"] = "1 Record Found";
                
                $row = mysqli_fetch_array($query);
                

                $user_first_name = $row['user_first_name'];
                $user_middle_name = $row['user_middle_name'];
                $user_last_name = $row['user_last_name'];
                $user_name = $user_first_name." ".$user_middle_name." ".$user_last_name;

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
                 

                
                $response["user_id"] = $row["user_id"];
                $response["user_first_name"] = $user_first_name;
                 $response["user_middle_name"] = $user_middle_name;
                 $response["user_last_name"] = $user_last_name;
                 $response["user_name"] = $user_name;
                 $response["user_gender"] = $row["user_gender"];
                 $response["user_email"] = $row["user_email"];
                 $response["user_mobileno"] = $row["user_mobileno"];
               
           
                 $response["user_address"] = $row["user_address"];
                 $response["user_address_line_1"] = $row["user_address_line_1"];
                 $response["user_address_line_2"] = $row["user_address_line_2"];
                 $query_city = mysqli_query($conn,"SELECT * FROM `tbl_city` where city_id='{$row["city_id"]}'")or die(mysqli_error($conn));
                 $row_city= mysqli_fetch_array($query_city);
                 $response["city_id"] = $row["city_id"];
                 $response["city_name"] = $row_city["city_name"];

                 $query_area = mysqli_query($conn,"SELECT * FROM `tbl_area` where area_id='{$row["area_id"]}'")or die(mysqli_error($conn));
                  $row_area= mysqli_fetch_array($query_area);
                  $response["area_id"] = $row["area_id"];
                  $response["area_name"] = $row_area["area_name"];


                 $query_pincode = mysqli_query($conn,"SELECT * FROM `tbl_pincode` where pincode_id='{$row["pincode_id"]}'")or die(mysqli_error($conn));
                 $row_pincode= mysqli_fetch_array($query_pincode);
                 $response["pincode_id"] = $row["pincode_id"];
                 $response["pincode"] = $row_pincode["pincode"];

                 $query_language = mysqli_query($conn,"SELECT * FROM `tbl_language` where language_id='{$row["language_id"]}'")or die(mysqli_error($conn));
                 $row_language= mysqli_fetch_array($query_language);
                 $response["language_id"] = $row["language_id"];
                 $response["language_name"] = $row_language["language_name"];
                 $response["user_lat"] = $latitude;
                 $response["user_long"] = $longitude;


                      $user_image =$row["user_image"];
                   $response["user_image"] = $imageupload_path."user/".$user_image;
                  
                  
                  
                
                
                
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