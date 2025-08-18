<!DOCTYPE html>
<html lang="th" data-bs-theme="dark">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <h1>การรับค่า POST</h1>
        <h4>ชื่อ: <?=$_POST["fname"];?></h4>
        <h4>นามสกุล: <?=$_POST["lname"];?></h4>
        <h4>ชื่อเล่น: <?=$_POST["nickname"];?></h4>
        <h4>วันเกิด: <?=$_POST["birthday"];?></h4>
        <h4>ที่อยู่: <?=$_POST["address"];?></h4>
    </div>

</body>

</html>