<?php
$conn = new mysqli("localhost", "root", "", "exam");

if(isset($_POST['StudentID'])){
    $student_id = $_POST['StudentID'];

    $get_current_pass = "SELECT StudentPass FROM Students WHERE StudentID = '$student_id'";

    $result = $conn->query($get_current_pass);

    if($result->num_rows > 0){
        echo json_encode(["get current password success" => true]);
        echo json_encode(["current password" => $result]);
    } else {
        echo json_encode(["get current password success" => false]);
    }
}
$conn->close();
?>