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

            if ($count > 0) {
                $row_worker = mysqli_fetch_array($query);

                if (isset($_POST["area_id"])) {
                    $area_id = mysqli_real_escape_string($conn, $_POST["area_id"]);
                    
                    if($area_id == "")
                    {
                        $area_id = $row_worker["area_id"];
                    }
                    else{
                    $area_id = $area_id;    
                    }
                    
                } else {
                    $area_id = $row_worker["area_id"];
                }

                // $query_cat = mysqli_query($conn, "SELECT * FROM `tbl_category` where is_delete='0' and  area_id='{$area_id}'")or die(mysqli_error($conn));
                // $count_cat = mysqli_num_rows($query_cat);

                // if ($count_cat > 0) {



                    $worker_name = $row_worker["worker_name"];
                     $worker_image_1 = $row_worker["worker_image"];
                       if($worker_image_1 =="")
                       {
                     $worker_image = "noimage.png";      
                       }
                       else{
                           $worker_image = $worker_image_1;      
                       }
                     
                    $response["flag"] = '1';

                    $response["message"] = "$count_cat Record Found";



                    // 24-hour format of an hour without leading zeros (0 through 23)
                    $Hour = date('G');

                    if ($Hour >= 5 && $Hour <= 11) {
                        $greeting = "Good Morning";
                    } else if ($Hour >= 12 && $Hour <= 18) {
                        $greeting = "Good Afternoon";
                    } else if ($Hour >= 19 || $Hour <= 4) {
                        $greeting = "Good Evening";
                    }

                    $response["worker_name"] = $worker_name;
                    
                    
                   $temparray["worker_image"] = 
                     $response["worker_image"] =$imageupload_path."worker/".$worker_image;
                    $response["greeting"] = "Hello, " . $greeting;

                    
                    $query_subcat = mysqli_query($conn,"SELECT * FROM `tbl_package` where package_id='{$row_worker["package_id"]}'")or die(mysqli_error($conn));
                    $row_subcat= mysqli_fetch_array($query_subcat);
                     $temparray["package_name"] = $row_subcat["package_name"];
                   
                   $query_cat = mysqli_query($conn,"SELECT * FROM `tbl_subservice` where subservice_id='{$row_subcat["subservice_id"]}'")or die(mysqli_error($conn));
                    $row_cat= mysqli_fetch_array($query_cat);
                    $temparray["subservice_name"] = $row_cat["subservice_name"];
                    
                    $query_service = mysqli_query($conn,"SELECT * FROM `tbl_service` WHERE `service_id`='{$row_cat["service_id"]}'")or die(mysqli_error($conn));
                    $row_service= mysqli_fetch_array($query_service);
                    
                    $query_area = mysqli_query($conn,"SELECT * FROM `tbl_area` where area_id='{$row_service["area_id"]}'")or die(mysqli_error($conn));
                    $row_area= mysqli_fetch_array($query_area);
                    $response["area_id"] = $row_area["area_id"];
                    
                    $response["area_name"] = $row_area["area_name"];


                    // $query_area = mysqli_query($conn, "SELECT * FROM `tbl_area` where area_id='{$area_id}'")or die(mysqli_error($conn));
                    // $row_area = mysqli_fetch_array($query_area);
                    // $response["area_id"] = $row_area["area_id"];
                    // $response["area_name"] = $row_area["area_name"];

                // } else {
                   
                //     $response["flag"] = '0';
                //     $response["message"] = "No Record Found";
                // }
            } else {
                $response["flag"] = '0';
                $response["message"] = "Your Data Not Matched With System";
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