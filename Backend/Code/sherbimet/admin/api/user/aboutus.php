<?php
require '../../class/at-class.php';
$response = array();


$query = mysqli_query($conn, "SELECT * FROM `tbl_aboutus` where aboutus_id='1'") or die(mysqli_error($conn));
$row = mysqli_fetch_array($query);
$response["flag"] = '1';

$response["message"] = "1 Record Found";

$response["description"] = $row["description"];
$image= $row["image"];
$response["image"] = $imageupload_path."aboutus/".$image;
$response["about_footer"] = "© ".$row["about_footer"];

echo json_encode($response);