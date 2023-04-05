<?php
// Connect Database
require("dbconnect.php");

// Get memberid from URL
$psid = isset($_GET["psid"]) ? $_GET["psid"] : '';
// echo $memberid;
if(isset($psid)){
    // Query product detial from DB
    $sql = "select * from repairperson where psid = '".$psid."'";
    $result = $conn->query($sql);
    $rowitem = $result->fetch_assoc();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($psid)){
        //Get the posted data
        $psid = $_POST["psid"];
        $psname = $_POST["psname"];
        $psphone = $_POST["psphone"];
        $psstatus = $_POST["psstatus"];
        $psdate = $_POST["psdate"];

        $sql = 'insert into repairperson (psid, psname, psphone, psstatus, psdate) values ( ?, ?, ?, ?,  ?)'; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('issss', $psid, $psname, $psphone, $psstatus, $psdate); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to Member.php
        header('Location:repairperson.php');
        exit();
    }else{
        //Update product
        //Get the posted data
        $psname = $_POST["psname"];
        $psphone = $_POST["psphone"];
        $psstatus = $_POST["psstatus"];
        $psdate = $_POST["psdate"];
        echo "Update<br>";
        echo $psid." ".$psname." ".$psphone." ".$psstatus." ".$psdate;

        $sql = 'update repairperson set  psname = ?, psphone = ? , psstatus = ?, psdate = ?  where psid = ? '; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('ssssi', $psname,$psphone,$psstatus,$psdate,$psid); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to member.php
        header('Location: repairperson.php');
        exit();
    }
}
?>

<?php
include "header.php"
?>

<!-- Body content -->
<div class="container-fluid">
<h1>รายการยืมอุปกรณ์ ( IT ) <?php echo $psid == '' ? 'Add' : ' '; ?> เพิ่มข้อมูลการยืม</h1>
     <form method="post">
        <div class="mb-3">
            <label for="psid" class="form-label">รหัสเเจ้งยืม</label>
            <input name="psid" type="text" class="form-control" id="psid" value="<?php echo empty($psid) ? '' : $rowitem["psid"]; ?>" <?php echo empty($psid) ? '' : 'disabled'; ?>>
        </div>
        <div class="mb-3">
            <label for="psname" class="form-label">ชื่อผู้แจ้งยืม</label>
            <input name="psname" type="text" class="form-control" id="psname" value="<?php echo empty($psid) ? '' : $rowitem["psname"]; ?>">
        </div>
        <div class="mb-3">
            <label for="psphone" class="form-label">เบอร์โทรศัพท์</label>
            <input name="psphone" type="text" class="form-control" id="psphone" value="<?php echo empty($psid) ? '' : $rowitem["psphone"]; ?>">
        </div>

        <div class="mb-3">
            <label for="psdate" class="form-label">วันที่เเจ้งยืม</label>
            <input name="psdate" type="date" class="form-control" id="psdate" value="<?php echo empty($psid) ? '' : $rowitem["psdate"]; ?>">
        </div>

        <div class="mb-3">
            <label for="psstatus" class="form-label">สถานะ</label>
            <select name="psstatus" class="form-select" id="psstatus">
                    <option value="" >Choose...</option>
                    <?php 
                        $resultcat = $conn->query("select * from repairperson");
                        while($row = $resultcat->fetch_assoc()){
                        echo "<option value=\"".$row["psstatus"]."\" ";
                        $catvalue = empty($personid) ? '' : $rowitem["psstatus"];
                        if($row["psstatus"]==$catvalue){
                            echo "selected";
                        }
                        echo ">".$row["psstatus"]."</option>";
                    }
                    ?>
                </select>
        </div>

    

        <button type="repairperson" class="btn btn-primary">Save</button>
        <a href="repairperson.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
$conn->close();
?>

<?php
include "footer.php"
?>