<?php
include 'class/at-class.php';
include 'class/session-check.php';
$page_title = "Feedback";
$list_link = "feedback-list.php";
$add_link = "feedback-add.php";
$table = "tbl_feedback";
$primary_key = "feedback_id";
$edit_link = "feedback-edit.php";
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
                                    
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Srno</th>
                                                <th>User</th>
                                                <th>Worker</th>
                                                <th>Date</th>
                                                <th>Rating</th>
                                                <th>Message</th>


                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_list = mysqli_query($conn, "select * from $table where is_active='1' and is_delete='0' order by $primary_key desc") or die(mysqli_error($conn));


                                            $x = 1;
                                            while ($row = mysqli_fetch_array($query_list)) {

                                                   $feedback_id = $row['feedback_id'];
                                                   $feedback_date = $row['feedback_date'];
                                                   $feedback_message = $row['feedback_message'];
                                                   $feedback_rating = $row['feedback_rating'];
                                                   $user_id = $row['user_id'];
                                                   $worker_id = $row['worker_id'];
                                                   
                                              
                                               $query_user = mysqli_query($conn,"select * from tbl_user where user_id='{$user_id}'")or die(mysqli_error($conn));
                            $row_user= mysqli_fetch_array($query_user);
                                                $user_name = $row_user['user_name'];
                                                
                                                
                                                $query_worker = mysqli_query($conn,"select * from tbl_worker where worker_id='{$worker_id}'")or die(mysqli_error($conn));
                            $row_worker= mysqli_fetch_array($query_worker);
                                                $worker_name = $row_worker['worker_name'];
                                                
                                                ?>

                                                <tr>

                                                    <td><?php echo $x++; ?></td>
                                                     <td><?php echo $user_name; ?></td>
                                                     <td><?php echo $worker_name; ?></td>
                                                     <td><?php echo date("d-m-Y",strtotime($feedback_date)); ?></td>
                                                       <td><?php 
                                                       
                                                     for($i=0;$i<$feedback_rating;$i++)
                                                     {
                                                         ?>
                                                           
                                                           <i class="fa fa-star" style="color:orange;"></i>
                                                        <?php
                                                     }
                                                       
                                                       ?></td>
                                                         <td><?php echo $feedback_message; ?></td>
                                                   
                                                    
                                    
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                    
                                    </table>
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
        
                        method: "POST",
                        data: {id: id, action: action, tbl_name: tbl_name, field_name: field_name},
                        success: function ()
                        {
                            
                            
                            alert("Your Record Deleted successfully");

                            //    location.reload(true);
                        }
                    })

            
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
