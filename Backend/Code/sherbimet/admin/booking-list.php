<?php
include 'class/at-class.php';
include 'class/session-check.php';
$page_title = "Booking List";
$list_link = "booking-list.php";
$add_link = "booking-add.php";
$table = "tbl_request";
$primary_key = "request_id";
$edit_link = "booking-edit.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>List <?php echo $page_title; ?> | <?php echo $project_title; ?></title>
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
                                <h1><?php echo $page_title; ?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo $home_page; ?>">Home</a></li>
                                    <li class="breadcrumb-item active">List <?php echo $page_title; ?></li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">List <?php echo $page_title; ?></h3>
<!--                                    <a href="<?php echo $add_link;?>" class="btn btn-primary float-right">Add <?php echo $page_title;?></a>-->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Srno</th>
                                                <th>User Name</th>
                                                <th>Package</th>
                                                <th>Worker Name</th>
                                                    <th>Booking Date & Time</th>
                                                    <th>Booking Status</th>
                                                    <th>Payment Method</th>
                                                <th>Total Amount</th>
                                                <th>Address</th>

                                                  
                                             

                                               <!-- <th>Action</th> -->
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // $query_list = mysqli_query($conn, "select * from $table where is_delete='0' and can_accept='0' order by $primary_key desc") or die(mysqli_error($conn));
                                            $query_list = mysqli_query($conn, "select * from $table where is_delete='0' order by $primary_key desc") or die(mysqli_error($conn));

                                            $x = 1;
                                            while ($row = mysqli_fetch_array($query_list)) {

                                                $request_id = $row['request_id'];
                                                $booking_date = $row['booking_date'];
                                                 $booking_time = $row['booking_time'];
                                                 $user_id = $row['user_id'];
                                                 $worker_id = $row['worker_id'];
                                                 $booking_totalamount = $row['booking_totalamount'];
                                                   $booking_address = $row['booking_address'];
                                                     $booking_status = $row['booking_status'];
                                                     $payment_method = $row['payment_method'];
                                          
                                                 $package_id = $row['package_id'];
                                                     $query_sub = mysqli_query($conn,"select * from tbl_package where package_id='{$package_id}'")or die(mysqli_error($conn));
                            $row_sub= mysqli_fetch_array($query_sub);
                                               

                            $status_id = $row['status_id'];
                            $query_status = mysqli_query($conn,"select * from tbl_status where status_id='{$status_id}'")or die(mysqli_error($conn));
   $row_status= mysqli_fetch_array($query_status);
   $status_name=$row_status["status_name"];

                            $package_name=$row_sub["package_name"];
                                                   $query_user = mysqli_query($conn,"select * from tbl_user where user_id='{$user_id}'")or die(mysqli_error($conn));
                            $row_user= mysqli_fetch_array($query_user);
                             $user_first_name = $row_user['user_first_name'];
                             $user_middle_name = $row_user['user_middle_name'];
                             $user_last_name = $row_user['user_last_name'];
                             $user_name = $user_first_name." ".$user_middle_name." ".$user_last_name;
                             
                             
                              $query_worker = mysqli_query($conn,"select * from tbl_worker where worker_id='{$worker_id}'")or die(mysqli_error($conn));
                              $count_w=mysqli_num_rows($query_worker);
                              
                              if($count_w>0)
                              {
                                
                                $row_worker= mysqli_fetch_array($query_worker);
                                $worker_first_name = $row_worker['worker_first_name'];
                                $worker_middle_name = $row_worker['worker_middle_name'];
                                $worker_last_name = $row_worker['worker_last_name'];
                             
                              }
                              else{
                                $worker_name = "";
                                
                              }
                              $worker_name = $worker_first_name." ".$worker_middle_name." ".$worker_last_name;
                                                ?>

                                                <tr>

                                                    <td><?php echo $x++; ?></td>
                                                    <td><?php echo $user_name; ?></td>
                                                    <td><?php echo $package_name;?></td>
                                                      <td><?php echo $worker_name; ?></td>
                                                       <td><?php echo date("d-m-Y",strtotime($booking_date)); ?> & <?php echo date("h:i A",strtotime($booking_time)); ?></td>
                                                       <td><?php echo $status_name;?></td>
                                                       <td><?php echo $payment_method;?></td>
                                                        <td><i class="fa fa-rupee-sign"></i> <?php echo $booking_totalamount;?></td>
                                                        <td> <?php echo $booking_address;?></td>

                                                    
                                                    

                                                    
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                        
                                    </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


            <?php include'themepart/footer.php'; ?>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <?php include'themepart/footer-script.php'; ?>
        <!-- page script -->
        <script>
            $(function () {
                $("#example1").DataTable();
        //    $('#example2').DataTable({
        //      "paging": true,
        //      "lengthChange": false,
        //      "searching": false,
        //      "ordering": true,
        //      "info": true,
        //      "autoWidth": false,
        //    });
            });



            $(document).on("click", '.delete_record', function () {

                var id = $(this).val();
                var action = 'delete';
                var tbl_name = '<?php echo $table; ?>';
                var field_name = '<?php echo $primary_key; ?>';
                if (confirm("Are you sure you want to Delete Record?"))
                {

                    $.ajax({
                        url: 'ajax/action.php',
        //				url:"action.php",
                        method: "POST",
                        data: {id: id, action: action, tbl_name: tbl_name, field_name: field_name},
                        success: function ()
                        {
                            //load_cart_data();
                         
                            alert("Your Record Deleted successfully");
                     
                            //    location.reload(true);
                        }
                    })

                    // window.location.href='category-list.php';
                    location.reload(true);

                } else
                {
        //                location.reload(true);
        //			return false;

                }


            });
        </script>
    </body>
</html>
