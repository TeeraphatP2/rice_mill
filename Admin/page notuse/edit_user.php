<?php
session_start();
include 'connect/conn.php';
$_SESSION['id_user'] = $_GET['id'];
$id_user = $_SESSION['id_user'];
$sql = "SELECT * FROM tb_user WHERE UserID='$id_user' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add member</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrab/css/bootstrap.min.css">
</head>

<body>
    <?= $_SESSION['id_user'] ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class=" h2 text-center  alert alert-warning mb-4 mt-4" role="alert"> แก้ไขข้อมูลสมาชิก </div>
                <form method="POST" action="edit_user_db.php">
                    <label>ชื่อผู้ใช้</label>
                    <input type="text" name="username" class="form-control" value=<?= $row['username'] ?>> <br>
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
</body>
<script src="assets/bootstrab/js/bootstrap.min.js"></script>

</html>