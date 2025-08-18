<?php
require 'cnn_db.php';

$name_th    = trim( $_POST['name_th'] ?? '');
$short_name = trim( $_POST['short_name'] ?? '');
// สร้างคำสั่ง SQL เก็บในตัวแปรก่อน
$sql = "
INSERT INTO departments (name_th,short_name)
VALUES (
    '".mysqli_real_escape_string($conn, $name_th)."',
    '".mysqli_real_escape_string($conn, $short_name)."'
)";
// รันคำสั่ง SQL
$query = mysqli_query($conn, $sql);
// เช็คผลลัพธ์ และกลับไปหน้า index
if ($query) {
    header('Location: index.php');
    exit;
} else {
    echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
}
