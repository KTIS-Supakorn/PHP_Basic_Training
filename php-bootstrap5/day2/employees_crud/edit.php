<?php
// edit.php - แสดงฟอร์มแก้ไขข้อมูลของพนักงานตาม id
require 'db.php';

// ---------------------------------------------
// 1) รับค่า id จาก query string และดึงข้อมูลพนักงาน
// ---------------------------------------------
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM employees WHERE id = {$id} LIMIT 1";
$res = mysqli_query($conn, $sql);
$emp = mysqli_fetch_assoc($res);

// ถ้าไม่พบข้อมูล ให้แจ้งและจบการทำงาน
if (!$emp) {
    exit('ไม่พบข้อมูลพนักงานที่ต้องการแก้ไข');
}

// ---------------------------------------------
// 2) ดึงรายการแผนกทั้งหมดเพื่อใช้ใน dropdown
// ---------------------------------------------
$sql_dept = "SELECT id, name_th FROM departments ORDER BY name_th";
$dept_result = mysqli_query($conn, $sql_dept);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลพนักงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h1 class="mb-3">แก้ไขข้อมูลพนักงาน</h1>

    <div class="mb-3">
        <a href="index.php" class="btn btn-secondary btn-sm">← กลับหน้ารายการ</a>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white">ฟอร์มแก้ไข</div>
        <div class="card-body">
            <form action="update_employee.php" method="post" class="row g-3">
                <!-- เก็บ id ไว้ส่งไปตอนบันทึก -->
                <input type="hidden" name="id" value="<?= (int)$emp['id'] ?>">

                <div class="col-md-3">
                    <label class="form-label">รหัสพนักงาน</label>
                    <input type="text" name="emp_code" class="form-control" value="<?= h($emp['emp_code']) ?>" required>
                </div>

                <div class="col-md-5">
                    <label class="form-label">ชื่อ-นามสกุล (ไทย)</label>
                    <input type="text" name="fullname_th" class="form-control" value="<?= h($emp['fullname_th']) ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">อีเมล</label>
                    <input type="email" name="email" class="form-control" value="<?= h($emp['email']) ?>">
                </div>

                <div class="col-md-3">
                    <label class="form-label">โทรศัพท์</label>
                    <input type="text" name="phone" class="form-control" value="<?= h($emp['phone']) ?>">
                </div>

                <div class="col-md-4">
                    <label class="form-label">แผนก</label>
                    <select name="dept_id" class="form-select" required>
                        <option value="">-- เลือกแผนก --</option>
                        <?php if ($dept_result && mysqli_num_rows($dept_result) > 0): ?>
                            <?php while ($d = mysqli_fetch_assoc($dept_result)): ?>
                                <option value="<?= (int)$d['id'] ?>" <?= ((int)$d['id'] === (int)$emp['dept_id']) ? 'selected' : '' ?>>
                                    <?= h($d['name_th']) ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">เงินเดือน (บาท)</label>
                    <input type="number" name="salary" class="form-control" step="0.01" min="0" value="<?= h($emp['salary']) ?>" required>
                </div>

                <div class="col-md-2">
                    <label class="form-label">วันที่เริ่มงาน</label>
                    <input type="date" name="hired_at" class="form-control" value="<?= h($emp['hired_at']) ?>" required>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                    <a href="index.php" class="btn btn-outline-secondary">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
