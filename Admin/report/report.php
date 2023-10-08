<?php
session_start();
include '../connect/conn.php';
?>

<?php
$result = null;
if (isset($_GET["start_date"]) && !empty($_GET["end_date"])) {
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
} else {
  $start_date = " ";
  $end_date = " ";
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
              <a href="../queue/queue.php" class="nav-link">
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
              <a href="report.php" class="nav-link">
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
          <!--  เพิ่มข้อมูล User end-->
          <div class="container">
            <div class="row mt-4">
              <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="text-primary">ออกรายงานตามช่วงเวลา</h4>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <form action="#" method="get">
                <div class="mb-3">
                  <label for="start_date" class="form-label">วันเริ่มต้น:</label>
                  <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>

                <div class="mb-3">
                  <label for="end_date" class="form-label">วันสิ้นสุด:</label>
                  <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
                <button type="submit" class="btn btn-primary" name="search">ค้นหา</button>
              </form>
            </div>

            <!-- เริ่มตารางแสดงคิวทั้งหมด -->
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <?php
                  $sql = "SELECT * FROM `queue_arranged` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID) WHERE DATE(time_of_booking) BETWEEN '$start_date' AND '$end_date';";
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
                      <?php $i = 1; ?>
                      <?php if (mysqli_num_rows($result) > 0 && isset($_GET['search'])) : ?>
                        <?php foreach ($result as $row) : ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row['firstname'] . " " . $row['lastname'] ?></td>
                            <td><?= $row['rice_type'] ?></td>
                            <td><?= $row['Number_of_sacks'] . " ถุง" ?></td>
                            <td><?= $row['time_of_booking'] ?></td>
                            <td><?= $row['rice_mill_price'] . " บาท" ?></td>
                            <td><?= $row['status'] ?></td>
                          </tr>
                        <?php endforeach ?>
                      <?php elseif (mysqli_num_rows($result) === 0 && isset($_GET['search'])) : ?>
                        <tr>
                          <td colspan="7" class="text-center">ไม่พบข้อมูล</td>
                        </tr>
                      <?php endif ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- จบตารางแสดงคิวทั้งหมด -->
            <?php if (mysqli_num_rows($result) > 0 && isset($_GET['search'])) { ?>
              <div class="row">
                <form action="../mpdf/pdf.php" method="post">
                  <div class="mb-3" style="display: none;">
                    <label class="form-label">วันเริ่มต้น:</label>
                    <input type="date" class="form-control" name="start_date" value="<?= $_GET['start_date'] ?>" required>
                  </div>
                  <div class="mb-3" style="display: none;">
                    <label class="form-label">วันสิ้นสุด:</label>
                    <input type="date" class="form-control" name="end_date" value="<?= $_GET['end_date'] ?>" required>
                  </div>
                  <div class="container text-center mt-3">
                    <button type="submit" name="report" class="btn btn-danger mx-auto">ออกรายงาน PDF</button>
                  </div>
                </form>
              </div>
            <?php } ?>


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