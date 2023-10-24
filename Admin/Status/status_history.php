<?php
session_start();
include '../connect/conn.php'
?>

<?php
$sql = "SELECT * FROM `rm_info`";
$result = mysqli_query($conn, $sql);
?>

<?php
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
  <title>จัดทำคิว</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- bootstrab -->
  <link rel="stylesheet" href="../assets/bootstrab/css/bootstrap.min.css">

  <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">

  <style>
    @media (max-width: 576px) {

      /* ตัวอย่าง: จัดให้ปุ่มอยู่ในบรรทัดใหม่เมื่อหน้าจอเล็ก */
      .d-flex {
        flex-direction: column;
        align-items: center;
      }
    }

    .table td,
    .table th {
      white-space: nowrap;
    }
  </style>
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
            <button type="button" class="btn btn-danger"><a href="../index.php?logout='1'" style="color:white;" class="text-decoration-none">logout</a></button>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../index.php" class="brand-link text-decoration-none">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"><br>
        <span class="brand-text font-weight-light">ระบบจัดการข้อมูลการสีข้าว<br>โรงสีข้าวไพศาลวัฒนา</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
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
              <a href="../queue/queue.php" class="nav-link">
                <i class="nav-icon fa fa-plus-square-o" style="font-size: 24px;" aria-hidden="true"></i>
                <p>รับข้าว</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../queue/queue1.php" class="nav-link">
                <i class="nav-icon fas fa-th" style="font-size: 19px;"></i>
                <p>จัดทำคิว</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../user/user.php" class="nav-link">
                <i class="nav-icon fa fa-address-book-o" style="font-size: 24px;" aria-hidden="true"></i>
                <p>จัดการข้อมูลลูกค้า</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../Status/status.php" class="nav-link">
                <i class="nav-icon fa fa-check-circle-o" style="font-size: 24px;" aria-hidden="true"></i>
                <p>ส่งแจ้งเตือนสถานะ</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../report/report.php" class="nav-link">
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
    <div class="content-wrapper">
      <div class="card">
        <div class="card-body">
          <div class="container">

            <div class="row mt-4">
              <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="text-primary">รายการข้อมูลข้าวที่ลูกค้ารับไปแล้วทั้งหมด</h4>
                </div>
                <div class="d-flex justify-content-end">
                  <a href="./status.php" class="btn btn-primary">กลับ</a>
                </div>
              </div>
            </div>
            <hr>
            <!-- เริ่มตารางแสดงคิวทั้งหมด -->
            <div class="row">
              <div class="col col-12 col-sm-12 col-lg-12 col-xl-12">
                <div class="table-responsive">
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
                        <th>อัพเดตสถานนะ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql_queue = "SELECT * FROM `queue_arranged` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID) WHERE `status` = 'ลูกค้ารับข้าวไปแล้ว' ORDER BY `time_queue_arranged` ASC;";
                      $result_queue = mysqli_query($conn, $sql_queue);
                      ?>
                      <?php $i = 1 ?>
                      <?php foreach ($result_queue as $row) : ?>
                        <tr>
                          <td><?= $i++ ?></td>
                          <td><?= $row['firstname'] . " " . $row['lastname'] ?> </td>
                          <td><?= $row['rice_type'] ?> </td>
                          <td><?= number_format($row['Number_of_sacks']) . " ถุง" ?> </td>
                          <td><?= $row['time_of_booking'] ?> </td>
                          <td><?= number_format($row['rice_mill_price']) . " บาท" ?> </td>
                          <td><?= $row['status'] ?> </td>
                          <td><a href="status_update.php?status_update_id=<?= $row['QueueID'] ?>" class="btn btn-warning">อัพเดต</a></td>
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