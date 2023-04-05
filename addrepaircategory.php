<?php
// Connect Database
require "dbconnect.php";

// Get memberid from URL
$ctgrid = isset($_GET["ctgrid"]) ? $_GET["ctgrid"] : '';
// echo $memberid;
if(isset($ctgrid)){
    // Query product detial from DB
    $sql = "select * from repaircategory where ctgrid = '".$ctgrid."'";
    $result = $conn->query($sql);
    $rowitem = $result->fetch_assoc();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($ctgrid)){
        //Get the posted data
        $ctgrid = $_POST["ctgrid"];
        $ctgrname = $_POST["ctgrname"];
        //echo $memberid." ".$namemem." ".$phonemem." ".$emailmem." ".$pointmember;

        $sql = 'insert into repaircategory (ctgrid, ctgrname) values (?, ?)'; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('is', $ctgrid, $ctgrname, ); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to Member.php
        header('Location: repaircategory.php');
        exit();
    }else{
        //Update product
        //Get the posted data
        $ctgrname = $_POST["ctgrname"];
        echo "Update<br>";
        echo $ctgrid." ".$ctgrname;

        $sql = 'update repaircategory set ctgrname = ?, where ctgrid = ? '; 
        $statement = $conn->prepare($sql); 
        $statement->bind_param('si', $ctgrname, $ctgrid,); 
        $result = $statement->execute(); 
        if (!$result) { 
            die('Execute failed: ' . $statement->error); 
        }

        // Redirect page to member.php
        header('Location: repaircategory.php');
        exit();
    }
}
?>

<?php
include "header.php"
?>

<!-- Body content -->
<div class="container-fluid">
<h1>ระบบซ่อมคอมพิวเตอร์ <?php echo $ctgrid == '' ? 'Add' : ''; ?> เพิ่มหมวดหมู่อุปกรณ์</h1>
     <form method="post">
        <div class="mb-3">
            <label for="ctgrid" class="form-label">	รหัสหมวดหมู่อุปกรณ์</label>
            <input name="ctgrid" type="text" class="form-control" id="ctgrid" value="<?php echo empty($ctgrid) ? '' : $rowitem["ctgrid"]; ?>" <?php echo empty($ctgrid) ? '' : 'disabled'; ?>>
        </div>
        <div class="mb-3">
            <label for="ctgrname" class="form-label"> หมวดหมู่อุปกรณ์ </label>
            <input name="ctgrname" type="text" class="form-control" id="ctgrname" value="<?php echo empty($ctgrid) ? '' : $rowitem["ctgrname"]; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="repaircategory.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
$conn->close();
?>

<?php
include "footer.php"
?>