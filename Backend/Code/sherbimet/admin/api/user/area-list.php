<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

        $query_area = mysqli_query($conn, "SELECT * FROM `tbl_area` where is_active='1' and is_delete='0' order by area_name asc")or die(mysqli_error($conn));

        $count = mysqli_num_rows($query_area);
        if ($count > 0) {
            $response["flag"] = '1';
            $response["message"] = "$count Record Found";
            $response["area"] = array();
            $temparray = array();
            while ($row = mysqli_fetch_array($query_area)) {

                $temparray["area_id"] = $row["area_id"];
                $temparray["area_name"] = $row["area_name"];

                  $title = $row["area_name"];
                $area_name_initials = ucfirst(mb_substr($title, 0, 1));
               
                if($area_name_initials == '.')
               {
                   $area_name_initials = ucfirst(mb_substr($title, 1, 1));
               }
                
                
             //  $response["user_name_type_initials"] = $area_name_initials;
  $temparray["area_name_initials"] = $area_name_initials;
                

                array_push($response["area"], $temparray);
            }
        } else {
            $response["flag"] = '0';
            $response["message"] = "No Record Found";
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