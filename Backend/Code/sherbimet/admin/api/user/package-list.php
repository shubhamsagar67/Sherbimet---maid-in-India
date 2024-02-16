<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

      if(isset($_POST["subservice_id"]))
      {
        $s_subservice_id=$_POST["subservice_id"];
        if($s_subservice_id == "")
        {
            $search =  "";
        }
        else{
          $search = "and subservice_id='{$s_subservice_id}'";
        }
      }
      else{
        $search ="";
      }


      if(isset($_POST["package_id"]))
      {
        $s_package_id=$_POST["package_id"];
        if($s_package_id == "")
        {
            $search_2 =  "";
        }
        else{
          $search_2 = "and package_id='{$s_package_id}'";
        }
      }
      else{
        $search_2 ="";
      }

    $query = mysqli_query($conn, "SELECT * FROM `tbl_package` where is_search='1' $search $search_2  order by package_name asc") or die(mysqli_error($conn));



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

        $query_cat = mysqli_query($conn, "SELECT * FROM `tbl_package` where is_search='1' $search $search_2 order by package_name asc limit $offset, $rowsperpage")or die(mysqli_error($conn));

        $count = mysqli_num_rows($query_cat);
        if ($count > 0) {
            $response["flag"] = '1';
            $response["message"] = "$count Record Found";
            $response["package_list"] = array();
            $temparray = array();
            while ($row = mysqli_fetch_array($query_cat)) {

                $temparray["package_id"] = $row["package_id"];
                $temparray["package_name"] = $row["package_name"];
                    $temparray["package_price"] = $rupee_symbol.$row["package_price"];
                $temparray["package_details"] = $row["package_details"];
               
                $package_image =$row["package_image"];
                 $temparray["package_image"] = $imageupload_path."package/".$package_image;
                 
                 $temparray["subservice_id"] = $row["subservice_id"];
                 
                 $query_1 = mysqli_query($conn,"SELECT * FROM `tbl_subservice` where subservice_id='{$row["subservice_id"]}'")or die(mysqli_error($conn));
                  $row_1= mysqli_fetch_array($query_1);
                  $temparray["subservice_name"] = $row_1["subservice_name"];

                array_push($response["package_list"], $temparray);
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