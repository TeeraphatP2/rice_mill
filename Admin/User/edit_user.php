<?php
session_start();
include '../connect/conn.php';
$_SESSION['id_user'] = $_GET['id'];
$sql = "SELECT * FROM tb_user WHERE UserID='".$_SESSION['id_user']."' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

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
      <a href="../index.html" class="brand-link">
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
              <a href="../User/user.php" class="nav-link">
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
            <div class="row">
              <div class="col-sm-6">
                <div class=" h2 text-center  alert alert-warning mb-4 mt-4" role="alert"> แก้ไขข้อมูลสมาชิก </div>
                <form method="POST" action="edit_user_db.php">
                  <label>ชื่อ:</label>
                  <input type="text" name="firstname" class="form-control" value=<?= $row['firstname'] ?>> <br>
                  <label>นามสกุล:</label>
                  <input type="text" name="lastname" class="form-control" value=<?= $row['lastname'] ?>> <br>
                  <label>เบอร์โทรศัพท์:</label>
                  <input type="text" name="phone_number" class="form-control" value=<?= $row['phone_number'] ?>> <br>
                  <input type="submit" value="อัปเดต" class="btn btn-success">
                  <a href="user.php" class="btn btn-danger ">ยกเลิก</a>

                </form>

              </div>
            </div>

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
</body>

</html>
<script language="Javascript">
  function Del(mypage) {
    var agree = confirm("คุณต้องการลบข้อมูลหรือไม่");
    if (agree) {
      window.location = mypage;
    }

  }
</script>