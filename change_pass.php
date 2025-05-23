<?php

$conn = new mysqli("localhost", "root", "", "exam");

if(isset($_POST['StudentID']) && isset($_POST['StudentPass'])){
    $student_id = $_POST['StudentID'];
    $student_pass = $_POST['StudentPass'];

    $change_pass_query = "UPDATE students SET StudentPass = '$student_pass' WHERE StudentID = '$student_id'";

    $result = $conn->query($change_pass_query);

    if($result){
        echo json_encode(["change password success" => true]);
    } else {
        echo json_encode(["change password success" => false]);
    }
}
$conn->close();
?>