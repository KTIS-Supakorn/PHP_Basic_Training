<?php
//delete_departments.php
require 'cnn_db.php';

// ✅ รับค่า id จาก URL (Query String) และแปลงเป็นตัวเลข
$id = isset($_GET['id_delete']) ? (int)$_GET['id_delete'] : 0;

// ✅ ตรวจว่ามีพนักงานใช้ฝ่ายนี้อยู่หรือไม่
$sql_count = "SELECT COUNT(*) AS cout_employees FROM employees WHERE dept_id = {$id}";
$res_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($res_count);
$in_use = (int)$row_count['cout_employees'];

if ($in_use > 0) {
    set_SweetAlert2(
        'warning',
        'ลบไม่สำเร็จ',
        "ไม่สามารถลบฝ่าย (ID: {$id}) ได้ เนื่องจากมีพนักงานใช้งานอยู่จำนวน {$in_use} รายการ"
    );
    header('Location: departments.php');
    exit;
}

$sql = "DELETE FROM departments WHERE id = {$id} LIMIT 1";
$query = mysqli_query($conn, $sql);
// if ($query) {
//       echo "<script>
//         alert('ลบข้อมูลสำเร็จ');
//         window.location = 'departments.php';
//     </script>";
//     exit;
// } else {
//     echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
// }
if ($query) {
    set_SweetAlert2('error', 'ลบข้อมูลสำเร็จ', "ลบฝ่าย (ID: {$id}) เรียบร้อยแล้ว");
} else {
    set_SweetAlert2('error', 'เกิดข้อผิดพลาด', mysqli_error($conn));
}
header('Location: departments.php');
exit;