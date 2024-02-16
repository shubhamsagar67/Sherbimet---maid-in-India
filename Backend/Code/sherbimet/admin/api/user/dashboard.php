<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

 

     
             if(isset($_POST["user_id"]))
             {
                $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
                $query = mysqli_query($conn, "SELECT * FROM `tbl_user` where user_id='{$user_id}'") or die(mysqli_error($conn));
                $row_user = mysqli_fetch_array($query);
                
                //          $area_id=$row_user["area_id"];

                // $search = "and area_id='{$area_id}'";
                
                 if (isset($_POST["area_id"])) {
                    $area_id = mysqli_real_escape_string($conn, $_POST["area_id"]);
                    
                    if($area_id == "")
                    {
                        $query_1 = mysqli_query($conn,"SELECT * FROM `tbl_area` order by  `area_id` asc limit 1")or die(mysqli_error($conn));
                        $row_1 = mysqli_fetch_array($query_1);

                        $area_id=$row_1["area_id"];
                        $search  = "and area_id='{$area_id}'";
                    }
                    else{
                    $search = "and area_id='{$area_id}'";
                    }
                    
                } else {
                    $query_1 = mysqli_query($conn,"SELECT * FROM `tbl_area` order by  `area_id` asc limit 1")or die(mysqli_error($conn));
                        $row_1 = mysqli_fetch_array($query_1);

                        $area_id=$row_1["area_id"];
                        $search  = "and area_id='{$area_id}'";
                    
                    
                }


                $user_name = $row_user["user_name"];
                     $user_image_1 = $row_user["user_image"];
                       if($user_image_1 =="")
                       {
                     $user_image = "noimage.png";      
                       }
                       else{
                           $user_image = $user_image_1;      
                       }
             }
             else{

                $user_name = "Guest";
                $user_image = "noimage.png";      
                if (isset($_POST["area_id"])) {
                    $area_id = mysqli_real_escape_string($conn, $_POST["area_id"]);
                    
                    if($area_id == "")
                    {
                        $query_1 = mysqli_query($conn,"SELECT * FROM `tbl_area` order by  `area_id` asc limit 1")or die(mysqli_error($conn));
                        $row_1 = mysqli_fetch_array($query_1);

                        $area_id=$row_1["area_id"];
                        $search  = "and area_id='{$area_id}'";
                    }
                    else{
                    $search = "and area_id='{$area_id}'";
                    }
                    
                } else {
                    $query_1 = mysqli_query($conn,"SELECT * FROM `tbl_area` order by  `area_id` asc limit 1")or die(mysqli_error($conn));
                        $row_1 = mysqli_fetch_array($query_1);

                        $area_id=$row_1["area_id"];
                        $search  = "and area_id='{$area_id}'";
                    
                    
                }

             }

            


            

                

                // $query_service = mysqli_query($conn, "SELECT * FROM `tbl_service` where is_search='1' $search")or die(mysqli_error($conn));
                 $query_service = mysqli_query($conn, "SELECT * FROM `tbl_service` where is_search='1'")or die(mysqli_error($conn));
                $count_service = mysqli_num_rows($query_service);

                if ($count_service > 0) {



                    
                     
                    $response["flag"] = '1';

                    $response["message"] = "$count_service Record Found";



                    // 24-hour format of an hour without leading zeros (0 through 23)
                    $Hour = date('G');

                    if ($Hour >= 5 && $Hour <= 11) {
                        $greeting = "Good Morning";
                    } else if ($Hour >= 12 && $Hour <= 18) {
                        $greeting = "Good Afternoon";
                    } else if ($Hour >= 19 || $Hour <= 4) {
                        $greeting = "Good Evening";
                    }

                    $response["user_name"] = $user_name;
                    
                    
                
                     $response["user_image"] =$imageupload_path."user/".$user_image;
                    $response["greeting"] = "Hello, " . $greeting;

                    
                    $query_area = mysqli_query($conn, "SELECT * FROM `tbl_area` where area_id='{$area_id}'")or die(mysqli_error($conn));
                    $row_area = mysqli_fetch_array($query_area);
                    $response["area_id"] = $row_area["area_id"];
                    $response["area_name"] = $row_area["area_name"];

                    $response["service_list"] = array();
                    $temparray = array();
                    $temparray1 = array();
                    while ($row = mysqli_fetch_array($query_service)) {
                        $temparray["service_id"] = $row["service_id"];
                        $temparray["service_name"] = $row["service_name"];
                        
                          $service_image =$row["service_image"];
                 $temparray["service_image"] = $imageupload_path."service/".$service_image;
                       

//                        $query_subcat = mysqli_query($conn, "SELECT * FROM `tbl_subcategory` where service_id='{$row["service_id"]}'")or die(mysqli_error($conn));
//
//                        while ($row_subcat = mysqli_fetch_array($query_subcat)) {
//
//
//                            $temparray1["subservice_id"] = $row_subcat["subservice_id"];
//                            $temparray1["subservice_name"] = $row_subcat["subservice_name"];
//                            $temparray1["subservice_image"] = $row_subcat["subservice_image"];
//
//                            $temparray2[] = $temparray1;
//                        }



                       // $temparray["subcategory"] = $temparray2;

                        array_push($response["service_list"], $temparray);
                    }
                } else {
                   
                    $response["flag"] = '0';
                    $query_area = mysqli_query($conn, "SELECT * FROM `tbl_area` where area_id='{$area_id}'")or die(mysqli_error($conn));
                    $row_area = mysqli_fetch_array($query_area);
                    $response["area_id"] = $row_area["area_id"];
                    $response["area_name"] = $row_area["area_name"];
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