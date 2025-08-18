<?php
require 'cnn_db.php';
// ---------------------------------------------
// 1) รับค่า id จาก query string และดึงข้อมูลพนักงาน
// ---------------------------------------------
$id = isset($_GET['id_edit']) ? (int)$_GET['id_edit'] : 0;

$sql = "SELECT * FROM employees WHERE id = {$id} LIMIT 1";
$res = mysqli_query($conn, $sql);
$emp = mysqli_fetch_assoc($res);

// ถ้าไม่พบข้อมูล ให้แจ้งและจบการทำงาน
if (!$emp) {
    exit('ไม่พบข้อมูลพนักงานที่ต้องการแก้ไข');
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <title>แก้ไขข้อมูลพนักงาน</title>
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
        <h2 class="mb-3"><i class="bi bi-people"></i> แก้ไขข้อมูลพนักงาน</h2>

        <!-- ฟอร์มเพิ่มข้อมูล -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                แก้ไขข้อมูลพนักงาน
            </div>
            <div class="card-body">
                <form action="update_employee.php" method="post" class="row g-3">
                    <!-- เก็บ id ไว้ส่งไปตอนบันทึก -->
                    <input type="hidden" name="id" value="<?= $emp['id'] ?>">
                    <!-- รหัสพนักงาน -->
                    <div class="col-md-3">
                        <label class="form-label">รหัสพนักงาน</label>
                        <input type="text" name="emp_code" class="form-control" value="<?= $emp['emp_code'] ?>" required>
                    </div>
                    <!-- ชื่อ-นามสกุล -->
                    <div class="col-md-5">
                        <label class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" name="fullname_th" class="form-control" value="<?= $emp['fullname_th'] ?>" required>
                    </div>
                    <!-- อีเมล -->
                    <div class="col-md-4">
                        <label class="form-label">อีเมล</label>
                        <input type="email" name="email" class="form-control" value="<?= $emp['email'] ?>">
                    </div>

                    <div class="row mb-3">
                        <!-- เบอร์โทร -->
                        <div class="col-md-4">
                            <label class="form-label">เบอร์โทร</label>
                            <input type="text" name="phone" class="form-control" value="<?= $emp['phone'] ?>">
                        </div>
                        <!-- ฝ่าย -->
                        <div class="col-md-4">
                            <label class="form-label">ฝ่าย</label>
                            <select name="dept_id" class="form-select" required>
                                <option value="">-- เลือกฝ่าย --</option>
                                <?php
                                $dept_sql = "SELECT id, name_th, short_name FROM departments ORDER BY id";
                                $dept_rs  = mysqli_query($conn, $dept_sql);
                                if ($dept_rs && mysqli_num_rows($dept_rs) > 0):
                                    while ($dep = mysqli_fetch_assoc($dept_rs)):
                                        $selected = ($dep['id'] == $emp['dept_id']) ? 'selected' : '';
                                ?>
                                        <option value="<?= $dep['id'] ?>" <?= $selected ?>>
                                            <?= $dep['id'] . ": " . $dep['name_th'] . " " . $dep['short_name'] ?>
                                        </option>
                                <?php
                                    endwhile;
                                endif;
                                ?>
                            </select>

                        </div>
                        <!-- เงินเดือน -->
                        <div class="col-md-2">
                            <label class="form-label">เงินเดือน</label>
                            <input type="number" name="salary" class="form-control" step="0.01" min="0" value="<?= $emp['salary'] ?>">
                        </div>
                        <!-- วันที่เริ่มงาน -->
                        <div class="col-md-2 mb-3">
                            <label class="form-label">วันที่เริ่มงาน</label>
                            <input type="date" name="hired_at" class="form-control" value="<?= $emp['hired_at'] ?>">
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-primary">✅ บันทึก</button>
                        <button type="reset" class="btn btn-outline-danger">❌ ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>