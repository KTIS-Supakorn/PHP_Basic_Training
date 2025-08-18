<?php
// delete_employee.php - ลบข้อมูลพนักงานตาม id
require 'db.php';

// รับ id จาก query string
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// สร้างคำสั่ง SQL เก็บในตัวแปร
$sql = "DELETE FROM employees WHERE id = {$id} LIMIT 1";

// รันคำสั่ง
$query = mysqli_query($conn, $sql);

// กลับหน้า index
if ($query) {
    // header('Location: employees.php');
    echo "<script>
        alert('ลบข้อมูลสำเร็จ');
        window.location = 'employees.php';
    </script>";
    exit;
} else {
    echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
}
