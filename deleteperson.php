<?php
// Connect Database
require("dbconnect.php");

// 1. Get the itemid
$psid = isset($_GET["psid"]) ? $_GET["psid"] : '';
// echo $itemid;

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // 3. Prepare sql and bind parameters
    $sql = 'delete from repairperson where psid = ?';
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $psid);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: repairperson.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>ระบบแจ้งซ่อมคอมพิวเตอร์</title>
</head>
<body class="container">
    <h1>ระบบแจ้งซ่อมคอมพิวเตอร์: ลบข้อมูลลูกค้า</h1>

    <?php 
        // 2. Get the product detail
        $sql = "select * from repairperson where psid = '".$psid."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    <p>คุณต้องการลบหรือไม่ ? <b><?php echo $row["psid"];?></b></p>
    <form method="post">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="repairperson.php" class="btn btn-secondary">Cancel</a>
    </form>

<?php
$conn->close();
?>
    
</body>
</html>