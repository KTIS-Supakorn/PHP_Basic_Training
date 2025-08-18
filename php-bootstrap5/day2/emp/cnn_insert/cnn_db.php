<?php
// db.php - ไฟล์เชื่อมต่อฐานข้อมูล และฟังก์ชันอรรถประโยชน์

// ✅ ตั้งค่าการเชื่อมต่อ (ปรับตามเครื่องของคุณ)
$host = 'localhost';
$user = 'root';
$pass = '';            // ใส่รหัสผ่านของ MySQL
$dbname = 'employees_db';

// ✅ เชื่อมต่อฐานข้อมูลด้วย mysqli (รูปแบบ Procedural)
$conn = mysqli_connect($host, $user, $pass, $dbname);

// ✅ ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die('❌ เชื่อมต่อฐานข้อมูลไม่สำเร็จ: ' . mysqli_connect_error());
}
// else {
//     echo '✅ เชื่อมต่อฐานข้อมูลสำเร็จ<br>';
// }

// ✅ ตั้งค่าชุดอักขระเพื่อรองรับภาษาไทย
mysqli_set_charset($conn, 'utf8mb4');

// ✅ ฟังก์ชัน h() สำหรับ Escape HTML เวลาแสดงผล (ป้องกัน XSS)
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
