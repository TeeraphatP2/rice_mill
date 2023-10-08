<?php
session_start();
include '../connect/conn.php'
?>

<?php
$sql = "SELECT * FROM `rm_info`";
$result = mysqli_query($conn, $sql);
?>

<?php
// if (isset($_GET["sert_name"]) && !empty($_GET["sert_name"])) {
//   $sert_name = $_GET["sert_name"];
//   $sql_sert = "SELECT * FROM tb_user WHERE username LIKE '%$sert_name%' OR phone_number LIKE '%$sert_name%' ORDER BY username ASC ";
//   $result_sert = mysqli_query($conn, $sql_sert); //รันคำสั่งที่ถูกเก็บไว้ในตัวแปร $sql
//   $count_sert = mysqli_num_rows($result_sert); //เก็บผลที่ได้จากคำสั่ง $result เก็บไว้ในตัวแปร $count
// }
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

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
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
              <a href="../registerUser/register.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>สมัครสมาชิก</p>
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
          <!--  เพิ่มข้อมูล User end-->
          <div class="container">
            <div class="row mt-4">
              <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="text-primary">รายการรับข้าวทั้งหมด</h4>
                </div>
                <div>
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addrice">เพิ่มประเภทข้าว</button>
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#queue">รับข้าว</button>
                </div>
              </div>
            </div>
            <hr>
            <!-- เรื่มฟอร์มจัดทำคิว-->
            <div class="modal fade" tabindex="-1" id="queue">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-header">รับข้าวลูกค้า</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="#" class="form-group my-3" method="GET">
                      <div class="row">
                        <!-- <div class="col-6">
                          <input type="text" placeholder="ค้นหาชื่อลูกค้า" class="form-control" name="sert_name" required>
                        </div>
                        <div class="col-6">
                          <input type="submit" value="ค้นหา" class="btn btn-info">
                        </div> -->
                      </div>
                    </form>
                    <?php if (isset($sert_name)  && !empty($sert_name)) : ?>
                      <?php if ($count_sert > 0) { ?>
                        <table class="table table-bordered">
                          <thead class="table-dark">
                            <tr>
                              <th>ชื่อผู้ใช้</th>
                              <th>รับข้าว</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php while ($row = mysqli_fetch_assoc($result_sert)) {
                            ?>
                              <tr>
                                <td><?php echo $row["username"]; ?></td>
                                <td><a href="add_queue.php?id_user_add_queue=<?= $row["UserID"] ?>" class="btn btn-warning">รับข้าว</a></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      <?php } else { ?>
                        <div class="alert alert-danger">
                          <b>ไม่พบข้อมูลลูกค้า!!</b>
                        </div>
                      <?php } ?>
                    <?php endif ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- จบฟอร์มจัดทำคิว-->

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
                          <input type="number" name="rice_price_pui_b" class="form-control form-control-lg" placeholder="ราคาข้าวต่อถุงปุ้ย" required><br>
                        </div>
                        <div class="col">
                          <input type="number" name="rice_price_parn_b" class="form-control form-control-lg" placeholder="ราคาข้าวต่อถุงป่าน" required><br>
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
              <div class="col-lg-12">
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
                          <td><?= $row['Number_of_sacks'] . " ถุง" ?></td>
                          <td><?= $row['time_of_booking'] ?></td>
                          <td><?= $row['rice_mill_price'] . " บาท" ?></td>
                          <td><?= $row['status'] ?></td>
                          <td><a href="edit_queue.php?queue_edit_id=<?= $row['QueueID'] ?>" class="btn btn-success btn-sm rounded-pull py-0 editlink">แก้ไข</a></td>
                          <td><a href="queue_delete_db.php?queue_del_id=<?= $row['QueueID'] ?>" class="btn btn-danger btn-sm rounded-pull py-0 deletelink" onclick="return confirm('คุณต้องการลบคิว <?= $row['rice_type'] ?> หรือไม่')">ลบ</a></td>
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
              //$sql_sum = "SELECT SUM(Number_of_sacks),rm_info.rice_type AS total_sacks FROM queue INNER JOIN rm_info USING(RiceMillingID) GROUP BY RiceMillingID = '3';";
              //$sql_sum = "SELECT SUM(Number_of_sacks) AS total_sacks FROM queue INNER JOIN rm_info USING(RiceMillingID) GROUP BY RiceMillingID ORDER BY total_sacks DESC ;";
              //$result_sum =mysqli_query($conn, $sql_sum);
              //$row_sum = mysqli_fetch_assoc($result_sum);
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
                    // while ($row_sum = mysqli_fetch_assoc($result_sum)) {
                    //   $rice_type = $row_sum['rice_type'];
                    //   $total_sacks = $row_sum['total_sacks'];
                    //} 
                    ?>
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
            <!-- เริ่มตารางแสดงประเภทข้าวทั้งหมด -->
            <div class="row mt-4">
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
              <div class="col-lg-12">
                <div class="table">
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
                          <td><?= $row['rice_price_pui_bag'] ?> บาท</td>
                          <td><?= $row['rice_price_parn_bag'] ?> บาท</td>
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