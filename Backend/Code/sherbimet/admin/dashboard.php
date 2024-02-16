<?php
include 'class/at-class.php';
include 'class/session-check.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $project_title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
include 'themepart/header-script.php';
?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
<!--                <li class="breadcrumb-item"><a href="dashboard.php.php">Home</a></li>-->
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                   <?php
                                    $query_worker = mysqli_query($conn,"select count(*) as worker_total from tbl_worker where is_active='1' and is_delete='0'")or die(mysqli_error($conn));
                                         
                                  $total_worker = mysqli_fetch_array($query_worker);                                    
                                    
                                    ?>
                <h3><?php echo $total_worker["worker_total"];?></h3>

                <p>Total Workers</p>
              </div>
              <div class="icon">
                <i class="ion ion-briefcase"></i>
              </div>
                <a href="worker-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                    <?php
                                    $query_area = mysqli_query($conn,"select count(*) as area_total from tbl_area where is_active='1' and is_delete='0'")or die(mysqli_error($conn));
                                         
                                  $total_area = mysqli_fetch_array($query_area);                                    
                                    
                                    ?>
                <h3><?php echo $total_area["area_total"];?>
<!--                    <sup style="font-size: 20px">%</sup>-->
                </h3>

                <p>Total Area</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="area-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                    <?php
                                    $query_user = mysqli_query($conn,"select count(*) as user_total from tbl_user where is_active='1' and is_delete='0'")or die(mysqli_error($conn));
                                         
                                  $total_user = mysqli_fetch_array($query_user);                                    
                                    
                                    ?>
                <h3><?php echo $total_user["user_total"];?></h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
                <a href="user-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                   <?php
                                    $query_booking = mysqli_query($conn,"select count(*) as booking_total from tbl_request")or die(mysqli_error($conn));
                                         
                                  $total_booking = mysqli_fetch_array($query_booking);                                    
                                    
                                    ?>
                <h3>  <?php echo $total_booking["booking_total"];?></h3>

                <p>Total Booking</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="booking-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
 
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include 'themepart/footer.php';?>

  <!-- Control Sidebar -->
<!--  <aside class="control-sidebar control-sidebar-dark">
     Control sidebar content goes here 
  </aside>-->
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'themepart/footer-script.php';?>
</body>
</html>
