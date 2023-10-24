<?php
$last_updated_file = '../last_updated/last_updated.txt';

// ตรวจสอบว่าไฟล์ถูกสร้างหรือไม่
if (file_exists($last_updated_file)) {
// อ่านข้อมูลจากไฟล์
$last_updated = file_get_contents($last_updated_file);
} else {
// หากไฟล์ยังไม่ถูกสร้างให้ใช้วันเวลาปัจจุบัน
$last_updated = date('Y-m-d');
}

// ดึงวันเวลาปัจจุบัน
$current_date = date('Y-m-d');

// ตรวจสอบว่าวันปัจจุบันแตกต่างจากวันที่สร้างครั้งล่าสุดหรือไม่
if ($current_date > $last_updated) {
// อัปเดต $current_time ด้วยเวลาปัจจุบัน
$current_time = date('Y-m-d');

// บันทึกข้อมูลวันที่ล่าสุดลงในไฟล์
file_put_contents($last_updated_file, $current_date);
} else {
// ใช้ $current_time จากข้อมูลล่าสุด
$current_time = date('Y-m-d', strtotime($current_date));
}
?>