<?php
//delete_employee.php
require 'cnn_db.php';
$id = isset($_GET['id_delete']) ? (int)$_GET['id_delete'] : 0;
$sql = "DELETE FROM employees WHERE id = {$id} LIMIT 1";
$query = mysqli_query($conn, $sql);

if ($query) {
    set_SweetAlert2('error', 'ลบข้อมูลสำเร็จ', "ลบพนักงาน (ID: {$id}) เรียบร้อยแล้ว");
} else {
    set_SweetAlert2('error', 'เกิดข้อผิดพลาด', mysqli_error($conn));
}
header('Location: employees.php');
exit;