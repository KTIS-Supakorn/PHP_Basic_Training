<?php
// update_employee.php - รับข้อมูลจากฟอร์มแก้ไข แล้ว UPDATE ตาราง employees
require 'db.php';

// ---------------------------------------------
// รับค่าจากฟอร์ม
// ---------------------------------------------
$id          = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$emp_code    = $_POST['emp_code'] ?? '';
$fullname_th = $_POST['fullname_th'] ?? '';
$email       = $_POST['email'] ?? '';
$phone       = $_POST['phone'] ?? '';
$dept_id     = $_POST['dept_id'] ?? '';
$salary      = $_POST['salary'] ?? 0;
$hired_at    = $_POST['hired_at'] ?? '';

$emp_code    = trim($emp_code);
$fullname_th = trim($fullname_th);
$email       = trim($email);
$phone       = trim($phone);
$dept_id     = (int)$dept_id;
$salary      = (float)$salary;

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
    dept_id = {$dept_id},
    salary = {$salary},
    hired_at = '".mysqli_real_escape_string($conn, $hired_at)."'
WHERE id = {$id}
";

// รันคำสั่ง
$query = mysqli_query($conn, $sql);

// กลับหน้า index
if ($query) {
    header('Location: index.php');
    exit;
} else {
    echo "เกิดข้อผิดพลาดในการแก้ไขข้อมูล: " . mysqli_error($conn);
}
