<?php
    session_start();
    include('../connect/conn.php');

    if (isset($_POST['status_update_sub']) && ($_SESSION['status_update_id'])) {
        $status_update = $_POST['status_update'];

        $sql = "UPDATE `queue_arranged` SET `status` ='$status_update' WHERE QueueID ='".$_SESSION['status_update_id']."'; ";
        
        $result = mysqli_query($conn, $sql);
        
        if ($result){
            $alert = '<script>';
            $alert .= 'alert("อัพเดตข้อมูลเรียบร้อยแล้ว");';
            $alert .= 'window.location.href = "./status.php";';
            $alert .= '</script>';
            echo $alert;
            exit();
        }else{
            echo "Error: " . $sql ."<br>". mysqli_error($conn);
        }
    }
?>