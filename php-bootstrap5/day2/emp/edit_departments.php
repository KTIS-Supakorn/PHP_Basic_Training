<?php
require 'cnn_db.php';

$id = isset($_GET['id_edit']) ? (int)$_GET['id_edit'] : 0;

$sql = "SELECT * FROM departments WHERE id = {$id} LIMIT 1";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

if (!$row) {
    exit('ไม่พบข้อมูลพนักงานที่ต้องการแก้ไข');
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <title>Departments</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>

<body>
    <?php include_once('nav.php'); ?>
    <div class="container" style="padding-top:70px">
        <h2 class="mb-3"><i class="bi bi-diagram-3"></i> แก้ข้อมูลฝ่าย</h2>
        <!-- =================== ฟอร์มเพิ่มข้อมูล=================== -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                แก้ไขข้อมูลDepartments
            </div>
            <div class="card-body">
                <!-- ใช้ Grid ของ Bootstrap: row g-3 -->
                <form action="update_departments.php" method="post" class="row g-3">
                    <input type="hidden" name="id" value="<?=$row['id']?>">
                    <!-- ชื่อฝ่าย -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ชื่อฝ่าย</label>
                        <input type="text" name="name_th" id="name_th" class="form-control"  value="<?=$row['name_th']?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ชื่อย่อ</label>
                        <input type="text" name="short_name" id="short_name"  value="<?=$row['short_name']?>" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- ปุ่มบันทึก -->
                            <button type="submit" class="btn btn-outline-primary">✅ บันทึก</button>
                            <!-- ปุ่มยกเลิก -->
                            <button type="reset" class="btn btn-outline-danger">❌ ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- container -->
</body>

</html>