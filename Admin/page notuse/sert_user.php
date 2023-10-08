<?php
include 'connect/conn.php';
$sert_name = $_POST["sert_name"];

$sql = "SELECT * FROM tb_user WHERE username LIKE '%$sert_name%' OR phone_number LIKE '%$sert_name%' ORDER BY username ASC ";
$result = mysqli_query($conn, $sql); //รันคำสั่งที่ถูกเก็บไว้ในตัวแปร $sql
$count = mysqli_num_rows($result); //เก็บผลที่ได้จากคำสั่ง $result เก็บไว้ในตัวแปร $count
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  <title>รายชื่อลูกค้า</title>
</head>

<body>
  <div class="container">
    <h1 class="text-center mt-3">แสดงข้อมูลสมาชิก</h1>
    <form action="sert_user.php" class="form-group my-3" method="POST">
      <div class="row">
        <div class="col-6">
          <input type="text" placeholder="ค้นหาชื่อลูกค้า" class="form-control" name="sert_name" required>
        </div>
        <div class="col-6">
          <input type="submit" value="ค้นหา" class="btn btn-info">
        </div>
      </div>

    </form>
    <?php if ($count > 0) { ?>
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>ลำดับ</th>
            <th>ชื่อผู้ใช้</th>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>เบอร์โทรศัพท์</th>
            <th>แก้ไข</th>
            <th>ลบ</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?php echo $row["username"]; ?></td>
              <td><?php echo $row["firstname"]; ?></td>
              <td><?php echo $row["lastname"]; ?></td>
              <td><?php echo $row["phone_number"]; ?></td>
              <!--แก้ไขข้อมูล-->
              <td><a href="edit_user.php?id=<?= $row["UserID"] ?>" class="btn btn-warning">แก้ไข</a></td>
              <!--ลบข้อมูล-->
              <td><a href="delete_user.php?id=<?= $row["UserID"] ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a></td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <div class="alert alert-danger">
        <b>ไม่พบข้อมูลลูกค้า!!</b>
      </div>
    <?php } ?>
    <a href="user.php" class="btn btn-success">กลับหน้าแรก</a>

  </div>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>