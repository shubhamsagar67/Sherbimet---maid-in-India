<?php

 if(isset($_SESSION["adminemail"]))
{

   $email = $_SESSION["adminemail"];
     
   
      $selectadminq = mysqli_query($conn, "select * from tbl_admin where admin_email='{$email}'") or die(mysqli_error($conn));
$admin_login_details = mysqli_fetch_array($selectadminq);
   
                    $admin_id  =    $admin_login_details["admin_id"];
                    $admin_name  =    $admin_login_details["admin_name"];
                    $admin_email  =    $admin_login_details["admin_email"];
                    $admin_mobile  =    $admin_login_details["admin_mobile"];
                    $admin_profile  =    $admin_login_details["admin_profile"];
                    $admin_password  =    $admin_login_details["admin_password"];
                  
     
}
else{
    header("location:index.php");
}
?>
