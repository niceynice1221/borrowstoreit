<?php
    require "dbconnect.php";
    
    // Get parameter's value from URL
    $manvalue = isset($_GET["mid"])? $_GET["mid"] : '';
 

    if($manvalue != "" ){
        if($manvalue != "" ){
            $sql = "SELECT * FROM repairman where mid = '". $manvalue."'";
        }
        } else{
        $sql = "select * from repairman ";
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
    <title>Repair Computer</title>
</head>
<body class = "container-fluid">
    <h1>พนักงาน( IT )</h1>
    <a class="btn btn-primary float-end bi bi-person-fill-add" href="addrepairman.php" role="button"> พนักงาน </a>
        <form class="row row-cols-lg-auto g-3 align-items-center" method="get" action="">
            <div class="col-3">
                <label class="visually-hidden" for="InlineFormSelectPref">Preference</label>
                <select name="mid" class="form-select" id="mid">
                    <option value="">รหัสพนักงาน</option>
                    <?php 
                        $resulttype = $conn->query("select * from repairman");
                        while($row = $resulttype->fetch_assoc()){
                        echo "<option value=\"".$row["mid"]."\"";
                        if($row["mid"]== $manvalue){
                            echo "selected";
                        }
                        echo ">".$row["mid"]."</option>";
                    }
                    ?>
                </select>
                
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-warning bi bi-search"> ค้นหา</button>
            </div>
        </form>

    <p>พนักงานไอทีมีทั้งหมด <?php echo $no;?> รายการ.</p>

    <!-- <ol>
    <?php 
        //while($row = $result->fetch_assoc()){
        //    echo "<li>".$row["psdate"]." ".$row["unitprice"].""."$row["mid"]." "$row["psname"]." "$row["psphone"]." "$row["pstatus"]." "</li>";
        //}
    ?>    
    </ol> -->

    <div class="container-fluid">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">รหัสพนักงาน</th>
                <th scope="col">ชื่อพนักงาน</th>
                <th scope="col">เบอร์โทรศัพท์</th>
                <th scope="col">สถานะพนักงาน</th>
                <th scope="col">วันที่พนักงานเข้างาน</th> 
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
                <td><?php echo $row["mid"];?></td>
                <td><?php echo $row["mname"];?></td>
                <td><?php echo $row["mphone"];?></td>
                <td><?php echo $row["mstatus"];?></td>
                <td><?php echo $row["mdate"];?></td>
                <td></td>
                <td><a class="btn btn-outline-warning" href="addrepairman.php?mid=<?php echo $row["mid"];?>" role="button"><i class="bi bi-pencil-square"></i></a>
                <a class="btn btn-outline-danger" href="deleteman.php?mid=<?php echo $row["mid"];?>" role="button"><i class="bi bi-trash3"></i></a></td>
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