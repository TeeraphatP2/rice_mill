<?php
include 'connect/conn.php';
$sql = "SELECT * FROM tb_user";
$result = mysqli_query($conn, $sql);

$count = mysqli_num_rows($result); //เก็บผลที่ได้จากคำสั่ง $result เก็บไว้ในตัวแปร $count
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>member</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrab/css/bootstrap.min.css">

</head>

<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-boredered">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>แก้ไข</th>
                            <th>ลบข้อมูล</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM tb_user";
                    $result = mysqli_query($conn, $sql);
                    $i = 1;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row["username"] ?></td>
                                <td><?= $row["firstname"] ?></td>
                                <td><?= $row["lastname"] ?></td>
                                <td><?= $row["phone_number"] ?></td>
                                <td><a href="edit_user.php?id=<?= $row['UserID'] ?>" class="btn btn-warning">แก้ไข</a> </td>
                                <td><a href="delete_user.php?id=<?= $row['UserID'] ?>" class="btn btn-danger" onclick="Del(this.href);return false;">ลบ</a> </td>
                            </tr>
                        </tbody>
                    <?php }
                    mysqli_close($conn); //ปิดการเชื่อมต่อฐานข้อมูล 
                    ?>
                    <table>
            </div>
        </div>
    </div>
    <script src="assets/bootstrab/js/bootstrap.min.js"></script>
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