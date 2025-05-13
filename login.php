<?php
$conn = new mysqli("localhost", "root", "", "exam");


if(isset($_POST['StudentID']) && isset($_POST['StudentPass'])){
    if(isset($_POST['StudentID']) && isset($_POST['StudentPass'])){
    $student_id = $_POST['StudentID'];
    $student_pass = $_POST['StudentPass'];
    
    $login_query = "SELECT StudentID FROM students WHERE StudentID = '$student_id' AND StudentPass = '$student_pass'";
    
    $result = $conn->query($login_query);
    
    if($result->num_rows > 0){
        echo json_encode(["login success" => true]);
    } else {
        echo json_encode(["login success" => false]);
    }
    }
}
$conn->close();
?>