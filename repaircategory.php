<?php
    require "dbconnect.php";
    
    // Get parameter's value from URL
    $ctgrid = isset($_GET["ctgrid"])? $_GET["ctgrid"] : '';
 

    if($ctgrid != "" ){
        if($ctgrid != "" ){
            $sql = "SELECT * FROM repaircategory where ctgrid = '". $ctgrid."'";
        }
        } else{
        $sql = "select * from repaircategory ";
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
    <h1>หมวดหมู่อุปกรณ์</h1>
    <a class="btn btn-primary float-end bi-cart-plus" href="addrepaircategory.php" role="button"> หมวดหมู่อุปกรณ์ </a>
        <form class="row row-cols-lg-auto g-3 align-items-center" method="get" action="">
            <div class="col-3">
                <label class="visually-hidden" for="InlineFormSelectPref">Preference</label>
                <select name="ctgrid" class="form-select" id="ctgrid">
                    <option value="">รหัสหมวดหมู่อุปกรณ์</option>
                    <?php 
                        $resulttype = $conn->query("select * from repaircategory");
                        while($row = $resulttype->fetch_assoc()){
                        echo "<option value=\"".$row["ctgrid"]."\"";
                        if($row["ctgrid"]== $ctgrid){
                            echo "selected";
                        }
                        echo ">".$row["ctgrid"]."</option>";
                    }
                    ?>
                </select>
                
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-warning bi bi-search"> ค้นหา</button>
            </div>
        </form>

    <p>รายการหมวดหมู่อุปกรณ์ทั้งหมด <?php echo $no;?> รายการ.</p>

    <!-- <ol>
    <?php 
        //while($row = $result->fetch_assoc()){
        //    echo "<li>".$row["psdate"]." ".$row["unitprice"].""."$row["psid"]." "$row["psname"]." "$row["psphone"]." "$row["pstatus"]." "</li>";
        //}
    ?>    
    </ol> -->

    <div class="container-fluid">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">รหัสหมวดหมู่อุปกรณ์</th>
                <th scope="col">หมวดหมู่อุปกรณ์</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $count = 1;
                    while($row = $result->fetch_assoc()){
                  
                ?>
                <tr>
                <th scope="row"><?php echo $count;?></th>
                <td><?php echo $row["ctgrid"];?></td>
                <td><?php echo $row["ctgrname"];?></td>
                <td></td>
                <td><a class="btn btn-outline-warning" href="addrepaircategory.php?ctgrid=<?php echo $row["ctgrid"];?>" role="button"><i class="bi bi-pencil-square"></i></a>
                <a class="btn btn-outline-danger" href="deletecategory.php?ctgrid=<?php echo $row["ctgrid"];?>" role="button"><i class="bi bi-trash3"></i></a></td>
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