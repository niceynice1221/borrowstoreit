<?php
// Connect Database
require "dbconnect.php";

// Get memberid from URL
$ivtrid = isset($_GET["ivtrid"]) ? $_GET["ivtrid"] : '';
// echo $memberid;
if(isset($ivtrid)){
    // Query product detial from DB
    $sql = "select * from repairinventory where ivtrid = '".$ivtrid."'";
    $result = $conn->query($sql);
    $rowitem = $result->fetch_assoc();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($ivtrid)){
        //Get the posted data
        $ivtrid = $_POST["ivtrid"];
        $ctgrid = $_POST["ctgrid"];
        $ivtrname = $_POST["ivtrname"];
        $ivtritem = $_POST["ivtritem"];
        $ivtrprice = $_POST["ivtrprice"];
        //echo $memberid." ".$namemem." ".$phonemem." ".$emailmem." ".$pointmember;

        $sql = 'insert into repairinventory (ivtrid, ctgrid, ivtrname, ivtritem, ivtrprice) values (?, ?, ?, ?, ?)'; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('iisii', $ivtrid,  $ctgrid, $ivtrname, $ivtritem, $ivtrprice); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to Member.php
        header('Location: repairinventory.php');
        exit();
    }else{
        //Update product
        //Get the posted data
        $ctgrid = $_POST["ctgrid"];
        $ivtrname = $_POST["ivtrname"];
        $ivtritem = $_POST["ivtritem"];
        $ivtrprice = $_POST["ivtrprice"];
        echo "Update<br>";
        echo $ivtrid." ".$ivtrname." ".$ivtritem." ".$ivtrprice;

        $sql = 'update repairinventory set ctgrid =?, ivtrname =?, ivtritem =?, ivtrprice =?  where ivtrid = ? '; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('isiii', $ctgrid, $ivtrname, $ivtritem, $ivtrprice, $ivtrid, ); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to member.php
        header('Location: repairinventory.php');
        exit();
    }
}
?>

<?php
include "header.php"
?>

<!-- Body content -->
<div class="container-fluid">
<h1>รายการอุปกรณ์ <?php echo $ivtrid == '' ? 'Add' : ''; ?> เพิ่มข้อมูลอุปกรณ์การยืม-คืน</h1>
     <form method="post">
        <div class="mb-3">
            <label for="ivtrid" class="form-label">	รหัสสินค้า</label>
            <input name="ivtrid" type="text" class="form-control" id="ivtrid" value="<?php echo empty($ivtrid) ? '' : $rowitem["ivtrid"]; ?>" <?php echo empty($ivtrid) ? '' : 'disabled'; ?>>
        </div>
        <div class="mb-3">
            <label for="ctgrid" class="form-label">รหัสหมวดหมู่อุปกรณ์</label>
            <input name="ctgrid" type="text" class="form-control" id="ctgrid" value="<?php echo empty($ivtrid) ? '' : $rowitem["ctgrid"]; ?>">
        </div>
        <div class="mb-3">
            <label for="ivtrname" class="form-label">ชื่อสินค้า</label>
            <input name="ivtrname" type="text" class="form-control" id="ivtrname" value="<?php echo empty($ivtrid) ? '' : $rowitem["ivtritem"]; ?>">
        </div>
        <div class="mb-3">
            <label for="ivtritem" class="form-label">จำนวน</label>
            <input name="ivtritem" type="text" class="form-control" id="ivtritem" value="<?php echo empty($ivtrid) ? '' : $rowitem["ivtritem"]; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="repairinventory.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
$conn->close();
?>

<?php
include "footer.php"
?>