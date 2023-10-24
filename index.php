<?php

include_once './connect/conn.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="10; url=" <?php echo $_SERVER['PHP_SELF']; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/bootstrab/css/bootstrap.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.min.css">

  <title>รายการสีข้าวโรงสีข้าวไพศาลวัฒนา</title>
  <style>
    .table td,
    .table th {
      white-space: nowrap;
    }
  </style>
</head>

<body>
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 border-bottom bg-success">
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="text-center text-white" style="font-size: 30px;">รายการสีข้าวโรงสีข้าวไพศาลวัฒนา</li>
      </ul>


    </header>
    <div class="table-responsive text-center">
      <div class="col col-12 col-sm-12 col-lg-12 col-xl-12">
        <table class="table table-striped table-bordered table-hover table-sm">
          <thead class="thead-dark"> <!-- Bootstrap class for table header -->
            <tr>
              <th>ลำดับที่</th>
              <th>ชื่อ-นามสกุล</th>
              <th>ชนิดข้าว</th>
              <th>จำนวนถุง</th>
              <th>ราคาสีข้าว</th>
              <th>สถานะ</th>
              <th>ดาวโหลดใบเสร็จ</th>
            </tr>
          </thead>
          <tbody>
            <?php //include 'update_currenttime.php'; 
            ?>
            <?php //$current_time = date("Y-m-d"); 
            ?>
            <?php
            //$sql_queue = "SELECT * FROM `queue_arranged` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID) WHERE `time_of_booking` >= '$current_time' AND `status` != 'ลูกค้ารับข้าวไปแล้ว' ORDER BY `time_queue_arranged` ASC;";
            $sql_queue = "SELECT * FROM `queue_arranged` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID) WHERE `status` != 'ลูกค้ารับข้าวไปแล้ว' AND (`status` = 'รอดำเนินการ' OR `status` = 'กำลังดำเนินการ' OR `status` = 'เสร็จสิ้น') ORDER BY `time_queue_arranged` ASC;";
            $result_queue = mysqli_query($conn, $sql_queue);
            ?>
            <?php $i = 1 ?>
            <?php foreach ($result_queue as $row) : ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?= $row['firstname'] . " " . $row['lastname'] ?></td>
                <td><?= $row['rice_type'] ?> </td>
                <td><?= $row['Number_of_sacks'] . " ถุง" ?> </td>
                <td><?= number_format($row['rice_mill_price']) . " บาท" ?> </td>
                <td <?php include './color_table.php'; ?>><?= $row['status'] ?> </td>
                <td><a href="./mpdf/pdf.php?user_id_slip=<?= $row['QueueID'] ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <a href="./Admin/" class="btn btn-primary btn-md" style="position: fixed; bottom: 10px; right: 10px;">
      Admin Login
    </a>
  </div>




  </div>
  <script src="assets/bootstrab/js/bootstrap.min.js"></script>
</body>

</html>