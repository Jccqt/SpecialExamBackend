<?php
$conn = new mysqli("localhost", "root", "", "exam");

if(isset($_POST['StudentID'])){
    $student_id = $_POST['StudentID'];

    $get_log_count = "SELECT LogCount FROM Students WHERE StudentID = '$student_id'";

    $result = $conn->query($get_log_count);

    if($result->num_rows > 0){
        $log_count = $result->fetch_assoc();
        echo json_encode(["get logcount success" => true,
                        "logcount" => (int)$log_count['LogCount']]);
 
    } else {
        echo json_encode(["get logcount success" => false]);
    }
}
$conn->close();
?>