<?php
    session_start();
    require_once 'connect/conn.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrab/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<section class="py-5" id="pageMain">
        <div class="container px-4 mt-4">
            <div class="row justify-content-center">
                <div class="col col-8 col-sm-6 col-lg-4 col-xl-3">
                    <h3>สมัครสามาชิก</h3>
                    <hr>
                <form action="register_db.php" method="post">
                    <?php include('errors.php'); ?>
                    <?php if (isset($_SESSION['error'])) : ?>
                    <div class="error">
                        <h3>
                            <?php 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            ?>
                        </h3>
                    </div>
                    <?php endif?>
                    <div class="mb-3">
                            <label for="username" class="form-label">ชื่อผู้ใช้</label>
                            <input type="text" class="form-control" name="username" aria-describedby="username">
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">ชื่อจริง</label>
                            <input type="text" class="form-control" name="firstname" aria-describedby="firstname">
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" name="lastname" aria-describedby="lastname">
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="number" class="form-control" name="phoneNumber" aria-describedby="phoneNumber">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm password" class="form-label">ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" name="c_password">
                        </div>
                        <button type="submit" name="register_user" class="btn btn-primary">สมัคร</button>
                        <p>เป็นสมาชิกแล้ว? <a href="login.php">ล็อคอิน</a></p>
                </form>
                </div>
            </div>
        </div>
    </section>
<script src="assets/bootstrab/js/bootstrap.min.js"></script>     
</body>
</html>