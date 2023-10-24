<?php
session_start();
include_once '../connect/conn.php';
// $_SESSION['sert_name'] = $_GET["sert_name"];
?>

<?php
$sql = "SELECT * FROM `rm_info` ";
$result = mysqli_query($conn, $sql);
?>

<?php
if (isset($_GET["add_queue_user_id_sert"]) && !empty($_GET["add_queue_user_id_sert"])) {
  $add_queue_user_id_sert = $_GET["add_queue_user_id_sert"];
  $sql_sert = "SELECT * FROM tb_user WHERE UserID = '$add_queue_user_id_sert'";
  $result_sert = mysqli_query($conn, $sql_sert); //รันคำสั่งที่ถูกเก็บไว้ในตัวแปร $sql
}
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
  <title>แก้ไข้ข้อมูลประเภทข้าว</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <link rel="stylesheet" href="../assets/bootstrab/css/bootstrap.min.css">

  <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">
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
            <button type="button" class="btn btn-danger"><a href="../index.php?logout='1'" style="color:white;"  class="text-decoration-none">logout</a></button>
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
          <div class="container px-4 mt-4">
            <div class="row justify-content-center">
              <div class="col col-12 col-sm-9 col-lg-6 col-xl-6">
                <form action="add_queue_sert_user.php" class="form-group my-3" method="GET">
                  <div class="row">
                    <div class="col-6">
                      <input type="text" placeholder="ค้นหาชื่อลูกค้า" class="form-control" name="sert_name" required>
                    </div>
                    <div class="col-6">
                      <input type="submit" value="ค้นหา" class="btn btn-info">
                    </div>
                  </div>
                </form>
                <form action="add_queue_db.php" method="post" class="p-2">
                  <div class="mb-3 gx-3">
                    <?php if (isset($result_sert)) : ?>
                      <?php while ($row = mysqli_fetch_array($result_sert)) : ?>
                        <div class="col mt-3">
                          <label for="firstname" class="form-label">ชื่อจริง</label>
                          <input type="text" class="form-control" name="firstname" value="<?= $row['firstname'] ?>" readonly>
                        </div>
                        <div class="col mt-3">
                          <label for="lastname" class="form-label">นามสกุล</label>
                          <input type="text" class="form-control" name="lastname" value="<?= $row['lastname'] ?>" readonly>
                        </div>
                        <div class="col mt-3">
                          <label for="phoneNumber" class="form-label">เบอร์โทรศัพท์</label>
                          <input type="number" class="form-control" name="phoneNumber" value="<?= $row['phone_number'] ?>" readonly>
                        </div>
                      <?php endwhile ?>
                    <?php else : ?>
                      <div class="col mt-3">
                        <label for="firstname" class="form-label">ชื่อจริง</label>
                        <input type="text" class="form-control" name="firstname">
                      </div>
                      <div class="col mt-3">
                        <label for="lastname" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="lastname">
                      </div>
                      <div class="col mt-3">
                        <label for="phoneNumber" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="number" class="form-control" name="phoneNumber">
                      </div>
                    <?php endif ?>
                    <div class="col mt-3">
                      <select class="form-select form-select-lg" aria-label="Default select example" name="rice_type_select" required>
                        <option disabled selected>เลือกชนิดข้าว</option>
                        <?php foreach ($result as $row) : ?>
                          <option value="<?= $row['RiceMillingID'] ?>"> <?= $row['rice_type'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="radio" name="sack" value="<?= $row['rice_price_pui_bag'] ?>" checked>
                      <label class="form-check-label" for="flexRadioDefault1">กระสอบปุ้ย</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="sack" value="<?= $row['rice_price_parn_bag'] ?>">
                      <label class="form-check-label" for="flexRadioDefault2">กระสอบป่าน</label>
                    </div>
                    <div class="col mt-3">
                      <input type="number" name="Number_sacks" id="Number_sacks" class="form-control form-control-lg" placeholder="จำนวนถุง" oninput="this.value = Math.abs(this.value)" required>
                    </div>
                    <div class="col-12 md-6">
                      <?php if (isset($result_sert)) : ?>
                        <?php foreach ($result_sert as $row) : ?>
                          <button class="btn btn-primary btn-block btn-lg mt-3" type="submit" name="add_queue" value="<?= $row['UserID'] ?>">รับข้าว</button>
                        <?php endforeach ?>
                      <?php else : ?>
                        <button class="btn btn-primary btn-block btn-lg mt-3" type="submit" name="add_queue">รับข้าว</button>
                      <?php endif ?>
                    </div>
                  </div>
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

  <!-- REQUIRED SCRIPTS -->
  <script src="../assets/bootstrab/js/bootstrap.min.js"></script>
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>
<script>
  document.getElementById("Number_sacks").addEventListener("input", function() {
    var inputValue = this.value;

    // ตรวจสอบว่าค่าที่ป้อนมีความยาวเท่ากับ 1 และเป็นเลข 0
    if (inputValue.length === 1 && inputValue === "0") {
      this.setCustomValidity("กรุณาป้อนเลขที่มีค่ามากกว่า 0");
    } else {
      this.setCustomValidity("");
    }
  });
</script>