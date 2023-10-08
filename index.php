<?php

include_once './connect/conn.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/bootstrab/css/bootstrap.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.min.css">

  <title>รายการสีข้าวโรงสีข้าวไพศาลวัฒนา</title>
</head>

<body>
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 border-bottom bg-success">
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="text-center text-white" style="font-size: 30px;">รายการสีข้าวโรงสีข้าวไพศาลวัฒนา</li>
      </ul>

      
    </header>
    <div class="table-responsive text-center">
      <?php
      $sql = "SELECT * FROM `queue` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID);";
      $result = mysqli_query($conn, $sql);
      ?>
      <table class="table table-striped table-bordered table-hover">
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
          <?php
          $sql_queue = "SELECT * FROM `queue_arranged` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID) ORDER BY `time_queue_arranged` ASC";
          $result_queue = mysqli_query($conn, $sql_queue);
          ?>
          <?php $i = 1 ?>
          <?php foreach ($result_queue as $row) : ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $row['firstname'] . " " . $row['lastname'] ?></td>
              <td><?= $row['rice_type'] ?> </td>
              <td><?= $row['Number_of_sacks'] . " ถุง"?> </td>
              <td><?= $row['rice_mill_price'] . " บาท"?> </td>
              <td><?= $row['status'] ?> </td>
              <td><a href="./mpdf/pdf.php?user_id_slip=<?= $row['QueueID'] ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="content">
    <!-- ข้อความแจ้งเตือน -->
    <?php //if (isset($_SESSION['success'])) : 
    ?>
    <div class="success">
      <h3>
        <?php
        //echo $_SESSION['success'];
        //unset($_SESSION['success']);
        ?>
      </h3>
    </div>
    <?php //endif 
    ?>


  </div>
  <script src="assets/bootstrab/js/bootstrap.min.js"></script>
</body>

</html>