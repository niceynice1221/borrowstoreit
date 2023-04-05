<?php
// Connect Database
require("dbconnect.php");

// Get memberid from URL
$mid = isset($_GET["mid"]) ? $_GET["mid"] : '';
// echo $memberid;
if(isset($mid)){
    // Query product detial from DB
    $sql = "select * from repairman where mid = '".$mid."'";
    $result = $conn->query($sql);
    $rowitem = $result->fetch_assoc();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($mid)){
        //Get the posted data
        $mid = $_POST["mid"];
        $mname = $_POST["mname"];
        $mphone = $_POST["mphone"];
        $mstatus = $_POST["mstatus"];
        $mdate = $_POST["mdate"];

        $sql = 'insert into repairman (mid, mname, mphone, mstatus, mdate) values ( ?, ?, ?, ?, ?)'; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('issss', $mid, $mname, $mphone, $mstatus, $mdate); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to Member.php
        header('Location:repairman.php');
        exit();
    }else{
        //Update product
        //Get the posted data
        $mname = $_POST["mname"];
        $mphone = $_POST["mphone"];
        $mstatus = $_POST["mstatus"];
        $mdate = $_POST["mdate"];
        echo "Update<br>";
        echo $mid." ".$mname." ".$mphone." ".$mstatus." ".$mdate;

        $sql = 'update repairman set  mname = ?, mphone = ? , mstatus = ?, mdate = ? where mid = ? '; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('ssssi', $mname,$mphone,$mstatus,$mdate,$mid); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to member.php
        header('Location: repairman.php');
        exit();
    }
}
?>

<?php
include "header.php"
?>

<!-- Body content -->
<div class="container-fluid">
<h1>ระบบยืม-คืน อุปกรณ์ (IT)  <?php echo $mid == '' ? 'Add' : ' '; ?> เพิ่มข้อมูลพนักงาน</h1>
     <form method="post">
        <div class="mb-3">
            <label for="mid" class="form-label">รหัสพนักงาน</label>
            <input name="mid" type="text" class="form-control" id="mid" value="<?php echo empty($mid) ? '' : $rowitem["mid"]; ?>" <?php echo empty($mid) ? '' : 'disabled'; ?>>
        </div>
        <div class="mb-3">
            <label for="mname" class="form-label">ชื่อพนักงาน</label>
            <input name="mname" type="text" class="form-control" id="mname" value="<?php echo empty($mid) ? '' : $rowitem["mname"]; ?>">
        </div>
        <div class="mb-3">
            <label for="mphone" class="form-label">เบอร์โทรศัพท์</label>
            <input name="mphone" type="text" class="form-control" id="mphone" value="<?php echo empty($mid) ? '' : $rowitem["mphone"]; ?>">
        </div>

        <div class="mb-3">
            <label for="mdate" class="form-label">วันเข้าทำงานพนักงาน</label>
            <input name="mdate" type="date" class="form-control" id="mdate" value="<?php echo empty($mid) ? '' : $rowitem["mdate"]; ?>">
        </div>

        <div class="mb-3">
            <label for="mstatus" class="form-label">สถานะ</label>
            <select name="mstatus" class="form-select" id="mstatus">
                    <option value="" >Choose...</option>
                    <?php 
                        $resultcat = $conn->query("select * from repairman");
                        while($row = $resultcat->fetch_assoc()){
                        echo "<option value=\"".$row["mstatus"]."\" ";
                        $catvalue = empty($personid) ? '' : $rowitem["mstatus"];
                        if($row["mstatus"]==$catvalue){
                            echo "selected";
                        }
                        echo ">".$row["mstatus"]."</option>";
                    }
                    ?>
                </select>
        </div>

        <button type="repairman" class="btn btn-primary">Save</button>
        <a href="repairman.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
$conn->close();
?>

<?php
include "footer.php"
?>