<?php
$db_name = "Exam";
$username = "root";
$pass = "";
$serverName = "localhost";
$conn = mysqli_connect($serverName, $username, $pass, $db_name);

if($conn){
    echo "Connection success";
} else {
    echo "Connction fail";
}