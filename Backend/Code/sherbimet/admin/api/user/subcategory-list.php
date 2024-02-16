<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    if (isset($_POST["category_id"])) {
        
        //blank field condition check
        if ($_POST["category_id"] != '') {
            
            $category_id = mysqli_real_escape_string($conn, $_POST["category_id"]);
        
        
    

    $query = mysqli_query($conn, "SELECT * FROM `tbl_subcategory` where is_active='1' and is_delete='0' and category_id='{$category_id}' order by subcategory_name asc") or die(mysqli_error($conn));



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

        $query_subcat = mysqli_query($conn, "SELECT * FROM `tbl_subcategory` where is_active='1' and is_delete='0' and category_id='{$category_id}' order by subcategory_name asc limit $offset, $rowsperpage")or die(mysqli_error($conn));

        $count = mysqli_num_rows($query_subcat);
        if ($count > 0) {
            $response["flag"] = '1';
            $response["message"] = "$count Record Found";
            $response["subcategory"] = array();
            $temparray = array();
            while ($row = mysqli_fetch_array($query_subcat)) {

                $temparray["subcategory_id"] = $row["subcategory_id"];
                $temparray["subcategory_name"] = $row["subcategory_name"];
               
                 
                  $subcategory_image =$row["subcategory_image"];
                   $temparray["subcategory_image"] = $imageupload_path."subcategory/".$subcategory_image;
                 
                 $temparray["category_id"] = $row["category_id"];
                 
                 $query_cat = mysqli_query($conn,"SELECT * FROM `tbl_category` where category_id='{$row["category_id"]}'")or die(mysqli_error($conn));
                  $row_cat= mysqli_fetch_array($query_cat);
                  $temparray["category_name"] = $row_cat["category_name"];

                array_push($response["subcategory"], $temparray);
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