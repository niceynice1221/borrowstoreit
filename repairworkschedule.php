<?php
    require "dbconnect.php";
    
    // Get parameter's value from URL
    $repairworkschedule = isset($_GET["wsid"])? $_GET["wsid"] : '';
    $repairworkschedules = isset($_GET["psid"])? $_GET["psid"] : '';
 
    if($repairworkschedule != "" || $repairworkschedules != ""){
        if($repairworkschedule != "" &&  $repairworkschedules == ""){
            $sql = "SELECT * FROM repairworkschedule where wsid = '".$repairworkschedule."'";
        }elseif($repairworkschedule == "" &&  $repairworkschedules != ""){
            $sql = "SELECT * FROM repairworkschedule where psid = '".$repairworkschedules."'";
        }else{
            $sql = "SELECT * FROM repairworkschedule where wsid = '".$repairworkschedule."' and psid = '".$typevalue."'";
        }
    }else{
        $sql = "select * from repairworkschedule ";
    }
    // echo $sql;
    $result = $conn->query($sql);
    $no = $result->num_rows;

    

?>
<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Borrow-Restore IT equipment</title>
</head>
<body class = "container-fluid">
    <h1>ตารางการยืม-คืน อุปกรณ์ ( IT) </h1>
    <a class="btn btn-primary float-end bi bi-list-columns-reverse" href="addrepairworkschedule.php" role="button">    เพิ่มข้อมูล </a>
        <form class="row row-cols-lg-auto g-3 align-items-center" method="get" action="">
            <div class="col-3">
                <label class="visually-hidden" for="InlineFormSelectPref">Preference</label>
                <select name="wsid" class="form-select" id="wsid">
                    <option value="">อุปกรณ์ไอที</option>
                    <?php 
                        $resulttype = $conn->query("select * from repairworkschedule");
                        while($row = $resulttype->fetch_assoc()){
                        echo "<option value=\"".$row["wsid"]."\"";
                        if($row["wsid"]== $repairworkschedule){
                            echo "selected";
                        }
                        echo ">".$row["wsname"]."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-3">
                <label class="visually-hidden" for="repairworkschedules">Preference</label>
                <select name="repairworkschedules" class="form-select" id="repairworkschedules">
                    <option value="">รหัสการยืม</option>
                    <?php 
                        $resulttype = $conn->query("select * from repairworkschedule");
                        while($row = $resulttype->fetch_assoc()){
                        echo "<option value=\"".$row["psid"]."\"";
                        if($row["psid"]==$repairworkschedules){
                            echo "selected";
                        }
                        echo ">".$row["psid"]."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-warning bi bi-search"> ค้นหา</button>
            </div>
        </form>

    <p>ตารางการยืม-คืนทั้งหมด <?php echo $no;?> รายการ.</p>

    <!-- <ol>
    <?php 
        //while($row = $result->fetch_assoc()){
        //    echo "<li>".$row["psdate"]." ".$row["unitprice"].""."$row["wsid"]." "$row["psname"]." "$row["psphone"]." "$row["pstatus"]." "</li>";
        //}
    ?>    
    </ol> -->

    <div class="container-fluid">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">รหัสตาราง</th>
                <th scope="col">วันที่เเจ้งยืม-คืน</th>
                <th scope="col">รหัสการยืม</th>
                <th scope="col">อุปกรณ์</th>
                <th scope="col">สถานะ</th> 
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $count = 1;
                    while($row = $result->fetch_assoc()){
                  
                ?>
                <tr>
                <th scope="row"><?php echo $count;?></th>
                <td><?php echo $row["wsid"];?></td>
                <td><?php echo $row["wsdate"];?></td>
                <td><?php echo $row["psid"];?></td>
                <td><?php echo $row["wslist"];?></td>
                <td><?php echo $row["wsname"];?></td>
                <td></td>
                <td><a class="btn btn-outline-warning" href="addrepairworkschedule.php?wsid=<?php echo $row["wsid"];?>" role="button"><i class="bi bi-pencil-square"></i></a>
                <a class="btn btn-outline-danger" href="deleteworkschedule.php?wsid=<?php echo $row["wsid"];?>" role="button"><i class="bi bi-trash3"></i></a></td>
                </tr>
                <?php
                    $count = $count +
                    1;
                }
                ?>

            </tbody>
            </table>
    </div>

<?php $conn->close(); ?>
</body>
</html>
<?php
include "footer.php";
?>