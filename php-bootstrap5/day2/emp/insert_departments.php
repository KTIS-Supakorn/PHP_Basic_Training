<?php
require 'cnn_db.php';

$name_th    = trim($_POST['name_th'] ?? '');
$short_name = trim($_POST['short_name'] ?? '');
// สร้างคำสั่ง SQL เก็บในตัวแปรก่อน
$sql = "
INSERT INTO departments (name_th,short_name)
VALUES (
    '" . mysqli_real_escape_string($conn, $name_th) . "',
    '" . mysqli_real_escape_string($conn, $short_name) . "'
)";
// รันคำสั่ง SQL
$query = mysqli_query($conn, $sql);
// เช็คผลลัพธ์ และกลับไปหน้า index


if ($query) {
    set_SweetAlert2('success', 'บันทึกสำเร็จ', 'เพิ่มพนักงานใหม่เรียบร้อยแล้ว');
    header('Location: departments.php'); exit;
} else {
    set_SweetAlert2('error', 'เกิดข้อผิดพลาด', mysqli_error($conn));
    header('Location: departments.php'); exit;
}
