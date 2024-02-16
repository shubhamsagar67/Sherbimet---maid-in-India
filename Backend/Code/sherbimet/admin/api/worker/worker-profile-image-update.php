<?php
require '../../class/at-class.php';
$response = array();
//authentication check token name and token value
// if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    //required field condition check
    if ((isset($_POST["worker_id"])) && (isset($_FILES["worker_image"]["name"]))) {
                //blank field condition check
                if ($_POST["worker_id"] != '' && $_FILES["worker_image"]["name"] != '' ) {   


                    $cphoto = $_FILES['worker_image']['name'];
                    $path = '../../images/worker/';
                    $time = time();
                    $destination = $path.$time.basename($cphoto);
                    
                 
                     //product image name
                     $cimg = $time.basename($cphoto);


                     if($cust_photo!=='')
                     {
                      if(file_exists('../../images/worker/'.$cust_photo))
                              
                                                      {
                          if($cust_photo == "noimage.png")
                          {
                              
                          }else{
                          
                                                          unlink('../../images/worker/'.$cust_photo);
                          }
                                                      }
                     }                               
                                                 $cimg =$cimg;
                     
                       move_uploaded_file($_FILES['worker_image']['tmp_name'], $destination);

                    $worker_id = mysqli_real_escape_string($conn, $_POST["worker_id"]);


                $query_update = mysqli_query($conn, "UPDATE `tbl_worker` SET `worker_image`='{$cimg}' WHERE `worker_id`='{$worker_id}'") or die(mysqli_query($conn));

                if ($query_update) {
                    $response["flag"] = '1';
                    $response["message"] = "Your Profile Updated Successfully ";
                } else {
                    $response["flag"] = '0';
                    $response["message"] = "Error In Query";
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
        // }
        
        // //if authentication failed then this condition true
        // else {
        //     header('WWW-Authenticate: Basic realm="My Realm"');
        //     header('HTTP/1.0 401 Unauthorized');
        //     $response['flag'] = '0';
        //     $response['message'] = 'Sorry You Are not Allow to access';
        // }
        echo json_encode($response);
        ?>
        

