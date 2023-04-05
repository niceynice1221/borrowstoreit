<?php
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "rpcom";
 
$objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);
 
if(trim($_POST["name"]) == "")
{
echo "Please input Username!";
exit();
}
 
if(trim($_POST["password"]) == "")
{
echo "Please input Password!";
exit();
}
 
if($_POST["password"] != $_POST["confirmpassword"])
{
echo "Password not Match!";
exit();
}

if(trim($_POST["email"]) == "")
{
echo "Please input Email!";
exit();
}

 
$strSQL = "SELECT * FROM login WHERE name = '".trim($_POST['name'])."' ";
$objQuery = mysqli_query($objCon,$strSQL);
$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);

if($objResult)
{
 echo "Username already exists!"; 
}
else
{
 
$strSQL = "INSERT INTO login (name,password,email) VALUES ('".$_POST["name"]."',
'".$_POST["password"]."','".$_POST["email"]."')";
$objQuery = mysqli_query($objCon,$strSQL);
 echo "Register Completed!<br>";
 
echo "<br> Go to <a href='signin.php'>Login page</a>";
 
}
 
mysqli_close($objCon);
?>