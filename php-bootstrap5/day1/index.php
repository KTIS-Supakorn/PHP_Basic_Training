<!DOCTYPE html>
<html lang="th" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มบันทึกข้อมูล</title>
    <!-- Bootstrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-house"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>++
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-box"></i> Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-apple"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-basket"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1><i class="bi bi-cake"></i> ศุภกร ขำสุวรรณ PHP</h1>
        <h2><i class="bi bi-camera"></i> Supakorn Khamsuwan</h2>
        <hr>
    
        <form action="action_index.php" method="post">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fname" class="form-label">ชื่อ <code>*</code></label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="กรอกชื่อ" value="" required>
                </div>
                <div class="col-md-6">
                    <label for="lname" class="form-label">นามสกุล <code>*</code></label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="กรอกนามสกุล" value="" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nickname">ชื่อเล่น</label>
                    <input type="text" class="form-control" name="nickname" id="nickname" value="">
                </div>
                <div class="col-md-6">
                    <label for="bday">วัน/เดือน/ปี เกิด <i class="bi bi-cake"></i></label>
                    <input type="date" name="birthday" id="birthday" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">ที่อยู่</label>
                <textarea class="form-control" id="address" name="address" rows="5" placeholder="กรอกที่อยู่"></textarea>
            </div>

            <div class="mb-3">
                <label for="province" class="form-label">จังหวัด</label>
                <select class="form-select" id="province" name="province">
                    <option selected disabled>-- เลือกจังหวัด --</option>
                    <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                    <option value="กระบี่">กระบี่</option>
                    <option value="กาญจนบุรี">กาญจนบุรี</option>
                    <option value="กาฬสินธุ์">กาฬสินธุ์</option>
                    <option value="กำแพงเพชร">กำแพงเพชร</option>
                    <option value="ขอนแก่น">ขอนแก่น</option>
                    <option value="จันทบุรี">จันทบุรี</option>
                    <option value="ฉะเชิงเทรา">ฉะเชิงเทรา</option>
                    <option value="ชลบุรี">ชลบุรี</option>
                    <option value="ชัยนาท">ชัยนาท</option>
                    <option value="ชัยภูมิ">ชัยภูมิ</option>
                    <option value="ชุมพร">ชุมพร</option>
                    <option value="เชียงราย">เชียงราย</option>

                </select>
            </div>

            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> บันทึกข้อมูล </button>
            <button type="reset" class="btn btn-danger"><i class="bi bi-x-circle"></i> ยกเลิก </button>
        </form>
    </div>
</body>

</html>