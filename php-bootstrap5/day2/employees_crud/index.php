<?php
// index.php - หน้าแสดงรายการพนักงาน + ฟอร์มเพิ่มข้อมูลใหม่
require 'db.php';

// ------------------------------------------------------
// 1) ดึงรายการพนักงานทั้งหมด (Join กับตารางแผนก)
// ------------------------------------------------------
$sql = "SELECT e.*, d.name_th AS dept_name
        FROM employees e
        LEFT JOIN departments d ON d.id = e.dept_id
        ORDER BY e.id DESC"; // เรียงจากรายการล่าสุด
$result = mysqli_query($conn, $sql);

// ------------------------------------------------------
// 2) ดึงรายการแผนกทั้งหมดไปใส่ใน dropdown ของฟอร์มเพิ่ม
// ------------------------------------------------------
$sql_dept = "SELECT id, name_th FROM departments ORDER BY name_th";
$dept_result = mysqli_query($conn, $sql_dept);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ระบบพนักงาน (PHP + MySQLi + Bootstrap 5)</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h1 class="mb-3">ระบบจัดการพนักงาน</h1>

    <!-- ปุ่มรีเฟรช/ล้างฟอร์มเล็กน้อย -->
    <div class="mb-3">
        <a href="index.php" class="btn btn-outline-secondary btn-sm">รีเฟรชหน้า</a>
    </div>

    <!-- =================== ตารางแสดงพนักงานทั้งหมด =================== -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            รายชื่อพนักงานทั้งหมด
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>รหัส</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>แผนก</th>
                            <th>อีเมล</th>
                            <th>โทรศัพท์</th>
                            <th class="text-end">เงินเดือน (บาท)</th>
                            <th>เริ่มงาน</th>
                            <th class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= h($row['id']) ?></td>
                                <td><?= h($row['emp_code']) ?></td>
                                <td><?= h($row['fullname_th']) ?></td>
                                <td><?= h($row['dept_name']) ?></td>
                                <td><?= h($row['email']) ?></td>
                                <td><?= h($row['phone']) ?></td>
                                <td class="text-end"><?= number_format($row['salary'], 2) ?></td>
                                <td><?= h($row['hired_at']) ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary" href="edit.php?id=<?= (int)$row['id'] ?>">แก้ไข</a>
                                    <a class="btn btn-sm btn-danger"
                                       href="delete_employee.php?id=<?= (int)$row['id'] ?>"
                                       onclick="return confirm('ยืนยันลบข้อมูลพนักงานคนนี้?');">ลบ</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="9" class="text-center py-4">ยังไม่มีข้อมูลพนักงาน</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- =================== ฟอร์มเพิ่มข้อมูลพนักงาน =================== -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            เพิ่มข้อมูลพนักงานใหม่
        </div>
        <div class="card-body">
            <!-- ใช้ Grid ของ Bootstrap: row g-3 -->
            <form action="insert_employee.php" method="post" class="row g-3">
                <!-- รหัสพนักงาน -->
                <div class="col-md-3">
                    <label class="form-label">รหัสพนักงาน</label>
                    <input type="text" name="emp_code" class="form-control" required>
                </div>

                <!-- ชื่อ-นามสกุล -->
                <div class="col-md-5">
                    <label class="form-label">ชื่อ-นามสกุล (ไทย)</label>
                    <input type="text" name="fullname_th" class="form-control" required>
                </div>

                <!-- อีเมล -->
                <div class="col-md-4">
                    <label class="form-label">อีเมล</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <!-- โทรศัพท์ -->
                <div class="col-md-3">
                    <label class="form-label">โทรศัพท์</label>
                    <input type="text" name="phone" class="form-control" placeholder="081-xxx-xxxx">
                </div>

                <!-- แผนก (Dropdown จากตาราง departments) -->
                <div class="col-md-4">
                    <label class="form-label">แผนก</label>
                    <select name="dept_id" class="form-select" required>
                        <option value="">-- เลือกแผนก --</option>
                        <?php if ($dept_result && mysqli_num_rows($dept_result) > 0): ?>
                            <?php while ($d = mysqli_fetch_assoc($dept_result)): ?>
                                <option value="<?= (int)$d['id'] ?>"><?= h($d['name_th']) ?></option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- เงินเดือน -->
                <div class="col-md-3">
                    <label class="form-label">เงินเดือน (บาท)</label>
                    <input type="number" name="salary" class="form-control" step="0.01" min="0" value="0" required>
                </div>

                <!-- วันที่เริ่มงาน -->
                <div class="col-md-2">
                    <label class="form-label">วันที่เริ่มงาน</label>
                    <input type="date" name="hired_at" class="form-control" required>
                </div>

                <!-- ปุ่มบันทึก -->
                <div class="col-12">
                    <button type="submit" class="btn btn-success">บันทึกพนักงานใหม่</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS (ถ้าต้องใช้ components ของ Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
