<?php
// Connect Database
require("dbconnect.php");

// Get memberid from URL
$wsid = isset($_GET["wsid"]) ? $_GET["wsid"] : '';
// echo $memberid;
if(isset($wsid)){
    // Query product detial from DB
    $sql = "select * from repairworkschedule where wsid = '".$wsid."'";
    $result = $conn->query($sql);
    $rowitem = $result->fetch_assoc();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($wsid)){
        //Get the posted data
        $wsid = $_POST["wsid"];
        $psid = $_POST["psid"];
        $ivtrid = $_POST["ivtrid"];
        $ssid = $_POST["ssid"];
        $mid = $_POST["mid"];
        $wsname = $_POST["wsname"];
        $wslist = $_POST["wslist"];
        $wsdate = $_POST["wsdate"];
        //echo $memberid." ".$namemem." ".$phonemem." ".$emailmem." ".$pointmember;

        $sql = 'insert into repairworkschedule (wsid, psid, ivtrid,  ssid, mid, wsname, wslist, wsdate) values (?, ?, ?, ?, ?,?,?,?)'; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('iiiiisss', $wsid, $psid, $ivtrid, $ssid, $mid, $wsname, $wslist, $wsdate); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to Member.php
        header('Location: repairworkschedule.php');
        exit();
    }else{
        //Update product
        //Get the posted data
        $psid = $_POST["psid"];
        $ivtrid = $_POST["ivtrid"];
        $ssid = $_POST["ssid"];
        $mid = $_POST["mid"];
        $wsname = $_POST["wsname"];
        $wslist = $_POST["wslist"];
        $wsdate = $_POST["wsdate"];
        echo "Update<br>";
        echo $wsid." ".$psid." ".$ivtrid." ".$ssid." ".$mid." ".$wsname." ".$wslist." ".$wsdate;

        $sql = 'update repairworkschedule set psid = ?, ivtrid = ?, ssid = ?, mid = ?, wsname = ?, wslist = ?, wsdate = ? where wsid = ? '; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('iiiisssi', $psid, $ivtrid, $ssid, $mid, $wsname, $wslist, $wsdate, $wsid,); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to member.php
        header('Location: repairworkschedule.php');
        exit();
    }
}
?>

<?php
include "header.php"
?>

<!-- Body content -->
<div class="container-fluid">
<h1>ตารางการเเจ้งยืม-คืน <?php echo $wsid == '' ? 'Add' : ''; ?> เพิ่มตารางงานแจ้งยืม-คืน</h1>
     <form method="post">
        <div class="mb-3">
            <label for="wsid" class="form-label">รหัสตาราง</label>
            <input name="wsid" type="text" class="form-control" id="wsid" value="<?php echo empty($wsid) ? '' : $rowitem["wsid"]; ?>" <?php echo empty($wsid) ? '' : 'disabled'; ?>>
        </div>
        <div class="mb-3">
            <label for="psid" class="form-label"> รหัสเเจ้งยืม </label>
            <input name="psid" type="text" class="form-control" id="psid" value="<?php echo empty($wsid) ? '' : $rowitem["psid"]; ?>">
        </div>
        <div class="mb-3">
            <label for="ivtrid" class="form-label"> รหัสอุปกรณ์ </label>
            <input name="ivtrid" type="text" class="form-control" id="ivtrid" value="<?php echo empty($wsid) ? '' : $rowitem["ivtrid"]; ?>">
        </div>
        <div class="mb-3">
            <label for="ssid" class="form-label"> รหัสการเเจ้งคืน </label>
            <input name="ssid" type="text" class="form-control" id="ssid" value="<?php echo empty($wsid) ? '' : $rowitem["ssid"]; ?>">
        </div>
        <div class="mb-3">
            <label for="mid" class="form-label"> รหัสพนักงาน </label>
            <input name="mid" type="text" class="form-control" id="mid" value="<?php echo empty($wsid) ? '' : $rowitem["mid"]; ?>">
        </div>

        <div class="mb-3">
            <label for="wslist" class="form-label">	อุปกรณ์</label>
            <input name="wslist" type="text" class="form-control" id="wslist" value="<?php echo empty($wsid) ? '' : $rowitem["wslist"]; ?>">
        </div>
        <div class="mb-3">
            <label for="wsdate" class="form-label">วันที่เเจ้งยืม-คืน</label>
            <input name="wsdate" type="date" class="form-control" id="wsdate" value="<?php echo empty($wsid) ? '' : $rowitem["wsdate"]; ?>">
        </div>


        <div class="mb-3">
            <label for="wsname" class="form-label">สถานะ</label>
            <select name="wsname" class="form-select" id="wsname">
                    <option value="" >Choose...</option>
                    <?php 
                        $resultcat = $conn->query("select * from repairworkschedule");
                        while($row = $resultcat->fetch_assoc()){
                        echo "<option value=\"".$row["wsname"]."\" ";
                        $catvalue = empty($personid) ? '' : $rowitem["wsid"];
                        if($row["wsname"]==$catvalue){
                            echo "selected";
                        }
                        echo ">".$row["wsname"]."</option>";
                    }
                    ?>
                </select>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="repairworkschedule.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
$conn->close();
?>

<?php
include "footer.php"
?>