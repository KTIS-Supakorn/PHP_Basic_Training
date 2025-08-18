<?php
require 'cnn_db.php';
$flash = $_SESSION['flash'] ?? [];
unset($_SESSION['flash']);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <title>ข้อมูลพนักงาน</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">
    <!-- DataTables + Bootstrap 5 JS -->
    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.3.2/b-3.2.4/b-html5-3.2.4/datatables.min.css" rel="stylesheet" integrity="sha384-jkZH0ncSUp7q0g3KlKZvWtf3/8cl+/GzEoLGWboqHc3Yul50jTTbOLzdBvAeqAqx" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.3.2/b-3.2.4/b-html5-3.2.4/datatables.min.js" integrity="sha384-Gj0CD9iiuSDLx+g/znHqTGye3nq8D0Ru5Bp1hMddGARyLMtsbaAC90xlvc+PuBkL" crossorigin="anonymous"></script>

 <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include_once('nav.php'); ?>

    <div class="container" style="padding-top:70px">
        <h2 class="mb-3"><i class="bi bi-people"></i> ข้อมูลพนักงาน</h2>

        <!-- ฟอร์มเพิ่มข้อมูล -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                เพิ่มข้อมูลพนักงาน
            </div>
            <div class="card-body">
                <form action="insert_employee.php" method="post" class="row g-3">
                    <!-- รหัสพนักงาน -->
                    <div class="col-md-3">
                        <label class="form-label">รหัสพนักงาน</label>
                        <input type="text" name="emp_code" class="form-control" required>
                    </div>
                    <!-- ชื่อ-นามสกุล -->
                    <div class="col-md-5">
                        <label class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" name="fullname_th" class="form-control" required>
                    </div>
                    <!-- อีเมล -->
                    <div class="col-md-4">
                        <label class="form-label">อีเมล</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="row mb-3">
                        <!-- เบอร์โทร -->
                        <div class="col-md-4">
                            <label class="form-label">เบอร์โทร</label>
                            <input type="text" name="phone" class="form-control">
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
                                ?>
                                        <option value="<?= $dep['id'] ?>">
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
                            <input type="number" name="salary" class="form-control" step="0.01" min="0">
                        </div>
                        <!-- วันที่เริ่มงาน -->
                        <div class="col-md-2 mb-3">
                            <label class="form-label">วันที่เริ่มงาน</label>
                            <input type="date" name="hired_at" class="form-control">
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-primary">✅ บันทึก</button>
                        <button type="reset" class="btn btn-outline-danger">❌ ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>

        <br>
        <div class="table-responsive">
            <table class="table table-dark table-hover table-striped table-bordered align-middle" id="employeesTable">
                <thead>
                    <tr>
                        <th>ไอดี</th>
                        <th>รหัสพนักงาน</th>
                        <th>ชื่อพนักงาน</th>
                        <th>email</th>
                        <th>เบอร์โทร</th>
                        <th>รหัสฝ่าย</th>
                        <th>เงินเดือน</th>
                        <th>วันที่เริ่มงาน</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // $sql = "SELECT * FROM employees";
                    $sql = "SELECT employees.*, 
                    departments.name_th AS dept_name
                    FROM employees
                    LEFT JOIN departments  ON departments.id = employees.dept_id
                    ORDER BY employees.id DESC";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0):
                        while ($row = mysqli_fetch_assoc($result)):
                            $hired = $row['hired_at'] ? date('d-m-Y', strtotime($row['hired_at'])) : '';
                    ?>
                            <tr style="white-space: nowrap;">
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['emp_code'] ?></td>
                                <td><?= $row['fullname_th'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['phone'] ?></td>
                                <td><?= $row['dept_id'] ?>: <?= $row['dept_name'] ?></td>
                                <td class="text-end"><?= number_format($row['salary'], 2) ?></td>
                                <td><?= $hired ?></td>
                                <td class="text-nowrap">
                                    <!-- แก้ไข -->
                                    <a href="edit_employee2.php?id_edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    <!-- ปุ่มลบ -->
                                    <!-- <a href="delete_employee.php?id_delete=<?= $row['id'] ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('ยืนยันลบข้อมูล รหัสพนักงาน <?= $row['emp_code'] . " " . $row['fullname_th'] ?> ?')">
                                        <i class="bi bi-trash"></i>
                                    </a> -->
                                    <!-- ปุ่มลบ -->
                                    <a href="javascript:void(0);"
                                        class="btn btn-sm btn-danger btn-delete"
                                        data-id="<?= $row['id'] ?>"
                                        data-name="<?= $row['fullname_th'] ?>">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endwhile;
                    else:
                        ?>
                        <tr>
                            <td colspan="9" class="text-center py-4">ยังไม่มีข้อมูล</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
       <script>
        $(document).ready(function() {
            $('#employeesTable').DataTable({
                dom: 'B<"row mb-3"<"col-md-6"l><"col-md-6 text-end"f>>tip',
                buttons: [
                    'copy', 'excel'
                ],

                order: [
                    [0, 'desc']
                ]
                // desc => มากไปน้อย asc => น้อยไปมาก
            });
        });
    </script>
     <?php if (!empty($flash)): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: "top-end",
                    toast: true,
                    icon: '<?= h($flash['type']) ?>',
                    title: '<?= h($flash['title']) ?>',
                    text: '<?= h($flash['text']) ?>',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
    <?php endif; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // จับคลิกปุ่มลบ
            document.querySelectorAll('.btn-delete').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');

                    Swal.fire({
                        title: 'ยืนยันการลบ?',
                        text: `คุณต้องการลบฝ่าย ${id} : ${name} หรือไม่`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'ลบข้อมูล',
                        cancelButtonText: 'ยกเลิก',
                        // background: "#fff url(/images/5eeea355389655.59822ff824b72.gif)",
                        backdrop: `
                        rgba(0,0,123,0.4)
                         url("https://media.giphy.com/media/sIIhZliB2McAo/giphy.gif")
                        left top
                        no-repeat
                        `
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // ไปหน้า delete
                            window.location.href = `delete_employee.php?id_delete=${id}`;
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>