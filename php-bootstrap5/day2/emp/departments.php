<?php
require 'cnn_db.php';
$flash = $_SESSION['flash'] ?? [];
unset($_SESSION['flash']);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <title>Departments</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">
    <!-- jQuery (จำเป็นสำหรับ DataTables) -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- bootstrap-icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


    <!-- DataTables + Bootstrap 5 JS -->
    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.3.2/b-3.2.4/b-html5-3.2.4/datatables.min.css" rel="stylesheet" integrity="sha384-jkZH0ncSUp7q0g3KlKZvWtf3/8cl+/GzEoLGWboqHc3Yul50jTTbOLzdBvAeqAqx" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.3.2/b-3.2.4/b-html5-3.2.4/datatables.min.js" integrity="sha384-Gj0CD9iiuSDLx+g/znHqTGye3nq8D0Ru5Bp1hMddGARyLMtsbaAC90xlvc+PuBkL" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
</head>

<body>
    <?php include_once('nav.php'); ?>
    <div class="container" style="padding-top:70px">
        <h2 class="mb-3"><i class="bi bi-diagram-3"></i> ข้อมูลฝ่าย</h2>
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
        <div class="table-responsive">
            <table class="table table-dark table-hover table-striped table-bordered" id="departmentsTable">
                <thead>
                    <tr>
                        <th class="text-start">รหัสฝ่าย</th>
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
                                <td class="text-start"><?= $row['id'] ?></td>
                                <td><?= $row['name_th'] ?></td>
                                <td><?= $row['short_name'] ?></td>
                                <td class="text-nowrap">
                                    <a href="edit_departments.php?id_edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>

                                    <!-- ปุ่มลบ -->
                                    <a href="javascript:void(0);"
                                        class="btn btn-sm btn-danger btn-delete"
                                        data-id="<?= $row['id'] ?>"
                                        data-name="<?= $row['name_th'] ?>">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center py-4">ยังไม่มีข้อมูล</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div> <!-- container -->
    <script>
        $(document).ready(function() {
            $('#departmentsTable').DataTable({
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
                         url("https://media.giphy.com/images/sIIhZliB2McAo/giphy.gif")
                        left top
                        no-repeat
                        `
                         //  url("/images/cat.gif")
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // ไปหน้า delete
                            window.location.href = `delete_departments.php?id_delete=${id}`;
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>