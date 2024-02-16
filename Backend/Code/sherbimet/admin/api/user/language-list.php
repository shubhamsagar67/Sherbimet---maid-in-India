<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    if(isset($_POST["language_name"]))
    {
        $language_name = mysqli_real_escape_string($conn, $_POST["language_name"]);
        if($language_name == "")
        {
            $search = "";    
        }
        else{
        $search = "and language_name LIKE '%{$language_name}%'";
        }
    }
    else{
        $search = "";
    }



    $query = mysqli_query($conn, "SELECT * FROM `tbl_language` where is_active='1' and is_delete='0' $search order by language_name asc") or die(mysqli_error($conn));
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

        $query_language = mysqli_query($conn, "SELECT * FROM `tbl_language` where is_active='1' and is_delete='0' $search order by language_name asc limit $offset, $rowsperpage")or die(mysqli_error($conn));

        $count = mysqli_num_rows($query_language);
        if ($count > 0) {
            $response["flag"] = '1';
            $response["message"] = "$count Record Found";
            $response["language"] = array();
            $temparray = array();
            while ($row = mysqli_fetch_array($query_language)) {

                $temparray["language_id"] = $row["language_id"];
                $temparray["language_name"] = $row["language_name"];

                  $title = $row["language_name"];
                $language_name_initials = ucfirst(mb_substr($title, 0, 1));
               
                if($language_name_initials == '.')
               {
                   $language_name_initials = ucfirst(mb_substr($title, 1, 1));
               }
                
                
             //  $response["user_name_type_initials"] = $language_name_initials;
  $temparray["language_name_initials"] = $language_name_initials;
                

                array_push($response["language"], $temparray);
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