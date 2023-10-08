<?php
    
    session_start();
    include('connect/conn.php');

    $errors = array();

    if (isset($_POST['register_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['c_password']);

        if (empty($username)){
            array_push($errors, "กรุณากรอกชื่อผู้ใช้");
        }
        if (empty($password_1)){
            array_push($errors, "กรุณากรอกรหัสผ่าน");
        }
        if ($password_1 !== $password_2){
            array_push($errors, "รหัสผ่านไม่ตรงกัน");
        }
        
        
        $user_check_query = " SELECT * FROM `admin` WHERE username = '$username' ";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);
        
        if ($result) { //ถ้ามี user อยู่ในระบบ
            if ($result['username'] === $username){
                array_push($errors,"มีชื่อแอดมินในระบบแล้ว");
            }
        }

        if (count($errors) == 0){
            $password = password_hash($password_1, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `admin` (username,password) VALUES ('$username','$password')";
            mysqli_query($conn, $sql);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "ตอนนี้คุณเข้าสู่ระบบแล้ว";
            header('location: index.php');
        } else{
            array_push($errors, "ชื่อผู้ใช้ หรือ เบอร์โทรศัพ มีอยู่ในระบบแล้ว");
            $_SESSION['error'] = "ชื่อผู้ใช้ หรือ เบอร์โทรศัพ มีอยู่ในระบบแล้ว";
            header("location: register.php");
        }
    }

?>