<?php
require 'cnn_db.php';

$emp_code    = trim($_POST['emp_code'] ?? '');
$fullname_th = trim($_POST['fullname_th'] ?? '');
$email       = trim($_POST['email'] ?? '');
$phone       = trim($_POST['phone'] ?? '');
$dept_id     = (int)($_POST['dept_id'] ?? 1);
$salary      = trim($_POST['salary'] ?? '');
$hired_at    = trim($_POST['hired_at'] ?? '');
// สร้างคำสั่ง SQL เก็บในตัวแปรก่อน
$sql = "
INSERT INTO employees (emp_code, fullname_th, email, phone, dept_id, salary, hired_at)
VALUES (
    '" . mysqli_real_escape_string($conn, $emp_code) . "',
    '" . mysqli_real_escape_string($conn, $fullname_th) . "',
    '" . mysqli_real_escape_string($conn, $email) . "',
    '" . mysqli_real_escape_string($conn, $phone) . "',
    '" . mysqli_real_escape_string($conn, $dept_id) . "',
    '" . mysqli_real_escape_string($conn, $salary) . "',
    '" . mysqli_real_escape_string($conn, $hired_at) . "'
)";
// รันคำสั่ง SQL
$query = mysqli_query($conn, $sql);
// เช็คผลลัพธ์ และกลับไปหน้า index

if ($query) {
    set_SweetAlert2('success', 'บันทึกสำเร็จ', 'เพิ่มพนักงานใหม่เรียบร้อยแล้ว');
    header('Location: employees.php'); exit;
} else {
    set_SweetAlert2('error', 'เกิดข้อผิดพลาด', mysqli_error($conn));
    header('Location: employees.php'); exit;
}
