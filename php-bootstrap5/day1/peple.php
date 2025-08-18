<?php
// ------- ตั้งค่าเชื่อมต่อฐานข้อมูล -------
$host = 'localhost';
$db   = 'people_db';
$user = 'root';    // <- แก้ตามเครื่อง
$pass = '';        // <- แก้ตามเครื่อง
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

$msg = '';
$errors = [];

try {
  $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
  die('เชื่อมต่อฐานข้อมูลไม่ได้: ' . $e->getMessage());
}

// ------- ถ้ามีการส่งฟอร์ม (POST) ให้บันทึก -------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $first = trim($_POST['first_name'] ?? '');
  $last  = trim($_POST['last_name'] ?? '');
  $nick  = trim($_POST['nickname'] ?? '');
  $birth = trim($_POST['birthday'] ?? '');
  $addr  = trim($_POST['address'] ?? '');

  if ($first === '') $errors[] = 'กรุณากรอกชื่อ';
  if ($last  === '') $errors[] = 'กรุณากรอกนามสกุล';

  // แปลงค่าวันเกิดให้เป็น NULL ถ้าไม่กรอก
  if ($birth === '') $birth = null;

  if (!$errors) {
    $sql = "INSERT INTO people (first_name, last_name, nickname, birthday, address)
            VALUES (:first, :last, :nick, :birth, :addr)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':first' => $first,
      ':last'  => $last,
      ':nick'  => $nick !== '' ? $nick : null,
      ':birth' => $birth,
      ':addr'  => $addr !== '' ? $addr : null,
    ]);
    $msg = 'บันทึกข้อมูลเรียบร้อยแล้ว (ID ใหม่: #' . $pdo->lastInsertId() . ')';
    // เคลียร์ค่าในฟอร์มหลังบันทึกสำเร็จ
    $_POST = [];
  }
}

// ฟังก์ชันกัน XSS แบบสั้นๆ
function e($v){ return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="th" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <title>เพิ่มข้อมูลบุคคล (ง่ายสุด)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-dark">
<div class="container py-4" style="max-width: 720px;">
  <h1 class="h4 mb-3"><i class="bi bi-person-plus me-2"></i>เพิ่มข้อมูลบุคคล</h1>

  <?php if ($msg): ?>
    <div class="alert alert-success"><?= e($msg) ?></div>
  <?php endif; ?>

  <?php if ($errors): ?>
    <div class="alert alert-danger">
      <div class="fw-semibold mb-1">กรุณาตรวจสอบ:</div>
      <ul class="mb-0">
        <?php foreach ($errors as $er): ?>
          <li><?= e($er) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form method="post" class="row g-3">
        <div class="col-md-6">
          <label class="form-label">ชื่อ <span class="text-danger">*</span></label>
          <input type="text" name="first_name" class="form-control" required value="<?= e($_POST['first_name'] ?? '') ?>">
        </div>
        <div class="col-md-6">
          <label class="form-label">นามสกุล <span class="text-danger">*</span></label>
          <input type="text" name="last_name" class="form-control" required value="<?= e($_POST['last_name'] ?? '') ?>">
        </div>
        <div class="col-md-4">
          <label class="form-label">ชื่อเล่น</label>
          <input type="text" name="nickname" class="form-control" value="<?= e($_POST['nickname'] ?? '') ?>">
        </div>
        <div class="col-md-4">
          <label class="form-label">วันเกิด</label>
          <input type="date" name="birthday" class="form-control" value="<?= e($_POST['birthday'] ?? '') ?>">
        </div>
        <div class="col-12">
          <label class="form-label">ที่อยู่</label>
          <textarea name="address" rows="3" class="form-control" placeholder="บ้านเลขที่ / หมู่ / ตำบล / อำเภอ / จังหวัด / รหัสไปรษณีย์"><?= e($_POST['address'] ?? '') ?></textarea>
        </div>
        <div class="col-12 d-flex gap-2">
          <button class="btn btn-success"><i class="bi bi-save me-1"></i> บันทึก</button>
          <button type="reset" class="btn btn-secondary">ล้างฟอร์ม</button>
        </div>
      </form>
    </div>
  </div>

  <p class="text-secondary small mt-3 mb-0">
    * ตาราง <code>people</code> มีคอลัมน์ <code>id</code> เป็น AUTO_INCREMENT (ไอดีออโต้) แล้ว
  </p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
