<?php
require 'cnn_db.php';
//update_employee.php
// ---------------------------------------------
// รับค่าจากฟอร์ม
// ---------------------------------------------
$id          = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$emp_code    = trim($_POST['emp_code'] ?? '');
$fullname_th = trim($_POST['fullname_th'] ?? '');
$email       = trim($_POST['email'] ?? '');
$phone       = trim($_POST['phone'] ?? '');
$dept_id     = trim($_POST['dept_id'] ?? '');
$salary      = trim($_POST['salary'] ?? 0);
$hired_at    = trim($_POST['hired_at'] ?? '');

// ---------------------------------------------
// สร้างคำสั่ง SQL เก็บในตัวแปรก่อน แล้วค่อย mysqli_query()
// ใช้ mysqli_real_escape_string() เพื่อความปลอดภัยระดับพื้นฐาน
// ---------------------------------------------
$sql = "
UPDATE employees
SET
    emp_code = '".mysqli_real_escape_string($conn, $emp_code)."',
    fullname_th = '".mysqli_real_escape_string($conn, $fullname_th)."',
    email = '".mysqli_real_escape_string($conn, $email)."',
    phone = '".mysqli_real_escape_string($conn, $phone)."',
    dept_id = '".mysqli_real_escape_string($conn, $dept_id)."',
    salary = '".mysqli_real_escape_string($conn, $salary)."',
    hired_at = '".mysqli_real_escape_string($conn, $hired_at)."'
WHERE id = {$id}
";

// รันคำสั่ง
$query = mysqli_query($conn, $sql);

// กลับหน้า index
if ($query) {
    set_SweetAlert2('success', 'แก้ไขข้อมูลสำเร็จ', 'แก้ไขพนักงานใหม่เรียบร้อยแล้ว');
    header('Location: employees.php'); exit;
} else {
    set_SweetAlert2('error', 'เกิดข้อผิดพลาด', mysqli_error($conn));
    header('Location: employees.php'); exit;
}