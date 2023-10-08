<?php
    session_start();
    include('../connect/conn.php');

    if (isset($_POST['edit_queue']) && ($_SESSION['queue_edit_id'])) {
        $num_sack = $_POST['num_sack'];
        $rice_mill_price = $_POST['rice_mill_price'];
        $queue_edit_id = $_SESSION['queue_edit_id'];

        $sql = "UPDATE `queue` SET Number_of_sacks = '$num_sack', rice_mill_price = '$rice_mill_price' WHERE QueueID = '$queue_edit_id'";

        $result = mysqli_query($conn, $sql);
        
        if ($result){
            $alert = '<script>';
            $alert .= 'alert("แก้ไขข้อมูลเรียบร้อยแล้ว");';
            $alert .= 'window.location.href = "./queue.php";';
            $alert .= '</script>';
            echo $alert;
            exit();
        }else{
            echo "Error: " . $sql ."<br>". mysqli_error($conn);
        }
    }
?>