<?php
    require "dbconnect.php";
    
    // Get parameter's value from URL
    $repairinventory = isset($_GET["ivtrid"])? $_GET["ivtrid"] : '';
    $repairinventorys = isset($_GET["ctgrid"])? $_GET["ctgrid"] : '';
 
    if($repairinventory != "" || $repairinventorys != ""){
        if($repairinventory != "" &&  $repairinventorys == ""){
            $sql = "SELECT * FROM repairinventory where ivtrid = '".$repairinventory."'";
        }elseif($repairinventory == "" &&  $repairinventorys != ""){
            $sql = "SELECT * FROM repairinventory where ctgrid = '".$repairinventorys."'";
        }else{
            $sql = "SELECT * FROM repairinventory where ivtrid = '".$repairinventory."' and ctgrid = '".$typevalue."'";
        }
    }else{
        $sql = "select * from repairinventory ";
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
    <h1>รายการอุปกรณ์</h1>
    <a class="btn btn-primary float-end bi bi-box-seam" href="addrepairinventory.php" role="button"> อุปกรณ์ </a>
        <form class="row row-cols-lg-auto g-3 align-items-center" method="get" action="">
        <div class="col-3">
                <label class="visually-hidden" for="repairinventorys">Preference</label>
                <select name="repairinventorys" class="form-select" id="repairinventorys">
                    <option value="">รหัสอุปกรณ์</option>
                    <?php 
                        $resulttype = $conn->query("select * from repairinventory");
                        while($row = $resulttype->fetch_assoc()){
                        echo "<option value=\"".$row["ivtrid"]."\"";
                        if($row["ivtrid"]==$repairinventorys){
                            echo "selected";
                        }
                        echo ">".$row["ivtrid"]."</option>";
                    }
                    ?>
                </select>
            </div>   
        <div class="col-3">
                <label class="visually-hidden" for="InlineFormSelectPref">Preference</label>
                <select name="ivtrid" class="form-select" id="ivtrid">
                    <option value="">ชื่อสินค้า</option>
                    <?php 
                        $resulttype = $conn->query("select * from repairinventory");
                        while($row = $resulttype->fetch_assoc()){
                        echo "<option value=\"".$row["ivtrid"]."\"";
                        if($row["ivtrid"]== $repairinventory){
                            echo "selected";
                        }
                        echo ">".$row["ivtrname"]."</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="col-3">
                <button type="submit" class="btn btn-warning bi bi-search"> ค้นหา</button>
            </div>
        </form>

    <p>อุปกรณ์ทั้งหมด <?php echo $no;?> รายการ.</p>

    <!-- <ol>
    <?php 
        //while($row = $result->fetch_assoc()){
        //    echo "<li>".$row["psdate"]." ".$row["unitprice"].""."$row["ivtrid"]." "$row["psname"]." "$row["psphone"]." "$row["pstatus"]." "</li>";
        //}
    ?>    
    </ol> -->

    <div class="container-fluid">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">รหัสอุปกรณ์</th>
                <th scope="col">ชื่ออุปกรณ์</th>
                <th scope="col">จำนวนอุปกรณ์</th>
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
                <td><?php echo $row["ivtrid"];?></td>
                <td><?php echo $row["ivtrname"];?></td>
                <td><?php echo $row["ivtritem"];?></td>
                <td></td>
                <td><a class="btn btn-outline-warning" href="addrepairinventory.php?ivtrid=<?php echo $row["ivtrid"];?>" role="button"><i class="bi bi-pencil-square"></i></a>
                <a class="btn btn-outline-danger" href="deleteinventory.php?ivtrid=<?php echo $row["ivtrid"];?>" role="button"><i class="bi bi-trash3"></i></a></td>
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