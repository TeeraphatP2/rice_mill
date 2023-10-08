<?php
session_start();
include '../connect/conn.php'
?>

<?php
$sql = "SELECT * FROM `rm_info`";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>จัดทำคิว</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- bootstrab -->
  <link rel="stylesheet" href="../assets/bootstrab/css/bootstrap.min.css">
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
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Home</a>
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
      <a href="../index.php" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">โรงสีข้าวไพศาลวัฒนา</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="queue.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>รับข้าว</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../queue/queue1.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>จัดทำคิว</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../user/user.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>จัดการข้อมูลลูกค้า</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../Status/status.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>ส่งแจ้งเตือนสถานะ</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../report/report.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>ออกรายงาน</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
      <div class="card">
        <div class="card-body">
          <div class="container">
            <div class="row mt-4">
              <div class="col-lh-12 d-flex justify-content-center align-items-center">
                <h4 class="text-primary">จัดคิว</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <?php
                  // $sql = "SELECT * FROM queue INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID)
                  // WHERE QueueID NOT IN (SELECT QueueID FROM queue_arranged);";
                  $sql = "SELECT * FROM queue INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID) ORDER BY time_of_booking ASC";
                  $result = mysqli_query($conn, $sql);
                  ?>
                  <table class="table table-striped table-boredered">
                    <thead>
                      <tr>
                        <th>ชนิดข้าว</th>
                        <th>ชื่อ-สกุล</th>
                        <th>จำนวนถุง</th>
                        <th>จัดคิว</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($result as $row) : ?>
                        <tr>
                          <td><?= $row['rice_type'] ?></td>
                          <td><?= $row['firstname'] ." ". $row['lastname']?></td>
                          <td><?= $row['Number_of_sacks'] . " ถุง" ?></td>
                          <td><a href="queue1_add_db.php?queue_add_id=<?= $row['QueueID']?>"class="btn btn-warning">จัดคิว</a></td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- เริ่มหน้ารวมจำนวนข้าวที่รับ -->
            <div class="row">
              <?php
              $sql_sum = "SELECT SUM(Number_of_sacks) AS total_sacks, rm_info.rice_type FROM queue INNER JOIN rm_info USING(RiceMillingID) GROUP BY RiceMillingID ORDER BY total_sacks DESC;";
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
              <div class="col-lg-6">
                <div>
                  <h4 class="text-primary">สรุป</h4>
                </div>
                <div class="card">
                  <div class="card-body">
                    <p class="card-text"><?= "มีชนิดข้าวที่รับมาสี $num_rice_types ชนิด" ?></p>
                    <?php
                    foreach ($rice_types as $rice_type => $total_sacks) {
                    ?>
                      <p class="card-text"><?= "$rice_type : $total_sacks ถุง" ?></p>
                    <?php } ?>

                  </div>
                </div>
              </div>
            </div>
            <!-- จบหน้ารวมจำนวนข้าวที่รับ -->
            
            <div class="row mt-4">
              <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="text-primary">รายการคิวข้าวที่จัดแล้วทั้งหมด</h4>
                </div>
              </div>
            </div>
            <hr>
            <!-- เริ่มตารางแสดงคิวทั้งหมด -->
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <?php
                  $sql = "SELECT * FROM `queue` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID);";
                  $result = mysqli_query($conn, $sql);
                  ?>
                  <table class="table table-striped table-boredered">
                    <thead>
                      <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ชนิดข้าว</th>
                        <th>จำนวนถุง</th>
                        <th>เวลาที่รับข้าว</th>
                        <th>ราคาสีข้าว</th>
                        <th>สถานะ</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $sql_queue = "SELECT * FROM `queue_arranged` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID) ORDER BY `time_queue_arranged` ASC";
                    $result_queue = mysqli_query($conn, $sql_queue);
                    ?>
                    <?php $i = 1?>
                    <?php foreach ($result_queue as $row) : ?>
                      <tr>
                          <td><?= $i++ ?></td>
                          <td><?= $row['firstname'] ." ". $row['lastname'] ?> </td>
                          <td><?= $row['rice_type']?> </td>
                          <td><?= $row['Number_of_sacks'] . " ถุง"?> </td>
                          <td><?= $row['time_of_booking']?> </td>
                          <td><?= $row['rice_mill_price']?> </td>
                          <td><?= $row['status']?> </td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- จบตารางแสดงคิวทั้งหมด -->
          </div>
        </div>
      </div>
    </div>

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

  <script src="../assets/bootstrab/js/bootstrap.min.js"></script>
  <script src="../dist/js/jquery-3.7.0.min.js"></script>
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>

  <?php
  if (isset($_GET['sert_name'])) {
    echo "
        <script>
        $(document).ready(function () {
            $('#queue').modal('show');
        });
        </script>";
  }
  ?>

</body>

</html>