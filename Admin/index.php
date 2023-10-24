<?php
session_start();

include_once './connect/conn.php';

if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "กรุณาล็อคอินก่อน";
  header('location: login.php');
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบจัดการข้อมูลการสีข้าวโรงสีข้าวไพศาลวัฒนา</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <div class="col-md-3">
            <button type="button" class="btn btn-danger"><a href="index.php?logout='1'" style="color:white;">logout</a></button>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="./index.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"><br>
        <span class="brand-text font-weight-light">ระบบจัดการข้อมูลการสีข้าว<br>โรงสีข้าวไพศาลวัฒนา</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <?php if (isset($_SESSION['username'])) : ?>
              <p class="text-white"> Welcome <strong class="text-white"><?php echo $_SESSION['username']; ?></strong> </p>
            <?php endif  ?>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="queue/queue.php" class="nav-link">
                <i class="nav-icon fa fa-plus-square-o" style="font-size: 24px;" aria-hidden="true"></i>
                <p>รับข้าว</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="queue/queue1.php" class="nav-link">
                <i class="nav-icon fas fa-th" style="font-size: 19px;"></i>
                <p>จัดทำคิว</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="User/user.php" class="nav-link">
                <i class="nav-icon fa fa-address-book-o" style="font-size: 24px;" aria-hidden="true"></i>
                <p>จัดการข้อมูลลูกค้า</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="Status/status.php" class="nav-link">
                <i class="nav-icon fa fa-check-circle-o" style="font-size: 24px;" aria-hidden="true"></i>
                <p>ส่งแจ้งเตือนสถานะ</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./report/report.php" class="nav-link">
                <i class="nav-icon fa fa-file-pdf-o" style="font-size: 24px;" aria-hidden="true"></i>
                <p>ออกรายงาน</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header bg-success">
        <div class="container-fluid">
          <div class="row mb-2 mt-2">
            <div class="col-sm-12">
              <h1 class="m-0 text-center">ระบบจัดการข้อมูลการสีข้าวโรงสีข้าวไพศาลวัฒนา</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row d-flex justify-content-center mt-4">
            <div class="col-lg-6">
              <a href="./queue/queue.php" class="card-link">
                <div class="card">
                  <div class="card-body text-center">
                    <h5 class="card-text text-center">รับข้าว</h5>
                    <i class="nav-icon fa fa-plus-square-o" style="font-size: 24px;" aria-hidden="true"></i>
                  </div>
                </div>
              </a>

              <a href="./Status/status.php">
                <div class="card card-primary card-outline">
                  <div class="card-body text-center">
                    <h5 class="card-text text-center">ส่งแจ้งเตื่อนสถานะ</h5>
                    <i class="nav-icon fa fa-check-circle-o" style="font-size: 24px;" aria-hidden="true"></i>
                  </div>
                </div><!-- /.card -->
              </a>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
              <a href="./queue/queue1.php">
                <div class="card">
                  <div class="card-body text-center">
                    <h5 class="card-text text-center">จัดคิว</h5>
                    <i class="nav-icon fas fa-th" style="font-size: 19px;"></i>
                  </div>
                </div>
              </a>

              <a href="./report/report.php">
                <div class="card card-primary card-outline">
                  <div class="card-body text-center">
                    <h5 class="card-text text-center">ออกรายงาน</h5>
                    <i class="nav-icon fa fa-file-pdf-o" style="font-size: 24px;" aria-hidden="true"></i>
                  </div>
                </div><!-- /.card -->
              </a>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
      <!-- เริ่มหน้ารวมจำนวนข้าวที่รับ -->
      <div class="content">
        <div class="container-fluid">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-9">
              <div class="card">
                <?php //include 'update_currenttime.php'; ?>
                <?php //$current_time = date("Y-m-d"); ?>
                <?php
                $sql_sum = "SELECT SUM(Number_of_sacks) AS total_sacks, rm_info.rice_type FROM queue_arranged INNER JOIN rm_info USING(RiceMillingID) WHERE DATE(time_of_booking) = CURDATE() GROUP BY RiceMillingID ORDER BY total_sacks DESC;";
                $result_sum = mysqli_query($conn, $sql_sum);
                $rice_types = array();
                ?>
                <?php
                while ($row_sum = mysqli_fetch_assoc($result_sum)) {
                  $rice_type = $row_sum['rice_type'];
                  $total_sacks = $row_sum['total_sacks'];

                  // เก็บข้อมูลในอาร์เรย์
                  $rice_types[$rice_type] = $total_sacks;
                }
                // นับจำนวนชนิดข้าว
                $num_rice_types = count($rice_types);
                ?>
                <div class="col">
                  <div>
                    <h4 class="text-primary text-center">สรุปข้อมูลข้าวที่ลูกค้านำมาสีวันนี้</h4>
                  </div>
                  <div class="card-body">
                    <p class="card-text text-center font-weight-bold"><?= "มีชนิดข้าวที่รับมาสี $num_rice_types ชนิด" ?></p>

                    <?php
                    foreach ($rice_types as $rice_type => $total_sacks) {
                    ?>
                      <p class="card-text text-center font-weight-bold"><?= "$rice_type : " . number_format($total_sacks) . " ถุง" ?></p>
                    <?php } ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- จบหน้ารวมจำนวนข้าวที่รับ -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>