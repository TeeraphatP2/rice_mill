<?php
    session_start();
    include('../connect/conn.php');

    if (isset($_POST['edit_rice_type']) && ($_SESSION['rice_edit_id'])) {
        $rice_edit_id = $_SESSION['rice_edit_id'];
        $rice_type = $_POST['rice_type'];
        $rice_price_pui_bag = $_POST['rice_price_pui_bag'];
        $rice_price_parn_bag = $_POST['rice_price_parn_bag'];

        $sql = "UPDATE rm_info SET rice_type = '$rice_type', rice_price_pui_bag = '$rice_price_pui_bag', 
                rice_price_parn_bag = '$rice_price_parn_bag' WHERE RiceMillingID = '$rice_edit_id'";

        $result = mysqli_query($conn, $sql);
        
        if ($result){
            echo "แก้ไขข้อมูลเรียบร้อยแล้ว";
            header('location: ./queue.php');
        }else{
            echo "Error: " . $sql ."<br>". mysqli_error($conn);
        }
    }
?>