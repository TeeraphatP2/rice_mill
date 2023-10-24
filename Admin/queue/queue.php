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
              <a href="queue.php" class="nav-link">
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
          <!--  เพิ่มข้อมูล User end-->
          <div class="container">
            <div class="row mt-4">
              <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="text-primary">รายการรับข้าวทั้งหมด</h4>
                </div>
                <div>
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addrice">เพิ่มประเภทข้าว</button>
                  <a href="add_queue.php" class="btn btn-primary">รับข้าว</a>
                  <!-- <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#queue">รับข้าว</button> -->
                </div>
              </div>
            </div>
            <hr>

            <!-- เริ่มฟอร์มเพิ่มชนิดข้าว-->
            <div class="modal fade" tabindex="-1" id="addrice">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-header">เพิ่มประเภทข้าว</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <!-- Start Form -->
                    <form action="rice_type_add_db.php" method="post" class="p-2">
                      <div class="row mb-3 gx-3">
                        <div class="col-mb-3">
                          <input type="text" name="rice_type" class="form-control form-control-lg" placeholder="ชนิดข้าว" required><br>
                        </div>
                        <div class="col">
                          <input type="number" name="rice_price_pui_b" id="rice_price_pui_b" class="form-control form-control-lg" placeholder="ราคาข้าวต่อถุงปุ้ย" required><br>
                        </div>
                        <div class="col">
                          <input type="number" name="rice_price_parn_b" id="rice_price_parn_b" class="form-control form-control-lg" placeholder="ราคาข้าวต่อถุงป่าน" required><br>
                        </div>
                        <div class="md-3">
                          <button class="btn btn-primary btn-block btn-lg mt-3" type="submit">บันทึก</button>
                        </div>
                      </div>
                    </form>
                    <!-- End Form  -->
                  </div>
                </div>
              </div>
            </div>
            <!-- จบฟอร์มเพิ่มชนิดข้าว -->

            <!-- เริ่มตารางแสดงคิวทั้งหมด -->
            <div class="row">
              <div class="col col-12 col-sm-12 col-lg-12 col-xl-12">
                <div class="table-responsive">
                  <?php
                  $sql = "SELECT * FROM `queue` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID) ORDER BY time_of_booking ASC;";
                  $result = mysqli_query($conn, $sql);
                  ?>
                  <?php
                  // $sql_price = "SELECT * FROM `queue` INNER JOIN rm_info USING(RiceMillingID);";
                  // $sql_price ="SELECT queue.Number_of_sacks, rm_info.rice_price FROM `queue` INNER JOIN rm_info ON queue.QueueID = rm_info.RiceMillingID";
                  // $result_price = mysqli_query($conn, $sql);
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
                        <th>แก้ไข้</th>
                        <th>ลบ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach ($result as $row) : ?>
                        <tr>
                          <td><?= $i++ ?></td>
                          <td><?= $row['firstname'] . " " . $row['lastname'] ?></td>
                          <td><?= $row['rice_type'] ?></td>
                          <td><?= number_format($row['Number_of_sacks']) . " ถุง" ?></td>
                          <td><?= $row['time_of_booking'] ?></td>
                          <td><?= number_format($row['rice_mill_price']) . " บาท" ?></td>
                          <td><?= $row['status'] . "จัดคิว" ?></td>
                          <td><a href="edit_queue.php?queue_edit_id=<?= $row['QueueID'] ?>" class="btn btn-success btn-sm rounded-pull py-0 editlink">แก้ไข</a></td>
                          <td><a href="queue_delete_db.php?queue_del_id=<?= $row['QueueID'] ?>" class="btn btn-danger btn-sm rounded-pull py-0 deletelink" onclick="return confirm('คุณต้องการลบข้อมูลรับข้าวของ <?= $row['firstname'] ?> หรือไม่')">ลบ</a></td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- จบตารางแสดงคิวทั้งหมด -->

            <!-- ไปหน้าจัดคิว -->
            <div class="row mb-3">
              <div class="col-12 d-flex justify-content-end">
                <a href="queue1.php" class="btn btn-warning btn-lg rounded-pull py-0 deletelink">จัดคิว</a>
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
                      <p class="card-text"><?= "$rice_type : " . number_format($total_sacks) . " ถุง" ?></p>
                    <?php } ?>

                  </div>
                </div>
              </div>
            </div>
            <!-- จบหน้ารวมจำนวนข้าวที่รับ -->
            <!-- เริ่มตารางแสดงประเภทข้าวทั้งหมด -->
            <div class="row">
              <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="text-primary">อัตราค่าบริการสีข้าว</h4>
                </div>
              </div>
            </div>
            <?php
            $sql = "SELECT * FROM `rm_info`";
            $result = mysqli_query($conn, $sql);
            ?>
            <div class="row">
              <div class="col col-12 col-sm-12 col-lg-12 col-xl-12">
                <div class="table-responsive">
                  <table class="table table-striped table-boredered">
                    <thead>
                      <tr>
                        <th>ลำดับที่</th>
                        <th>ชนิดข้าว</th>
                        <th>ราคาสีข้าว/ต่อถุงปุ้ย</th>
                        <th>ราคาสีข้าว/ต่อถุงป่าน</th>
                        <th>แก้ไข้</th>
                        <th>ลบ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      foreach ($result as $row) : ?>
                        <tr>
                          <td><?= $i++ ?></td>
                          <td><?= $row['rice_type'] ?></td>
                          <td><?= number_format($row['rice_price_pui_bag']) ?> บาท</td>
                          <td><?= number_format($row['rice_price_parn_bag']) ?> บาท</td>
                          <td><a href="rice_type_edit.php?rice_edit_id=<?= $row['RiceMillingID'] ?>" class="btn btn-success btn-sm rounded-pull py-0 editlink">แก้ไข</a></td>
                          <td><a href="rice_type_delete_db.php?rice_del_id=<?= $row['RiceMillingID'] ?>" class="btn btn-danger btn-sm rounded-pull py-0 deletelink" onclick="return confirm('คุณต้องการลบ <?= $row['rice_type'] ?> หรือไม่')">ลบ</a></td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- จบตารางแสดงประเภทข้าวทั้งหมด-->
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
<script>
  document.getElementById("rice_price_pui_b").addEventListener("input", function() {
    var rice_price_pui_b = this.value;

    // ตรวจสอบว่าค่าที่ป้อนมีความยาวเท่ากับ 1 และเป็นเลข 0
    if (rice_price_pui_b.length === 1 && rice_price_pui_b === "0") {
      this.setCustomValidity("กรุณาป้อนเลขที่มีค่ามากกว่า 0");
    } else {
      this.setCustomValidity("");
    }
  });

  document.getElementById("rice_price_parn_b").addEventListener("input", function() {
    var rice_price_parn_b = this.value;

    // ตรวจสอบว่าค่าที่ป้อนมีความยาวเท่ากับ 1 และเป็นเลข 0
    if (rice_price_parn_b.length === 1 && rice_price_parn_b === "0") {
      this.setCustomValidity("กรุณาป้อนเลขที่มีค่ามากกว่า 0");
    } else {
      this.setCustomValidity("");
    }
  });
</script>