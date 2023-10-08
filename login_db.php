<?php
    session_start();
    include('connect/conn.php');

    $errors = array();

    if (isset($_POST['login_user'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($username)){
            array_push($errors, "กรุณากรอกชื่อผู้ใช้");
        }
        if (empty($password)){
            array_push($errors, "กรุณากรอกรหัสผ่าน");
        }

        if (count($errors) == 0){
            $query = "SELECT * FROM tb_user WHERE username = '$username' ";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['password'])) {
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "ตอนนี้คุณเข้าสู่ระบบแล้ว";
                    header("location: index.php");
                } else {
                    array_push($errors, "ชื่อผู้ใช้/รหัสผ่าน ผิด");
                    $_SESSION['error'] = "ชื่อผู้ใช้ หรือ รหัสผ่าน ผิด กรุณาลองอีกครั้ง";
                    header("location: login.php");
                }
            } else {
                array_push($errors, "ชื่อผู้ใช้/รหัสผ่าน ผิด");
                $_SESSION['error'] = "กรุณาลองอีกครั้ง";
                header("location: login.php");
            }
        }
    }
?>