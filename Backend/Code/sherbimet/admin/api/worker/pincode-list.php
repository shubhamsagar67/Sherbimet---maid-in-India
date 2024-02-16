<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {


    if(isset($_POST["pincode"]))
    {
        $pincode = mysqli_real_escape_string($conn, $_POST["pincode"]);
        if($pincode == "")
        {
            $search = "";    
        }
        else{
        $search = "and pincode LIKE '%{$pincode}%'";
        }
    }
    else{
        $search = "";
    }

    $query = mysqli_query($conn, "SELECT * FROM `tbl_pincode` where is_active='1' and is_delete='0' $search order by pincode asc") or die(mysqli_error($conn));
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

        $query_pincode = mysqli_query($conn, "SELECT * FROM `tbl_pincode` where is_active='1' and is_delete='0' $search order by pincode asc limit $offset, $rowsperpage")or die(mysqli_error($conn));

        $count = mysqli_num_rows($query_pincode);
        if ($count > 0) {
            $response["flag"] = '1';
            $response["message"] = "$count Record Found";
            $response["pincode"] = array();
            $temparray = array();
            while ($row = mysqli_fetch_array($query_pincode)) {

                $temparray["pincode_id"] = $row["pincode_id"];
                $temparray["pincode"] = $row["pincode"];

                  $title = $row["pincode"];
            //     $pincode_initials = ucfirst(mb_substr($title, 0, 1));
               
            //     if($pincode_initials == '.')
            //    {
            //        $pincode_initials = ucfirst(mb_substr($title, 1, 1));
            //    }
                
                
             //  $response["user_name_type_initials"] = $pincode_initials;
//   $temparray["pincode_initials"] = $pincode_initials;
                

                array_push($response["pincode"], $temparray);
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