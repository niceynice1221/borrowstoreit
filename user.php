<?php

session_start();
require_once 'config/db.php';
if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: signin.php');
}
include "header.php";


?>

<body>


    <div class="container">
        <?php

        if (isset($_SESSION['user_login'])) {
            $user_id = $_SESSION['user_login'];
            $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        ?>
        <h3 class="mt-4">Welcome <?php echo $row['firstname'] . ' ' . $row['lastname'] ?></h3>
    </div>
            
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h3>ระบบเเจ้งซ่อมคอมพิวเตอร์ & โน๊ตบุ๊ค</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo">Add User</button>
            </div>
        </div>
        <hr>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']); 
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); 
                ?>
            </div>
        <?php } ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">วันที่เเจ้งซ่อม</th>
                    <th scope="col">ใบเเจ้งซ่อม</th>
                    <th scope="col">ชื่อผู้เเจ้งซ่อม</th>
                    <th scope="col">เบอร์โทร</th>
                    <th scope="col">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $stmt = $conn->query("SELECT * FROM repairperson");
                    $stmt->execute();
                    $repairperson = $stmt->fetchAll();

                    if (!$repairperson) {
                        echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                    } else {
                    foreach($repairperson as $repairperson)  {  
                ?>
                    <tr>
                        <th scope="row"><?php echo $repairperson['psdate']; ?></th>
                        <td><?php echo $repairperson['psid']; ?></td>
                        <td><?php echo $repairperson['psname']; ?></td>
                        <td><?php echo $repairperson['psphone']; ?></td>
                        <td><?php echo $repairperson['psstatus']; ?></td>
                        <td><?php echo $repairperson['psphone']; ?></td>
                        <td width="250px"><img class="rounded" width="100%" src="uploads/<?php echo $user['img']; ?>" alt=""></td>
                        <td>
                            <a href="edit.php?id=<?php echo $user['psid']; ?>" class="btn btn-warning">Edit</a>
                            <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $user['psid']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php }  } ?>
            </tbody>
            </table>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }

    </script>
