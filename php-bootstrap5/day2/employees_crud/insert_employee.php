<?php
// insert_employee.php - รับข้อมูลจากฟอร์ม แล้วบันทึกเข้าตาราง employees
require 'db.php';

// ---------------------------------------------
// รับค่าจากฟอร์ม (แบบง่ายๆ สำหรับมือใหม่)
// หมายเหตุ: ตัวอย่างนี้ "ไม่ใช้ prepared statement" ตามโจทย์
// แนะนำให้ตรวจ/ทำความสะอาดข้อมูลเบื้องต้นก่อนใช้งานจริง
// ---------------------------------------------
$emp_code    = $_POST['emp_code'] ?? '';
$fullname_th = $_POST['fullname_th'] ?? '';
$email       = $_POST['email'] ?? '';
$phone       = $_POST['phone'] ?? '';
$dept_id     = $_POST['dept_id'] ?? '';
$salary      = $_POST['salary'] ?? 0;
$hired_at    = $_POST['hired_at'] ?? '';

// แปลง/ตัดช่องว่างนิดหน่อย
$emp_code    = trim($emp_code);
$fullname_th = trim($fullname_th);
$email       = trim($email);
$phone       = trim($phone);
$salary      = (float)$salary;
$dept_id     = (int)$dept_id;

// สร้างคำสั่ง SQL เก็บในตัวแปรก่อน
$sql = "
INSERT INTO employees (emp_code, fullname_th, email, phone, dept_id, salary, hired_at)
VALUES (
    '".mysqli_real_escape_string($conn, $emp_code)."',
    '".mysqli_real_escape_string($conn, $fullname_th)."',
    '".mysqli_real_escape_string($conn, $email)."',
    '".mysqli_real_escape_string($conn, $phone)."',
    {$dept_id},
    {$salary},
    '".mysqli_real_escape_string($conn, $hired_at)."'
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
