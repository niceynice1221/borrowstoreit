<?php  
    $conn = new mysqli('localhost', 'root', '', 'rpcom', 3306);
    if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error); 
    }else{
        //echo "Connected Successful";
    }

    $conn->set_charset('utf8');
?>
