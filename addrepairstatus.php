<?php
// Connect Database
require "dbconnect.php";

// Get memberid from URL
$ssid = isset($_GET["ssid"]) ? $_GET["ssid"] : '';
// echo $memberid;
if(isset($ssid)){
    // Query product detial from DB
    $sql = "select * from repairstatus where ssid = '".$ssid."'";
    $result = $conn->query($sql);
    $rowitem = $result->fetch_assoc();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($ssid)){
        //Get the posted data
        $ssid = $_POST["ssid"];
        $sstatus = $_POST["sstatus"];
        $ssdetail = $_POST["ssdetail"];
        $ssdate = $_POST["ssdate"];
        //echo $memberid." ".$namemem." ".$phonemem." ".$emailmem." ".$pointmember;

        $sql = 'insert into repairstatus (ssid, sstatus, ssdetail, ssdate) values (?, ?, ?,  ?)'; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('isss', $ssid, $sstatus, $ssdetail, $ssdate); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to Member.php
        header('Location: repairstatus.php');
        exit();
    }else{
        //Update product
        //Get the posted data
        $sstatus = $_POST["sstatus"];
        $ssdetail = $_POST["ssdetail"];
        $ssdate = $_POST["ssdate"];
        echo "Update<br>";
        echo $ssid." ".$sstatus." ".$ssdetail." ".$ssdate;

        $sql = 'update repairstatus set sstatus = ?, ssdetail = ?, ssdate = ? where ssid = ? '; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('sssi',  $sstatus, $ssdetail, $ssdate,  $ssid,); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to member.php
        header('Location: repairstatus.php');
        exit();
    }
}
?>

<?php
include "header.php"
?>

<!-- Body content -->
<div class="container-fluid">
<h1>รายการคืนอุปกรณ์ ( IT ) <?php echo $ssid == '' ? 'Add' : ''; ?> เพิ่มข้อมูลการคืน</h1>
     <form method="post">
        <div class="mb-3">
            <label for="ssid" class="form-label">รหัสการเเจ้งคืน</label>
            <input name="ssid" type="text" class="form-control" id="ssid" value="<?php echo empty($ssid) ? '' : $rowitem["ssid"]; ?>" <?php echo empty($ssid) ? '' : 'disabled'; ?>>
        </div>

        <div class="mb-3">
            <label for="sstatus" class="form-label">สถานะ</label>
            <select name="sstatus" class="form-select" id="sstatus">
                    <option value="" >Choose...</option>
                    <?php 
                        $resultcat = $conn->query("select * from repairstatus");
                        while($row = $resultcat->fetch_assoc()){
                        echo "<option value=\"".$row["sstatus"]."\" ";
                        $catvalue = empty($personid) ? '' : $rowitem["ssid"];
                        if($row["ssid"]==$catvalue){
                            echo "selected";
                        }
                        echo ">".$row["sstatus"]."</option>";
                    }
                    ?>
                </select>
        </div>

        <div class="mb-3">
            <label for="ssdetail" class="form-label">อุปกรณ์</label>
            <input name="ssdetail" type="text" class="form-control" id="ssdetail" value="<?php echo empty($ssid) ? '' : $rowitem["ssdetail"]; ?>">
        </div>
        <div class="mb-3">
            <label for="ssdate" class="form-label">วันที่เเจ้งยืม</label>
            <input name="ssdate" type="date" class="form-control" id="ssdate" value="<?php echo empty($ssid) ? '' : $rowitem["ssdate"]; ?>">
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="repairstatus.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
$conn->close();
?>

<?php
include "footer.php"
?>