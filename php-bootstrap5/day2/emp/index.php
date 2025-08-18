<?php
require 'cnn_db.php';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <title>Bootstrap Example</title>
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
        <h2 class="mb-3"><i class="bi bi-house-door"></i> หน้าแรก</h2>
        <!-- =================== ฟอร์มเพิ่มข้อมูล=================== -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                เพิ่มข้อมูลDepartments
            </div>
            <div class="card-body">
                <!-- ใช้ Grid ของ Bootstrap: row g-3 -->
                <form action="insert_departments.php" method="post" class="row g-3">
                    <!-- ชื่อฝ่าย -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ชื่อฝ่าย</label>
                        <input type="text" name="name_th" id="name_th" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ชื่อย่อ</label>
                        <input type="text" name="short_name" id="short_name" class="form-control">
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
        <hr>
        <table class="table table-dark table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th>รหัสฝ่าย</th>
                    <th>ชื่อฝ่าย</th>
                    <th>ชื่อย่อ</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <?php
            $sql = "SELECT * FROM departments";
            $result = mysqli_query($conn, $sql);
            ?>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name_th'] ?></td>
                            <td><?= $row['short_name'] ?></td>
                            <td>ปุ่ม</td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center py-4">ยังไม่มีข้อมูล</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div> <!-- container -->
</body>
</html>