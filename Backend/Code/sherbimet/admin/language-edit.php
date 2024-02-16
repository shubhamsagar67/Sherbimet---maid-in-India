<?php
include 'class/at-class.php';
include 'class/session-check.php';
$page_title = "Language";
$list_link = "language-list.php";
$add_link = "language-add.php";
$table = "tbl_language";
$primary_key = "language_id";

$editid = $_GET['eid'];


if (isset($_POST['update'])) {

    $id = mysqli_real_escape_string($conn, $_POST['language_id']);
    $language_name = mysqli_real_escape_string($conn, $_POST['language_name']);

    
     $query_check = mysqli_query($conn, "select lower(language_name) from $table where language_name=lower('{$language_name}') and NOT $primary_key = '{$id}'") or die(mysqli_error($conn));

  $count = mysqli_num_rows($query_check);
  
  if($count>0)
  {
         echo "<script>alert('Language Name Already Exist');window.location='$list_link';</script>";
  }
    else{
    
    
    
    $queryupdate = mysqli_query($conn, "update $table set language_name='{$language_name}',update_datetime='{$datetime}' where $primary_key='{$id}'") or die(mysqli_error($conn));



    if ($queryupdate) {
echo "<script>alert('Your Record Updated Successfully');window.location='$list_link';</script>";
       
    }
    else{
        echo "<script>alert('Your Record Not Update');window.location='$list_link';</script>";
              
            }
    }
}


if (!isset($_GET['eid']) || empty($_GET['eid'])) {
    header("location:$list_link");
}

$query_list = mysqli_query($conn, "select * from $table  where $primary_key='{$editid}'")or die(mysqli_error($conn));
$row_list = mysqli_fetch_array($query_list);


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit <?php echo $page_title;?> | <?php echo $project_title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

   <?php
include 'themepart/header-script.php';
?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php
include 'themepart/top-header.php';
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   <?php
include 'themepart/sidebar.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $page_title;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $home_page;?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo $list_link;?>">List <?php echo $page_title;?></a></li>
              <li class="breadcrumb-item active">Edit <?php echo $page_title;?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit <?php echo $page_title;?></h3>
              </div>
                <form role="form" id="area-edit" method="post" action="#">
              <!-- /.card-header -->
              <div class="card-body">
              
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                          <input type="hidden" class="form-control" name="language_id"  value="<?php echo $row_list['language_id']; ?>"  required>
                      <div class="form-group">
                        <label>Language</label>
                        <input type="text" name="language_name" onkeyup ="Validatestring(this)" value="<?php echo $row_list['language_name']; ?>" class="form-control" placeholder="Enter Language" required="">
                      </div>
                    </div>
                      

                      
                    
                  </div>
                   
                  
                
                  
              
                    
              </div>
              <div class="card-footer">
                  <button type="submit" name="update" class="btn btn-primary">Update</button>
                  <a href="<?php echo $list_link;?>" class="btn btn-info">View</a>
<!--                  <button type="submit" class="btn btn-default">Cancel</button>-->
                </div>
              <!-- /.card-body -->
                </form>
            </div>
            <!-- /.card -->
            <!-- general form elements disabled -->

            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include'themepart/footer.php';?>


</div>
<!-- ./wrapper -->


<?php include'themepart/footer-script.php';?>
     <script>
              $(document).ready(function () {

                // validate signup form on keyup and submit
                $("#area-edit").validate({
                    rules: {
                        language_name: {
                            required: true,
                            minlength:2,

                       },
//                        language_id: {
//                            required: true
//
//
//                        }
                      

                    },
                    messages: {
                        language_name: {
                            required: "Please Enter Language"

                       },
//                        language_id: {
//                            required: "Please Select City"
//
//                        }
                        

                    }
                });

            });
            </script>
<!--<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>-->
</body>
</html>
