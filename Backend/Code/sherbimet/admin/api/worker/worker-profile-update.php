<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    //required field condition check
    

if ((isset($_POST["worker_id"])) && (isset($_POST["worker_gender"])) && (isset($_POST["worker_email"])) && (isset($_POST["worker_first_name"])) && (isset($_POST["worker_middle_name"])) && (isset($_POST["worker_last_name"])) && (isset($_POST["worker_address_line_1"])) && (isset($_POST["worker_address_line_2"])) && (isset($_POST["worker_dob"])) && (isset($_POST["city_id"])) && (isset($_POST["pincode_id"])) && (isset($_POST["language_id"])) && (isset($_POST["aadharcard_no"])) && (isset($_POST["package_id"])) ) {
        //blank field condition check
        
        if ($_POST["worker_id"] != '' && $_POST["worker_gender"] != '' && $_POST["worker_email"] != '' && $_POST["worker_first_name"] != '' && $_POST["worker_middle_name"] != '' && $_POST["worker_last_name"] != '' && $_POST["worker_address_line_1"] != '' && $_POST["worker_address_line_2"] != '' && $_POST["worker_dob"] != '' && $_POST["city_id"] != '' && $_POST["pincode_id"] != '' && $_POST["language_id"] != '' && $_POST["aadharcard_no"] != ''  && $_POST["package_id"] != '') {


            $worker_id = mysqli_real_escape_string($conn, $_POST["worker_id"]);

            $query = mysqli_query($conn, "SELECT * FROM `tbl_worker` where worker_id='{$worker_id}'") or die(mysqli_error($conn));

            $count = mysqli_num_rows($query);

            if ($count > 0) {

                $worker_name = mysqli_real_escape_string($conn, $_POST["worker_name"]);
                $worker_gender = mysqli_real_escape_string($conn, $_POST["worker_gender"]);
                $worker_email = mysqli_real_escape_string($conn, $_POST["worker_email"]);
            

                $worker_first_name = mysqli_real_escape_string($conn, $_POST['worker_first_name']);
      $worker_middle_name = mysqli_real_escape_string($conn, $_POST['worker_middle_name']);
      $worker_last_name = mysqli_real_escape_string($conn, $_POST['worker_last_name']);
    
             $worker_name = $worker_first_name." ".$worker_middle_name." ".$worker_last_name;
             $worker_address_line_1 = mysqli_real_escape_string($conn, $_POST['worker_address_line_1']);
             $worker_address_line_2 = mysqli_real_escape_string($conn, $_POST['worker_address_line_2']);

             $package_id = mysqli_real_escape_string($conn, $_POST['package_id']);
             $city_id = mysqli_real_escape_string($conn, $_POST['city_id']);
           $pincode_id = mysqli_real_escape_string($conn, $_POST['pincode_id']);
           $language_id = mysqli_real_escape_string($conn, $_POST['language_id']);


             $query_city = mysqli_query($conn,"SELECT * FROM `tbl_city` WHERE `city_id`='{$city_id}'")or die(mysqli_error($conn));
           $row_city = mysqli_fetch_array($query_city);
                      $city_name = $row_city["city_name"];
    
                      $query_pincode = mysqli_query($conn,"SELECT * FROM `tbl_pincode` WHERE `pincode_id`='{$pincode_id}'")or die(mysqli_error($conn));
                      $row_pincode = mysqli_fetch_array($query_pincode);
                                 $pincode = $row_pincode["pincode"];
    
                                 $query_subcat = mysqli_query($conn,"SELECT * FROM `tbl_package` where package_id='{$package_id}'")or die(mysqli_error($conn));
                                 $row_subcat= mysqli_fetch_array($query_subcat);
                                  
    
                                  $query_cat = mysqli_query($conn,"select * from tbl_subservice where subservice_id='{$row_subcat["subservice_id"]}'")or die(mysqli_error($conn));
                                  $row_cat= mysqli_fetch_array($query_cat);

                                  $query_service = mysqli_query($conn,"SELECT * FROM `tbl_service` WHERE `service_id`='{$row_cat["service_id"]}'")or die(mysqli_error($conn));
                                  $row_service= mysqli_fetch_array($query_service);
                                  $area_id = $row_service['area_id'];
                                            
    
                                 $query_area = mysqli_query($conn,"SELECT * FROM `tbl_area` WHERE `area_id`='{$area_id}'")or die(mysqli_error($conn));
                                 $row_area = mysqli_fetch_array($query_area);
                                            $area_name = $row_area["area_name"];
    
                                            $worker_address = $worker_address_line_1." ".$worker_address_line_2." ".$city_name." ".$area_name." ".$pincode;
    
                                            $aadharcard_no = mysqli_real_escape_string($conn, $_POST['aadharcard_no']);
                                            $worker_dob_new = mysqli_real_escape_string($conn, $_POST['worker_dob']);

                                            $worker_dob = date("Y-m-d",strtotime($worker_dob_new));


                $query_update = mysqli_query($conn, "UPDATE `tbl_worker` SET `package_id`='{$package_id}',`worker_address`='{$worker_address}',`worker_name`='{$worker_name}',`worker_gender`='{$worker_gender}',`worker_email`='{$worker_email}',`worker_first_name`='{$worker_first_name}',`worker_middle_name`='{$worker_middle_name}',`worker_last_name`='{$worker_last_name}',`worker_address_line_1`='{$worker_address_line_1}',`worker_address_line_2`='{$worker_address_line_2}',`city_id`='{$city_id}',`pincode_id`='{$pincode_id}',`language_id`='{$language_id}',`aadharcard_no`='{$aadharcard_no}',`worker_dob`='{$worker_dob}' WHERE `worker_id`='{$worker_id}'") or die(mysqli_query($conn));

                if ($query_update) {
                    $response["flag"] = '1';
                    $response["message"] = "Your Profile Updated Successfully ";
                } else {
                    $response["flag"] = '0';
                    $response["message"] = "Error In Query";
                }
            } else {
                $response["flag"] = '0';
                $response["message"] = "Your Worker Id not Found";
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
