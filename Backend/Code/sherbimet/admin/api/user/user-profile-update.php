<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    //required field condition check
    if ((isset($_POST["user_id"]))  && (isset($_POST["user_gender"])) && (isset($_POST["user_email"])) && (isset($_POST["user_first_name"])) && (isset($_POST["user_middle_name"])) && (isset($_POST["user_last_name"])) && (isset($_POST["user_address_line_1"])) && (isset($_POST["user_address_line_2"])) && (isset($_POST["city_id"])) && (isset($_POST["pincode_id"])) && (isset($_POST["language_id"]))  ) {

        //blank field condition check
        if ($_POST["user_id"] != '' && $_POST["user_gender"] != '' && $_POST["user_email"] != '' && $_POST["user_first_name"] != '' && $_POST["user_middle_name"] != '' && $_POST["user_last_name"] != '' && $_POST["user_address_line_1"] != '' && $_POST["user_address_line_2"] != '' && $_POST["city_id"] != '' && $_POST["pincode_id"] != '' && $_POST["language_id"] != '' ) {


            $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);

            $query = mysqli_query($conn, "SELECT * FROM `tbl_user` where user_id='{$user_id}'") or die(mysqli_error($conn));

            $count = mysqli_num_rows($query);

            if ($count > 0) {

                   $row_user = mysqli_fetch_array($query);

                $user_first_name = mysqli_real_escape_string($conn, $_POST['user_first_name']);
                $user_middle_name = mysqli_real_escape_string($conn, $_POST['user_middle_name']);
                $user_last_name = mysqli_real_escape_string($conn, $_POST['user_last_name']);
              
                $user_address_line_1 = mysqli_real_escape_string($conn, $_POST['user_address_line_1']);
                $user_address_line_2 = mysqli_real_escape_string($conn, $_POST['user_address_line_2']);
                $city_id = mysqli_real_escape_string($conn, $_POST['city_id']);
                $pincode_id = mysqli_real_escape_string($conn, $_POST['pincode_id']);
                $language_id = mysqli_real_escape_string($conn, $_POST['language_id']);

                $query_city = mysqli_query($conn,"SELECT * FROM `tbl_city` WHERE `city_id`='{$city_id}'")or die(mysqli_error($conn));
                $row_city = mysqli_fetch_array($query_city);
                           $city_name = $row_city["city_name"];
               
               $area_id = $row_user["area_id"];
                           $query_area = mysqli_query($conn,"SELECT * FROM `tbl_area` WHERE `area_id`='{$area_id}'")or die(mysqli_error($conn));
                $row_area = mysqli_fetch_array($query_area);
                           $area_name = $row_area["area_name"];
               
                           $query_pincode = mysqli_query($conn,"SELECT * FROM `tbl_pincode` WHERE `pincode_id`='{$pincode_id}'")or die(mysqli_error($conn));
                $row_pincode = mysqli_fetch_array($query_pincode);
                           $pincode = $row_pincode["pincode"];
               
                        $user_name = $user_first_name." ".$user_middle_name." ".$user_last_name;
                        $user_address = $user_address_line_1." ".$user_address_line_2." ".$city_name." ".$area_name." ".$pincode;


                
                $user_gender = mysqli_real_escape_string($conn, $_POST["user_gender"]);
                $user_email = mysqli_real_escape_string($conn, $_POST["user_email"]);
                // $user_address = mysqli_real_escape_string($conn, $_POST["user_address"]);
                // $area_id = mysqli_real_escape_string($conn, $_POST["area_id"]);

                $query_update = mysqli_query($conn, "UPDATE `tbl_user` SET `user_gender`='{$user_gender}',`user_email`='{$user_email}',`user_first_name`='{$user_first_name}',`user_middle_name`='{$user_middle_name}',`user_last_name`='{$user_last_name}',`user_address_line_1`='{$user_address_line_1}',`user_address_line_2`='{$user_address_line_2}',`city_id`='{$city_id}',`pincode_id`='{$pincode_id}',`language_id`='{$language_id}' WHERE `user_id`='{$user_id}'") or die(mysqli_query($conn));

                if ($query_update) {
                    $response["flag"] = '1';
                    $response["message"] = "Your Profile Updated Successfully ";
                } else {
                    $response["flag"] = '0';
                    $response["message"] = "Error In Query";
                }
            } else {
                $response["flag"] = '0';
                $response["message"] = "Your User Id not Found";
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
