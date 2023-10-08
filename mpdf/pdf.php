<?php
require '../connect/conn.php';
session_start();
if (isset($_GET['user_id_slip'])) {
  $user_id_slip = $_GET['user_id_slip'];
  $sql = "SELECT * FROM `queue_arranged` INNER JOIN tb_user USING(UserID) INNER JOIN rm_info USING(RiceMillingID) WHERE QueueID = '$user_id_slip';";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
};


// ------------------------------------------------------------------------------------------------------
require_once("vendor/autoload.php");
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
  'mode' => 'utf-8',
  'format' => [80, 160],
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
  *{
    margin: 0;
    padding: 0;
  }
  table {
    font-size: 19px;
  }
  th, td {
    border: none;
    padding-left: 0px;
    padding-right: 0px;
  }
</style>
</head>

<body>

  <h1 style="margin-bottom: 0px; text-align:center;">โรงสีข้าวไพศาลวัฒนา</h1>
  <h4 style="text-align: center;">-----------------------------------------------------------</h4>
  <table> 
    <tr>
      <td style="text-align: left;">ชื่อ-สกุล</td>
      <td style="text-align: right;"><?= $row['firstname'] . " " . $row['lastname'] ?></td>
    </tr>
    <tr>
      <td style="text-align: left;">ชนิดข้าว</td>
      <td style="text-align: right;"><?= $row['rice_type'] ?></td>
    </tr>
    <tr>
      <td style="text-align: left;">จำนวนถุง</td>
      <td style="text-align: right;"><?= $row['Number_of_sacks'] . " ถุง" ?></td>
    </tr>
    <tr>
      <td style="text-align: left;">เวลาที่รับข้าว</td>
      <td style="text-align: right;"><?= $row['time_of_booking'] ?></td>
    </tr>
  </table>
  <h4 style="text-align: center;">===============================</h4>
  <table>
  <tr>
      <td style="text-align: left; font-weight: bold;">ราคาสีข้าว</td>
      <td style="text-align: right; font-weight: bold;"><?= $row['rice_mill_price'] . " บาท" ?></td>
    </tr>
  </table>
  <h4 style="text-align: center;">===============================</h4>
  <h4 style="text-align: center; font-weight: normal;">โรงสีข้าวไพศาลวัฒนาขอบคุณที่มาใช้บริการ</h4>
  <?php
  $content = ob_get_contents();
  ob_end_clean();
  $stylesheet = file_get_contents('style.css');
  $mpdf->WriteHTML($stylesheet, 1);
  $mpdf->WriteHTML($content);
  $mpdf->Output("ใบเสร็จ"  . ".pdf", "I");
  exit;
