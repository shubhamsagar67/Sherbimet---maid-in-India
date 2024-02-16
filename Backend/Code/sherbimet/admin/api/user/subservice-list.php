<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

      if(isset($_POST["service_id"]))
      {
        $s_service_id=$_POST["service_id"];
        if($s_service_id == "")
        {
            $search =  "";
        }
        else{
          $search = "and service_id='{$s_service_id}'";
        }
      }
      else{
        $search ="";
      }


    $query = mysqli_query($conn, "SELECT * FROM `tbl_subservice` where is_search='1' $search  order by subservice_name asc") or die(mysqli_error($conn));



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

        $query_cat = mysqli_query($conn, "SELECT * FROM `tbl_subservice` where is_search='1' $search order by subservice_name asc limit $offset, $rowsperpage")or die(mysqli_error($conn));

        $count = mysqli_num_rows($query_cat);
        if ($count > 0) {
            $response["flag"] = '1';
            $response["message"] = "$count Record Found";
            $response["subservice_list"] = array();
            $temparray = array();
            while ($row = mysqli_fetch_array($query_cat)) {

                $temparray["subservice_id"] = $row["subservice_id"];
                $temparray["subservice_name"] = $row["subservice_name"];
               
                $subservice_image =$row["subservice_image"];
                 $temparray["subservice_image"] = $imageupload_path."service/".$subservice_image;
                 
                 $temparray["service_id"] = $row["service_id"];
                 
                 $query_1 = mysqli_query($conn,"SELECT * FROM `tbl_service` where service_id='{$row["service_id"]}'")or die(mysqli_error($conn));
                  $row_1= mysqli_fetch_array($query_1);
                  $temparray["service_name"] = $row_1["service_name"];

                array_push($response["subservice_list"], $temparray);
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

//if authentication failed then this condition true
else {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    $response['flag'] = '0';
    $response['message'] = 'Sorry You Are not Allow to access';
}
echo json_encode($response);
?>