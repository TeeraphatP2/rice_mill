<?php
require '../connect/conn.php';
session_start();
if (isset($_POST['report'])) {
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];

  $sql_sum_rice_type_report ="SELECT SUM(Number_of_sacks) AS total_sacks, rm_info.rice_type AS rice_type
                              FROM `queue_arranged` 
                              INNER JOIN tb_user USING(UserID) 
                              INNER JOIN rm_info USING(RiceMillingID) 
                              WHERE DATE(time_of_booking) BETWEEN '$start_date' AND '$end_date' 
                              GROUP BY rm_info.rice_type 
                              UNION ALL 
                              SELECT SUM(Number_of_sacks) AS 'total_sacks' , 'สรุปรวมทั้งหมด' AS rice_type
                              FROM `queue_arranged` 
                              INNER JOIN tb_user USING(UserID) 
                              INNER JOIN rm_info USING(RiceMillingID) 
                              WHERE DATE(time_of_booking) BETWEEN '$start_date' AND '$end_date';";

  $result_sum_rice_type_report = mysqli_query($conn, $sql_sum_rice_type_report);

  $sql_rice_type_report = "SELECT * FROM `queue_arranged` 
                    INNER JOIN tb_user USING(UserID) 
                    INNER JOIN rm_info USING(RiceMillingID) 
                    WHERE DATE(time_of_booking) BETWEEN '$start_date' AND '$end_date'
                    ORDER BY `time_queue_arranged` ASC; ";
  $result_rice_type_report = mysqli_query($conn, $sql_rice_type_report);

};


// ------------------------------------------------------------------------------------------------------
require_once("vendor/autoload.php");
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
  'mode' => 'utf-8',
  'orientation' => 'P',
  'fontDir' => array_merge($fontDirs, [
    __DIR__ . '/vendor/mpdf/mpdf/ttfonts',
  ]),
  'fontdata' => $fontData + [
    'frutiger' => [
      'R' => 'THSarabunNew.ttf',
      'I' => 'THSarabun-Italic.ttf',

    ]
  ],
  'default_font' => 'frutiger'
]);
ob_start();
?>
<style>
  table {
    width: 100%; /* ทำให้ตารางเต็มขอบ */
    border-collapse: collapse; /* รวมเส้นขอบของเซลล์ */
  }
  th, td {
    padding: 8px; /* เพิ่มระยะห่างรอบขอบของเซลล์ */
  }

</style>
</head>

<body>

  <h1 style="margin-bottom: 0px; text-align:center;">โรงสีข้าวไพศาลวัฒนา</h1>
  <h2 style="text-align:center;">รายงานประเภทข้าวที่นำมาสีวันที่ <?= $start_date ?> ถึง <?= $end_date ?> </h2>

  <h2 style="text-align:center;">===========================================================================</h2>
  <table style="text-align: center;">
    <tr class="thbg">
      <th style="text-align: center;">ลำดับที่</th>
      <th style="text-align: center;">ชนิดข้าว</th>
      <th style="text-align: center;">จำนวนถุง</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($result_rice_type_report as $row) : ?>
    <tr>
      <td style="text-align: center;"><?= $i++ ?></td>
      <td><?= $row['rice_type'] ?></td>
      <td style="text-align: center;"><?= number_format($row['Number_of_sacks']) . " ถุง" ?></td>
    </tr>
    <?php endforeach ?>
  </table>

  <br>
  <h1 style="text-align:center;">สรุป</h1>

  <table>
    <tr class="thbg">
      <th style="text-align: center;">ชนิดข้าว</th>
      <th style="text-align: center;">จำนวนถุง</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($result_sum_rice_type_report as $row) : ?>
    <tr>
      <td style="font-weight: bold;"><?= $row['rice_type'] ?></td>
      <td style="font-weight: bold; text-align: center"><?= number_format($row['total_sacks']) . " ถุง" ?></td>
    </tr>
    <?php endforeach ?>

  </table>
  <?php
  $content = ob_get_contents();
  ob_end_clean();
  $stylesheet = file_get_contents('style.css');
  $mpdf->WriteHTML($stylesheet, 1);
  $mpdf->WriteHTML($content);
  $mpdf->Output("rice_mill_report"  . ".pdf", "I");
  exit;
