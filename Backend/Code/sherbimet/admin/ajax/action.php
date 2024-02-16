<?php
include '../class/at-class.php';


if(isset($_POST["action"]))
{

     if($_POST["action"] == 'delete')
	{
    
 $id = mysqli_real_escape_string($conn, $_POST['id']);
 $tbl_name = mysqli_real_escape_string($conn, $_POST['tbl_name']);
 $field_name = mysqli_real_escape_string($conn, $_POST['field_name']);
 
 
 
// $deleteq = mysqli_query($conn, "DELETE FROM $tbl_name WHERE  $field_name='{$id}'")or die(mysqli_error($conn));
 
 $deleteq = mysqli_query($conn, "UPDATE $tbl_name SET is_delete='1' WHERE  $field_name='{$id}'")or die(mysqli_error($conn));
 
        }
}