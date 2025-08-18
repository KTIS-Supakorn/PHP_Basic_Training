<?php
require 'cnn_db.php';

$id          = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$name_th    = trim($_POST['name_th'] ?? '');
$short_name = trim($_POST['short_name'] ?? '');

$sql = "
UPDATE departments
SET
    name_th = '".mysqli_real_escape_string($conn, $name_th)."',
    short_name = '".mysqli_real_escape_string($conn, $short_name)."'
WHERE id = {$id}
";

// รันคำสั่ง
$query = mysqli_query($conn, $sql);

if ($query) {
    set_SweetAlert2('success', 'แก้ไขข้อมูลสำเร็จ', 'แก้ไขฝ่ายเรียบร้อยแล้ว');
    header('Location: departments.php'); exit;
} else {
    set_SweetAlert2('error', 'เกิดข้อผิดพลาด', mysqli_error($conn));
    header('Location: departments.php'); exit;
}