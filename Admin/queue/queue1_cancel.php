<?php
include_once '../connect/conn.php';
if (isset($_GET['queue1_cancel_id']) && !empty($_GET['queue1_cancel_id'])) {
    $sql = "SELECT * FROM `queue_arranged` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID) 
        WHERE QueueID = '" . $_GET['queue1_cancel_id'] . "' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {

        $row = mysqli_fetch_assoc($result);

        $status = $row['status'];
        $time_of_booking = $row['time_of_booking'];
        $Number_of_sacks = $row['Number_of_sacks'];
        $rice_mill_price = $row['rice_mill_price'];
        $UserID = $row['UserID'];
        $RiceMillingID = $row['RiceMillingID'];

        $sql_queue = "INSERT INTO `queue` (`status`, `time_of_booking`, `Number_of_sacks`, `rice_mill_price`, 
                        `UserID`, `RiceMillingID`) 
                        VALUES('$status', '$time_of_booking', '$Number_of_sacks', '$rice_mill_price', '$UserID', '$RiceMillingID');";
        $result_queue = mysqli_query($conn, $sql_queue);

        if ($result_queue) {

            $sql_del = "DELETE FROM `queue_arranged` WHERE QueueID = '".$_GET['queue1_cancel_id']."' ";
            mysqli_query($conn, $sql_del);

            $alert = '<script>';
            $alert .= 'alert("ยกเลิกคิวเรียบร้อย");';
            $alert .= 'window.location.href = "./queue1.php";';
            $alert .= '</script>';
            echo $alert;
            exit();
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
