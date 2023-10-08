<?php
include '../connect/conn.php';

if (isset($_POST) && !empty($_POST)) {
    $rice_name = $_POST['rice_type'];
    $rice_price_pui_b = $_POST['rice_price_pui_b'];
    $rice_price_parn_b = $_POST['rice_price_parn_b'];

    //check
    if (!empty($rice_name)) {
        // INSERT INTO `rm_info` (`RiceMillingID`, `ricetype`, `price`) VALUES (NULL, 'ข้าวทอง', '500');
        // SELECT * FROM `rm_info WHERE rice_name =`
        $sql = "SELECT * FROM `rm_info` WHERE rice_type = '$rice_name'";
        $query1 = mysqli_query($conn, $sql); //Protype_name
        $row_rice_name = mysqli_num_rows($query1);
        if ($row_rice_name > 0) {
            echo '<script>
                                alert("มีชนิดข้าวนี้แล้ว");
                                window.location.href = "queue.php";
                                </script>';
            exit();
        } else {
            $sql = "INSERT INTO `rm_info` (`rice_type`, `rice_price_pui_bag`, `rice_price_parn_bag`) 
            VALUES ('$rice_name', '$rice_price_pui_b', '$rice_price_parn_b')";
            if (mysqli_query($conn, $sql)) {
                $alert = '<script>';
                $alert .= 'alert("เพิ่มประเภทข้าวสำเร็จ");';
                $alert .= 'window.location.href = "queue.php";';
                $alert .= '</script>';
                echo $alert;
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
}
