<?php
require '../connect/conn.php';
session_start();
if (isset($_POST['report'])) {
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $sql = "SELECT * FROM `queue_arranged` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID) WHERE DATE(time_of_booking) BETWEEN '$start_date' AND '$end_date';";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $sql_sum = "SELECT SUM(rice_mill_price) AS TotalSum
    FROM queue_arranged
    WHERE DATE(time_of_booking) BETWEEN '$start_date' AND '$end_date';";

    $result_sum = mysqli_query($conn, $sql_sum);
    $row_sum = mysqli_fetch_assoc($result_sum);
  }
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

</head>

<body>

  <h1 style="margin-bottom: 0px; text-align:center;">โรงสีข้าวไพศาลวัฒนา</h1>
  <h2 style="text-align:center;">รายงานการสีข้าววันที่ <?= $start_date ?> ถึง <?= $end_date ?> </h2>

  <h2 style="text-align:center;">===========================================================================</h2>
  <table>
    <tr class="thbg">
      <th>ลำดับที่</th>
      <th>ชื่อ-นามสกุล</th>
      <th>ชนิดข้าว</th>
      <th>จำนวนถุง</th>
      <th>เวลาที่รับข้าว</th>
      <th>ราคาสีข้าว</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($result as $row) : ?>
    <tr>
      <td><?= $i++ ?></td>
      <td><?= $row['firstname'] . " " . $row['lastname'] ?></td>
      <td><?= $row['rice_type'] ?></td>
      <td><?= number_format($row['Number_of_sacks']) . " ถุง" ?></td>
      <td><?= $row['time_of_booking'] ?></td>
      <td><?= number_format($row['rice_mill_price']) . " บาท" ?></td>
    </tr>
    <?php endforeach ?>
    <tr>
      <td colspan="5" style="text-align: right; font-weight: bold;">สรุปราคารวม</td>
      <td style="font-weight: bold;"><?= number_format($row_sum['TotalSum']) . " บาท" ?></td>
    </tr>
  </table>
  <?php
  $content = ob_get_contents();
  ob_end_clean();
  $stylesheet = file_get_contents('style.css');
  $mpdf->WriteHTML($stylesheet, 1);
  $mpdf->WriteHTML($content);
  $mpdf->Output("rice_mill_report"  . ".pdf", "I");
  exit;
