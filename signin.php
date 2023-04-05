<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Computer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <h3 class="mt-4">เข้าสู่ระบบ ระบบยืม-คืนอุปกรณ์ไอที
        </h3>
        <hr>
        <form action="signin_db.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="name" class="form-control" name="name" aria-describedby="name" id="name">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" name="Submit" class="btn btn-primary btn-block btn-lg " >Login</button>
        </form>
        <hr>
        <p>ยังไม่เป็นสมาชิกใช่ไหม คลิ๊กที่นี่เพื่อ <a href="login.php">สมัครสมาชิก</a></p>
    </div>
    
</body>
</html>