<?php
    
    session_start();
    include('../connect/conn.php');

    $errors = array();

    if (isset($_POST['register_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['c_password']);

        if (empty($username)){
            array_push($errors, "กรุณากรอกชื่อผู้ใช้");
        }
        if (empty($firstname)){
            array_push($errors, "กรุณากรอกชื่อ");
        }
        if (empty($lastname)){
            array_push($errors, "กรุณากรอกนามสกุล");
        }
        if (empty($phoneNumber)){
            array_push($errors, "กรุณากรอกเบอร์โทรศัพท์");
        }
        if (empty($password_1)){
            array_push($errors, "กรุณากรอกรหัสผ่าน");
        }
        if ($password_1 !== $password_2){
            array_push($errors, "รหัสผ่านไม่ตรงกัน");
        }
        
        
        $user_check_query = " SELECT * FROM tb_user WHERE username = '$username' ";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);
        
        if ($result) { //ถ้ามี user อยู่ในระบบ
            if ($result['username'] === $username){
                array_push($errors,"มีชื่อผู้ใช้แล้วในระบบแล้ว");
            }
            if ($result['phone_number'] === $phoneNumber){
                array_push($errors,"มีเบอร์โทรอยู่ในระบบแล้ว");
            }
        }

        if (count($errors) == 0){
            $password = password_hash($password_1, PASSWORD_DEFAULT);
            $sql = "INSERT INTO tb_user (username,firstname,lastname,phone_number,password) VALUES ('$username','$firstname','$lastname','$phoneNumber','$password')";
            mysqli_query($conn, $sql);

            $alert = '<script>';
            $alert .= 'alert("สมัครสมาชิกเรียบร้อย");';
            $alert .= 'window.location.href = "register.php";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else{
            array_push($errors, "ชื่อผู้ใช้ หรือ เบอร์โทรศัพ มีอยู่ในระบบแล้ว");
            $_SESSION['error'] = "ชื่อผู้ใช้ หรือ เบอร์โทรศัพ มีอยู่ในระบบแล้ว";
            header("location: register.php");
        }
    }
