<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    //required field condition check
    if ((isset($_POST["worker_mobile"]))) {


        //blank field condition check
        if ($_POST["worker_mobile"] != '') {

            if (isset($_POST["device_token"])) {

                $device_token = mysqli_real_escape_string($conn, $_POST["device_token"]);

                $device = ",`device_token`='{$device_token}'";
            } else {
                $device = "";
            }


            $worker_mobile = mysqli_real_escape_string($conn, $_POST["worker_mobile"]);

            $query = mysqli_query($conn, "SELECT * FROM `tbl_worker` where worker_mobile='{$worker_mobile}'") or die(mysqli_error($conn));

            $count = mysqli_num_rows($query);

            if ($count > 0) {

                $otp = rand(100000, 999999);

                $query_update = mysqli_query($conn, "UPDATE `tbl_worker` SET `mobile_otp`='{$otp}' $device WHERE `worker_mobile`='{$worker_mobile}'") or die(mysqli_query($conn));

                if ($query_update) {
                    $response["flag"] = '1';
                      $response["worker_mobile"] = $worker_mobile;
                    $response["message"] = "Your OTP Send Successfully ";
                      $response["otp"] = "{$otp}";
                } else {
                    $response["flag"] = '0';
                    $response["message"] = "Error In Query";
                }
            } else {
                $response["flag"] = '0';
                $response["message"] = "Mobile No Not Matched With System";
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

