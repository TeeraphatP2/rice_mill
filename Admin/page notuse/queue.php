<!DOCTYPE html>
<html lang="en">
<?php include 'connect/conn.php' ?>
<?php
$sql = "SELECT * FROM `rice_milling_information`";
$result = mysqli_query($conn, $sql);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrab/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <!--   -->
        
    <!--  เพิ่มข้อมูล User end-->
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="text-primary">คิวทั้งหมด</h4>
                </div>
                <div>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addrice">เพิ่มประเภทข้าว</button>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#queue">จัดทำคิว</button>
                </div>
            </div>
        </div>
        <hr>
        <!-- เรื่มฟอร์มจัดทำคิว-->
        <div class="modal fade" tabindex="-1" id="queue">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-header">จัดการคิว</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" class="p-2">
                            <div class="mb-3 gx-3">
                                <div class="col">
                                    <select class="form-select form-select-lg" aria-label="Default select example" required>
                                        <option disabled selected >เลือกชนิดข้าว</option>
                                        <?php foreach ($result as $row) : ?>
                                            <option value="<?= $row['RiceMillingID'] ?>"> <?= $row['ricetype'] ?> [<?= $row['price'] ?>฿] </option>
                                        <?php endforeach ?>
                                        <div class="invalid-feedback">กรุณาชนิดข้าว</div>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="number" name="price" class="form-control form-control-lg" placeholder="ราคาสีข้าว" required>
                                </div>
                                <div class="md-3">
                                    <button class="btn btn-primary btn-block btn-lg mt-3" type="submit">Add queue</button>
                                    <!-- <input type="submit" value="" class="btn btn-primary btn-block btn-lg mt-3" id="add-queue-btn"> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- จบฟอร์มจัดทำคิว-->
        <!-- เริ่มฟอร์มเพิ่มชนิดข้าว-->
        <div class="modal fade" tabindex="-1" id="addrice">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-header">จัดการคิว</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Start Form -->
                        <form action="rice_add.php" method="post" class="p-2">
                            <div class="row mb-3 gx-3">
                                <div class="col">
                                    <input type="text" name="rice_name" class="form-control form-control-lg" placeholder="ชนิดข้าว" required>
                                </div>
                                <div class="col">
                                    <input type="number" name="price" class="form-control form-control-lg" placeholder="ราคาข้าว" required>
                                </div>
                                <div class="md-3">
                                    <button class="btn btn-primary btn-block btn-lg mt-3" type="submit">บันทึก</button>
                                </div>
                            </div>
                        </form>
                        <!-- End Form  -->
                    </div>
                </div>
            </div>
        </div>
        <!-- จบฟอร์มเพิ่มชนิดข้าว -->
        <div class="row">
            <div class="col-lg-12">
                <div id="showAlert"></div>
            </div>
        </div>
        <!-- เริ่มตารางแสดงคิวทั้งหมด -->
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <?php
                    $sql = "SELECT * FROM `queue` INNER JOIN tb_user USING(UserID)";
                    $result = mysqli_query($conn, $sql);
                    ?>
                    <table class="table table-striped table-boredered">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                                <th>เวลาที่สีข้าว/จองคิว</th>
                                <th>สถานะ</th>
                                <th>รายละเอียด</th>
                                <th>แก้ไข้</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row) : ?>
                                <tr>
                                    <td><?= $row['queue_number']?></td>
                                    <td><?= $row['firstname']?></td>
                                    <td><?= $row['lastname']?></td>
                                    <td><?= $row['time_of_booking']?></td>
                                    <td><?= $row['status']?></td>
                                    <td><a href="" class="btn btn-info btn-sm rounded-pull py-0">รายละเอียด</a></td>
                                    <td><a href="" class="btn btn-success btn-sm rounded-pull py-0 editlink">แก้ไข</a></td>
                                    <td><a href="" class="btn btn-danger btn-sm rounded-pull py-0 deletelink">ลบ</a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- จบตารางแสดงคิวทั้งหมด -->
        <!-- เริ่มตารางแสดงประเภทข้าวทั้งหมด -->
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="text-primary">ประเภทข้าว</h4>
                </div>
            </div>
        </div>
        <?php
        $sql = "SELECT * FROM `rice_milling_information`";
        $result = mysqli_query($conn, $sql);
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="table">
                    <table class="table table-striped table-boredered">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชนิดข้าว</th>
                                <th>ราคาข้าว</th>
                                <th>แก้ไข้</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($result as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['ricetype'] ?></td>
                                    <td><?= $row['price'] ?></td>
                                    <td><a href="" class="btn btn-success btn-sm rounded-pull py-0 editlink">แก้ไข</a></td>
                                    <td><a href="rice_delete.php?rice_id=<?= $row['RiceMillingID'] ?>" class="btn btn-danger btn-sm rounded-pull py-0 deletelink" onclick="return confirm('คุณต้องการลบ <?= $row['ricetype'] ?> หรือไม่')">ลบ</a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- จบตารางแสดงประเภทข้าวทั้งหมด-->
    <script src="assets/bootstrab/js/bootstrap.min.js"></script>
    <script src="dist/js/jquery-3.7.0.min.js"></script>
</body>

</html>