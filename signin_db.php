<?php
//session_start();
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "rpcom";
 
$objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);
 
$strSQL = "SELECT * FROM login WHERE name = '".mysqli_real_escape_string($objCon,$_POST['name'])."' and password = '".mysqli_real_escape_string($objCon,$_POST['password'])."'";
$objQuery = mysqli_query($objCon,$strSQL);
$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
if(!$objResult)
{
echo "Username and Password ไม่ถูกต้อง!";
}else{
    echo "Login Completed!<br>";
    echo "<br> Go to <a href='repairman.php'>Repair Computer</a>";
}

mysqli_close($objCon);
?>