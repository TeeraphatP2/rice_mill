style="background-color:
<?php
$status = $row['status'];
switch ($status) {
    case 'รอดำเนินการ':
        echo '#2DCCFF';
        break;
    case 'กำลังดำเนินการ':
        echo '#FCE83A';
        break;
    case 'เสร็จสิ้น':
        echo '#56F000';
        break;
    case 'ลูกค้ารับข้าวไปแล้ว':
        echo '#A4ABB6';
        break;
    default:
        echo 'white'; // สีพื้นหลังเริ่มต้น
}
?>
"