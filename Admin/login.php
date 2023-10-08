<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrab/css/bootstrap.min.css">
    <title>login</title>
</head>

<body>
    <div class="container px-4 mt-4">
        <div class="row justify-content-center">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">ล็อคอินเข้าสู่ระบบ</h1>
            </div>
            <div class="modal-body p-5 pt-0">
                <form action="login_db.php" method="post">
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="error">
                            <h3>
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </h3>
                        </div>
                    <?php endif ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com" name="username">
                        <label for="floatingInput">ชื่อผู้ใช้</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">รหัสผ่าน</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit" name="login_user">Sign up</button>
                    <p>ยังไม่เป็นสมาชิก? <a href="register.php">สมัครสมาชิก</a></p>
                </form>

            </div>
        </div>
    </div>
    <script src="assets/bootstrab/js/bootstrap.min.js"></script>
</body>

</html>